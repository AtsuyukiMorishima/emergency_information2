@extends('layouts.base')

@section('title', '災害情報ポータルプロジェクトについて - 災害情報ポータルサイト')

@section('body_id', 'event-about')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
        管理者
        <br class="d-sm-none">
        画面
    </span>
    <span></span>
@endsection

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- バリデーションエラーの表示に使用-->

@section('contents')
    <div class="card shadow">
        <div class="card-body">
            <p class="card-text text-secondary">
              adminページ

                @if (!Request::is('admin'))
                <form action="{{ url('update') }}" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
                  {{ method_field('put') }}
                  タイトル<input name="event_title" value="{{$emergencyEvent->event_title}}">
                  日時<input type="date" name="event_date" value="{{$emergencyEvent->event_date->format('Y-m-d')}}">
                  <input type="hidden" name="ee_id" value="{{$emergencyEvent->ee_id}}">
                  <button type="submit" class="">更新</button>
                </form>
                <div>URL一覧</div>
                <form action="">
                  @foreach ($emergencyEvent->siteUrls as $item)
                    <div>{{$item->url}}</div>
                  @endforeach
                </form>
                  <button type="submit" class="btn btn-success">
                    <a href="{{ url('edit/url/'.$emergencyEvent->ee_id) }}" class="text-light" style="text-decoration: none;">URL編集</a>
                  </button>
                @else
                <form action="{{ url('post') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  タイトル<input name="event_title">
                  日時<input type="date" name="event_date">
                  <button type="submit" class="">登録</button>
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
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($emergencyEvents as $emergencyEvent)
                            <tr>
                                <!-- タイトル -->
                                <td class="table-text">
                                    <div>{{ $emergencyEvent->event_title }}</div>
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
                                  <form action="{{ url('delete/'.$emergencyEvent->ee_id) }}" method="POST">
                                      {{ csrf_field() }}
                                      {{ method_field('delete') }}
                                      <button type="submit" class="btn btn-danger">
                                          削除
                                      </button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


@endsection
