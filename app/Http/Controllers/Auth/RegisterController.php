<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\View\View as IlluminateView;

class RegisterController extends Controller
{
    public function showForm(): IlluminateView|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        $mataPelajaran = MataPelajaran::orderBy('name')->get();

        return view('auth.register', compact('mataPelajaran'));
    }

    public function register(Request $request): RedirectResponse
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
            ->route('login')
            ->with('sukses', 'Pendaftaran berhasil! Akun Anda sedang menunggu konfirmasi dari admin. silahkan login setelah dikonfirmasi.');
    }

    private function redirectByRole(): RedirectResponse
    {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            default => redirect()->route('login'),
        };
    }
}
