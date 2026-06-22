<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\OnboardingChecklist;

class GenerateSpvOnboardingFull extends Command
{
    protected $signature = 'onboarding:generate-spv-full';
    protected $description = 'Generate onboarding FULL (month=0) for SPV join before 2025';

public function handle()
{
    $this->info('Total employees: ' . Employee::count());

    $employees = Employee::whereDate('joining_date', '<', '2026-01-01')->get();
    $this->info('Joined before 2026: ' . $employees->count());

    $count = 0;

    foreach ($employees as $employee) {

        $exists = OnboardingChecklist::where('employee_id', $employee->employee_id)
            ->where('month', 0)
            ->exists();

        if (!$exists) {
            OnboardingChecklist::create([
                'employee_id'         => $employee->employee_id,
                'filled_by'           => 'system',
                'month'               => 0,
                'week'                => 0,
                'checklist_json'      => 0,
                'notes_store_manager' => null,
                'status'              => 'approved',
                'notes_hr'            => 'Auto approved - joined before 2025',
            ]);

            $count++;
        }
    }

    $this->info("SUCCESS: {$count} onboarding FULL created.");
    return Command::SUCCESS;
}

}
