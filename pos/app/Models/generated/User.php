<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Role constants — used across the app instead of magic strings.
     */
    public const ROLE_ADMIN  = 'admin';
    public const ROLE_GUDANG = 'gudang';
    public const ROLE_KASIR  = 'kasir';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'deleted_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------
    | Role helpers
    |--------------------------------------------------------------------
    */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isGudang(): bool
    {
        return $this->role === self::ROLE_GUDANG;
    }

    public function isKasir(): bool
    {
        return $this->role === self::ROLE_KASIR;
    }

    /*
    |--------------------------------------------------------------------
    | Audit-trail relations (records this user has created)
    |--------------------------------------------------------------------
    */
    public function suppliers(): HasMany
    {
        return $this->hasMany(Supplier::class, 'created_by');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'created_by');
    }

    public function memberTypes(): HasMany
    {
        return $this->hasMany(MemberType::class, 'created_by');
    }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'created_by');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'created_by');
    }

    public function stockAdjustments(): HasMany
    {
        return $this->hasMany(StockAdjustment::class, 'created_by');
    }

    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class, 'created_by');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'created_by');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'created_by');
    }

    public function expenseCategories(): HasMany
    {
        return $this->hasMany(ExpenseCategory::class, 'created_by');
    }

    public function profitLossSnapshots(): HasMany
    {
        return $this->hasMany(ProfitLossSnapshot::class, 'created_by');
    }
}
