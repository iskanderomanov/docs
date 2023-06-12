<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS files -->
    <link href="{{ asset('/vendor/dist/css/tabler.css') }}" rel="stylesheet"/>
    <link href="{{asset('/vendor/dist/css/tabler-vendors.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" media="print"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    @stack('styles')
</head>
<body class="antialiased" data-bs-theme="dark">
<div class="page">
    @include('layouts.header')
    <header>
        <div class="navbar-expand-md">
{{--            {!! $navbar_view !!}--}}
        </div>
    </header>
    <div class="content mt-5">
        @yield('content')
    </div>
</div>
<!-- Libs JS -->
<script src="{{ asset('/vendor/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- Tabler Core -->
<script src="{{ asset('/vendor/dist/js/tabler.js') }}"></script>
<script src="{{ asset('/vendor/dist/js/tabler.esm.js') }}"></script>
<script src="{{ asset('/vendor/dist/js/demo.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{ asset('/js/lib/axios/js/axios.min.js')}}"></script>
<script src="{{ asset('/js/core.js') }}"></script>
<script src="{{ asset('/js/scripts.js') }}"></script>
<!-- CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
@stack('scripts')
</body>
</html>
