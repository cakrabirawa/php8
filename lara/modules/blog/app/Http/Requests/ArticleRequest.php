<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
            'is_published' => 'nullable|boolean',
        ];
    }
}
