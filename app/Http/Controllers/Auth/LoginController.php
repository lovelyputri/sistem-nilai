<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ], [
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password wajib di isi'
        ]); 

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->isGuru() && ! $user->isAktif()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $message = match ($user->status) {
                    'menunggu' => 'Akun Anda masih menunggukonfirmasi dari admin. Silahkan hubungi admin.',
                    'ditolak'  => 'Akun adna telah ditolak oleh admin.',
                    default => 'Akun Anda tidak dapat mengakses sistem,',
                };

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => $message]);
            }

            return $this->redirectByRole();
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau kata sandi tidak sesuai.']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('sukses', 'Anda telah berhasil keluar');
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
