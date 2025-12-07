@extends('layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/mandiri/layout.css') }}">
@endpush

@section('body')
    <div class="split-layout-wrapper">
        <div class="split-container">
            <aside class="split-left">
                @yield('split-left')
            </aside>
            <main class="split-right">
                @yield('split-right')
            </main>
        </div>
    </div>
@endsection