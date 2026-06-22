<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeTrainingScore;
use App\Models\Employee;

class EmployeeTrainingScoreController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $scores = EmployeeTrainingScore::with(['employee.store'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('employee', function ($emp) use ($search) {
                    $emp->where('employee_id', 'LIKE', "%{$search}%")
                        ->orWhere('name', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.development.index', compact('scores', 'search'));
}


    public function search(Request $request)
    {
        $q = trim((string) $request->input('q', ''));

        if ($q === '') {
            return response()->json([]);
        }

        $results = Employee::query()
            ->where('employee_id', 'LIKE', "%{$q}%")
            ->orWhere('name', 'LIKE', "%{$q}%")
            ->limit(10)
            ->get(['employee_id', 'name']);

        return response()->json($results);
    }

    
    public function create()
    {
        $employees = Employee::all();
        return view('admin.development.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => [
                'required',
                'exists:employees,employee_id',
                'unique:employee_training_scores,employee_id'
            ],
            'gramedia_daily_store' => 'nullable|integer|min:0|max:100',
            'rso_supervisory_skill' => 'nullable|integer|min:0|max:100',
            'rso_retail_salesmanship' => 'nullable|integer|min:0|max:100',
            'rso_customer_service_loyalty' => 'nullable|integer|min:0|max:100',
            'rso_product_merchandising' => 'nullable|integer|min:0|max:100',
            'rso_visual_merchandising' => 'nullable|integer|min:0|max:100',
            'rso_retail_store_promotion' => 'nullable|integer|min:0|max:100',
            'rso_store_financial_perspective' => 'nullable|integer|min:0|max:100',
            'rso_store_general_checkup_strategy' => 'nullable|integer|min:0|max:100',
            'learning_hours' => 'nullable|numeric|min:0',
            'nilai_ngecas' => 'nullable|integer|min:0|max:100',
            'inhouse_training' => 'nullable|string',
            'public_training' => 'nullable|string',
            'intensive_training' => 'nullable|string',
            'development_program' => 'nullable|string',
        ],[
            'employee_id.unique' => 'Employee ini sudah memiliki training score.',
            'employee_id.exists' => 'Employee tidak ditemukan di database.',
            'employee_id.required' => 'Employee wajib dipilih.',
        ]);

        EmployeeTrainingScore::create($validated);

        return redirect()
            ->route('admin.development.index')
            ->with('success', 'Training score saved successfully.');
    }


    public function searchEmployees(Request $request)
    {
        $q = $request->q;

        $results = Employee::where('employee_id', 'LIKE', "%{$q}%")
            ->orWhere('name', 'LIKE', "%{$q}%")
            ->limit(10)
            ->get(['employee_id', 'name']);

        return response()->json($results);
    }

    public function edit($id)
    {
        $score = EmployeeTrainingScore::findOrFail($id);
        $employees = Employee::all();

        return view('admin.development.edit', compact('score', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $score = EmployeeTrainingScore::findOrFail($id);

        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',

            'gramedia_daily_store' => 'nullable|integer|min:0|max:100',
            'rso_supervisory_skill' => 'nullable|integer|min:0|max:100',
            'rso_retail_salesmanship' => 'nullable|integer|min:0|max:100',
            'rso_customer_service_loyalty' => 'nullable|integer|min:0|max:100',
            'rso_product_merchandising' => 'nullable|integer|min:0|max:100',
            'rso_visual_merchandising' => 'nullable|integer|min:0|max:100',
            'rso_retail_store_promotion' => 'nullable|integer|min:0|max:100',
            'rso_store_financial_perspective' => 'nullable|integer|min:0|max:100',
            'rso_store_general_checkup_strategy' => 'nullable|integer|min:0|max:100',

            'learning_hours' => 'nullable|numeric|min:0',
            'nilai_ngecas' => 'nullable|integer|min:0|max:100',

            'inhouse_training' => 'nullable|string',
            'public_training' => 'nullable|string',
            'intensive_training' => 'nullable|string',
            'development_program' => 'nullable|string',
        ]);

        $score->update($validated);

        return redirect()
            ->route('admin.development.index')
            ->with('success', 'Training score updated successfully.');
    }

    public function show($id)
    {
        $score =  EmployeeTrainingScore::with(['employee.store'])->findOrFail($id);

        return view('admin.development.show', compact('score'));
    }


    public function destroy($id)
    {
        EmployeeTrainingScore::destroy($id);

        return redirect()
            ->route('admin.development.index')
            ->with('success', 'Training score deleted.');
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        // helper: kosong ('') → null, angka → float
        $num = function ($v) {
            if ($v === '' || $v === null) {
                return null;
            }
            return (float) str_replace(',', '.', $v);
        };

        // helper: string kosong → null
        $str = function ($v) {
            return ($v === '' || $v === null) ? null : trim($v);
        };

        $file = fopen($request->file('file'), 'r');

        // detect delimiter
        $firstLine = fgets($file);
        $delimiter = str_contains($firstLine, ';') ? ';'
            : (str_contains($firstLine, "\t") ? "\t" : ',');
        rewind($file);

        // skip header
        fgetcsv($file, 0, $delimiter);

        $read = 0;
        $created = 0;
        $updated = 0;
        $skipped = 0;
        $errors = [];

        while (($row = fgetcsv($file, 0, $delimiter)) !== false) {

            if (count($row) < 2 || empty($row[0])) {
                $skipped++;
                continue;
            }

            $read++;

            $employeeId = str_pad(trim($row[0]), 6, '0', STR_PAD_LEFT);

            // employee harus ada
            if (!Employee::where('employee_id', $employeeId)->exists()) {

                $errors[] = [
                    'employee_id' => $employeeId,
                    'issue' => 'Employee tidak ditemukan'
                ];

                $skipped++;
                continue;
            }

            $data = [
                'employee_id'                         => $employeeId,
                'gramedia_daily_store'               => $num($row[1] ?? null),
                'rso_supervisory_skill'              => $num($row[2] ?? null),
                'rso_retail_salesmanship'            => $num($row[3] ?? null),
                'rso_customer_service_loyalty'       => $num($row[4] ?? null),
                'rso_product_merchandising'          => $num($row[5] ?? null),
                'rso_visual_merchandising'           => $num($row[6] ?? null),
                'rso_retail_store_promotion'         => $num($row[7] ?? null),
                'rso_store_financial_perspective'    => $num($row[8] ?? null),
                'rso_store_general_checkup_strategy' => $num($row[9] ?? null),
                'learning_hours'                     => $num($row[10] ?? null),
                'nilai_ngecas'                       => $num($row[11] ?? null),
                'inhouse_training'                   => $str($row[12] ?? null),
                'public_training'                    => $str($row[13] ?? null),
                'intensive_training'                 => $str($row[14] ?? null),
                'development_program'                => $str($row[15] ?? null),
            ];

            $existing = EmployeeTrainingScore::where(
                'employee_id',
                $employeeId
            )->first();

            if ($existing) {
                $existing->update($data);
                $updated++;
            } else {
                EmployeeTrainingScore::create($data);
                $created++;
            }
        }

        fclose($file);

        return back()
            ->with('success', "Import Training Score selesai.
                {$read} baris dibaca,
                {$created} data dibuat,
                {$updated} diperbarui,
                {$skipped} dilewati.")
            ->with('errors_import', $errors);
            }


}
