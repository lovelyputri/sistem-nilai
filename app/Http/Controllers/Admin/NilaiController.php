<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $totalMapel = MataPelajaran::count();

        $siswa = Siswa::with([
            'nilai.mataPelajaran',
            'nilai.guru'
        ])
        ->orderBy('kelas')
        ->orderBy('name')
        ->get()
        ->map(function (Siswa $siswa) use ($totalMapel) {
            $jumlahNilai = $siswa->nilai->count();
            $totalNilai = $siswa->nilai->sum('nilai');

            return [
                'id' => $siswa->id,
                'name' => $siswa->name,
                'nis' => $siswa->nis,
                'kelas' => $siswa->nilai,
                'nilai_mapel' => $siswa->nilai,
                'rata-rata' => $totalMapel > 0 
                    ? round($totalNilai / $totalMapel, 2)
                    : null,
                'lengkap' => $jumlahNilai >= $totalMapel,
                'progress' => $totalMapel > 0
                    ? round(($jumlahNilai / $totalMapel) * 100)
                    : 0,
            ];
        });

        $mataPelajaran = MataPelajaran::orderBy('name')->get();

        return view('admin.nilai.index', compact('siswa', 'mataPelajaran', 'totalMapel'));
    }

    public function show(Siswa $siswa)
    {
        $siswa->load('nilai.mataPelajaran', 'nilai.guru');

        $totalMapel = MataPelajaran::count();
        $totalNilai = $siswa->nilai->sum('nilai');
        $jumlahNilai = $siswa->nilai->count();

        $rataRata = $totalMapel > 0
            ? round($totalNilai / $totalMapel, 2)
            : null;

            $mataPelajaranBelumDiisi = MataPelajaran::whereNotIn(
                'id',
                $siswa->nilai->pluck('mata_pelajaran_id')
            )->get();

        return view('admin.nilai.show', compact(
            'siswa',
            'totalMapel',
            'rataRata',
            'mataPelajaranBelumDiisi'
        ));
    }
}
