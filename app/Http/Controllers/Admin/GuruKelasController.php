<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class GuruKelasController extends Controller
{
    /**
     * Menampilkan halaman kelola guru dan kelas
     */
    public function index()
    {
        // Ambil semua guru
        $guru = User::where('role', 'guru')
            ->orderBy('name')
            ->get();

        // Ambil semua assignment guru ke kelas
        $guruKelas = GuruKelas::with([
            'guru:id,name,nip,email'
        ])
            ->orderBy('kelas')
            ->get();

        return view('admin.guruKelas.index', compact(
            'guru',
            'guruKelas'
        ));
    }

    /**
     * Menampilkan daftar kelas unik dari tabel siswa
     */
    public function daftarKelas()
    {
        $kelas = Siswa::select('kelas')
            ->whereNotNull('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');

        return view('admin.guruKelas.daftarKelas', compact(
            'kelas'
        ));
    }

    /**
     * Menampilkan guru-guru yang ditugaskan
     * pada kelas tertentu
     */
    public function show(string $kelas)
    {
        $guruDiKelas = GuruKelas::with([
            'guru:id,name,nip,email'
        ])
            ->where('kelas', $kelas)
            ->orderBy('id')
            ->get();

        return view('admin.guruKelas.show', compact(
            'guruDiKelas',
            'kelas'
        ));
    }

    /**
     * Menambahkan guru ke kelas
     * Satu guru bisa mengajar banyak kelas
     * Satu kelas bisa memiliki banyak guru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'kelas'   => 'required|string|max:30',
        ], [
            'id_user.required' => 'Guru wajib dipilih.',
            'id_user.exists'   => 'Guru tidak ditemukan.',
            'kelas.required'   => 'Kelas wajib dipilih.',
            'kelas.max'        => 'Nama kelas maksimal 30 karakter.',
        ]);

        // Pastikan user yang dipilih adalah guru
        $guru = User::where('id', $validated['id_user'])
            ->where('role', 'guru')
            ->first();

        if (!$guru) {
            return back()
                ->withInput()
                ->with('error', 'User yang dipilih bukan guru.');
        }

        // Cek apakah guru sudah ada di kelas tersebut
        $exists = GuruKelas::where('id_user', $validated['id_user'])
            ->where('kelas', $validated['kelas'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    "Guru {$guru->name} sudah ditugaskan di kelas {$validated['kelas']}."
                );
        }

        // Simpan assignment guru ke kelas
        GuruKelas::create([
            'id_user' => $validated['id_user'],
            'kelas'   => $validated['kelas'],
        ]);

        return redirect()
            ->route('admin.guruKelas.index')
            ->with(
                'success',
                "Guru {$guru->name} berhasil ditambahkan ke kelas {$validated['kelas']}."
            );
    }

    /**
     * Menghapus assignment guru dari kelas
     */
    public function destroy(GuruKelas $guruKelas)
    {
        $guruKelas->load('guru:id,name');

        $namaGuru = $guruKelas->guru->name ?? 'Guru';
        $kelas = $guruKelas->kelas;

        $guruKelas->delete();

        return redirect()
            ->route('admin.guruKelas.index')
            ->with(
                'success',
                "Guru {$namaGuru} berhasil dihapus dari kelas {$kelas}."
            );
    }
}