<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introduction extends Model
{
    protected $fillable = [
        'nik',
        'fgd_analytic_score',
        'fgd_business_score',
        'fgd_leadership_score',
        'interview_analytic_score',
        'interview_business_score',
        'interview_leadership_score',
        'fgd_note',
        'interview_note',
        'mcu',
        'psikotes',
        'rekomendasi',
        'pic',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nik', 'employee_id');
    }

    public function getFgdAverageAttribute()
    {
        $scores = array_filter([
            $this->fgd_analytic_score,
            $this->fgd_business_score,
            $this->fgd_leadership_score,
        ], fn ($v) => $v !== null);

        return count($scores)
            ? round(array_sum($scores) / count($scores), 2)
            : null;
    }

    public function getInterviewAverageAttribute()
    {
        $scores = array_filter([
            $this->interview_analytic_score,
            $this->interview_business_score,
            $this->interview_leadership_score,
        ], fn ($v) => $v !== null);

        return count($scores)
            ? round(array_sum($scores) / count($scores), 2)
            : null;
    }
    private function mapLevel($level)
    {
        return match ((int) $level) {
            1 => 'Lone Ranger',
            2 => 'Team Player',
            3 => 'Team Leader',
            default => null,
        };
    }

    public function getFgdLevelLabelAttribute()
    {
        $scores = array_filter([
            $this->fgd_analytic_score,
            $this->fgd_business_score,
            $this->fgd_leadership_score,
        ]);

        return $scores
            ? $this->mapLevel(max($scores))
            : null;
    }

    public function getInterviewLevelLabelAttribute()
    {
        $scores = array_filter([
            $this->interview_analytic_score,
            $this->interview_business_score,
            $this->interview_leadership_score,
        ]);

        return $scores
            ? $this->mapLevel(max($scores))
            : null;
    }


}
