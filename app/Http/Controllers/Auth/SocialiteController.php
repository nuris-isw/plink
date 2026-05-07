<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Mencari user berdasarkan email yang didaftarkan oleh admin
            $user = User::where('email', $googleUser->email)->first();

            // Jika email tidak ditemukan di database, tolak akses
            if (!$user) {
                return redirect()->route('login')->withErrors([
                    'email' => 'Email Anda belum terdaftar di sistem. Silakan hubungi Admin instansi.',
                ]);
            }

            // Update data profil dari Google (opsional)
            $user->update([
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
            ]);

            Auth::login($user);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Terjadi kesalahan saat mencoba login dengan Google.',
            ]);
        }


    }
}
