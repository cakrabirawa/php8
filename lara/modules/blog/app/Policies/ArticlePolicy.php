<?php

declare(strict_types=1);

namespace Modules\Blog\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('article.view');
    }

    public function view(User $user, Article $article): bool
    {
        return $user->hasPermissionTo('article.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('article.create');
    }

    public function update(User $user, Article $article): bool
    {
        return $user->hasPermissionTo('article.edit');
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->hasPermissionTo('article.delete');
    }
}
