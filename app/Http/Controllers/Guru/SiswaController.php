<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar siswa.
     * Guru hanya dapat melihat data.
     */
    public function index(Request $request): View
    {
        $search = trim($request->get('search', ''));
        $kelasTerpilih = $request->get('kelas', '');
        $statusTerpilih = $request->get('status', '');

        $perPage = (int) $request->get('per_page', 10);

        if (!in_array($perPage, [10, 25, 50])) {
            $perPage = 10;
        }

        /*
        |--------------------------------------------------------------------------
        | DAFTAR KELAS
        |--------------------------------------------------------------------------
        */

        $daftarKelas = Siswa::query()
            ->select('kelas')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');


        /*
        |--------------------------------------------------------------------------
        | DATA SISWA
        |--------------------------------------------------------------------------
        */

        $siswa = Siswa::query()

            ->when($kelasTerpilih, function ($query) use ($kelasTerpilih) {
                $query->where('kelas', $kelasTerpilih);
            })

            ->when($statusTerpilih, function ($query) use ($statusTerpilih) {
                $query->where('status', $statusTerpilih);
            })

            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('nis', 'like', "%{$search}%")
                        ->orWhere('nisn', 'like', "%{$search}%");
                });
            })

            ->orderBy('kelas')
            ->orderBy('name')

            ->paginate($perPage)

            ->appends($request->query());


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalSiswa = Siswa::count();

        $totalSiswaAktif = Siswa::where('status', 'aktif')->count();

        $totalKelas = Siswa::query()
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->count('kelas');


        return view('guru.siswa.index', compact(
            'siswa',
            'daftarKelas',
            'kelasTerpilih',
            'statusTerpilih',
            'search',
            'perPage',
            'totalSiswa',
            'totalSiswaAktif',
            'totalKelas'
        ));
    }


    /**
     * Menampilkan detail siswa.
     * Guru hanya dapat melihat data.
     */
    public function show(Siswa $siswa): View
    {
        return view(
            'guru.siswa.show',
            compact('siswa')
        );
    }
}