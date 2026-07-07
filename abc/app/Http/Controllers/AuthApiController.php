<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthApiController extends Controller
{
    // Generate posisi target acak untuk slider captcha
    public function generateCaptcha()
    {
        // Target posisi acak antara 50px sampai 230px (lebar box captcha 280px)
        $targetX = rand(50, 230);

        // Simpan posisi asli di session secara aman (jangan kirim angka ini ke user!)
        Session::put('captcha_target_x', $targetX);

        return response()->json([
            // Hanya kirim informasi untuk tampilan visual (bukan koordinat jawaban)
            'status' => 'ready'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'user_x' => 'required|numeric' // Koordinat dari geseran slider user
        ]);

        $targetX = Session::get('captcha_target_x');
        $userX = $request->input('user_x');

        // Toleransi error geseran sebesar 5 piksel
        if (abs($targetX - $userX) > 5) {
            return response()->json([
                'errors' => ['captcha' => ['Verifikasi Captcha gagal! Harap geser dengan tepat.']]
            ], 422);
        }

        // Proses login Laravel
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            // Bersihkan captcha dari session setelah sukses
            Session::forget('captcha_target_x');

            return response()->json(['message' => 'Login sukses']);
        }

        return response()->json([
            'errors' => ['email' => ['Email atau password salah.']]
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logout sukses']);
    }
}
