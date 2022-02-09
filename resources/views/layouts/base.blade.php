<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ url(mix('/css/app.css')) }}">

    <!--Tagifi.js-->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
</head>

<body id="@yield('body_id')" class="pb-2">
    <header class="navbar navbar-light bg-light fixed-top shadow cust-header">
        <div class="container-fluid">
            @yield('navbar')
        </div>
    </header>
    <main class="container mt-lg-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                @yield('contents')
            </div>
        </div>
    </main>

    <script src="{{ url(mix('/js/app.js')) }}"></script>
</body>

</html>
