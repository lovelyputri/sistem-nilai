<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // --- Filter Semester ---
        // Tidak ada kolom semester di database, jadi semester ditentukan otomatis
        // dari bulan Nilai::created_at: Juli-Desember = Ganjil, Januari-Juni = Genap.
        // Ini berlaku lintas tahun (menggabungkan semua tahun untuk semester yang sama).
        $semester = $request->query('semester', 'all'); // all | ganjil | genap

        $bulanSemester = [
            'ganjil' => [7, 8, 9, 10, 11, 12],
            'genap'  => [1, 2, 3, 4, 5, 6],
        ];

        $filterSemester = function ($query) use ($semester, $bulanSemester) {
            if (isset($bulanSemester[$semester])) {
                $bulan = implode(',', $bulanSemester[$semester]);
                $query->whereRaw("MONTH(created_at) IN ($bulan)");
            }
            return $query;
        };

        $totalGuru          = User::where('role', 'guru')->count();
        $totalMataPelajaran = MataPelajaran::count();
        $totalSiswa         = Siswa::count();
        $totalNilai         = $filterSemester(Nilai::query())->count();

        $statistik = [
            'total_guru'           => $totalGuru,
            'total_mata_pelajaran' => $totalMataPelajaran,
            'total_siswa'          => $totalSiswa,
            'total_nilai'          => $totalNilai,
        ];

        // Perbaikan key 'nilai terendah' -> 'nilai_terendah' agar konsisten
        $statistikNilai = [
            'rata_rata'                => round($filterSemester(Nilai::query())->avg('nilai') ?? 0, 2),
            'nilai_tertinggi'          => $filterSemester(Nilai::query())->max('nilai') ?? 0,
            'nilai_terendah'           => $filterSemester(Nilai::query())->min('nilai') ?? 0,
            'total_siswa_punya_nilai'  => $filterSemester(Nilai::query())->distinct('id_siswa')->count('id_siswa'),
        ];

        // --- Distribusi Nilai (untuk bar chart) ---
        $rentangNilai = [
            '0 - 20'   => [0, 20],
            '21 - 40'  => [21, 40],
            '41 - 60'  => [41, 60],
            '61 - 80'  => [61, 80],
            '81 - 100' => [81, 100],
        ];

        $distribusiNilai = [];
        foreach ($rentangNilai as $label => $range) {
            $distribusiNilai[] = [
                'label' => $label,
                'total' => $filterSemester(Nilai::whereBetween('nilai', $range))->count(),
            ];
        }
        $maxDistribusi = collect($distribusiNilai)->max('total') ?: 1;

        // --- Nilai per Mata Pelajaran (untuk donut chart) ---
        // Asumsi: relasi MataPelajaran hasMany Nilai bernama 'nilai'.
        // Nama kolom nama mapel dicoba beberapa kemungkinan (nama, nama_mapel, mapel, mata_pelajaran, name)
        // karena nama kolom aslinya belum diketahui pasti. Sesuaikan jika masih kosong.
        $nilaiPerMapel = MataPelajaran::withCount(['nilai' => function ($q) use ($filterSemester) {
                $filterSemester($q);
            }])
            ->orderByDesc('nilai_count')
            ->get()
            ->map(function ($mapel) use ($totalNilai) {
                $nama = $mapel->nama
                    ?? $mapel->nama_mapel
                    ?? $mapel->mapel
                    ?? $mapel->mata_pelajaran
                    ?? $mapel->name
                    ?? 'Tanpa Nama';

                return [
                    'nama'       => $nama,
                    'total'      => $mapel->nilai_count,
                    'persentase' => $totalNilai > 0
                        ? round(($mapel->nilai_count / $totalNilai) * 100, 1)
                        : 0,
                ];
            })
            ->values();

        // --- 10 Peringkat Siswa berdasarkan rata-rata nilai ---
        // Asumsi: Siswa hasMany Nilai bernama 'nilai', dan Siswa punya kolom 'kelas'
        $topSiswa = Siswa::with(['nilai' => function ($q) use ($filterSemester) {
                $filterSemester($q);
            }])
            ->get()
            ->map(function ($s) {
                $rata = $s->nilai->avg('nilai');
                return [
                    'nama'      => $s->name,
                    'kelas'     => $s->kelas ?? '-',
                    'rata_rata' => $rata ? round($rata, 2) : 0,
                ];
            })
            ->filter(fn ($s) => $s['rata_rata'] > 0)
            ->sortByDesc('rata_rata')
            ->take(10)
            ->values();

        // --- Statistik Kelas ---
        // Kolom 'kelas' ternyata berformat "xi.tkj", "xi.rpl", "XII.RPL", dst
        // (huruf tingkat sebelum tanda titik, huruf besar/kecil bercampur).
        // Jadi kita ambil bagian sebelum titik lalu bandingkan tanpa peduli besar/kecil huruf,
        // bukan pakai LIKE 'X-%' yang tidak akan pernah cocok dengan format ini.
        $semuaKelas = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->pluck('kelas');

        $tingkatKelas = $semuaKelas->map(function ($kelas) {
            return strtoupper(trim(explode('.', $kelas)[0] ?? $kelas));
        });

        $statistikKelas = [
            'total' => $semuaKelas->count(),
            'x'     => $tingkatKelas->filter(fn ($t) => $t === 'X')->count(),
            'xi'    => $tingkatKelas->filter(fn ($t) => $t === 'XI')->count(),
            'xii'   => $tingkatKelas->filter(fn ($t) => $t === 'XII')->count(),
        ];

        // --- Aktivitas Terbaru (gabungan input nilai terbaru & siswa yang diperbarui) ---
        $aktivitasNilai = Nilai::with(['siswa', 'mataPelajaran'])
            ->latest()
            ->take(5)
            ->get()
            ->filter(fn ($n) => $n->created_at !== null)
            ->map(function ($n) {
                return [
                    'type'       => 'nilai',
                    'nama'       => $n->siswa->name ?? 'Siswa',
                    'mapel'      => $n->mataPelajaran->nama
                        ?? $n->mataPelajaran->nama_mapel
                        ?? $n->mataPelajaran->mapel
                        ?? $n->mataPelajaran->mata_pelajaran
                        ?? $n->mataPelajaran->name
                        ?? 'Mata Pelajaran',
                    'waktu'      => $n->created_at->diffForHumans(),
                    'created_at' => $n->created_at,
                ];
            });

        // Beberapa data lama di tabel siswa punya updated_at / created_at NULL,
        // jadi kita fallback ke created_at, lalu skip kalau dua-duanya tetap NULL
        // supaya tidak memanggil diffForHumans() di atas null.
        $aktivitasSiswa = Siswa::latest('updated_at')
            ->take(5)
            ->get()
            ->map(function ($s) {
                $waktu = $s->updated_at ?? $s->created_at;
                return [
                    'type'       => 'siswa',
                    'nama'       => $s->name,
                    'mapel'      => null,
                    'waktu'      => $waktu ? $waktu->diffForHumans() : '-',
                    'created_at' => $waktu,
                ];
            })
            ->filter(fn ($a) => $a['created_at'] !== null);

        $aktivitasTerbaru = $aktivitasNilai->concat($aktivitasSiswa)
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        $grafikNilai = Nilai::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('bulan')
        ->get();

        return view('admin.dashboard', compact(
            'statistik',
            'statistikNilai',
            'distribusiNilai',
            'maxDistribusi',
            'nilaiPerMapel',
            'topSiswa',
            'statistikKelas',
            'aktivitasTerbaru',
            'grafikNilai'
        ));
    }
}