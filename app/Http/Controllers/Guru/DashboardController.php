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
        /** @var User $guru */
        $guru = Auth::user();

        $guru->load('mataPelajaran');

        $mataPelajaran = $guru->mataPelajaran()->first();

        $kelasGuru = $guru
            ->kelas()
            ->pluck('kelas')
            ->unique()
            ->values();

        $semuaNilai = Nilai::query()
            ->where('id_user', $guru->id)
            ->whereHas('siswa', function ($query) use ($kelasGuru) {
                $query->whereIn('kelas', $kelasGuru);
            })
            ->with([
                'siswa',
                'mataPelajaran',
            ])
            ->get();

        $totalSiswa = Siswa::whereIn('kelas', $kelasGuru)->count();

        $sudahDiinput = $semuaNilai
            ->pluck('id_siswa')
            ->filter()
            ->unique()
            ->count();

        $nilaiDiinput = $semuaNilai
            ->sortByDesc('updated_at')
            ->take(8)
            ->values();

        $jumlahNilai = $semuaNilai->count();

        $rataRataNilai = $jumlahNilai > 0
            ? round($semuaNilai->avg('nilai'), 2)
            : 0;

        $nilaiTertinggi = $jumlahNilai > 0
            ? $semuaNilai->max('nilai')
            : 0;

        $nilaiTerendah = $jumlahNilai > 0
            ? $semuaNilai->min('nilai')
            : 0;

        $jumlahLulus = $semuaNilai
            ->where('nilai', '>=', 75)
            ->count();

        $jumlahRemedial = $semuaNilai
            ->where('nilai', '<', 75)
            ->count();

        $persentaseLulus = $jumlahNilai > 0
            ? round(($jumlahLulus / $jumlahNilai) * 100)
            : 0;

        $persentaseInput = $totalSiswa > 0
            ? round(($sudahDiinput / $totalSiswa) * 100)
            : 0;

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
                    'rata_rata' => round($nilaiSiswa->avg('nilai'), 2),
                ];
            })
            ->sortByDesc('rata_rata')
            ->values();

        $siswaTerbaik = $rankingSiswa->first();

        $siswaPerluPerhatian = $rankingSiswa
            ->sortBy('rata_rata')
            ->take(5)
            ->values();

        $distribusiNilai = collect([
            ['label' => '< 60', 'min' => 0, 'max' => 59],
            ['label' => '60-69', 'min' => 60, 'max' => 69],
            ['label' => '70-74', 'min' => 70, 'max' => 74],
            ['label' => '75-84', 'min' => 75, 'max' => 84],
            ['label' => '85-94', 'min' => 85, 'max' => 94],
            ['label' => '95-100', 'min' => 95, 'max' => 100],
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

        $chartData = $semuaNilai
            ->sortBy('updated_at')
            ->take(12)
            ->values();

        $chartLabels = $chartData
            ->map(fn ($nilai) => $nilai->siswa->name ?? 'Siswa')
            ->toArray();

        $chartValues = $chartData
            ->map(fn ($nilai) => (float) ($nilai->nilai ?? 0))
            ->toArray();

        return view('guru.dashboard', compact(
            'guru',
            'mataPelajaran',
            'semuaNilai',
            'nilaiDiinput',
            'totalSiswa',
            'sudahDiinput',
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
            'chartValues'
        ));
    }
}
