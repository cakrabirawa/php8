<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mentoring;
use App\Models\Employee;
use Illuminate\Http\Request;

class MentoringController extends Controller
{
    public function index()
    {
        $storeId = auth()->user()->store->id;

        $mentorings = Mentoring::whereHas('employee', function($q) use ($storeId) {
                $q->where('store_id', $storeId);
            })
            ->with('employee')
            ->orderBy('employee_id')
            ->orderBy('created_at')
            ->get()
            ->groupBy('employee_id')
            ->flatMap(function ($items) {
                return $items->values()->map(function ($item, $index) {
                    $item->mentoring_number = $index + 1;
                    return $item;
                });
            });

        return view('user.mentoring.index', compact('mentorings'));
    }


    public function create()
    {
        $storeId = auth()->user()->store->id;

        $employees = Employee::where('store_id', $storeId)->get();

        return view('user.mentoring.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'mentor_name' => 'required|string', 
            'notes' => 'nullable|string',
            'score' => 'nullable|integer|min:1|max:100', // ✅ tambah ini
        ]);
        Mentoring::create([
            'employee_id' => $request->employee_id,
            'mentor_name' => $request->mentor_name,
            'notes' => $request->notes,
            'score' => $request->score,
            'store_id' => auth()->user()->store->id,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('user.mentoring.index')
            ->with('success', 'Mentoring berhasil ditambahkan');
    }
}
