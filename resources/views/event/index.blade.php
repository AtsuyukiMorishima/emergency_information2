@extends('layouts.base')

@section('title', '災害情報ポータルサイト')

@section('body_id', 'event-index')

@section('navbar')
    <span class="navbar-brand mx-0 text-center text-light">災害情報ポータルサイト</span>
    <span></span>
    <span>
        <a href="{{ route('event.about') }}">
            <i class="fas fa-lg fa-info-circle text-light"></i>
        </a>
    </span>
@endsection

@section('contents')
    {{-- <div class="d-flex flex-nowrap"> --}}
    <div class="row row-cols-1 row-cols-md-2 mx-0">
        @forelse ($emergencyEvents->sortByDesc('event_date') as $emergencyEvent)
            <div class="col p-1">
                <div class="card shadow-sm">
                    <a href="{{ route('event.show', ['id' => $emergencyEvent->ee_id]) }}">
                        <div class="border-bottom">
                            <img class="card-img-top" src="{{ asset('img/img.jpeg') }}" alt="" style="width:100%; height:200px;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-secondary">{{ $emergencyEvent->event_title }}</h5>
                            <div class="text-secondary">Subtitile</div>
                            <div class="text-secondary">Hogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehoge</div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <span>Not found.</span>
        @endforelse
    </div>
@endsection
