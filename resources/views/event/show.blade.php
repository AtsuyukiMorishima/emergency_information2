<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $emergencyEvent->event_title }}</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body id="event-show" class="pb-2">
    <header class="navbar navbar-light bg-light fixed-top shadow cust-header">
        <div class="container-fluid">
            <span></span>
            <span class="navbar-brand mx-0 text-center text-light">
                {{ $emergencyEvent->event_date->format('n月j日') }}
                <br class="d-sm-none">
                {{ $emergencyEvent->event_title }}
            </span>
            <span></span>
        </div>
    </header>
    <main class="container mt-lg-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">ニュース一覧</h5>
                        <ul class="list-group list-group-flush">
                            @forelse ($emergencyEvent->siteUrls as $siteUrl)
                                <li class="list-group-item">
                                    <a href="{{ $siteUrl->url }}" class="text-secondary">{{ $siteUrl->url }}</a>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <span class="text-secondary">Not found.</span>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>