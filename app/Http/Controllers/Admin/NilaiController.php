<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Rekap nilai semua siswa
     */
    public function index()
    {
        $totalMapel = MataPelajaran::count();

        $siswa = Siswa::with(['nilai.mataPelajaran', 'nilai.guru'])
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
                    'kelas' => $siswa->kelas,
                    'nilai_mapel' => $siswa->nilai,
                    'rata_rata' => $totalMapel > 0
                        ? round($totalNilai / $totalMapel, 2)
                        : null,
                    'lengkap' => $jumlahNilai >= $totalMapel,
                    'progress' => $totalMapel > 0
                        ? round(($jumlahNilai / $totalMapel) * 100)
                        : 0,
                ];
            });

        $mataPelajaran = MataPelajaran::orderBy('name')
            ->get(['id', 'name', 'kode']);

        return view('admin.nilai.index', compact(
            'siswa',
            'mataPelajaran',
            'totalMapel'
        ));
    }

    /**
     * Detail nilai satu siswa
     */
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
            $siswa->nilai->pluck('id_mata_pelajaran')
        )->get(['id', 'name', 'kode']);

        return view('admin.nilai.show', compact(
            'siswa',
            'totalMapel',
            'totalNilai',
            'jumlahNilai',
            'rataRata',
            'mataPelajaranBelumDiisi'
        ));
    }

    /**
     * Hapus nilai
     */
    public function destroy(Nilai $nilai)
    {
        $namaSiswa = $nilai->siswa->name ?? 'Siswa';

        $nilai->delete();

        return redirect()
            ->back()
            ->with('success', "Nilai {$namaSiswa} berhasil dihapus.");
    }
}