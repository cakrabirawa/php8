<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndividualDevelopmentPlan;
use App\Models\Employee;
use App\Models\IdpTask;
use App\Models\Competency;
use Illuminate\Http\Request;

class IDPController extends Controller
{

    // LIST IDP UNTUK HR
    public function index(Request $request)
    {

        $query = IndividualDevelopmentPlan::with(['employee','tasks']);

        if($request->search){

            $search = $request->search;

            $query->whereHas('employee', function($q) use ($search){
                $q->where('name','like',"%$search%")
                ->orWhere('employee_id','like',"%$search%");
            });

        }

        $idps = $query
            ->whereIn('status',['draft','pending','waiting_hr','completed'])
            ->latest()
            ->get();

        return view('admin.idp.index',compact('idps'));

    }


    // DETAIL IDP
    public function show($id)
    {

        $idp = IndividualDevelopmentPlan::with(['employee','tasks'])
            ->findOrFail($id);

        $levels = IndividualDevelopmentPlan::levels();

        $currentLevel = $levels[$idp->current_level] ?? '-';
        $targetLevel = $levels[$idp->target_level] ?? '-';

        return view('admin.idp.show',compact(
            'idp',
            'currentLevel',
            'targetLevel'
        ));
    }



    // APPROVE HR
    public function approve(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required'
        ]);

        $idp = IndividualDevelopmentPlan::with('tasks')->findOrFail($id);

        if ($idp->status !== 'waiting_hr') {
            return back()->with('error', 'IDP belum siap untuk approval HR');
        }

        // ambil task terakhir yang completed & belum ada feedback HR
        $task = IdpTask::where('idp_id', $idp->id)
            ->where('status', 'completed')
            ->whereNull('feedback_hr')
            ->latest()
            ->first();

        if (!$task) {
            return back()->with('error', 'Tidak ada task completed yang perlu diberi feedback HR');
        }

        // update hanya task ini
        $task->update([
            'feedback_hr' => $request->feedback
        ]);

        // cek semua task completed
        $allCompleted = $idp->tasks->isNotEmpty() &&
            $idp->tasks->every(fn($t) => $t->status === 'completed');

        // update status IDP
        $idp->update([
            'status' => $allCompleted ? 'completed' : 'draft'
        ]);

        return redirect()
            ->route('admin.idp.index')
            ->with('success', $allCompleted
                ? 'IDP berhasil diapprove HR'
                : 'Masih ada task yang belum selesai, status dikembalikan ke draft');
    }
    public function competencyIndex()
    {
        $competencies = Competency::latest()->get();

        return view('admin.competency.index', compact('competencies'));
    }
}