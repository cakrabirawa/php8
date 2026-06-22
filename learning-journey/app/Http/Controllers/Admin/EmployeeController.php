<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Employee;
use App\Models\Introduction;
use App\Models\Region;
use App\Models\Store;
use App\Models\Section;
use App\Models\Job;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterRegion = $request->input('region');
        $filterStore = $request->input('store');
        $sort = $request->input('sort');

        $employees = Employee::with(['region','store','section','job'])

            // 🔍 SEARCH
            ->when($search, function ($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('employees.employee_id', 'like', "%$search%")
                    ->orWhere('employees.name', 'like', "%$search%")

                    ->orWhereHas('store', function ($q2) use ($search) {
                        $q2->where('stores.name', 'like', "%$search%");
                    })

                    ->orWhereHas('region', function ($q3) use ($search) {
                        $q3->where('regions.name', 'like', "%$search%");
                    });
                });
            })
            
            ->when($filterRegion, function ($query) use ($filterRegion) {
                $query->where('employees.region_id', $filterRegion);
            })

            ->when($filterStore, function ($query) use ($filterStore) {
                $query->where('employees.store_id', $filterStore);
            })

            // 🔥 SORTING FIXED
            ->when($sort, function ($query) use ($sort) {

                if (str_ends_with($sort, '_asc')) {
                    $sortDir = 'asc';
                    $sortBy = str_replace('_asc', '', $sort);
                } elseif (str_ends_with($sort, '_desc')) {
                    $sortDir = 'desc';
                    $sortBy = str_replace('_desc', '', $sort);
                } else {
                    return;
                }

                if ($sortBy === 'store') {
                    $query->join('stores', 'employees.store_id', '=', 'stores.id')
                        ->orderBy('stores.name', $sortDir)
                        ->select('employees.*');
                }

                elseif ($sortBy === 'region') {
                    $query->join('regions', 'employees.region_id', '=', 'regions.id')
                        ->orderBy('regions.name', $sortDir)
                        ->select('employees.*');
                }

                else {
                    $query->orderBy('employees.' . $sortBy, $sortDir);
                }
            })

            ->paginate(20)
            ->withQueryString();

        $regions = Region::all();
        $stores = \App\Models\Store::all();

        return view('admin.employees.index', compact(
            'employees',
            'regions',
            'stores',
            'search',
            'filterRegion',
            'filterStore',
            'sort'
        ));
    }
    public function show($id)
    {
        $employee = Employee::with(['region','store','section','job'])->findOrFail($id);
        return view('admin.employees.show', compact('employee'));
    }
    public function create()
    {
        return view('admin.employees.create', [
            'regions' => \App\Models\Region::all(),
            'stores' => \App\Models\Store::all(),
            'sections' => \App\Models\Section::all(),
            'jobs' => \App\Models\Job::all(),
        ]);
    }

    public function search(Request $request)
    {
        $q = trim($request->q);

        if ($q === '') {
            return response()->json([]);
        }

        return Employee::where('employee_id', 'like', "%{$q}%")
            ->orWhere('name', 'like', "%{$q}%")
            ->limit(10)
            ->get([
                'employee_id',
                'name'
            ]);
    }


    public function store(Request $request)
    {
        $request->merge([
            'employee_id' => str_pad($request->employee_id, 6, '0', STR_PAD_LEFT)
        ]);

        $validated = $request->validate([
            'employee_id' => [
                    'required',
                    'string',
                    'max:6',
                    'regex:/^[0-9]+$/',
                    'unique:employees,employee_id'
                ],
            'name' => 'required',
            'contract_type' => 'required|in:Permanent,Contract',
            'store_id' => 'required|exists:stores,id',
            'section_id' => 'required|exists:sections,id',
            'job_id' => 'required|exists:jobs,id',
            'birthday' => 'nullable|date',
            'initial_employment_date' => 'nullable|date',
            'joining_date' => 'nullable|date',
            'permanent_date' => 'nullable|date',
        ]);

        $store = Store::findOrFail($validated['store_id']);
        $validated['region_id'] = $store->region_id;


        $employee = Employee::create($validated);

        User::create([
            'name' => $employee->name,
            'email' => (string) $validated['employee_id'],
            'password' => Hash::make('12345678'),
            'role' => User::ROLE_SALES_SUPERINTENDENT,
        ]);


        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee Created & Account Generated');

    }


    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', [
            'employee' => $employee,
            'regions' => \App\Models\Region::all(),
            'stores' => \App\Models\Store::all(),
            'sections' => \App\Models\Section::all(),
            'jobs' => \App\Models\Job::all(),
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->merge([
            'employee_id' => str_pad($request->employee_id, 6, '0', STR_PAD_LEFT)
        ]);

        $validated = $request->validate([
            'employee_id' => [
                'required',
                'string',
                'max:6',
                'regex:/^[0-9]+$/',
                Rule::unique('employees', 'employee_id')
                    ->ignore($employee->employee_id, 'employee_id')
            ],
            'name' => 'required',
            'contract_type' => 'required|in:Permanent,Contract',
            'store_id' => 'required|exists:stores,id',
            'section_id' => 'required|exists:sections,id',
            'job_id' => 'required|exists:jobs,id',
            'birthday' => 'nullable|date',
            'initial_employment_date' => 'nullable|date',
            'joining_date' => 'nullable|date', 
            'permanent_date' => 'nullable|date',
        ]);

        $store = Store::findOrFail($validated['store_id']);
        $validated['region_id'] = $store->region_id;

        // ===============================
        // SYNC KE USERS TABLE
        // ===============================

        // cari user lama berdasarkan employee_id lama
        $user = User::where('email', $employee->getOriginal('employee_id'))->first();

        if ($user) {

            // update user lama
            $user->update([
                'name'  => $validated['name'],
                'email' => (string) $validated['employee_id'],
            ]);

        } else {

            // kalau belum ada (edge case), buat baru
            User::create([
                'name'     => $validated['name'],
                'email'    => (string) $validated['employee_id'],
                'password' => Hash::make('12345678'),
                'role'     => User::ROLE_SALES_SUPERINTENDENT,
            ]);
        }


        $employee->update($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy(Employee $employee)
    {
        DB::transaction(function () use ($employee) {

            User::where('email', $employee->employee_id)->delete();

            $employee->introduction()->delete();
            $employee->mentorings()->delete();
            $employee->onboardingChecklists()->delete();
            $employee->developmentScore()->delete();

            $employee->delete();
        });

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee and related data deleted successfully');
    }


private function parseDate($value)
{
    $value = trim((string) $value);

    if ($value === '') {
        return null;
    }

    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        return $value;
    }

    if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value)) {
        return \Carbon\Carbon::createFromFormat('d/m/Y', $value)
            ->format('Y-m-d');
    }

    return null;
}


