<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevelopmentScore extends Model
{
    protected $table = 'employee_training_scores';

    protected $primaryKey = 'id';

    public function getRsoAverageAttribute()
    {
        $fields = [
            $this->rso_supervisory_skill,
            $this->rso_retail_salesmanship,
            $this->rso_customer_service_loyalty,
            $this->rso_product_merchandising,
            $this->rso_visual_merchandising,
            $this->rso_retail_store_promotion,
            $this->rso_store_financial_perspective,
            $this->rso_store_general_checkup_strategy,
        ];

        $fields = array_filter($fields, fn ($v) => $v !== null);

        return count($fields)
            ? round(array_sum($fields) / count($fields), 2)
            : 0;
    }

    public function employee()
    {
        return $this->belongsTo(
            Employee::class,
            'employee_id', 
            'employee_id'   
        );
    }
}
