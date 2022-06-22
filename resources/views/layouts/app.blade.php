<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','災害情報ポータルサイト')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- tagify.js --}}
    <script src="{{ asset(('js/tagify.min.js')) }}"></script>
    <script src="{{ asset(('/js/tagify.polyfills.min.js')) }}"></script>
    <link rel="stylesheet" href="{{ asset(('/css/tagify.css')) }}">

</head>
<body class="pt-0">
    <div id="@yield('body_id')">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm cust-header">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', '災害情報ポータルサイト') }}
                </a>
                <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Menu links -->
                        @Auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="{{ route('admin') }}">{{__('Home')}}</a>
                                <a class="dropdown-item"  href="{{ route('admin.addUser') }}">{{__('Register new admin')}}</a>
                                <a class="dropdown-item"  href="{{ route('admin.updateUser') }}">{{__('Update user')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container mt-lg-5 mt-3">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    {{-- 管理者ページ用のJS --}}
    <script src="{{ asset('/js/admin.js') }}"></script>
</body>
</html>
