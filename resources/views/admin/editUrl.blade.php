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

    <div>{{$emergencyEvent->event_title}}</div>
    <div>{{$emergencyEvent->event_date}}</div>

@section('contents')
    <!-- 現在のURL一覧 -->
    @if (count($siteUrls) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>URL一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                      <form action="{{ url('update') }}" method="POST" class="form-horizontal">
                        <tr>
                          <td class="table-text">
                            <input class="form-control" type="text" name="url" value="">
                          </td>
                          <td class="table-text">
                            <button type="submit" class="btn btn-success">登録</button>
                          </td>
                          <td>
                            &nbsp;
                          </td>
                        </tr>
                    </form>
                      @foreach ($siteUrls as $siteUrl)
                          <tr>
                              <!-- URL -->
                              <td class="table-text">
                                  <input class="form-control" type="text" name="url" value="{{ $siteUrl->url }}">
                              </td>
                              <!-- 編集ボタン -->
                              <td>
                                    <button type="submit" class="btn btn-primary">
                                        <a href="{{ url('edit/'.$siteUrl->ee_id) }}" class="text-light" style="text-decoration: none;">編集</a>
                                    </button>
                              </td>
                              <!-- 削除ボタン -->
                              <td>
                                <form action="{{ url('delete/'.$siteUrl->ee_id) }}" method="POST">
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
