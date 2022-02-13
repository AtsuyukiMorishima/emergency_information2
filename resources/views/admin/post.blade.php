@extends('layouts.base')

@section('title', '災害情報ポータルプロジェクトについて - 災害情報ポータルサイト')

@section('body_id', 'event-post')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">管理者ページ</span>
    <span>
        {{-- ログアウト用のボタン --}}
        <div class="nav-link" aria-labelledby="navbarDropdown">
            <a class="text-white" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </span>
@endsection

<!--css 読み込み-->
<link href="{{ asset('css/form.css') }}" rel="stylesheet">

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- フラッシュメッセージの表示に使用-->
    @include('common.flash')

@section('contents')
    <div class="card shadow">
        <div class="card-body">
            <p class="card-text text-secondary">
                <div>災害イベント登録</div>
                @if (!Request::is('admin'))
                    <form action="{{ url('update') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        イベントタイトル<input name="event_title" class="form-control" value="{{$emergencyEvent->event_title}}">
                        イベント日時<input type="date" class="form-control" name="event_date" value="{{$emergencyEvent->event_date->format('Y-m-d')}}">
                        タグ<input name="tags" id="input-custom-dropdown" class="form-control" placeholder="選択"
                        value="
                            @foreach($emergencyEvent->tags as $tag)
                                #{{$tag->tag_name}},
                            @endforeach
                        ">
                        <input type="hidden" name="ee_id" value="{{$emergencyEvent->ee_id}}">
                        <div class="text-right">
                        <button type="submit" class="btn btn-primary mt-2">更新</button>
                        </div>
                    </form>
                    <div class="mb-2">URL一覧</div>
                    <div class="text-right">
                        @foreach ($emergencyEvent->siteUrls as $item)
                            <div class="mt-1 mr-3">{{$item->url}}</div>
                        @endforeach
                        <button type="submit" class="btn btn-success mt-2">
                            <a href="{{ url('edit/url/'.$emergencyEvent->ee_id) }}" class="text-light" style="text-decoration: none;">URL編集</a>
                        </button>
                    </div>
                @else
                    <form action="{{ url('post') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        タイトル<input  type="text" class="form-control" name="event_title">
                        日時<input class="form-control" type="date" name="event_date">
                        タグ<input name="tags" id="input-custom-dropdown" class="form-control" placeholder="選択">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary mt-2">登録</button>
                        </div>
                    </form>
                    @endif
            </p>
        </div>
    </div>

    <!-- 現在のイベント一覧 -->
    @if (count($emergencyEvents) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>イベント一覧</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($emergencyEvents as $emergencyEvent)
                            <tr>
                                <!-- タイトル -->
                                <td class="table-text">
                                    <div>
                                        <div>{{ $emergencyEvent->event_title }}</div>
                                        @foreach($emergencyEvent->tags as $tag)
                                            <span>#{{$tag->tag_name}}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <!-- 編集ボタン -->
                                <td>
                                    <button type="submit" class="btn btn-primary">
                                        <a href="{{ url('edit/'.$emergencyEvent->ee_id) }}" class="text-light" style="text-decoration: none;">編集</a>
                                    </button>
                                </td>
                                <!-- URL編集ボタン -->
                                <td>
                                    <button type="submit" class="btn btn-success">
                                        <a href="{{ url('edit/url/'.$emergencyEvent->ee_id) }}" class="text-light" style="text-decoration: none;">URL編集</a>
                                    </button>
                                </td>
                                <!-- 削除ボタン -->
                                <td>
                                    <form action="{{ url('delete/'.$emergencyEvent->ee_id) }}" method="POST" id="delete">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete this item?') }}');">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <script src="{{ asset('/js/tag.js') }}"></script>
    {{-- <script src="{{ asset('/js/confirm.js') }}"></script> --}}

@endsection
