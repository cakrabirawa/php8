<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'dob', 'email'])]
class Author extends Model
{
    use HasFactory, Notifiable;
    protected function casts(): array
    {
        return [
            'dob' => 'date',
        ];
    }
    public function phones(): HasMany
    {
        return $this->hasMany(AuthorPhone::class);
    }
}
