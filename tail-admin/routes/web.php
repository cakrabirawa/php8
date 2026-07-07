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
    Route::get('/admin/create-menu', function () {
        return view('dashboard');
    });

    // Rute Khusus untuk Fetch API (Mengembalikan HTML Parsial)
    Route::get('/ajax/page/{name}', function (string $name) {
        // Ganti garis miring dengan titik untuk mencocokkan notasi view Laravel
        $name = str_replace('/', '.', $name);

        $targetPath = "partials.{$name}";
        if (view()->exists($targetPath)) {
            return view($targetPath);
        }
        return response('Halaman tidak ditemukan', 404);
    })->where('name', '.*'); // Izinkan parameter 'name' mengandung karakter apa pun, termasuk '/'

    // Rute untuk mengambil data menu sidebar
    Route::get('/ajax/menu', function () {
        $menu = [
            [
                'id' => 'dashboard',
                'label' => 'Dashboard',
                'pageName' => 'dashboard',
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>'
            ],
            [
                'id' => 'products',
                'label' => 'Products',
                'pageName' => 'products',
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>'
            ],
            [
                'id' => 'active-orders',
                'label' => 'Active Orders',
                'pageName' => 'active-orders',
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM5 11a1 1 0 100 2h4a1 1 0 100-2H5z"></path></svg>'
            ],
            [
                'id' => 'admin/create-user',
                'label' => 'Create User',
                'pageName' => 'admin/create-user',
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>'
            ],
            [
                'id' => 'admin/create-menu',
                'label' => 'Create Menu',
                'pageName' => 'admin/create-menu',
                'icon' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>'
            ]
        ];
        return response()->json($menu);
    });

    // ACTION POST: Proses pembuatan menu baru
    Route::post('/admin/menu', function (Request $request) {
        // Untuk saat ini, kita hanya akan memvalidasi dan mengembalikan response.
        // Logika penyimpanan ke database/file bisa ditambahkan di sini.
        $validated = $request->validate([
            'id' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'pageName' => 'required|string|max:255',
            'icon' => 'required|string',
        ]);

        // Logika untuk menyimpan data menu...

        return response()->json(['success' => true, 'message' => 'Menu baru berhasil divalidasi! (Data belum disimpan)']);
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
