@extends('blog::layouts.master')

@section('title')
    {{ $breadcrumbs['title'] . ' | ' . config('app.name') }}
@endsection

@section('blog-admin-content')
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="mt-6">
            <livewire:blog::components.article-datatable lazy />
        </div>
    </div>
@endsection
