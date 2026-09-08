<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search', ''));
        $kelasTerpilih = $request->get('kelas', '');
        $statusTerpilih = $request->get('status', '');

        $perPage = (int) $request->get('per_page', 10);

        if (!in_array($perPage, [10, 25, 50])) {
            $perPage = 10;
        }

        $daftarKelas = Auth::user()
            ->kelas()
            ->pluck('kelas')
            ->unique()
            ->values();

        if ($kelasTerpilih && !$daftarKelas->contains($kelasTerpilih)) {
            abort(403, 'Anda tidak mengajar kelas ini.');
        }

        $siswa = Siswa::query()
            ->whereIn('kelas', $daftarKelas)

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

        $totalSiswa = Siswa::whereIn('kelas', $daftarKelas)->count();

        $totalSiswaAktif = Siswa::whereIn('kelas', $daftarKelas)
            ->where('status', 'aktif')
            ->count();

        $totalKelas = $daftarKelas->count();

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

    public function show(Siswa $siswa): View
    {
        $kelasGuru = Auth::user()
            ->kelas()
            ->pluck('kelas');

        abort_unless(
            $kelasGuru->contains($siswa->kelas),
            403,
            'Siswa ini bukan bagian dari kelas Anda.'
        );

        return view('guru.siswa.show', compact('siswa'));
    }
}
