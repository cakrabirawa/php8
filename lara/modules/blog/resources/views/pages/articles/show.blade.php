@extends('blog::layouts.master')

@section('title')
    {{ $breadcrumbs['title'] . ' | ' . config('app.name') }}
@endsection

@section('blog-admin-content')
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="mt-6">
            <x-card.card>
                <x-slot name="header">{{ __('Article Information') }}</x-slot>

                <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Title') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $article->title }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Author') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $article->author }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Content') }}</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white whitespace-pre-wrap">{{ $article->content }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Is Published') }}</dt>
                    <dd class="mt-1">
                        @if($article->is_published)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">{{ __('Yes') }}</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">{{ __('No') }}</span>
                        @endif
                    </dd>
                </div>
                </dl>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('admin.blog.articles.edit', $article->id) }}" class="btn btn-primary">
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('admin.blog.articles.index') }}" class="btn btn-default">
                        {{ __('Back to List') }}
                    </a>
                </div>
            </x-card.card>
        </div>
    </div>
@endsection
