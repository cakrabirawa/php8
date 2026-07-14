<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use App\Traits\Blameable;

#[Fillable(['product_name', 'price', 'category_id', 'description', 'product_image'])]
class Product extends Model
{
    use HasFactory, Notifiable;
    use Blameable;
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
