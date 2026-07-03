<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTrainingScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'gramedia_daily_store',
        'rso_supervisory_skill',
        'rso_retail_salesmanship',
        'rso_customer_service_loyalty',
        'rso_product_merchandising',
        'rso_visual_merchandising',
        'rso_retail_store_promotion',
        'rso_store_financial_perspective',
        'rso_store_general_checkup_strategy',
        'learning_hours',
        'nilai_ngecas',
        'inhouse_training',
        'public_training',
        'intensive_training',
        'development_program',
    ];

    protected $attributes = [
        'gramedia_daily_store' => 0,
        'rso_supervisory_skill' => 0,
        'rso_retail_salesmanship' => 0,
        'rso_customer_service_loyalty' => 0,
        'rso_product_merchandising' => 0,
        'rso_visual_merchandising' => 0,
        'rso_retail_store_promotion' => 0,
        'rso_store_financial_perspective' => 0,
        'rso_store_general_checkup_strategy' => 0,
        'nilai_ngecas' => 0,
    ];

    protected $casts = [
        'learning_hours' => 'float',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function getRsoAverageAttribute()
    {
        $fields = [
            $this->rso_supervisory_skill ?? 0,
            $this->rso_retail_salesmanship ?? 0,
            $this->rso_customer_service_loyalty ?? 0,
            $this->rso_product_merchandising ?? 0,
            $this->rso_visual_merchandising ?? 0,
            $this->rso_retail_store_promotion ?? 0,
            $this->rso_store_financial_perspective ?? 0,
            $this->rso_store_general_checkup_strategy ?? 0,
        ];

        return round(array_sum($fields) / count($fields), 2);
    }

}
