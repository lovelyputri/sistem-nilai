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
    public function index() 
    {
        $statistik = [
            'total_guru' => User::where('role', 'guru')->count(),
            'total_mata_pelajaran' => MataPelajaran::count(),
            'total_siswa' => Siswa::count(),
            'total_nilai' => Nilai::count(),
        ];

        $siswa = Siswa::with('nilai.mataPelajaran')
            ->orderBy('name')
            ->take(5)
            ->get();

        $statistikNilai = [
            'rata_rata' => round(Nilai::avg('nilai') ?? 0, 2),
            'nilai_tertinggi' => Nilai::max('nilai') ?? 0,
            'nilai terendah' => Nilai::min('nilai') ?? 0,
            'total_siswa_punya_nilai' => Nilai::distinct('id_siswa')->count('id_siswa'),
        ];

        $grafikNilai = Nilai::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('bulan')
        ->get();


        return view('admin.dashboard', compact('statistik', 'siswa','statistikNilai','grafikNilai'));
    }
}
