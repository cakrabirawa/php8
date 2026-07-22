<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Blameable
{
  public static function bootBlameable(): void
  {
    // Otomatis terisi saat data baru dibuat (Create)
    static::creating(function ($model) {
      if (Auth::check() && !$model->isDirty('created_by')) {
        $model->created_by = Auth::id();
      }
      if (Auth::check() && !$model->isDirty('updated_by')) {
        $model->updated_by = Auth::id();
      }
    });

    // Otomatis terupdate saat data diubah (Update)
    static::updating(function ($model) {
      if (Auth::check() && !$model->isDirty('updated_by')) {
        $model->updated_by = Auth::id();
      }
    });
  }

  // Relasi ke User pembuat
  public function creator(): BelongsTo
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  // Relasi ke User pengubah terakhir
  public function updater(): BelongsTo
  {
    return $this->belongsTo(User::class, 'updated_by');
  }
}
