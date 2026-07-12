<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'group_user_id', 'avatar_url'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function groupUser(): BelongsTo
    {
        return $this->belongsTo(GroupUser::class, 'group_user_id');
    }
    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar_url) {
            // Mengambil hanya nama file dari path yang tersimpan (misal: 'avatars/namafile.jpg' -> 'namafile.jpg')
            $filename = basename($this->avatar_url);
            // Membuat URL menggunakan route kustom 'custom.avatar'
            return route('custom.avatar', ['filename' => $filename]);
        }
        return null;
    }
}
