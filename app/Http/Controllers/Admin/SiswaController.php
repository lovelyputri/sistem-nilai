<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class SiswaController extends Controller
{

   public function index(Request $request)
{
    $search        = $request->get('search');
    $kelasTerpilih = $request->get('kelas');
    $statusTerpilih = $request->get('status');
    $perPage       = (int) $request->get('per_page', 10);

    // Daftar kelas
    $daftarKelas = Siswa::select('kelas')
        ->whereNotNull('kelas')
        ->where('kelas', '!=', '')
        ->distinct()
        ->orderBy('kelas')
        ->pluck('kelas');

    // Data siswa
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
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate($perPage)
        ->appends($request->query());

    // Statistik
    $totalSiswa = Siswa::count();

    $totalSiswaAktif = Siswa::where('status', 'aktif')->count();

    $totalKelas = Siswa::select('kelas')
        ->whereNotNull('kelas')
        ->where('kelas', '!=', '')
        ->distinct()
        ->count('kelas');

    return view('admin.siswa.index', compact(
        'siswa',
        'daftarKelas',
        'kelasTerpilih',
        'statusTerpilih',
        'search',
        'totalSiswa',
        'totalSiswaAktif',
        'totalKelas'
    ));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $daftarKelas = MataPelajaran::orderBy('name')->get();
        return view('admin.siswa.tambah', compact('daftarKelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:225',
            'nis'   => 'required|string|unique:siswas,nis',
            'kelas' => 'required|string|max:30',
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'nis.required'   => 'NIS wajib diisi.',
            'nis.unique'     => 'NIS sudah terdaftar.',
            'kelas.required' => 'Kelas wajib diisi.',
        ]);

        $siswa = Siswa::create($request->only('name', 'nis', 'kelas'));

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => "Siswa {$siswa->name} berhasil ditambahkan.",
                'data'    => $siswa,
            ], 201);
        }

        return redirect()->route('admin.siswa.index')->with('sukses', "Siswa {$siswa->name} berhasil ditambahkan.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $daftarKelas = MataPelajaran::orderBy('name')->get();
        return view('admin.siswa.edit', compact('siswa', 'daftarKelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'name'  => 'required|string|max:225',
            'nis'   => 'required|string|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required|string|max:30',
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'nis.required'   => 'NIS wajib diisi.',
            'nis.unique'     => 'NIS sudah terdaftar.',
            'kelas.required' => 'Kelas wajib diisi.',
        ]);

        $siswa->update($request->only('name', 'nis', 'kelas'));

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => "Data siswa {$siswa->name} berhasil diperbarui.",
                'data'    => $siswa,
            ]);
        }

        return redirect()->route('admin.siswa.index')->with('sukses', "Data siswa {$siswa->name} berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Siswa $siswa)
    {
        $name = $siswa->name;
        $siswa->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => "Siswa {$name} berhasil dihapus.",
            ]);
        }

        return redirect()->route('admin.siswa.index')->with('sukses', "Siswa {$name} berhasil dihapus.");
    }
}
