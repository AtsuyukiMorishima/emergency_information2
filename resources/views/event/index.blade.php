<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>災害情報ポータルサイト</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body id="event-index" class="pb-2">
    <header class="navbar navbar-light bg-light fixed-top shadow cust-header">
        <div class="container-fluid">
            <span class="navbar-brand mx-0 text-center text-light">災害情報ポータルサイト</span>
            <span></span>
            <span></span>
        </div>
    </header>
    <main class="container mt-lg-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="row row-cols-1 row-cols-md-2">
                    @forelse ($emergencyEvents as $emergencyEvent)
                        <div class="col p-1">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-secondary">{{ $emergencyEvent->event_title }}</h5>
                                </div>
                            </div>
                        </div>
                    @empty
                        <span>Not found.</span>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>