<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Nilai KKM.
     */
    private const KKM = 75;

    /**
     * Dashboard Guru.
     */
    public function index(): View
    {
        /** @var User $guru */
        $guru = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | DATA DASAR
        |--------------------------------------------------------------------------
        */

        $kkm = self::KKM;

        $guru->load('mataPelajaran');

        $mataPelajaran = $guru->mataPelajaran()->first();

        /*
        |--------------------------------------------------------------------------
        | KELAS YANG DIAJAR GURU
        |--------------------------------------------------------------------------
        */

        $kelasGuru = $guru
            ->kelas()
            ->pluck('kelas')
            ->unique()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | SEMUA NILAI GURU
        |--------------------------------------------------------------------------
        |
        | Hanya mengambil nilai:
        | - milik guru yang sedang login
        | - siswa dari kelas yang diajar guru
        | - siswa yang masih aktif
        |
        */

        $semuaNilai = Nilai::query()
            ->where('id_user', $guru->id)
            ->whereHas('siswa', function ($query) use ($kelasGuru) {
                $query
                    ->whereIn('kelas', $kelasGuru)
                    ->where('status', 'aktif');
            })
            ->with([
                'siswa',
                'mataPelajaran',
            ])
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TOTAL SISWA
        |--------------------------------------------------------------------------
        */

        $totalSiswa = Siswa::query()
            ->whereIn('kelas', $kelasGuru)
            ->where('status', 'aktif')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | SISWA YANG SUDAH MEMILIKI NILAI
        |--------------------------------------------------------------------------
        */

        $sudahDiinput = $semuaNilai
            ->pluck('id_siswa')
            ->filter()
            ->unique()
            ->count();

        /*
        |--------------------------------------------------------------------------
        | SISWA YANG BELUM MEMILIKI NILAI
        |--------------------------------------------------------------------------
        */

        $belumDiinput = max(
            $totalSiswa - $sudahDiinput,
            0
        );

        /*
        |--------------------------------------------------------------------------
        | PERSENTASE INPUT NILAI
        |--------------------------------------------------------------------------
        */

        $persentaseInput = $totalSiswa > 0
            ? round(($sudahDiinput / $totalSiswa) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | NILAI TERBARU
        |--------------------------------------------------------------------------
        |
        | Dipakai untuk bagian aktivitas/nilai terbaru jika diperlukan.
        |
        */

        $nilaiDiinput = $semuaNilai
            ->sortByDesc('updated_at')
            ->take(8)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK NILAI
        |--------------------------------------------------------------------------
        */

        $jumlahNilai = $semuaNilai->count();

        $rataRataNilai = $jumlahNilai > 0
            ? round((float) $semuaNilai->avg('nilai'), 2)
            : 0;

        $nilaiTertinggi = $jumlahNilai > 0
            ? $semuaNilai->max('nilai')
            : 0;

        $nilaiTerendah = $jumlahNilai > 0
            ? $semuaNilai->min('nilai')
            : 0;

        /*
        |--------------------------------------------------------------------------
        | LULUS & REMEDIAL
        |--------------------------------------------------------------------------
        */

        $jumlahLulus = $semuaNilai
            ->where('nilai', '>=', $kkm)
            ->count();

        $jumlahRemedial = $semuaNilai
            ->where('nilai', '<', $kkm)
            ->count();

        $persentaseLulus = $jumlahNilai > 0
            ? round(($jumlahLulus / $jumlahNilai) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | RANKING SISWA
        |--------------------------------------------------------------------------
        */

        $rankingSiswa = $semuaNilai
            ->filter(fn ($nilai) => $nilai->siswa !== null)
            ->groupBy('id_siswa')
            ->map(function ($nilaiSiswa) {
                $siswa = $nilaiSiswa->first()->siswa;

                return [
                    'id' => $siswa->id,
                    'nama' => $siswa->name,
                    'nis' => $siswa->nis ?? '-',
                    'kelas' => $siswa->kelas ?? '-',
                    'jumlah_nilai' => $nilaiSiswa->count(),
                    'rata_rata' => round(
                        (float) $nilaiSiswa->avg('nilai'),
                        2
                    ),
                ];
            })
            ->sortByDesc('rata_rata')
            ->values();

        $siswaTerbaik = $rankingSiswa->first();

        /*
        |--------------------------------------------------------------------------
        | SISWA PERLU PERHATIAN
        |--------------------------------------------------------------------------
        */

        $siswaPerluPerhatian = $rankingSiswa
            ->sortBy('rata_rata')
            ->take(5)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | DISTRIBUSI NILAI
        |--------------------------------------------------------------------------
        */

        $distribusiNilai = collect([
            [
                'label' => '< 60',
                'min' => 0,
                'max' => 59,
            ],
            [
                'label' => '60-69',
                'min' => 60,
                'max' => 69,
            ],
            [
                'label' => '70-74',
                'min' => 70,
                'max' => 74,
            ],
            [
                'label' => '75-84',
                'min' => 75,
                'max' => 84,
            ],
            [
                'label' => '85-94',
                'min' => 85,
                'max' => 94,
            ],
            [
                'label' => '95-100',
                'min' => 95,
                'max' => 100,
            ],
        ])
        ->map(function ($range) use ($semuaNilai) {
            $total = $semuaNilai
                ->filter(function ($nilai) use ($range) {
                    $value = (float) $nilai->nilai;

                    return $value >= $range['min']
                        && $value <= $range['max'];
                })
                ->count();

            return [
                'label' => $range['label'],
                'total' => $total,
            ];
        })
        ->values();

        $maxDistribusi = max(
            $distribusiNilai->max('total') ?? 0,
            1
        );

        /*
        |--------------------------------------------------------------------------
        | TREN NILAI
        |--------------------------------------------------------------------------
        |
        | Bagian ini khusus untuk:
        | "Tren Nilai"
        | "Perkembangan nilai terbaru"
        |
        | Yang ditampilkan adalah maksimal 8 nilai terbaru
        | dari siswa yang berbeda.
        |
        | Jadi satu siswa tidak muncul berkali-kali hanya karena
        | mempunyai beberapa nilai.
        |
        */

        $chartData = $semuaNilai
            ->filter(function ($nilai) {
                return $nilai->siswa !== null;
            })
            ->sortByDesc('updated_at')
            ->groupBy('id_siswa')
            ->map(function ($nilaiSiswa) {
                return $nilaiSiswa
                    ->sortByDesc('updated_at')
                    ->first();
            })
            ->sortByDesc('updated_at')
            ->take(8)
            ->sortBy('updated_at')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | DATA CHART
        |--------------------------------------------------------------------------
        */

        $chartLabels = $chartData
            ->map(function ($nilai) {
                return $nilai->siswa?->name ?? 'Siswa';
            })
            ->values()
            ->toArray();

        $chartValues = $chartData
            ->map(function ($nilai) {
                return (float) $nilai->nilai;
            })
            ->values()
            ->toArray();

        $chartSubjects = $chartData
            ->map(function ($nilai) {
                return $nilai->mataPelajaran?->name ?? 'Mata Pelajaran';
            })
            ->values()
            ->toArray();

        $chartDates = $chartData
            ->map(function ($nilai) {
                if (!$nilai->updated_at) {
                    return '-';
                }

                return $nilai->updated_at->format('d M Y');
            })
            ->values()
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK KHUSUS TREN
        |--------------------------------------------------------------------------
        */

        $trendJumlah = $chartData->count();

        $trendTerbaru = $trendJumlah > 0
            ? (float) $chartData->last()->nilai
            : 0;

        $trendTertinggi = $trendJumlah > 0
            ? (float) $chartData->max('nilai')
            : 0;

        $trendRataRata = $trendJumlah > 0
            ? round((float) $chartData->avg('nilai'), 2)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('guru.dashboard', compact(
            'guru',
            'kkm',
            'mataPelajaran',
            'semuaNilai',
            'nilaiDiinput',
            'totalSiswa',
            'sudahDiinput',
            'belumDiinput',
            'persentaseInput',
            'jumlahNilai',
            'rataRataNilai',
            'nilaiTertinggi',
            'nilaiTerendah',
            'jumlahLulus',
            'jumlahRemedial',
            'persentaseLulus',
            'rankingSiswa',
            'siswaTerbaik',
            'siswaPerluPerhatian',
            'distribusiNilai',
            'maxDistribusi',
            'chartLabels',
            'chartValues',
            'chartSubjects',
            'chartDates',
            'trendJumlah',
            'trendTerbaru',
            'trendTertinggi',
            'trendRataRata'
        ));
    }
}
