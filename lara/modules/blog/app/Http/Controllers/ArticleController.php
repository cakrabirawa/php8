<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Modules\Blog\Http\Requests\ArticleRequest;
use Modules\Blog\Models\Article;
use Modules\Blog\Services\ArticleService;

class ArticleController extends BlogController
{
    public function __construct(private readonly ArticleService $articleService) {}

    public function index(): Renderable
    {
        $this->authorize('viewAny', Article::class);

        $this->setBreadcrumbTitle(__('Articles'))
            ->setBreadcrumbIcon('lucide:list')
            ->setBreadcrumbActionButton(
                route('admin.blog.articles.create'),
                __('New Article'),
                'lucide:plus'
            );

        return $this->renderViewWithBreadcrumbs('blog::pages.articles.index');
    }

    public function create(): Renderable
    {
        $this->authorize('create', Article::class);

        $this->setBreadcrumbTitle(__('Create Article'))
            ->setBreadcrumbIcon('lucide:list')
            ->addBreadcrumbItem(__('Articles'), route('admin.blog.articles.index'));

        return $this->renderViewWithBreadcrumbs('blog::pages.articles.create');
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $this->authorize('create', Article::class);

        $validated = $request->validated();

        $item = $this->articleService->createArticle($validated);

        if (! $item) {
            return redirect()->back()->with('error', __('Article creation failed.'))->withInput();
        }

        return redirect()->route('admin.blog.articles.index')
            ->with('success', __('Article created successfully.'));
    }

    public function show(int $id): Renderable|RedirectResponse
    {
        $article = $this->articleService->getArticleById($id);

        if (! $article) {
            return redirect()->route('admin.blog.articles.index')
                ->with('error', __('Article not found.'));
        }

        $this->authorize('view', $article);

        $this->setBreadcrumbTitle(__('View Article'))
            ->setBreadcrumbIcon('lucide:list')
            ->addBreadcrumbItem(__('Articles'), route('admin.blog.articles.index'))
            ->setBreadcrumbActionButton(
                route('admin.blog.articles.edit', $id),
                __('Edit Article'),
                'lucide:pencil'
            );

        return $this->renderViewWithBreadcrumbs('blog::pages.articles.show', [
            'article' => $article,
        ]);
    }

    public function edit(int $id): Renderable|RedirectResponse
    {
        $article = $this->articleService->getArticleById($id);

        if (! $article) {
            return redirect()->route('admin.blog.articles.index')
                ->with('error', __('Article not found.'));
        }

        $this->authorize('update', $article);

        $this->setBreadcrumbTitle(__('Edit Article'))
            ->setBreadcrumbIcon('lucide:list')
            ->addBreadcrumbItem(__('Articles'), route('admin.blog.articles.index'))
            ->setBreadcrumbActionButton(
                route('admin.blog.articles.show', $id),
                __('View Article'),
                'lucide:eye',
                null,
                true
            );

        return $this->renderViewWithBreadcrumbs('blog::pages.articles.edit', [
            'article' => $article,
        ]);
    }

    public function update(ArticleRequest $request, int $id): RedirectResponse
    {
        $article = $this->articleService->getArticleById($id);

        if (! $article) {
            return redirect()->route('admin.blog.articles.index')
                ->with('error', __('Article not found.'));
        }

        $this->authorize('update', $article);

        $validated = $request->validated();

        $updated = $this->articleService->updateArticle($article, $validated);

        if (! $updated) {
            return redirect()->back()->with('error', __('Article update failed.'))->withInput();
        }

        return redirect()->route('admin.blog.articles.index')
            ->with('success', __('Article updated successfully.'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $article = $this->articleService->getArticleById($id);

        if (! $article) {
            return redirect()->back()->with('error', __('Article not found.'));
        }

        $this->authorize('delete', $article);

        if (! $this->articleService->deleteArticle($article)) {
            return redirect()->back()->with('error', __('Article deletion failed.'));
        }

        return redirect()->route('admin.blog.articles.index')
            ->with('success', __('Article deleted successfully.'));
    }
}
