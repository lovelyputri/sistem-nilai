<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('admin.dashboard', compact('statistik', 'siswa'));
    }
}
