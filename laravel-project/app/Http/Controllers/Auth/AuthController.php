<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\OtpMail;
use App\Models\Pasien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{

    public function login()
    {
        return view('login', [
            "title" => "Login"
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                if ($user->admin->admin_role === 'superadmin') {
                    return redirect('/super-admin');
                } elseif ($user->admin->admin_role === 'content admin') {
                    return redirect('/content-admin');
                }
            } elseif ($user->role === 'tenaga ahli') {
                return redirect('tenaga-ahli');
            } else {
                return redirect('/');
            }
        }

        return back()->with('error', 'Email dan Password tidak sesuai!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function registrasi()
    {
        return view('registrasi', [
            "title" => "Registrasi"
        ]);
    }

    public function registration(RegisterRequest $request)
    {

        $user = User::create([
            'role' => 'pasien',
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'password' => Hash::make($request->password),
        ]);

        Pasien::create([
            'id_user' => $user->id,
        ]);

        // Generate OTP
        $user->generateOtp();

        // Coba kirim email OTP
        $emailSent = true;
        try {
            Mail::to($user->email)->send(new OtpMail($user->otp_code));
        } catch (\Exception $e) {
            $emailSent = false;
        }

        // Login pengguna
        Auth::login($user);

        // Redirect dengan pesan sesuai hasil pengiriman email OTP
        if ($emailSent) {
            return redirect()->route('verification.notice')
                ->with('success', 'Kode OTP telah dikirimkan ke email anda.');
        } else {
            return redirect()->route('verification.notice')
                ->with('error', 'Gagal mengirim email OTP, namun akun Anda telah berhasil dibuat dan Anda telah login.');
        }
    }

    public function showVerificationNotice()
    {
        $user = Auth::user();
        // Hitung waktu kedaluwarsa dalam timestamp (milidetik)
        $otpExpiresAt = $user->otp_expires_at ? $user->otp_expires_at->timestamp : null;
        return view('verifikasi_email',[
            "title" => "Verifikasi Email",
            "otpExpiresAt" => $otpExpiresAt
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|size:6',
        ]);

        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        // Periksa apakah OTP cocok dan masih berlaku
        if ($user->otp_code !== $request->otp_code) {
            return back()->withErrors(['otp_code' => 'Kode OTP tidak sesuai.']);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp_code' => 'Kode OTP sudah expired, tekan tombol kirim ulang OTP.']);
        }

        // OTP valid, tandai email sebagai terverifikasi
        $user->update([
            $user->otp_code = null,
            $user->otp_expires_at = null,
            $user->email_verified_at = Carbon::now(),
        ]);

        return redirect('/profile')->with('success', 'Email berhasil diverifikasi!');
    }

    public function resendOtp()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
    
        // Mulai transaksi database
        DB::beginTransaction();
    
        try {
            // Generate OTP baru
            $user->generateOtp();
    
            // Coba kirim email OTP
            Mail::to($user->email)->send(new OtpMail($user->otp_code));
    
            // Jika pengiriman berhasil, komit transaksi
            DB::commit();
    
            return back()->with('success', 'OTP baru telah dikirimkan ke email anda.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback perubahan
            DB::rollBack();
    
            return back()->with('error', 'Gagal mengirim email OTP. Silakan coba lagi.');
        }
    }
}
