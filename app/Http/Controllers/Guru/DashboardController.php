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
    public function index(): View
    {
        /**
         * @var User $guru
         */
        $guru = Auth::user();

        $guru->load('mataPelajaran');

        $mataPelajaran = $guru->mataPelajaran()->first();

        /*
        |--------------------------------------------------------------------------
        | SEMUA NILAI GURU
        |--------------------------------------------------------------------------
        */
        $semuaNilai = Nilai::query()
            ->where('id_user', $guru->id)
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
        $totalSiswa = Siswa::count();

        /*
        |--------------------------------------------------------------------------
        | SUDAH DIINPUT
        |--------------------------------------------------------------------------
        */
        $sudahDiinput = $semuaNilai
            ->pluck('id_siswa')
            ->filter()
            ->unique()
            ->count();

        /*
        |--------------------------------------------------------------------------
        | NILAI TERBARU
        |--------------------------------------------------------------------------
        */
        $nilaiDiinput = $semuaNilai
            ->sortByDesc('updated_at')
            ->take(8)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | JUMLAH NILAI
        |--------------------------------------------------------------------------
        */
        $jumlahNilai = $semuaNilai->count();

        /*
        |--------------------------------------------------------------------------
        | RATA-RATA
        |--------------------------------------------------------------------------
        */
        $rataRataNilai = $jumlahNilai > 0
            ? round($semuaNilai->avg('nilai'), 2)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | NILAI TERTINGGI
        |--------------------------------------------------------------------------
        */
        $nilaiTertinggi = $jumlahNilai > 0
            ? $semuaNilai->max('nilai')
            : 0;

        /*
        |--------------------------------------------------------------------------
        | NILAI TERENDAH
        |--------------------------------------------------------------------------
        */
        $nilaiTerendah = $jumlahNilai > 0
            ? $semuaNilai->min('nilai')
            : 0;

        /*
        |--------------------------------------------------------------------------
        | LULUS KKM
        |--------------------------------------------------------------------------
        */
        $jumlahLulus = $semuaNilai
            ->where('nilai', '>=', 75)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | REMEDIAL
        |--------------------------------------------------------------------------
        */
        $jumlahRemedial = $semuaNilai
            ->where('nilai', '<', 75)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | PERSENTASE LULUS
        |--------------------------------------------------------------------------
        */
        $persentaseLulus = $jumlahNilai > 0
            ? round(($jumlahLulus / $jumlahNilai) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | PERSENTASE INPUT
        |--------------------------------------------------------------------------
        */
        $persentaseInput = $totalSiswa > 0
            ? round(($sudahDiinput / $totalSiswa) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | RANKING SISWA
        |--------------------------------------------------------------------------
        */
        $rankingSiswa = $semuaNilai
            ->filter(function ($nilai) {
                return $nilai->siswa !== null;
            })
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
                        $nilaiSiswa->avg('nilai'),
                        2
                    ),
                ];
            })
            ->sortByDesc('rata_rata')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | SISWA TERBAIK
        |--------------------------------------------------------------------------
        */
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
        ])->map(function ($range) use ($semuaNilai) {

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
        })->values();

        $maxDistribusi = max(
            $distribusiNilai->max('total') ?? 0,
            1
        );

        /*
        |--------------------------------------------------------------------------
        | DATA CHART TREN
        |--------------------------------------------------------------------------
        */
        $chartData = $semuaNilai
            ->sortBy('updated_at')
            ->take(12)
            ->values();

        $chartLabels = $chartData
            ->map(function ($nilai) {
                return $nilai->siswa->name ?? 'Siswa';
            })
            ->toArray();

        $chartValues = $chartData
            ->map(function ($nilai) {
                return (float) ($nilai->nilai ?? 0);
            })
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */
        return view('guru.dashboard', [

            'guru' => $guru,

            'mataPelajaran' => $mataPelajaran,

            'semuaNilai' => $semuaNilai,

            'nilaiDiinput' => $nilaiDiinput,

            'totalSiswa' => $totalSiswa,

            'sudahDiinput' => $sudahDiinput,

            'persentaseInput' => $persentaseInput,

            'jumlahNilai' => $jumlahNilai,

            'rataRataNilai' => $rataRataNilai,

            'nilaiTertinggi' => $nilaiTertinggi,

            'nilaiTerendah' => $nilaiTerendah,

            'jumlahLulus' => $jumlahLulus,

            'jumlahRemedial' => $jumlahRemedial,

            'persentaseLulus' => $persentaseLulus,

            'rankingSiswa' => $rankingSiswa,

            'siswaTerbaik' => $siswaTerbaik,

            'siswaPerluPerhatian' => $siswaPerluPerhatian,

            'distribusiNilai' => $distribusiNilai,

            'maxDistribusi' => $maxDistribusi,

            'chartLabels' => $chartLabels,

            'chartValues' => $chartValues,

        ]);
    }
}