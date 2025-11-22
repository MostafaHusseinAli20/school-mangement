<!DOCTYPE html>

@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
@endphp

<html lang="{{ LaravelLocalization::getCurrentLocale() }}" 
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    @include('dashboard.layouts.head')
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        <!-- preloader -->

        <div id="pre-loader">
            <img src="{{ asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        @include('dashboard.layouts.main-header')
        @include('dashboard.layouts.main-sidebar')

        <!-- main-content -->
        <div class="content-wrapper">
            @section('content')
            @show

            @include('dashboard.layouts.footer')

        </div>
    </div>
    @include('dashboard.layouts.scripts')
    @livewireScripts
    @stack('scripts')
</body>

</html>
