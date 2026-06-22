<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\IndividualDevelopmentPlan;
use App\Models\IdpTask;
use App\Models\Competency;
use Illuminate\Http\Request;

class IndividualDevelopmentPlanController extends Controller
{

    public function index()
    {
        $employeeId = auth()->user()->email;

        $idps = IndividualDevelopmentPlan::with(['tasks','competency'])
            ->where('employee_id', $employeeId)
            ->latest()
            ->get();

        return view('sales.idp.index', compact('idps'));
    }


    public function create()
    {
        $competencies = Competency::where('name', 'not like', '%deleted%')
            ->orderBy('name')
            ->get();
        return view('sales.idp.create', compact('competencies'));
    }


    public function store(Request $request)
    {
        $employeeId = auth()->user()->email;

        $request->validate([
            'competency_id' => 'required|exists:competencies,id',
            'current_level' => 'required',
            'target_level' => 'required',
            'target_idp' => 'required',
            'mentor_name' => 'required',
            'first_meeting_date' => 'required',

            'tasks.*' => 'required',
            'categories.*' => 'required|in:knowledge,experiential_learning,mentoring',
            'target_dates.*' => 'required|date'
        ]);

        $existing = IndividualDevelopmentPlan::where('employee_id', $employeeId)
            ->where('competency_id', $request->competency_id)
            ->latest()
            ->first();

        if ($existing && $existing->first_meeting_date) {
            $oneYearLater = \Carbon\Carbon::parse($existing->first_meeting_date)->addYear();

            if (now()->lt($oneYearLater)) {
                return back()
                    ->withInput()
                    ->with('error', 'IDP untuk competency ini sudah dibuat dan baru bisa dibuat lagi setelah 1 tahun.');
            }
        }

        $idp = IndividualDevelopmentPlan::create([
            'employee_id' => $employeeId,
            'competency_id' => $request->competency_id,
            'current_level' => $request->current_level,
            'target_level' => $request->target_level,
            'target_idp' => $request->target_idp,
            'mentor_name' => $request->mentor_name,
            'first_meeting_date' => $request->first_meeting_date,
            'status' => 'draft'
        ]);

        $tasks = array_filter($request->tasks ?? []);

    foreach ($request->tasks ?? [] as $index => $task) {

        if (!$task) continue; // skip kosong

        IdpTask::create([
            'idp_id' => $idp->id,
            'category' => $request->categories[$index] ?? 'knowledge',
            'task' => $task,
            'notes_ss' => $request->task_notes[$index] ?? null,
            'target_date' => $request->target_dates[$index] ?? null,
            'evidence_link' => $request->evidence_links[$index] ?? null,
        ]);
    }

        return redirect()
            ->route('sales.idp.index')
            ->with('success', 'IDP berhasil disimpan');
    }


    public function addTask(Request $request, $id)
    {
        $idp = IndividualDevelopmentPlan::where('id', $id)
            ->where('employee_id', auth()->user()->email)
            ->firstOrFail();

        $request->validate([
            'task' => 'required',
            'category' => 'required|in:knowledge,experiential_learning,mentoring',
            'target_date' => 'required|date'
            
        ]);

        IdpTask::create([
            'idp_id' => $idp->id,
            'category' => $request->category,
            'task' => $request->task,
            'notes_ss' => $request->notes_ss,
            'target_date' => $request->target_date,
            'evidence_link' => $request->evidence_link
        ]);

        return back()->with('success', 'Task added');
    }


    public function updateTask(Request $request, $id)
    {
        $task = IdpTask::findOrFail($id);

        if ($task->status === 'completed') {
            return back()->with('error', 'Completed task cannot be edited.');
        }

        $request->validate([
            'status' => 'required|in:pending,ongoing,completed',
            'evidence_link' => 'nullable|string'
        ]);

        if ($request->status == 'completed' && empty($request->evidence_link)) {
            return back()->with('error', 'Evidence link wajib sebelum completed.');
        }

        $task->update([
            'status' => $request->status,
            'evidence_link' => $request->evidence_link
        ]);

        if ($request->status == 'completed') {
            $task->idp->update([
                'status' => 'pending'
            ]);
        }

        return back()->with('success', 'Task updated');
    }


    public function deleteTask($id)
    {
        $task = IdpTask::findOrFail($id);

        if ($task->status === 'completed') {
            return back()->with('error', 'Completed task cannot be deleted.');
        }

        $task->delete();

        return back()->with('success', 'Task deleted');
    }


    public function edit($id)
    {
        $idp = IndividualDevelopmentPlan::with(['tasks','competency'])
            ->where('id', $id)
            ->where('employee_id', auth()->user()->email)
            ->firstOrFail();

        return view('sales.idp.edit', compact('idp'));
    }

}