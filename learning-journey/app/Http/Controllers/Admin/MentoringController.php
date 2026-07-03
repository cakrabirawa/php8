<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Mentoring;

class MentoringController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $all = Mentoring::with(['employee.store'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('employee_id', 'like', "%{$search}%")
                    ->orWhereHas('store', function ($s) use ($search) {
                        $s->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->get()
            ->groupBy('employee_id')
            ->map(fn ($items) => $items->first())
            ->values();

        $perPage = 9;
        $page = request()->get('page', 1);
        $slice = $all->slice(($page - 1) * $perPage, $perPage)->values();

        $mentorings = new LengthAwarePaginator(
            $slice,
            $all->count(),
            $perPage,
            $page,
            [
                'path'  => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('admin.mentoring.index', compact('mentorings', 'search'));
    }


    public function show($employee_id)
    {
        $employee = Employee::with('store')
        ->where('employee_id', $employee_id)
        ->firstOrFail();


            $records = Mentoring::where('employee_id', $employee_id)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('admin.mentoring.show', [
            'employee' => $employee,
            'records' => $records,
        ]);
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'notes_hr' => 'nullable|string',
        ]);

        $mentoring = Mentoring::findOrFail($id);

        $mentoring->update([
            'status'   => 'verified',
            'notes_hr' => $request->notes_hr,
        ]);

        return redirect()
            ->route('admin.mentoring.index')
            ->with('success', 'Mentoring record has been verified.');
    }


}
