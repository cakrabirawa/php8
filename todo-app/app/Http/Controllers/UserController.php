<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Tampil List User
    public function index(Request $request)
    {
        $users = User::paginate(5); // Menggunakan paginate untuk membatasi data per halaman (misal: 5 user per halaman)

        if ($request->header('X-Injected-Page')) {
            return view('pages.users.index', ['users' => $users]);
        }

        return view('welcome', [
            'pageView' => 'pages.users.index',
            'pageTitle' => 'User Management - TailAdmin',
            'users' => $users
        ]);
    }

    // Simpan User Baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi avatar
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('avatar')) {
            // Simpan file avatar dan dapatkan path-nya
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user = User::create($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User berhasil ditambahkan.', 'user' => $user], 201);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // Update User
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Password is nullable for updates; if not provided, it won't be changed.
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi avatar
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan avatar baru dan update path
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }
        $user->save();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User berhasil diperbarui.', 'user' => $user], 200);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    // Hapus User
    public function destroy(Request $request, User $user)
    {
        // Hapus file avatar dari storage jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User berhasil dihapus.']);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
