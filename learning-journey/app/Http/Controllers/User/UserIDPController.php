<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\IndividualDevelopmentPlan;
use App\Models\Employee;
use App\Models\IdpTask;
use Illuminate\Http\Request;

class UserIDPController extends Controller
{

    // LIST IDP YANG PERLU DIREVIEW
    public function index()
    {
        $userId = auth()->id();

        $idps = IndividualDevelopmentPlan::with(['employee','tasks'])
            ->whereIn('status', ['draft','pending','waiting_hr','completed'])
            ->whereHas('employee.store', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->get();

        return view('user.idp.index', compact('idps'));
    }



    // DETAIL IDP
    public function show($id)
    {
        $userId = auth()->id();

        $idp = IndividualDevelopmentPlan::with(['employee','tasks'])
            ->whereHas('employee.store', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->findOrFail($id);

        $levels = IndividualDevelopmentPlan::levels();

        $currentLevel = $levels[$idp->current_level] ?? '-';
        $targetLevel = $levels[$idp->target_level] ?? '-';

        return view('user.idp.show', compact(
            'idp',
            'currentLevel',
            'targetLevel'
        ));
    }


    // CONFIRM STORE MANAGER
    public function confirmSM(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string'
        ]);

        $idp = IndividualDevelopmentPlan::with('tasks')->findOrFail($id);

        if ($idp->status !== 'pending') {
            return back()->with('error', 'IDP tidak dalam status review Store Manager');
        }

        // ambil task terakhir yang completed & belum ada feedback
        $task = IdpTask::where('idp_id', $idp->id)
            ->where('status', 'completed')
            ->whereNull('feedback_sm')
            ->latest() // ambil yang paling baru
            ->first();

        if (!$task) {
            return back()->with('error', 'Tidak ada task completed yang perlu diberi feedback');
        }

        // update hanya 1 task ini
        $task->update([
            'feedback_sm' => $request->feedback
        ]);

        // update status IDP
        $idp->update([
            'status' => 'waiting_hr'
        ]);

        return back()->with('success', 'Feedback berhasil disimpan dan dikirim ke HR');
    }

}