@extends('layouts.base')

@section('title', "{$tag->tag_name} - 災害情報ポータルサイト")

@section('body_id', 'event-show')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">#{{$tag->tag_name}}</span>
    <span></span>

@endsection

@section('contents')
    <div class="row row-cols-1 row-cols-md-2 mx-0">
        @forelse ($tag->emergencyEvents as $emergencyEvent)
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
                            @foreach($emergencyEvent->tags as $tag)
                                <span><a href="{{ url('category/'.$tag->id)}}">#{{$tag->tag_name}}</a></span>
                            @endforeach
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <span>Not found.</span>
        @endforelse
    </div>
@endsection
