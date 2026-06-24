<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Tampilkan semua To-Do milik user yang sedang login di halaman dashboard
    public function index()
    {
        $todos = auth()->user()->todos()->latest()->get();
        return view('dashboard', compact('todos'));
    }

    // Simpan To-Do baru
    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);

        auth()->user()->todos()->create([
            'title' => $request->title,
        ]);

        return redirect()->back();
    }

    // Ubah status selesai / belum selesai
    public function update(Todo $todo)
    {
        // Pastikan todo ini milik user yang login
        $this->authorizeTodo($todo);

        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);

        return redirect()->back();
    }

    // Hapus To-Do
    public function destroy(Todo $todo)
    {
        $this->authorizeTodo($todo);
        $todo->delete();
        return redirect()->back();
    }

    // Helper pengaman relasi user
    private function authorizeTodo(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
