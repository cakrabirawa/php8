<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci dari query string parameter '?search='
        $search = $request->query('search');

        // Panggil fungsi library macro kita, lalu ambil datanya
        $todos = Todo::searchAllFields($search)
            ->latest()
            ->get();

        // Jika dipanggil lewat Fetch API (AJAX), kembalikan data JSON langsung
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($todos);
        }

        // Jika diakses biasa lewat browser, tampilkan halaman HTML awal
        return view('todo', compact('todos'));
    }

    // Mengembalikan data JSON saat berhasil menyimpan
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $todo = Todo::create(['title' => $request->title]);

        return response()->json($todo, 201);
    }

    // Mengembalikan status data terbaru setelah diperbarui
    public function update(Request $request, Todo $todo)
    {
        if ($request->has('title')) {
            $request->validate(['title' => 'required|string|max:255']);
            $todo->update(['title' => $request->title]);
        } else {
            $todo->update(['is_completed' => !$todo->is_completed]);
        }

        return response()->json($todo, 200);
    }

    // Mengembalikan pesan sukses setelah dihapus
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(['success' => true], 200);
    }
}
