<?php

declare(strict_types=1);

namespace Modules\Blog\Services;

use Modules\Blog\Models\Article;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function getPaginatedArticles(
        ?string $search = null,
        int $perPage = 15
    ): LengthAwarePaginator {
        return Article::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getArticleById(int $id): ?Article
    {
        return Article::find($id);
    }

    public function createArticle(array $data): ?Article
    {
        return Article::create($data);
    }

    public function updateArticle(Article $article, array $data): bool
    {
        return $article->update($data);
    }

    public function deleteArticle(Article $article): bool
    {
        return (bool) $article->delete();
    }
}
