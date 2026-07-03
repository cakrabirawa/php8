<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competency;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompetencyController extends Controller
{
    // LIST
    public function index()
    {
        $competencies = Competency::where('name', 'not like', '%deleted%')
        ->latest()
        ->get();

        return view('admin.competency.index', compact('competencies'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:competencies,name'
        ]);

        Competency::create([
            'name' => ( $request->name),
            'slug' => strtolower(str_replace(' ', '_', $request->name))
        ]);

        return back()->with('success', 'Competency berhasil ditambahkan');
    }

    // DELETE
    public function destroy($id)
    {
        $competency = Competency::findOrFail($id);

        // kalau belum pernah di-delete, baru tandai
        if (!str_contains($competency->name, '(deleted)')) {

            $competency->update([
                'name' => $competency->name . '_deleted_',
                'slug' => $competency->slug . '-deleted-'
            ]);

        }

        return back()->with('success', 'Competency berhasil dihapus (soft delete)');
    }
}