<?php

declare(strict_types=1);

namespace Modules\Blog\Livewire\Components;

use App\Livewire\Datatable\Datatable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\Article;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleDatatable extends Datatable
{
    public string $model = Article::class;

    public function getSearchbarPlaceholder(): string
    {
        return __('Search articles...');
    }

    protected function getHeaders(): array
    {
        return [
            [
                'id' => 'title',
                'title' => __('Title'),
                'sortable' => true,
                'sortBy' => 'title',
                'searchable' => true,
            ],
            [
                'id' => 'author',
                'title' => __('Author'),
                'sortable' => true,
                'sortBy' => 'author',
                'searchable' => true,
            ],
            [
                'id' => 'content',
                'title' => __('Content'),
                'sortable' => true,
                'sortBy' => 'content',
                'searchable' => true,
            ],
            [
                'id' => 'is_published',
                'title' => __('Is Published'),
                'sortable' => true,
                'sortBy' => 'is_published',
                'width' => '120px',
            ],
            [
                'id' => 'created_at',
                'title' => __('Created'),
                'sortable' => true,
                'sortBy' => 'created_at',
                'width' => '150px',
            ],
            [
                'id' => 'actions',
                'title' => __('Actions'),
                'sortable' => false,
                'is_action' => true,
                'width' => '100px',
            ],
        ];
    }

    public function getRoutes(): array
    {
        return [
            'create' => 'admin.blog.articles.create',
            'view' => 'admin.blog.articles.show',
            'edit' => 'admin.blog.articles.edit',
            'delete' => 'livewire',
        ];
    }

    public function getDeleteRouteUrl($item): string
    {
        return '';
    }

    public function getActionCellPermissions($item): array
    {
        return [
            'view' => true,
            'edit' => true,
            'delete' => true,
        ];
    }

    protected function buildQuery(): QueryBuilder
    {
        return QueryBuilder::for(Article::query())
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', "%{$this->search}%")
                        ->orWhere('author', 'like', "%{$this->search}%")
                        ->orWhere('content', 'like', "%{$this->search}%");
                });
            })
            ->orderBy($this->sort, $this->direction);
    }

    public function handleRowDelete(Model|Article $item): bool
    {
        return $item->delete();
    }

    public function renderIsPublishedColumn(Article $item): Renderable
    {
        return view('components.datatable.boolean-cell', ['value' => $item->is_published]);
    }
}
