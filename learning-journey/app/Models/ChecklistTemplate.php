<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistTemplate extends Model
{
    use HasFactory;

    protected $table = 'checklist_templates';

    protected $fillable = [
        'month',
        'week',
        'template_json',
    ];

    protected $casts = [
        'template_json' => 'array',
    ];

    public function onboardingChecklists()
    {
        return $this->hasMany(OnboardingChecklist::class, 'week', 'week')
            ->whereColumn('onboarding_checklists.month', 'checklist_templates.month');
    }

}
