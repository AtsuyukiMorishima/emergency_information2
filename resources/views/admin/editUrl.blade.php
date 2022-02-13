@extends('layouts.base')

@section('title', '災害情報ポータルプロジェクトについて - 災害情報ポータルサイト')

@section('body_id', 'edit_url')

@section('navbar')
    <span>
        <a href="{{ route('event.index') }}">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">管理者ページ</span>
    <span></span>
@endsection

    <!-- バリデーションエラーの表示に使用-->
    @include('common.errors')
    <!-- フラッシュメッセージの表示に使用-->
    @include('common.flash')

@section('contents')

<div class="card shadow">
    <div class="card-body">
        <p class="card-text text-secondary">
          <h5>{{$emergencyEvent->event_title}}</h5>
          <div>{{$emergencyEvent->event_date}}</div>
        </p>
    </div>
</div>

    <!-- 現在のURL一覧 -->
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>URL一覧</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                      <form action="{{ url('postUrl') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <tr>
                          <td class="table-text">
                            <input class="form-control" type="text" name="url" placeholder="https//www.sample.jp">
                            <input type="hidden" name="ee_id" value="{{$emergencyEvent->ee_id}}">
                          </td>
                          <td class="table-text">
                            <button type="submit" class="btn btn-success">登録</button>
                          </td>
                          <td>
                            &nbsp;
                          </td>
                        </tr>
                    </form>
                    @if (count($siteUrls) > 0)
                      @foreach ($siteUrls as $siteUrl)
                          <tr>
                            <form action="{{ url('updateUrl') }}" method="POST" class="form-horizontal">
                              {{ csrf_field() }}
                              {{ method_field('put') }}
                              <!-- URL -->
                              <td class="table-text">
                                  <input class="form-control" type="text" name="url" value="{{ $siteUrl->url }}">
                                  <input type="hidden" name="site_id" value="{{ $siteUrl->site_id }}">
                              </td>
                              <!-- 編集ボタン -->
                              <td>
                                    <button type="submit" class="btn btn-primary">更新</button>
                              </td>
                            </form>
                              <!-- 削除ボタン -->
                              <td>
                                <form action="{{ url('delete/'.$siteUrl->ee_id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete this item?') }}');">
                                        削除
                                    </button>
                                </form>
                              </td>
                          </tr>
                      @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>


@endsection
