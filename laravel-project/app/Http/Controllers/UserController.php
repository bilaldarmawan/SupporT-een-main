<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->redirectTo();
        }

        return redirect()->route('login')->with('error', 'Gagal login. Email atau password salah.');
    }

    protected function redirectTo()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            return redirect()->route('admin.page.dashboard')->with('success', 'Berhasil login sebagai admin.');
        }
        return redirect()->route('home')->with('success', 'Berhasil login.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Ubah bagian ini untuk membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => false, // Default ke false
            'role' => 'user', // Default role
        ]);

        return redirect()->route('login')->with('success', 'Berhasil registrasi. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Anda berhasil logout.');
    }
}
