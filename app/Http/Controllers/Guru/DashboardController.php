<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
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

        $nilaiDiinput = Nilai::where('id_user', $guru->id)
            ->with('siswa', 'mataPelajaran')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

            $totalSiswa = Siswa::count();
            $sudahDiinput = Nilai::where('id_user', $guru->id)->count();

            return view('guru.dashboard', compact(
                'guru',
                'mataPelajaran',
                'nilaiDiinput',
                'totalSiswa',
                'sudahDiinput',
            ));
    }
}
