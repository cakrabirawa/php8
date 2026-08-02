<?php

namespace App\Models;

use App\Models\Concerns\HasCreator;
use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberType extends Model
{
    use HasFactory, SoftDeletes, Blameable;

    protected $fillable = [
        'name',
        'discount_percentage',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'discount_percentage' => 'decimal:2',
            'deleted_at' => 'datetime',
        ];
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
