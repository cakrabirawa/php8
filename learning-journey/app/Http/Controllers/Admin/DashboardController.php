<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeTrainingScore;
use App\Models\EmployeeEvaluation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ===============================
        // EMPLOYEES
        // ===============================
        $employees = Employee::with(['store', 'onboardingChecklists'])->get();
        $totalEmployees = $employees->count();

        // ===============================
        // ONBOARDING CHECKLIST SUMMARY
        // ===============================
        $totalApprovedMonthsAllEmployees = 0;
        $monthCompletedCounts = array_fill(1, 6, 0);

        foreach ($employees as $emp) {

            $grouped = $emp->onboardingChecklists
                ->whereBetween('month', [1, 6])
                ->groupBy('month');

            $approvedMonths = 0;

            foreach ($grouped as $month => $weeks) {

                // ✅ FIX: tidak pakai count === 4
                if (
                    $weeks->count() > 0 &&
                    $weeks->every(fn ($w) => $w->status === 'approved')
                ) {
                    $approvedMonths++;
                    $monthCompletedCounts[$month]++;
                }
            }

            $totalApprovedMonthsAllEmployees += $approvedMonths;
        }

        // Average completed months
        $avgCompletedMonths = $totalEmployees > 0
            ? round($totalApprovedMonthsAllEmployees / $totalEmployees, 1)
            : 0;

        // Overall completion percent
        $overallCompletionPercent = ($totalEmployees * 6) > 0
            ? round(($totalApprovedMonthsAllEmployees / ($totalEmployees * 6)) * 100)
            : 0;

        // ===============================
        // KPI (FROM employee_evaluations)
        // ===============================
        $kpiJuneAvg = round(
            EmployeeEvaluation::whereNotNull('kpi_june')->avg('kpi_june') ?? 0,
            1
        );

        $kpiDecAvg = round(
            EmployeeEvaluation::whereNotNull('kpi_december')->avg('kpi_december') ?? 0,
            1
        );

        // ===============================
        // DEVELOPMENT SUMMARY
        // ===============================
        $employeesWithDevelopmentProgram = EmployeeTrainingScore::whereNotNull('development_program')
            ->where('development_program', '!=', '')
            ->distinct('employee_id')
            ->count('employee_id');

        $developmentProgramPercent = $totalEmployees > 0
            ? round(($employeesWithDevelopmentProgram / $totalEmployees) * 100)
            : 0;

        $avgLearningHours = round(
            EmployeeTrainingScore::avg('learning_hours') ?? 0,
            1
        );

        // ===============================
        // MONTHLY PROGRESS (%)
        // ===============================
        $monthProgressPercent = [];
        for ($m = 1; $m <= 6; $m++) {
            $monthProgressPercent[$m] = $totalEmployees > 0
                ? round(($monthCompletedCounts[$m] / $totalEmployees) * 100)
                : 0;
        }

        return view('admin.dashboard', compact(
            'totalEmployees',
            'avgCompletedMonths',
            'overallCompletionPercent',
            'kpiJuneAvg',
            'kpiDecAvg',
            'employeesWithDevelopmentProgram',
            'developmentProgramPercent',
            'avgLearningHours',
            'monthProgressPercent'
        ));
    }
}
