<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\EmployeeEvaluation;
use App\Models\Employee;
use App\Models\Introduction;
use Illuminate\Http\Request;

class EmployeeEvaluationController extends Controller
{
    public function index(Request $request){
    $search = $request->search;
    $sort   = $request->sort;

    $query = EmployeeEvaluation::query()
        ->select('employee_evaluations.*')
        ->with([
            'employee.store',
            'employee.introduction',
            'employee.onboardingChecklists',
            'employee.mentorings',
            'employee.developmentScore',
        ])

        ->when($search, function ($q) use ($search) {
            $q->whereHas('employee', function ($emp) use ($search) {
                $emp->where('employee_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        });

        
    /**
     * SORTING
     */
    if ($sort) {
        switch ($sort) {

            // KPI JUNE
            case 'kpi_june_desc':
                $query->orderByDesc('kpi_june');
                break;

            case 'kpi_june_asc':
                $query->orderBy('kpi_june');
                break;

            // KPI DECEMBER
            case 'kpi_december_desc':
                $query->orderByDesc('kpi_december');
                break;

            case 'kpi_december_asc':
                $query->orderBy('kpi_december');
                break;

            // AVG DEVELOPMENT (HITUNG LANGSUNG DI SQL)
            case 'development_desc':
                $query
                    ->leftJoin(
                        'employee_training_scores',
                        'employee_training_scores.employee_id',
                        '=',
                        'employee_evaluations.employee_id'
                    )
                    ->selectRaw('(
                        (
                            employee_training_scores.rso_supervisory_skill +
                            employee_training_scores.rso_retail_salesmanship +
                            employee_training_scores.rso_customer_service_loyalty +
                            employee_training_scores.rso_product_merchandising +
                            employee_training_scores.rso_visual_merchandising +
                            employee_training_scores.rso_retail_store_promotion +
                            employee_training_scores.rso_store_financial_perspective +
                            employee_training_scores.rso_store_general_checkup_strategy
                        ) / 8
                    ) as rso_average_calc')
                    ->orderByDesc('rso_average_calc');
                break;

            case 'development_asc':
                $query
                    ->leftJoin(
                        'employee_training_scores',
                        'employee_training_scores.employee_id',
                        '=',
                        'employee_evaluations.employee_id'
                    )
                    ->selectRaw('(
                        (
                            employee_training_scores.rso_supervisory_skill +
                            employee_training_scores.rso_retail_salesmanship +
                            employee_training_scores.rso_customer_service_loyalty +
                            employee_training_scores.rso_product_merchandising +
                            employee_training_scores.rso_visual_merchandising +
                            employee_training_scores.rso_retail_store_promotion +
                            employee_training_scores.rso_store_financial_perspective +
                            employee_training_scores.rso_store_general_checkup_strategy
                        ) / 8
                    ) as rso_average_calc')
                    ->orderBy('rso_average_calc');
                break;
        }
    }

    $evaluations = $query->get();
    
        /**
         * HITUNG DATA TAMBAHAN (LOGIC LAMA KAMU)
         */
    foreach ($evaluations as $ev) {

        $employee = $ev->employee;
        $intro = $employee->introduction;

        // ===============================
        // INTRO STATUS
        // ===============================
        $ev->intro_status = ($intro && (
            $intro->fgd_analytic_score ||
            $intro->fgd_business_score ||
            $intro->fgd_leadership_score ||
            $intro->interview_analytic_score ||
            $intro->interview_business_score ||
            $intro->interview_leadership_score
        )) ? 'Sudah' : 'Belum';

        $checklists = $employee->onboardingChecklists;

        // ===============================
        // AUTO GENERATED (MONTH 0)
        // ===============================
        if ($checklists->contains(fn ($c) => $c->month == 0)) {

            $approved = 6;
            $ev->checklist_summary = '6/6';

            $ev->expected_month = 6;
            $ev->progress_delta = 0;

            $ev->checklist_color = 'gray'; // selalu abu
            $ev->is_generated = true;

        } else {

            // ===============================
            // HITUNG APPROVED MONTH
            // ===============================
            $approved = 0;

            $grouped = $checklists
                ->whereBetween('month', [1, 6])
                ->groupBy('month');

            foreach ($grouped as $weeks) {
                if (
                    $weeks->count() === 4 &&
                    $weeks->every(fn ($w) => $w->status === 'approved')
                ) {
                    $approved++;
                }
            }

            $ev->checklist_summary = $approved . '/6';

            // ===============================
            // HITUNG EXPECTED DARI JOINING DATE
            // ===============================
            if ($employee->joining_date) {

                $joining = \Carbon\Carbon::parse($employee->joining_date);
                $monthsPassed = $joining->diffInMonths(now());

                // bulan berjalan belum wajib selesai
                $expected = max(0, min($monthsPassed - 1, 6));

                $ev->expected_month = (int) $expected;

            } else {
                $ev->expected_month = 0;
            }

            // ===============================
            // HITUNG PROGRESS DELTA
            // ===============================
            $ev->progress_delta = $approved - ($ev->expected_month ?? 0);

            // ===============================
            // SET WARNA
            // ===============================
            if ($ev->progress_delta < 0) {
                $ev->checklist_color = 'red';      // 🔴 terlambat
            } elseif ($ev->progress_delta == 0) {
                $ev->checklist_color = 'green';    // 🟢 normal
            } else {
                $ev->checklist_color = 'blue';     // 🔵 lebih cepat
            }

            $ev->is_generated = false;
        }

        // ===============================
        // TOTAL MENTORING
        // ===============================
        $ev->total_mentoring = $employee->mentorings
            ->where('status', 'verified')
            ->count();

        // ===============================
        // DEVELOPMENT
        // ===============================
        $ev->avg_development = $employee->developmentScore
            ? $employee->developmentScore->rso_average
            : null;
    }
    // ===============================
    // SORTING ONBOARDING
    // ===============================
    if ($sort === 'onboarding_fast') {

        $evaluations = $evaluations
            ->where('is_generated', false)
            ->sortByDesc('progress_delta')
            ->values();

    }

    if ($sort === 'onboarding_slow') {

        $evaluations = $evaluations
            ->where('is_generated', false)
            ->sortBy('progress_delta')
            ->values();
    }

    $perPage = 10;
    $page = request()->get('page', 1);

    $evaluations = new \Illuminate\Pagination\LengthAwarePaginator(
        $evaluations->forPage($page, $perPage),
        $evaluations->count(),
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]
    );
        return view('admin.evaluations.index', compact('evaluations', 'search', 'sort'));
    }




    public function create()
    {
        $employees = Employee::select('employee_id', 'name')->get();

        return view('admin.evaluations.create', compact('employees'));
    }



    public function store(Request $request)
    {
        if ($request->filled('assessment_link') &&
            !preg_match('/^https?:\/\//', $request->assessment_link)) {

            $request->merge([
                'assessment_link' => 'https://' . $request->assessment_link
            ]);
        }
        $validated = $request->validate([

            'employee_id' => 'required|exists:employees,employee_id',

            // hanya wajib kalau KPI diisi
            'kpi_period' => 'nullable|in:june,december|required_with:business_score,behavior_score,pa_score',

            // kalau satu diisi semua wajib
            'business_score' => 'nullable|numeric|min:1|max:350|required_with:behavior_score,pa_score',
            'behavior_score' => 'nullable|numeric|min:1|max:150|required_with:business_score,pa_score',
            'pa_score'       => 'nullable|numeric|min:1|max:60|required_with:business_score,behavior_score',

            // boleh berdiri sendiri
            'assessment_link' => 'nullable|url',
        ]);

        $hasKpi =
            filled($request->business_score) ||
            filled($request->behavior_score) ||
            filled($request->pa_score);

        $updateData = [
            'assessment_link' => $validated['assessment_link'] ?? null,
        ];

        if ($hasKpi) {

            $totalKpi =
                $validated['business_score'] +
                $validated['behavior_score'] +
                $validated['pa_score'];

            if ($totalKpi > 500) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'business_score' =>
                        "Total KPI ($totalKpi) melebihi batas maksimal 500."
                    ]);
            }

            $updateData['business_score'] = $validated['business_score'];
            $updateData['behavior_score'] = $validated['behavior_score'];
            $updateData['pa_score']       = $validated['pa_score'];

            if ($validated['kpi_period'] === 'june') {
                $updateData['kpi_june'] = $totalKpi;
            } else {
                $updateData['kpi_december'] = $totalKpi;
            }
        }

        EmployeeEvaluation::updateOrCreate(
            ['employee_id' => $validated['employee_id']],
            $updateData
        );

        return redirect()
            ->route('admin.evaluations.index')
            ->with('success','Employee evaluation updated successfully.');
    }

    public function edit(EmployeeEvaluation $evaluation)
    {
        $employees = \App\Models\Employee::all();

        return view('admin.evaluations.edit', [
            'employee_evaluation' => $evaluation,
            'employees' => $employees
        ]);
    }

    public function update(Request $request, EmployeeEvaluation $evaluation)
    {
        if ($request->filled('assessment_link') &&
            !preg_match('/^https?:\/\//', $request->assessment_link)) {

            $request->merge([
                'assessment_link' => 'https://' . $request->assessment_link
            ]);
        }
        // 1. Validasi awal per input (0-500)
        $validated = $request->validate([
            'business_score'  => 'required|numeric|min:0|max:350',
            'behavior_score'  => 'required|numeric|min:0|max:150',
            'pa_score'        => 'required|numeric|min:0|max:60',
            'assessment_link' => 'nullable|url',
        ]);

        // 2. Hitung total
        $totalKpi = $validated['business_score'] + 
                    $validated['behavior_score'] + 
                    $validated['pa_score'];

        // 3. Validasi TOTAL (Sesuai revisi: total tidak boleh out of range 500)
        if ($totalKpi > 500) {
            return back()
                ->withInput()
                ->with('error', "Gagal! Total skor ($totalKpi) melebihi batas maksimal 500.");
        }

        // 4. Update Aspect
        $evaluation->business_score = $validated['business_score'];
        $evaluation->behavior_score = $validated['behavior_score'];
        $evaluation->pa_score       = $validated['pa_score'];
        $evaluation->assessment_link = $validated['assessment_link'];

        // 5. Update KPI Berdasarkan Periode yang Terisi
        // Logika: Jika kpi_december ada isinya, berarti kita sedang mengupdate periode Dec.
        // Jika tidak, kita update periode June.
        if (!is_null($evaluation->kpi_december)) {
            $evaluation->kpi_december = $totalKpi;
        } else {
            $evaluation->kpi_june = $totalKpi;
        }

        $evaluation->save();

        return redirect()
            ->route('admin.evaluations.index')
            ->with('success', 'Employee evaluation updated successfully.');
    }

    public function destroy(EmployeeEvaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('admin.evaluations.index')
            ->with('success', 'Employee evaluation deleted.');
    }

    public function search(Request $request)
    {
        $q = trim($request->get('q'));

        if ($q === '') {
            return response()->json([]);
        }

        $employees = Employee::where('employee_id', 'LIKE', "%{$q}%")
            ->orWhere('name', 'LIKE', "%{$q}%")
            ->limit(10)
            ->get(['employee_id', 'name']);

        return response()->json($employees);
    }

public function export(Request $request)
{
    $search = $request->search;


    $evaluations = EmployeeEvaluation::with([
        'employee.store',
        'employee.introduction',
        'employee.onboardingChecklists',
        'employee.mentorings',
        'employee.developmentScore',
    ])
    ->when($search, function ($query) use ($search) {
        $query->whereHas('employee', function ($q) use ($search) {
            $q->where('employee_id', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%");
        });
    })
    ->orderByDesc('created_at')
    ->get()
    ->groupBy('employee_id')
    ->map(fn ($rows) => $rows->first());

    foreach ($evaluations as $ev) {

        $employee = $ev->employee;

        $intro = $employee->introduction;
        $ev->intro_status = ($intro && (
            $intro->fgd_analytic_score ||
            $intro->fgd_business_score ||
            $intro->fgd_leadership_score ||
            $intro->interview_analytic_score ||
            $intro->interview_business_score ||
            $intro->interview_leadership_score
        )) ? 'Sudah' : 'Belum';

        $checklists = $employee->onboardingChecklists;

        if ($checklists->contains(fn ($c) => $c->month == 0)) {
            $ev->checklist_summary = '6/6';
        } else {
            $approved = 0;
            $grouped = $checklists
                ->whereBetween('month', [1, 6])
                ->groupBy('month');

            foreach ($grouped as $weeks) {
                if (
                    $weeks->count() === 4 &&
                    $weeks->every(fn ($w) => $w->status === 'approved')
                ) {
                    $approved++;
                }
            }

            $ev->checklist_summary = $approved . '/6';
        }

        $ev->total_mentoring = $employee->mentorings
            ->where('status', 'verified')
            ->count();

        $ev->avg_development = $employee->developmentScore
            ? $employee->developmentScore->rso_average
            : 'Pending';
    }

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename=employee-evaluation.csv',
    ];

    return response()->stream(function () use ($evaluations) {

        $file = fopen('php://output', 'w');

        fwrite($file, "\xEF\xBB\xBF");

        fputcsv($file, [
            'Employee ID',
            'Employee Name',
            'Store',
            'Introduction',
            '6-Month Checklist',
            'KPI June',
            'KPI December',
            'Total Mentoring',
            'Avg Development',
            'Assessment Link',
        ]);

        foreach ($evaluations as $ev) {

            $emp = $ev->employee;
            if (!$emp) continue;

        fputcsv($file, [
            "'".$emp->employee_id,           
            $this->cleanCsv($emp->name),
            $this->cleanCsv($emp->store->name ?? '-'),
            $ev->intro_status,

            "'".$ev->checklist_summary,        

            $ev->kpi_june !== null ? $ev->kpi_june : '-',
            $ev->kpi_december !== null ? $ev->kpi_december : '-',

            $ev->total_mentoring . 'x',

            is_numeric($ev->avg_development)
                ? $ev->avg_development
                : 'Pending',

            $this->cleanCsv($ev->assessment_link ?? '-'),
        ]);

        }

        fclose($file);

    }, 200, $headers);
}

public function show($id)
{
    $employee_evaluation = EmployeeEvaluation::with('employee')->findOrFail($id);

    return view('admin.evaluations.show', compact('employee_evaluation'));
}

public function downloadTemplate(string $type)
{
    $templates = [
        'kpi' => 'KPI.csv',
        'assessment' => 'assessment.csv',
    ];

    if (!array_key_exists($type, $templates)) {
        abort(404);
    }

    // path ke public/templates
    $path = public_path('templates/' . $templates[$type]);

    if (!file_exists($path)) {
        abort(404, 'Template file not found');
    }

    return response()->download($path);
}




private function cleanCsv($value)
{
    if ($value === null) return '-';

    return trim(
        preg_replace('/\s+/', ' ', str_replace(["\r", "\n"], ' ', $value))
    );
}

public function import(Request $request, string $period)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    if (!in_array($period, ['june', 'december'])) {
        abort(404);
    }

    $file = fopen($request->file('file'), 'r');

    $firstLine = fgets($file);
    if (str_contains($firstLine, ';')) {
        $delimiter = ';';
    } elseif (str_contains($firstLine, "\t")) {
        $delimiter = "\t";
    } else {
        $delimiter = ',';
    }
    rewind($file);


    fgetcsv($file, 0, $delimiter);

    $read    = 0;
    $created = 0;
    $updated = 0;
    $skipped = 0;
    $errors = [];

    while (($row = fgetcsv($file, 0, $delimiter)) !== false) {


        $read++;

        $employeeId = str_pad(trim($row[0]), 6, '0', STR_PAD_LEFT);
        $business   = (float) str_replace(',', '.', $row[1] ?? 0);
        $behavior   = (float) str_replace(',', '.', $row[2] ?? 0);
        $pa         = (float) str_replace(',', '.', $row[3] ?? 0);

        $totalKpi = $business + $behavior + $pa;

        if (!Employee::where('employee_id', $employeeId)->exists()) {

            $errors[] = [
                'employee_id' => $employeeId,
                'issue' => 'Employee tidak ditemukan'
            ];

            $skipped++;
            continue;
        }

        $data = [
            'business_score' => $business,
            'behavior_score' => $behavior,
            'pa_score'       => $pa,
        ];

        if ($period === 'june') {
            $data['kpi_june'] = $totalKpi;
        } else {
            $data['kpi_december'] = $totalKpi;
        }

        $evaluation = \App\Models\EmployeeEvaluation::where(
            'employee_id',
            $employeeId
        )->first();

        if ($evaluation) {
            $evaluation->update($data);
            $updated++;
        } else {
            \App\Models\EmployeeEvaluation::create(
                array_merge(['employee_id' => $employeeId], $data)
            );
            $created++;
        }
    }

    fclose($file);

    return back()->with(
        'success',
        "Import KPI completed. 
        Read: {$read}, 
        Created: {$created}, 
        Updated: {$updated}, 
        Skipped: {$skipped}."
        )->with('errors_import', $errors
    );

}

public function importAssessment(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $file = fopen($request->file('file'), 'r');

    $firstLine = fgets($file);

    if (str_contains($firstLine, ';')) {
        $delimiter = ';';
    } elseif (str_contains($firstLine, "\t")) {
        $delimiter = "\t";
    } else {
        $delimiter = ',';
    }
    rewind($file);


    fgetcsv($file, 0, $delimiter);

    $read    = 0;
    $created = 0;
    $updated = 0;
    $skipped = 0;
    $errors = [];

    while (($row = fgetcsv($file, 0, $delimiter)) !== false) {

        if (count($row) < 2 || trim($row[0]) === '') {
            $skipped++;
            continue;
        }

        $read++;

        $employeeId = str_pad(trim($row[0]), 6, '0', STR_PAD_LEFT);
        $assessmentLink = trim($row[1]);

        if (!Employee::where('employee_id', $employeeId)->exists()) {

            $errors[] = [
                'employee_id' => $employeeId,
                'issue' => 'Employee tidak ditemukan'
            ];

            $skipped++;
            continue;
        }

        $evaluation = EmployeeEvaluation::where(
            'employee_id',
            $employeeId
        )->first();

        if ($evaluation) {
            if ($evaluation->assessment_link !== $assessmentLink) {
                $evaluation->update([
                    'assessment_link' => $assessmentLink
                ]);
                $updated++;
            }
        } else {
            EmployeeEvaluation::create([
                'employee_id'     => $employeeId,
                'assessment_link' => $assessmentLink
            ]);
            $created++;
        }
    }

    fclose($file);

    return back()->with(
        'success',
        "Import Assessment completed. 
        Read: {$read}, 
        Created: {$created}, 
        Updated: {$updated}, 
        Skipped: {$skipped}."
        )->with('errors_import', $errors
    );

}

    public function reset()
    {
        try {
            // Mengosongkan kolom skor untuk semua record di tabel evaluations
            EmployeeEvaluation::query()->update([
                'business_score' => null,
                'behavior_score' => null,
                'pa_score'       => null,
                'kpi_june'       => null,
                'kpi_december'   => null,
            ]);

            return redirect()->back()->with('success', 'Semua data KPI berhasil direset menjadi kosong.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mereset data: ' . $e->getMessage());
        }
    }
} 
