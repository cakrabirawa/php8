<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    use HasFactory;

    protected $table = 'blog_articles';

    protected $fillable = [
        'title',
        'author',
        'content',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

}
