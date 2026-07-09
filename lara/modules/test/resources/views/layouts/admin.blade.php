@extends('test::layouts.master')

@section('test-admin-content')
    <div class="space-y-6">
        <div>
            {{ $slot }}
        </div>
    </div>
@endsection
