@extends('backend.layouts.app')

@section('title')
    @yield('blog-title', $breadcrumbs['title'] ?? __('Blog')) | {{ __('Blog') }} | {{ config('app.name') }}
@endsection

@push('styles')
    {{-- Resilient CSS loader: renders the compiled module bundle when present and
         degrades gracefully (no 500) when it has not been built yet. --}}
    <x-module-styles :entrypoints="['modules/Blog/resources/assets/css/app.css']" build="build-blog" />
@endpush

@section('admin-content')
    <div class="blog-module container px-6 py-8 mx-auto min-h-[80vh]">
        @yield('blog-admin-content')
    </div>
@endsection

@push('scripts')
    @stack('blog-scripts')
@endpush
