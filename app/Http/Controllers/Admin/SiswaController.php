<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelasTerpilih = $request->get('kelas');
        $daftarKelas = Siswa::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');

        $siswa = Siswa::query()
            ->when($kelasTerpilih, function ($q)  use ($kelasTerpilih) {
                $q->where('kelas', $kelasTerpilih);  
            })
            ->orderBy('kelas')
            ->orderBy('name')
            ->get();

        return view('admin.siswa.index', compact('siswa', 'daftarKelas', 'kelasTerpilih'));
    }

    public function create() 
    {
        return view('admin.siswa.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'nis' => 'required|string|unique:siswas,nis',
            'kelas' => 'required|string|max:30',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'kelas.required' => 'Kelas wajib diisi'
        ]);

        Siswa::create($request->only('name', 'nis', 'kelas'));

        return redirect()
            ->route('admin.siswa.index')
            ->with('sukses', "Siswa {$request->name} berhasil ditambahkan");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'nis' => 'required|string|unique:siswas,nis',
            'kelas' => 'required|string|max:30',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'kelas.required' => 'Kelas wajib diisi'
        ]);

        $siswa->update($request->only('name', 'nis', 'kelas'));

        return redirect()
            ->route('admin.siswa.index')
            ->with('sukses', "Data siswa {$siswa->name} berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $name = $siswa->name;
        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('sukses', "Siswa {$name} berhasil dihapus");
    }
}
