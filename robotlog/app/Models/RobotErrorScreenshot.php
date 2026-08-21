<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RobotErrorScreenshot extends Model
{
  use HasFactory;

  protected $table = 'robot_error_screenshots';

  protected $fillable = [
    'nama_robot',
    'file_name',
  ];

  public function getImagePathAttribute(): ?string
  {
    if (blank($this->file_name)) {
      return null;
    }

    $path = ltrim($this->file_name, '/');

    if (! str_contains($path, 'robot-error-screenshots/')) {
      $path = 'robot-error-screenshots/' . $path;
    }

    return $path;
  }

  public function getImageUrlAttribute(): ?string
  {
    $path = $this->image_path;

    if (! $path) {
      return null;
    }

    if (! Storage::disk('public')->exists($path)) {
      return null;
    }

    return route('robot.error_screenshot', ['filename' => basename($path)]);
  }
}
