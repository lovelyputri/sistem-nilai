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
        $semester = $request->query('semester', 'all');

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

        $totalGuru = User::where('role', 'guru')->count();
        $totalMataPelajaran = MataPelajaran::count();
        $totalSiswa = Siswa::count();
        $totalNilai = $filterSemester(Nilai::query())->count();

        $statistik = [
            'total_guru' => $totalGuru,
            'total_mata_pelajaran' => $totalMataPelajaran,
            'total_siswa' => $totalSiswa,
            'total_nilai' => $totalNilai,
        ];

        $queryNilaiStatistik = $filterSemester(Nilai::query());

        $statistikNilai = [
            'rata_rata' => round($queryNilaiStatistik->avg('nilai') ?? 0, 2),
            'nilai_tertinggi' => $filterSemester(Nilai::query())->max('nilai') ?? 0,
            'nilai_terendah' => $filterSemester(Nilai::query())->min('nilai') ?? 0,
            'total_siswa_punya_nilai' => $filterSemester(Nilai::query())
                ->distinct('id_siswa')
                ->count('id_siswa'),
        ];

        $rentangNilai = [
            '0 - 20' => [0, 20],
            '21 - 40' => [21, 40],
            '41 - 60' => [41, 60],
            '61 - 80' => [61, 80],
            '81 - 100' => [81, 100],
        ];

        $distribusiNilai = [];

        foreach ($rentangNilai as $label => $range) {
            $queryDistribusi = Nilai::whereBetween('nilai', $range);
            $filterSemester($queryDistribusi);

            $distribusiNilai[] = [
                'label' => $label,
                'total' => $queryDistribusi->count(),
            ];
        }

        $maxDistribusi = collect($distribusiNilai)->max('total') ?: 1;

        $nilaiPerMapel = MataPelajaran::withCount([
            'nilai' => function ($q) use ($filterSemester) {
                $filterSemester($q);
            }
        ])
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
                'nama' => $nama,
                'total' => $mapel->nilai_count,
                'persentase' => $totalNilai > 0
                    ? round(($mapel->nilai_count / $totalNilai) * 100, 1)
                    : 0,
            ];
        })
        ->values();

        $topSiswa = Siswa::with([
            'nilai' => function ($q) use ($filterSemester) {
                $filterSemester($q);
            }
        ])
        ->get()
        ->map(function ($siswa) use ($totalMataPelajaran) {
            $jumlahNilai = $siswa->nilai->count();
            $totalNilaiSiswa = $siswa->nilai->sum('nilai');

            $rataRata = $totalMataPelajaran > 0
                ? round($totalNilaiSiswa / $totalMataPelajaran, 2)
                : 0;

            $progress = $totalMataPelajaran > 0
                ? round(($jumlahNilai / $totalMataPelajaran) * 100)
                : 0;

            return [
                'id' => $siswa->id,
                'nama' => $siswa->name,
                'kelas' => $siswa->kelas ?? '-',
                'rata_rata' => $rataRata,
                'jumlah_nilai' => $jumlahNilai,
                'progress' => min($progress, 100),
            ];
        })
        ->sortByDesc('rata_rata')
        ->take(10)
        ->values();

        $semuaKelas = Siswa::whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->pluck('kelas');

        $tingkatKelas = $semuaKelas->map(function ($kelas) {
            return strtoupper(trim(explode('.', $kelas)[0] ?? $kelas));
        });

        $statistikKelas = [
            'total' => $semuaKelas->count(),
            'x' => $tingkatKelas->filter(fn ($t) => $t === 'X')->count(),
            'xi' => $tingkatKelas->filter(fn ($t) => $t === 'XI')->count(),
            'xii' => $tingkatKelas->filter(fn ($t) => $t === 'XII')->count(),
        ];

        $aktivitasNilai = Nilai::with(['siswa', 'mataPelajaran'])
            ->latest()
            ->take(5)
            ->get()
            ->filter(fn ($nilai) => $nilai->created_at !== null)
            ->map(function ($nilai) {
                return [
                    'type' => 'nilai',
                    'nama' => $nilai->siswa->name ?? 'Siswa',
                    'mapel' => $nilai->mataPelajaran->nama
                        ?? $nilai->mataPelajaran->nama_mapel
                        ?? $nilai->mataPelajaran->mapel
                        ?? $nilai->mataPelajaran->mata_pelajaran
                        ?? $nilai->mataPelajaran->name
                        ?? 'Mata Pelajaran',
                    'waktu' => $nilai->created_at->diffForHumans(),
                    'created_at' => $nilai->created_at,
                ];
            });

        $aktivitasSiswa = Siswa::latest('updated_at')
            ->take(5)
            ->get()
            ->map(function ($siswa) {
                $waktu = $siswa->updated_at ?? $siswa->created_at;

                return [
                    'type' => 'siswa',
                    'nama' => $siswa->name,
                    'mapel' => null,
                    'waktu' => $waktu ? $waktu->diffForHumans() : '-',
                    'created_at' => $waktu,
                ];
            })
            ->filter(fn ($aktivitas) => $aktivitas['created_at'] !== null);

        $aktivitasTerbaru = $aktivitasNilai
            ->concat($aktivitasSiswa)
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

        return view(
            'admin.dashboard',
            compact(
                'statistik',
                'statistikNilai',
                'distribusiNilai',
                'maxDistribusi',
                'nilaiPerMapel',
                'topSiswa',
                'statistikKelas',
                'aktivitasTerbaru',
                'grafikNilai'
            )
        );
    }
}