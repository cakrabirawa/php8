<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\ProfileController;

// 1. Otomatis alihkan root ke login jika belum masuk
Route::get('/', function () {
    return redirect()->route('login');
});

// GROUP ROUTE: Semua rute di bawah ini wajib LOGIN terlebih dahulu
Route::middleware(['auth', 'verified'])->group(function () {

    // Rute Utama Dashboard (Mengembalikan layout penuh)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/products', function () {
        return view('dashboard');
    });
    Route::get('/active-orders', function () {
        return view('dashboard');
    });
    Route::get('/admin/create-user', function () {
        return view('dashboard');
    });

    // Rute Khusus untuk Fetch API (Mengembalikan HTML Parsial)
    Route::get('/ajax/page/{name}', function ($name) {
        $targetPath = "partials.{$name}";
        if (view()->exists($targetPath)) {
            return view($targetPath);
        }
        return response('Halaman tidak ditemukan', 404);
    });

    // ACTION POST: Proses pendaftaran user baru via Fetch / AJAX
    Route::post('/admin/user', function (Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => true, 'message' => 'User baru berhasil dibuat!']);
    });

    // ================= PERBAIKAN: RUTE PROFIL BAWAAN BREEZE =================
    // Kita sediakan rute kosong/tiruan agar Breeze tidak memicu error RouteNotFound
    Route::get('/profile', function () {
        return view('dashboard');
    })->name('profile.edit');
    Route::patch('/profile', function () {
        return back();
    })->name('profile.update');
    Route::delete('/profile', function () {
        return back();
    })->name('profile.destroy');
});

require __DIR__ . '/auth.php';