public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $file = fopen($request->file('file'), 'r');

    if (!$file) {
        return back()->with('error','File cannot be opened.');
    }

    try {

        $firstLine = fgets($file);

        $delimiter = str_contains($firstLine,"\t")
            ? "\t"
            : (str_contains($firstLine,';') ? ';' : ',');

        rewind($file);

        fgetcsv($file,0,$delimiter);

        $read    = 0;
        $created = 0;
        $updated = 0;
        $skipped = 0;

        $errors = [];

        $password = Hash::make('12345678');

        set_time_limit(300);

        static $stores = null;

        if ($stores === null) {
            $stores = DB::table('stores')
                ->get()
                ->keyBy(fn($s)=>strtolower(trim($s->name)));
        }

        while(($row=fgetcsv($file,0,$delimiter)) !== false){

            if(count($row)<8 || trim($row[0])===''){
                $errors[]=[
                    'employee_id'=>'-',
                    'name'=>'-',
                    'issue'=>'Format tidak valid / kolom kurang'
                ];

                $skipped++;
                continue;
            }

            $read++;

            $employeeId = str_pad(trim($row[0]),6,'0',STR_PAD_LEFT);

            $storeInput = trim($row[3] ?? '');

            $storeInput = preg_replace('/\bdept\b/i','',$storeInput);
            $storeInput = strtolower(trim($storeInput));

            $store = $stores[$storeInput] ?? null;

            if(!$store){

                $errors[]=[
                    'employee_id'=>$employeeId,
                    'name'=>trim($row[1] ?? '-'),
                    'issue'=>'Store tidak ditemukan: '.$row[3]
                ];

                $skipped++;
                continue;
            }

            $data = [
                'name'                    => trim($row[1]),
                'contract_type'           => trim($row[2]),

                'region_id'               => $store->region_id,
                'store_id'                => $store->id,

                'section_id'              => 1,
                'job_id'                  => 1,

                'birthday'                => $this->parseDate($row[4] ?? null),
                'initial_employment_date' => $this->parseDate($row[5] ?? null),
                'joining_date'            => $this->parseDate($row[6] ?? null),
                'permanent_date'          => $this->parseDate($row[7] ?? null),

                'updated_at'              => now(),
            ];

            $existing = Employee::where(
                'employee_id',
                $employeeId
            )->first();

            if($existing){

                $existing->update($data);
                $updated++;

            }else{

                Employee::create(
                    array_merge(
                        [
                            'employee_id'=>$employeeId,
                            'created_at'=>now()
                        ],
                        $data
                    )
                );

                $created++;
            }

            /*
            |--------------------------------------------------------------------------
            | Sync user account
            |--------------------------------------------------------------------------
            */
            User::updateOrCreate(
                ['email'=>$employeeId],
                [
                    'name'=>trim($row[1]),
                    'password'=>$password,
                    'role'=>User::ROLE_SALES_SUPERINTENDENT,
                ]
            );
        }

        fclose($file);

        return redirect()
            ->route('admin.employees.index')
            ->with([
                'success'=>
                    "Import Employees selesai.
                    Read: {$read},
                    Created: {$created},
                    Updated: {$updated},
                    Skipped: {$skipped}.",

                'errors_import'=>$errors
            ]);

    } catch(\Throwable $e){

        fclose($file);

        return back()->with(
            'error',
            'Import failed: '.$e->getMessage()
        );
    }
}


}
