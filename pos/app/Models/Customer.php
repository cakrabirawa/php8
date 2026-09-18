<?php

namespace App\Models;

use App\Models\Concerns\HasCreator;
use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes, Blameable;

    protected $fillable = [
        'member_code',
        'name',
        'phone',
        'member_type_id',
        'points',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'points' => 'integer',
            'deleted_at' => 'datetime',
        ];
    }

    public function memberType(): BelongsTo
    {
        return $this->belongsTo(MemberType::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Discount percentage granted to this customer based on its member tier.
     */
    public function getDiscountPercentageAttribute(): float
    {
        return (float) ($this->memberType->discount_percentage ?? 0);
    }

    protected static function booted(): void
    {
        static::creating(function ($customer) {
            // Cek apakah kode member sudah ada di database (terjadi saat proses duplicate)
            $exists = Customer::where('member_code', $customer->member_code)->exists();

            if ($exists || empty($customer->member_code)) {
                // Paksa generate ulang ke nomor seri berikutnya yang tersedia
                $nextId = Customer::max('id') + 1;
                $customer->member_code = 'MBR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
                //$customer->member_code = 'MBR-' . strtoupper(Str::ulid());
            }
        });
    }
}
