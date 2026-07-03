<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnboardingChecklist;
use App\Models\ChecklistTemplate;
use App\Models\Employee;

class ChecklistController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $checklists = OnboardingChecklist::with(['employee', 'employee.store'])
            ->whereHas('employee')
            ->whereIn('status', ['pending', 'approved', 'rejected'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('employee_id', 'like', "%{$search}%")
                    ->orWhereHas('store', function ($s) use ($search) {
                        $s->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->orderBy('employee_id')
            ->orderBy('month')
            ->orderBy('week')
            ->get();



        $groupedByEmployee = $checklists->groupBy('employee_id');

        $cards = collect();

        foreach ($groupedByEmployee as $employeeId => $employeeChecklists) {
            $fullChecklist = $employeeChecklists->firstWhere('month', 0);

            if ($fullChecklist) {
                $cards->push([
                    'type'        => 'summary',
                    'employee'    => $fullChecklist->employee,
                    'employee_id' => $fullChecklist->employee_id,
                    'is_full'     => true,
                ]);
                continue; 
            }

            $byMonth = $employeeChecklists
                ->whereBetween('month', [1, 6])
                ->groupBy('month');

            $validMonths = $byMonth->filter(fn ($weeks) => $weeks->count() === 4);

            $approvedMonths = $validMonths->filter(fn ($weeks) =>
                $weeks->every(fn ($w) => $w->status === 'approved')
            )->count();

            if ($approvedMonths >= 6) {
                $first = $employeeChecklists->first();

                $cards->push([
                    'type'        => 'summary',
                    'employee'    => $first->employee,
                    'employee_id' => $first->employee_id,
                    'is_full'     => false,
                ]);

                continue;
            }

            foreach ($validMonths as $month => $items) {
                $cards->push([
                    'type'  => 'month',
                    'items' => $items,
                ]);
            }
        }


        $cards = $cards->sortBy(function ($card) {

            if (($card['is_full'] ?? false) === true) {
                return 4;
            }

            if ($card['type'] === 'summary') {
                return 3;
            }

            $items = $card['items'];

            if ($items->contains(fn($i) => $i->status === 'rejected')) {
                return 2;
            }

            if ($items->every(fn($i) => $i->status === 'approved')) {
                return 3;
            }

            return 1;
        });


        $perPage = 12;
        $page = request('page', 1);

        $paged = new \Illuminate\Pagination\LengthAwarePaginator(
            $cards->forPage($page, $perPage)->values(),
            $cards->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.onboarding.index', ['cards' => $paged]);
    }


    public function show($id)
    {
        $checklist = OnboardingChecklist::findOrFail($id);


        if ($checklist->month == 0) {
            return redirect()
                ->route('admin.checklist.index')
                ->with('info', 'Onboarding ini sudah FULL (auto approved).');
        }

        $allChecklists = OnboardingChecklist::where('employee_id', $checklist->employee_id)
            ->where('month', $checklist->month)
            ->orderBy('week')
            ->get();

        return view('admin.onboarding.show', compact('checklist', 'allChecklists'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'   => 'required|in:pending,approved,rejected',
            'notes_hr' => 'nullable|string'
        ]);

        $checklist = OnboardingChecklist::findOrFail($id);

        if ($checklist->month == 0) {
            return back()->with('error', 'Onboarding FULL tidak bisa diubah.');
        }

        $checklist->status   = $request->status;
        $checklist->notes_hr = $request->notes_hr;
        $checklist->save();

        return redirect()
            ->route('admin.checklist.show', $id)
            ->with('success', 'Status checklist berhasil diperbarui!');
    }


    public function updateMonthStatus(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'month'       => 'required',
            'status'      => 'required|in:approved,rejected',
            'notes_hr'    => 'nullable|string'
        ]);

        if ($request->month == 0) {
            return back()->with('error', 'Onboarding FULL tidak bisa diubah.');
        }

        OnboardingChecklist::where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->update([
                'status'   => $request->status,
                'notes_hr' => $request->notes_hr,
            ]);

        return redirect()
            ->route('admin.checklist.index')
            ->with('success', 'Month '.$request->month.' updated to '.$request->status.'!');
    }


    public function summary($employeeId)
    {

        $full = OnboardingChecklist::where('employee_id', $employeeId)
            ->where('month', 0)
            ->first();


        $checklists = OnboardingChecklist::with(['employee', 'employee.store'])
            ->where('employee_id', $employeeId)
            ->orderBy('month')
            ->orderBy('week')
            ->get();

        abort_if($checklists->isEmpty(), 404);

        $employee = $checklists->first()->employee;

        $months = $checklists->groupBy('month')->map(function ($weeks) {

            $status = 'pending';

            if ($weeks->every(fn($w) => $w->status === 'approved')) {
                $status = 'approved';
            } elseif ($weeks->contains(fn($w) => $w->status === 'rejected')) {
                $status = 'rejected';
            }

            return [
                'weeks'    => $weeks,
                'notes_hr' => $weeks->first()->notes_hr,
                'status'   => $status,
            ];
        });

        return view('admin.onboarding.summary', compact(
            'employee',
            'months'
        ));
    }
    public function editTemplate($month, $week)
    {
        $template = ChecklistTemplate::where([
            'month' => $month,
            'week'  => $week
        ])->firstOrFail();

        return view('admin.onboarding.edit-template', compact('template', 'month', 'week'));
    }
    public function updateTemplate(Request $request, ChecklistTemplate $template)
    {
        $request->validate([
            'title' => 'required|string|max:255',

            'items' => 'nullable|array',
            'items.*' => 'nullable|string|max:500',

            'mandatory_tasks' => 'nullable|array',
            'mandatory_tasks.*' => 'nullable|string|max:500',
        ]);

        // ================= ITEMS =================
        $formattedItems = collect($request->items ?? [])
            ->filter()
            ->map(function ($item, $index) use ($template) {

                return [
                    'id'      => 'm'.$template->month.'w'.$template->week.'_i'.($index + 1),
                    'text'    => $item,
                    'checked' => false,
                ];
            })->values()->toArray();


        // ================= MANDATORY TASKS =================
        $formattedMandatory = collect($request->mandatory_tasks ?? [])
            ->filter()
            ->map(function ($task, $index) use ($template) {

                return [
                    'id'      => 'm'.$template->month.'w'.$template->week.'_t'.($index + 1),
                    'text'    => $task,
                    'checked' => false,
                ];
            })->values()->toArray();


        // ================= SAVE =================
        $template->update([
            'template_json' => [
                'title' => $request->title,

                'items' => $formattedItems,

                'mandatory_tasks' => $formattedMandatory,
            ]
        ]);

        return back()->with('success', 'Checklist template berhasil diupdate.');
    }

    

}
