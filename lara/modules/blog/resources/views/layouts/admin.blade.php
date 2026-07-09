@extends('blog::layouts.master')

@section('blog-admin-content')
    <div class="space-y-6">
        <div>
            {{ $slot }}
        </div>
    </div>
@endsection
