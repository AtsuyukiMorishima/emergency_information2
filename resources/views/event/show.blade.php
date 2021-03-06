@extends('layouts.base')

@section('title', "{$emergencyEvent->event_title} - 災害情報ポータルサイト")

@section('body_id', 'event-show')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
        {{ $emergencyEvent->event_date->format('n月j日') }}
        <br class="d-sm-none">
        {{ $emergencyEvent->event_title }}
    </span>
    <span></span>
@endsection

@section('contents')
    <div class="reccomend-translate">
        <a href="https://translate.google.co.jp/?hl=ja" target="_blank" rel="noopener noreferrer">
            <button type="submit" class="btn btn-secondary">Google翻訳を利用して記事を翻訳する</button>
        </a>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-secondary">ニュース一覧</h5>
            <ul class="list-group list-group-flush">
                @forelse ($emergencyEvent->siteUrls->sortByDesc('registration_date') as $siteUrl)
                    <li class="list-group-item">
                        <a href="{{ $siteUrl->url }}" class="text-secondary site-urls-title">{{ $siteUrl->url }}</a>
                        <!-- <a href="{{ $siteUrl->url }}" class="text-secondary site-urls-title">@if(empty($siteUrl->title)) {{ $siteUrl->url }} @else {{ $siteUrl->title }} @endif</a> -->
                    <!-- <a class="text-secondary registration_date">{{ $siteUrl->registration_date }}</a>
                    <div>
                    @isset($siteUrl->tags_json)
                        @foreach(json_decode($siteUrl->tags_json) as $tag)
                            <span><a href="{{ route('event.showCategory', ['ee_id' => $emergencyEvent->ee_id, 'site_id' => $siteUrl->site_id, 'tag_id' => $tag->tag_id]) }}">#{{$tag->tag_name}}</a></span>
                        @endforeach
                    @endisset
                    </div> -->
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