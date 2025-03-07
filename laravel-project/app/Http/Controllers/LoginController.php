<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('user.page.index'); // Pastikan halaman ini menyertakan modal login
    }

    protected $redirectTo = '/home'; // Default redirect path

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Berhasil login sebagai admin.');
        }

        return redirect()->route('home.page')->with('success', 'Berhasil login.');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->route('login')->with('error', 'Gagal login. Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Anda berhasil logout.');
    }
}
