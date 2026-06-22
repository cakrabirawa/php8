<?php

namespace App\Http\Controllers\Sales;

use App\Models\Employee;
use App\Models\OnboardingChecklist;
use App\Models\ChecklistTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OnboardingSSController extends Controller
{
    // ===============================
    // LIST EMPLOYEE & PROGRESS
    // ===============================
    public function index()
{
    // Ambil data employee
    $employee = Employee::where('employee_id', auth()->user()->email)->firstOrFail();

    // 1. Definisikan Trigger di tingkat paling atas agar bisa diakses semua Closure
    $hasMonthZero = OnboardingChecklist::where([
        'employee_id' => $employee->employee_id,
        'month'       => 0,
    ])->exists();

    $employees = collect([$employee])->map(function ($employee) use ($hasMonthZero) {
        
        // 2. Loop Month 1 sampai 6
        $months = collect(range(1, 6))->map(function ($month) use ($employee, $hasMonthZero) {
            
            $records = OnboardingChecklist::where([
                'employee_id' => $employee->employee_id,
                'month'       => $month,
            ])->get();

            // 3. Logika Penentuan Status Bulan
            if ($records->isEmpty()) {
                // Jika Month 0 ada, status jadi generated (ungu), jika tidak ada tetap not_yet (abu)
                $monthStatus = $hasMonthZero ? 'generated' : 'not_yet';
            } elseif ($records->contains('status', 'rejected')) {
                $monthStatus = 'rejected';
            } elseif ($records->contains('status', 'pending_sm')) {
                $monthStatus = 'pending_sm';
            } elseif ($records->contains('status', 'pending')) {
                $monthStatus = 'pending';
            } elseif ($records->every(fn ($r) => $r->status === 'approved')) {
                $monthStatus = 'approved';
            } else {
                $monthStatus = 'draft';
            }

            // 4. Logika Status Minggu (Week 1-4)
            $weeks = collect(range(1,4))->map(function ($week) use ($employee,$month){

                $record = OnboardingChecklist::where([
                    'employee_id'=>$employee->employee_id,
                    'month'=>$month,
                    'week'=>$week,
                ])->first();


                /*
                ==========================
                DEFAULT kalau belum ada record
                ==========================
                */
                if(!$record){
                    return [
                        'week'=> $week,
                        'fill_status'=>'ready',
                        'fill_label'=>'Ready to Fill',
                        'locked'=>false,
                    ];
                }


                /*
                ==========================
                HITUNG CHECKLIST
                ==========================
                */
                $data = $record->checklist_json ?? [];

                $items = $data['items'] ?? [];
                $mandatory = $data['mandatory_tasks'] ?? [];

                $allTasks = array_merge(
                    is_array($items) ? $items : [],
                    is_array($mandatory) ? $mandatory : []
                );

                $totalTasks = count($allTasks);

                $completed = collect($allTasks)
                    ->filter(function($task){

                        if(!is_array($task)){
                            return false;
                        }

                        return !empty($task['checked']);
                    })
                    ->count();

                /*
                ==========================
                STATUS WEEK
                ==========================
                */
                if($completed==0){
                    $fillStatus='ready';
                    $fillLabel='Ready to Fill';
                }
                elseif($completed < $totalTasks){
                    $fillStatus='incomplete';
                    $fillLabel='Incomplete';
                }
                else{
                    $fillStatus='filled';
                    $fillLabel='Filled';
                }


                return [
                    'week'=>$week,
                    'fill_status'=>$fillStatus,
                    'fill_label'=>$fillLabel,

                    // lock kalau sudah submit approval
                    'locked'=> !in_array(
                        $record->status,
                        ['draft','rejected']
                    ),
                ];

            });

            return [
                'month'  => $month,
                'status' => $monthStatus,
                'weeks'  => $weeks,
                'locked' => false, // Default awal
            ];
        });

        // 5. 🔥 LOCKING MONTH BERDASARKAN URUTAN (Urutan 1-6)
        // Kita tambahkan use ($hasMonthZero) agar tidak error Undefined Variable
        $months = $months->map(function ($m, $index) use ($months, $hasMonthZero) {
            
            // Aturan Dasar: Month 1 terbuka, Month lainnya cek bulan sebelumnya
            if ($m['month'] > 1) {
                $prevMonth = $months->get($index - 1);
                if ($prevMonth) {
                    // Lock jika bulan sebelumnya belum submit ke SM/HR
                    $m['locked'] = !in_array($prevMonth['status'], ['pending_sm', 'pending', 'approved']);
                }
            }

            // LOGIKA TAMBAHAN:
            if ($hasMonthZero == true) {
                $m['locked'] = true;
            }

            return $m;
        });

        $employee->months = $months;
        return $employee;
    });

    return view('sales.onboarding.index', compact('employees'));
}

    // ===============================
    // FORM INPUT CHECKLIST
    // ===============================
    public function show($employeeId, $month, $week)
    {
        $employee = Employee::where('employee_id', $employeeId)->firstOrFail();

        $checklist = OnboardingChecklist::where([
            'employee_id' => $employeeId,
            'month' => $month,
            'week' => $week, 
        ])->first();

        if (!$checklist) {
            $template = ChecklistTemplate::where('month', $month)
                ->where('week', $week)
                ->firstOrFail();

            $checklist = OnboardingChecklist::create([
                'employee_id'    => $employeeId,
                'month'          => $month,
                'week'           => $week,
                'checklist_json' => $template->template_json,
                'status'         => 'draft',
            ]);
        }

        // ✅ jangan decode
        $data = $checklist->checklist_json;

        return view('sales.onboarding.checklist', compact(
            'employee',
            'month',
            'week',
            'checklist',
            'data'
        ));
    }

    // ===============================
    // SIMPAN CHECKLIST
    // ===============================
    public function store(Request $request, $employeeId, $month, $week)
    {
        $checklist = OnboardingChecklist::firstOrCreate([
            'employee_id' => $employeeId,
            'month' => $month,
            'week' => $week,
        ]);

        // 🔥 CANCEL
        if ($request->has('cancel')) {
            if ($checklist && $checklist->status === 'draft') {
                $checklist->delete();
            }

            return redirect()
                ->route('sales.onboarding.index')
                ->with('success', 'Checklist minggu ini dibatalkan.');
        }

        // 🔒 LOCK
        if (!in_array($checklist->status, ['draft', 'rejected', 'pending_sm'])) {
            abort(403, 'Checklist sudah dikunci.');
        }

        // ✅ NORMALIZE JSON (ANTI ERROR STRING)
        $data = is_array($checklist->checklist_json)
            ? $checklist->checklist_json
            : json_decode($checklist->checklist_json, true);

        if (!is_array($data)) {
            $data = [];
        }

        // 🔥 UPDATE CHECKED
        if ($request->has('checklist')) {
            foreach ($data as $section => &$items) {
                if (!is_array($items)) continue;

                foreach ($items as $i => &$item) {
                    if (!is_array($item)) continue;

                    $item['checked'] = isset($request->checklist[$section][$i]['checked']);
                }
            }
        }

        // 💾 SAVE
        $checklist->update([
            'checklist_json' => $data,
            'status' => 'draft',
            'notes_ss' => $request->notes_ss,
        ]);

        // =====================================================
        // 🔥 SUBMIT MONTH
        // =====================================================
        if ($week == 4 && $request->has('submit_month')) {

            $errors = [];

            $sections = [
                'items' => 'Checklist Items',
                'mandatory_tasks' => 'Mandatory Tasks'
            ];

            // 🔥 ambil semua week dalam 1 bulan
            $allWeeks = OnboardingChecklist::where([
                'employee_id' => $employeeId,
                'month' => $month,
            ])->get()->keyBy('week');

            // ===============================
            // ❌ VALIDASI WEEK BELUM ADA
            // ===============================
            $missingWeeks = [];

            foreach (range(1, 4) as $w) {
                if (!isset($allWeeks[$w])) {
                    $missingWeeks[] = $w;
                }
            }

            if (!empty($missingWeeks)) {
                return back()
                    ->withInput()
                    ->with('error','Lengkapi week sebelumnya terlebih dahulu.')
                    ->with('missing_weeks',$missingWeeks);
            }

            // ===============================
            // ❌ VALIDASI CHECKLIST BELUM DICENTANG
            // ===============================
            foreach ($allWeeks as $w) {

                $weekData = is_array($w->checklist_json)
                    ? $w->checklist_json
                    : json_decode($w->checklist_json, true);

                if (!is_array($weekData)) continue;

                foreach ($sections as $key => $label) {
                    if (!empty($weekData[$key])) {
                        foreach ($weekData[$key] as $i => $item) {
                            if (empty($item['checked'])) {
                                $errors[] = [
                                    'week' => $w->week,
                                    'section' => $label,
                                    'text' => $item['text'] ?? "Item ke-" . ($i + 1)
                                ];
                            }
                        }
                    }
                }
            }

            if (!empty($errors)) {
                return back()
                    ->withInput()
                    ->with('error_checklist', $errors);
            }

            // ✅ semua aman → submit
            OnboardingChecklist::where([
                'employee_id' => $employeeId,
                'month' => $month,
            ])->update([
                'status' => 'pending_sm'
            ]);

            return redirect()
                ->route('sales.onboarding.index')
                ->with('success', "Month $month berhasil disubmit ke Store Manager.");
        }
    
    return redirect()
        ->route('sales.onboarding.index', ['month' => $month])
        ->with('success', 'Checklist berhasil disimpan.');
    }
    }