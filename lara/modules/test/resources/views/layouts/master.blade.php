@extends('backend.layouts.app')

@section('title')
    @yield('test-title', $breadcrumbs['title'] ?? __('Test')) | {{ __('Test') }} | {{ config('app.name') }}
@endsection

@push('styles')
    {{-- Resilient CSS loader: renders the compiled module bundle when present and
         degrades gracefully (no 500) when it has not been built yet. --}}
    <x-module-styles :entrypoints="['modules/Test/resources/assets/css/app.css']" build="build-test" />
@endpush

@section('admin-content')
    <div class="test-module container px-6 py-8 mx-auto min-h-[80vh]">
        @yield('test-admin-content')
    </div>
@endsection

@push('scripts')
    @stack('test-scripts')
@endpush
