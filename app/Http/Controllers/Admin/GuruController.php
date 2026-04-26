<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = User::where('role', 'guru')
            ->with('mataPelajaran', 'nilaiDiinput')
            ->orderby('name')
            ->get();
        $waitingTeacher = $guru->where('status', 'menunggu')->count();

        return view('admin.guru.index', compact('guru', 'waitingTeacher'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $mataPelajaran = MataPelajaran::orderBy('name')->get();
        return view('admin.guru.create', compact('mataPelajaran'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'nip' => 'required|string|unique:users,nip',
            'id_mata_pelajaran'=> 'required|exists:mata_pelajarans,id',
        ], [
            'name.required'              => 'Nama lengkap wajib diisi.',
            'email.required'             => 'Email wajib diisi.',
            'email.email'                => 'Format email tidak valid.',
            'email.unique'               => 'Email sudah terdaftar.',
            'nip.required'               => 'NIP wajib diisi.',
            'nip.unique'                 => 'NIP sudah terdaftar.',
            'password.required'        => 'Kata sandi wajib diisi.',
            'password.min'             => 'Kata sandi minimal 6 karakter.',
            'password.confirmed'       => 'Konfirmasi kata sandi tidak cocok.',
            'id_mata_pelajaran.required' => 'Mata pelajaran wajib dipilih.',
            'id_mata_pelajaran.exists'   => 'Mata pelajaran tidak ditemukan.',
        ]);

        $guru = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'guru',
            'status' => 'menunggu',
        ]);

        $guru->mataPelajaran()->attach($request->id_mata_pelajaran);

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Guru {$guru->name} berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(User $guru) {
        abort_if($guru->role !== 'guru', 404);

        $guru->load('mataPelajaran');
        $mataPelajaran = MataPelajaran::orderBy('name')->get();

        return view('admin.guru.edit', compact('guru', 'mataPelajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $guru)
    {
        abort_if($guru->role !== 'guru',404);

        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'nip' => 'required|string|unique:users,nip',
            'id_mata_pelajaran'=> 'nullable|exists:mata_pelajarans,id',
        ], [
            'name.required'              => 'Nama lengkap wajib diisi.',
            'email.required'             => 'Email wajib diisi.',
            'email.email'                => 'Format email tidak valid.',
            'email.unique'               => 'Email sudah terdaftar.',
            'nip.required'               => 'NIP wajib diisi.',
            'nip.unique'                 => 'NIP sudah terdaftar.',
            'password.required'        => 'Kata sandi wajib diisi.',
            'password.min'             => 'Kata sandi minimal 6 karakter.',
            'password.confirmed'       => 'Konfirmasi kata sandi tidak cocok.',
            'id_mata_pelajaran.required' => 'Mata pelajaran wajib dipilih.',
            'id_mata_pelajaran.exists'   => 'Mata pelajaran tidak ditemukan.',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip, 
        ];

        if ($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }

        $guru->update($data);
        $guru->mataPelajaran()->sync([$request->id_mata_pelajaran]);

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Data guru {$guru->name} berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $guru)
    {
        abort_if($guru->role !== 'guru', 404);

        $name = $guru->name;
        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Akun guru {$name} berhasil dihapus");
    }

    public function confirmation(User $guru) 
    {
        abort_if($guru->role !== 'guru', 404);

        $guru->update(['status' => 'aktif']);

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Akun guru {$guru->name} telah dikonfirmasi. Guru sekarang dapat login");
    }

    public function rejected(User $guru) 
    {
        abort_if($guru->role !== 'guru', 404);

        $guru->update(['status' => 'ditolak']);

        return redirect()
            ->route('admin.guru.index')
            ->with('sukses', "Akun guru {$guru->name} telah ditolak");
    }
}
