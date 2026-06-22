<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Mentoring;
use App\Models\EmployeeEvaluation;

class DashboardController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;

        /* =======================
         * SUMMARY
         * ======================= */

        $totalSpv = Employee::where('store_id', $store->id)->count();

        $onboardingPending = Employee::where('store_id', $store->id)
            ->whereDoesntHave('onboardingChecklists', fn ($q) =>
                $q->where('month', 0)
            )
            ->whereHas('onboardingChecklists', fn ($q) =>
                $q->whereBetween('month', [1, 6])
                  ->where('status', '!=', 'approved')
            )
            ->count();

        $mentoringActive = Mentoring::whereHas('employee', fn ($q) =>
            $q->where('store_id', $store->id)
        )
        ->where('status', 'verified')
        ->count();

        $developmentPending = Employee::where('store_id', $store->id)
            ->whereDoesntHave('developmentScore')
            ->count();

        /* =======================
         * MAIN DATA (SEMUA EMPLOYEE TOKO)
         * ======================= */

        $supervisors = Employee::with([
                'evaluation',
                'introduction',
                'onboardingChecklists',
                'mentorings',
                'developmentScore',
            ])
            ->where('store_id', $store->id)
            ->get()
            ->map(function ($emp) {

                // evaluation optional
                $ev = $emp->evaluation ?? new EmployeeEvaluation();

                /* ===== INTRO STATUS ===== */
                $intro = $emp->introduction;
                $ev->intro_status = $intro &&
                    !(
                        $intro->fgd_analytic_score == 0 &&
                        $intro->fgd_business_score == 0 &&
                        $intro->fgd_leadership_score == 0 &&
                        $intro->interview_analytic_score == 0 &&
                        $intro->interview_business_score == 0 &&
                        $intro->interview_leadership_score == 0
                    )
                    ? 'Sudah'
                    : 'Belum';

                /* ===== CHECKLIST SUMMARY ===== */
                $checklists = $emp->onboardingChecklists;

                if ($checklists->contains(fn ($c) => $c->month == 0)) {
                    $ev->checklist_summary = '6/6';
                } else {
                    $approvedMonths = 0;

                    $grouped = $checklists
                        ->whereBetween('month', [1, 6])
                        ->groupBy('month');

                    foreach ($grouped as $weeks) {
                        if (
                            $weeks->count() === 4 &&
                            $weeks->every(fn ($w) => $w->status === 'approved')
                        ) {
                            $approvedMonths++;
                        }
                    }

                    $ev->checklist_summary = $approvedMonths . '/6';
                }

                /* ===== MENTORING ===== */
                $ev->total_mentoring = $emp->mentorings
                    ->where('status', 'verified')
                    ->count();

                /* ===== DEVELOPMENT ===== */
                $ev->avg_development = $emp->developmentScore
                    ? $emp->developmentScore->rso_average
                    : null;

                /* ===== KPI (JAGA BIAR GA ERROR DI BLADE) ===== */
                $ev->kpi_june = $ev->kpi_june ?? null;
                $ev->kpi_december = $ev->kpi_december ?? null;

                // inject employee ke object evaluation
                $ev->employee = $emp;

                return $ev;
            });

        return view('user.dashboard', compact(
            'totalSpv',
            'onboardingPending',
            'mentoringActive',
            'developmentPending',
            'supervisors'
        ));
    }
}
