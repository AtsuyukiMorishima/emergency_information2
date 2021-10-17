@extends('layouts.base')

@section('title', "{$emergencyEvent->event_title} - 災害情報ポータルサイト")

@section('body_id', 'event-show')

@section('navbar')
    <span></span>
    <span class="navbar-brand mx-0 text-center text-light">
        {{ $emergencyEvent->event_date->format('n月j日') }}
        <br class="d-sm-none">
        {{ $emergencyEvent->event_title }}
    </span>
    <span></span>
@endsection

@section('contents')
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-secondary">ニュース一覧</h5>
            <ul class="list-group list-group-flush">
                @forelse ($emergencyEvent->siteUrls->sortByDesc('registration_date') as $siteUrl)
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
@endsection