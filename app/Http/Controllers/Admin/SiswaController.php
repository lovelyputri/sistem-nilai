<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar seluruh siswa.
     */
    public function index(Request $request)
    {
        $search         = $request->get('search');
        $kelasTerpilih  = $request->get('kelas');
        $statusTerpilih = $request->get('status');
        $perPage        = (int) $request->get('per_page', 10);

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
     * Menampilkan form tambah siswa.
     */
    public function create()
    {
        $daftarKelas = Siswa::select('kelas')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view(
            'admin.siswa.tambah',
            compact('daftarKelas')
        );
    }


    /**
     * Menyimpan siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:225',
            'nis'            => 'required|string|max:50|unique:siswas,nis',
            'nisn'           => 'nullable|string|max:20|unique:siswas,nisn',
            'nik'            => 'nullable|string|max:20|unique:siswas,nik',
            'jenis_kelamin'  => 'nullable|in:L,P',
            'tempat_lahir'   => 'nullable|string|max:100',
            'tanggal_lahir'  => 'nullable|date',
            'agama'          => 'nullable|string|max:30',
            'alamat'         => 'nullable|string',
            'kelas'          => 'required|string|max:30',
            'jurusan'        => 'nullable|string|max:100',
            'angkatan'       => 'nullable|string|max:10',
            'tahun_masuk'    => 'nullable|integer|min:2000|max:2100',
            'no_hp'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:255',
            'foto'           => 'nullable|string|max:255',
            'status'         => 'nullable|string|max:30',
        ], [
            'name.required'          => 'Nama wajib diisi.',
            'nis.required'           => 'NIS wajib diisi.',
            'nis.unique'             => 'NIS sudah terdaftar.',
            'nisn.unique'            => 'NISN sudah terdaftar.',
            'nik.unique'             => 'NIK sudah terdaftar.',
            'jenis_kelamin.in'       => 'Jenis kelamin tidak valid.',
            'tanggal_lahir.date'     => 'Tanggal lahir tidak valid.',
            'email.email'            => 'Format email tidak valid.',
            'kelas.required'         => 'Kelas wajib diisi.',
            'tahun_masuk.integer'    => 'Tahun masuk harus berupa angka.',
        ]);

        $siswa = Siswa::create([
            'name'          => $request->name,
            'nis'           => $request->nis,
            'nisn'          => $request->nisn,
            'nik'           => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama'         => $request->agama,
            'alamat'        => $request->alamat,
            'kelas'         => $request->kelas,
            'jurusan'       => $request->jurusan,
            'angkatan'      => $request->angkatan,
            'tahun_masuk'   => $request->tahun_masuk,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
            'foto'          => $request->foto,
            'status'        => $request->status ?? 'aktif',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => "Siswa {$siswa->name} berhasil ditambahkan.",
                'data'    => $siswa,
            ], 201);
        }

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'sukses',
                "Siswa {$siswa->name} berhasil ditambahkan."
            );
    }

    public function show(Siswa $siswa)
    {
        return view(
            'admin.siswa.show',
            compact('siswa')
        );
    }


    /**
     * Menampilkan form edit siswa.
     */
    public function edit(Siswa $siswa)
    {
        // Ambil kelas yang sudah tersedia dari tabel siswa
        $daftarKelas = Siswa::select('kelas')
            ->whereNotNull('kelas')
            ->where('kelas', '!=', '')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view(
            'admin.siswa.edit',
            compact(
                'siswa',
                'daftarKelas'
            )
        );
    }


    /**
     * Memperbarui data siswa.
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

        $siswa->update(
            $request->only('name', 'nis', 'kelas')
        );

        if ($request->wantsJson()) {
            return response()->json([
                'status'  => 'success',
                'message' => "Data siswa {$siswa->name} berhasil diperbarui.",
                'data'    => $siswa,
            ]);
        }

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'sukses',
                "Data siswa {$siswa->name} berhasil diperbarui."
            );
    }

    /**
     * Menghapus siswa.
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

        return redirect()
            ->route('admin.siswa.index')
            ->with(
                'sukses',
                "Siswa {$name} berhasil dihapus."
            );
    }
}