<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $statistik = [
            'total_guru' => User::where('role', 'guru')->count(),
            'total_mata_pelajaran' => MataPelajaran::count(),
            'total_siswa' => Siswa::count(),
            'total_nilai' => Nilai::count(),
        ];

        $siswa = Siswa::with('nilai.mataPelajaran')
            ->withAvg('nilai', 'nilai')
            ->orderByDesc('nilai_avg_nilai')
            ->take(10)
            ->get();

        $statistikNilai = [
            'rata_rata' => round(Nilai::avg('nilai') ?? 0, 2),
            'nilai_tertinggi' => Nilai::max('nilai') ?? 0,
            'nilai_terendah' => Nilai::min('nilai') ?? 0,
            'total_siswa_punya_nilai' => Nilai::distinct('id_siswa')->count('id_siswa'),
        ];

        // Distribusi nilai berdasarkan rentang
        $distribusiNilai = [
            [
                'label' => '0 - 20',
                'jumlah' => Nilai::whereBetween('nilai', [0, 20])->count(),
            ],
            [
                'label' => '21 - 40',
                'jumlah' => Nilai::whereBetween('nilai', [21, 40])->count(),
            ],
            [
                'label' => '41 - 60',
                'jumlah' => Nilai::whereBetween('nilai', [41, 60])->count(),
            ],
            [
                'label' => '61 - 80',
                'jumlah' => Nilai::whereBetween('nilai', [61, 80])->count(),
            ],
            [
                'label' => '81 - 100',
                'jumlah' => Nilai::whereBetween('nilai', [81, 100])->count(),
            ],
        ];

        // Ambil semua mata pelajaran beserta total nilai masing-masing
        // Mapel yang belum memiliki nilai tetap akan muncul dengan total_nilai = 0
        $nilaiPerMapel = MataPelajaran::withSum(
            'nilai as total_nilai',
            'nilai'
        )->get();

        // Total seluruh nilai dari semua mata pelajaran
        $totalSemuaNilai = $nilaiPerMapel->sum('total_nilai');

        // Tambahkan persentase setiap mata pelajaran
        $nilaiPerMapel = $nilaiPerMapel->map(function ($mapel) use ($totalSemuaNilai) {
            $mapel->persentase = $totalSemuaNilai > 0
                ? round(($mapel->total_nilai ?? 0) / $totalSemuaNilai * 100, 1)
                : 0;

            return $mapel;
        });

        // Nilai terbesar untuk menentukan tinggi grafik
        $nilaiMaksimum = collect($distribusiNilai)->max('jumlah') ?? 0;

        // Tambahkan tinggi batang ke data backend
        $distribusiNilai = collect($distribusiNilai)
            ->map(function ($item) use ($nilaiMaksimum) {
                return [
                    'label' => $item['label'],
                    'jumlah' => $item['jumlah'],
                    'tinggi' => $nilaiMaksimum > 0
                        ? round(($item['jumlah'] / $nilaiMaksimum) * 100, 2)
                        : 0,
                ];
            });

        return view('admin.dashboard', compact(
            'statistik',
            'siswa',
            'statistikNilai',
            'distribusiNilai',
            'nilaiPerMapel',
            'totalSemuaNilai'
        ));
    }
}
