<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Proses login user
     */
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ]);
        }

        // ⚠️ PLAINTEXT CHECK (sementara)
        if ($request->password !== $user->password) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ]);
        }
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        $user = Auth::user();

            // Routing berdasarkan role
            return match ($user->role_id) {
                1 => redirect()->route('nurse.dashboard.index'),
                2 => redirect()->route('admin.dashboard'),
                3 => redirect()->route('poli.index'),
                6 => redirect()->route('admin-registration.index'),
                default => redirect()->route('home.index'),
            };

    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home.index');
    }
}
