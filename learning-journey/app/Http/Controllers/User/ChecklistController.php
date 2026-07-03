<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\OnboardingChecklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    // ===============================
    // LIST EMPLOYEE & STATUS BULAN
    // ===============================
public function index()
{
    $store = auth()->user()->store;

    $employees = Employee::where('store_id', $store->id)
        ->with('onboardingChecklists')
        ->get()
        ->map(function ($employee) {

            // 🔥 AUTO APPROVED CHECK
            $hasAutoApproved = $employee->onboardingChecklists
                ->contains(fn($c) => $c->month == 0 && $c->week == 0);

            if ($hasAutoApproved) {
                $employee->months = collect(range(1, 6))->map(fn($m) => [
                    'month' => $m,
                    'status' => 'approved',
                    'locked' => true,
                    'auto' => true,
                ]);

                return $employee;
            }

            $previousMonthApproved = true;

            $months = collect(range(1, 6))->map(function ($month) use ($employee, &$previousMonthApproved) {

                $records = $employee->onboardingChecklists->where('month', $month);

                // 🔹 STATUS
                if ($records->isEmpty()) {
                    $status = 'not_yet';
                } elseif ($records->contains('status', 'pending_sm')) {
                    $status = 'pending_sm';
                } elseif ($records->contains('status', 'pending')) {
                    $status = 'pending';
                } elseif ($records->contains('status', 'rejected')) {
                    $status = 'rejected';
                } elseif ($records->every(fn($r) => $r->status === 'approved')) {
                    $status = 'approved';
                } else {
                    $status = 'draft';
                }

                // 🔥 LOCK LOGIC (urutan bulan)
                $locked = !$previousMonthApproved;

                // update status untuk bulan berikutnya
                $previousMonthApproved = ($status === 'approved');

                return [
                    'month' => $month,
                    'status' => $status,
                    'locked' => $locked,
                    'auto' => false,
                ];
            });

            $employee->months = $months;
            return $employee;
        });

    return view('user.onboarding.index', compact('employees'));
}       

    // ===============================
    // REVIEW BULAN (lihat detail week)
    // ===============================
    public function review($employeeId, $month)
    {
        $employee = Employee::findOrFail($employeeId);

        $checklists = OnboardingChecklist::where([
            'employee_id' => $employeeId,
            'month' => $month
        ])->orderBy('week')->get();

        return view('user.onboarding.review', compact(
            'employee',
            'month',
            'checklists'
        ));
    }

    // ===============================
    // CONFIRM BULAN → KIRIM KE HR
    // ===============================
    public function confirm(Request $request, $employeeId, $month)
    {
        $request->validate([
            'filled_by' => 'required|string|max:255', // ✅ wajib diisi SM
            'notes_store_manager' => 'nullable|string|max:1000',
            'score' => 'required|integer|min:1|max:100',
        ]);

        $updated = OnboardingChecklist::where([
            'employee_id' => $employeeId,
            'month' => $month,
            'status' => 'pending_sm'
        ])->update([
            'status' => 'pending', // → kirim ke HR
            'notes_store_manager' => $request->notes_store_manager,
            'score' => $request->score,
            'filled_by' => $request->filled_by, // ✅ ambil dari input SM
        ]);

        if (!$updated) {
            return redirect()->back()->with('error', 'Tidak ada data yang bisa dikonfirmasi.');
        }

        return redirect()
            ->route('user.onboarding.index')
            ->with('success', "Month {$month} confirmed & sent to HR.");
    }


}