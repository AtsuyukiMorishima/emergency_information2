@extends('layouts.app')

@section('title', "管理者画面 - 災害情報ポータルサイト")

@section('content')

<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- フラッシュメッセージの表示に使用-->
@include('common.flash')

  {{-- 災害イベントの内容 --}}
  <div class="card shadow">
      <div class="card-body">
          <p class="card-text text-secondary">
            <h5>{{$emergencyEvent->event_title}}</h5>
            <div>{{$emergencyEvent->event_date->format('Y年n月j日') }}</div>
          </p>
      </div>
  </div>

  <!-- 現在のURL一覧 -->
  <div class="card-body p-1">
    <table class="table table-striped task-table">
        <!-- テーブルヘッダ -->
        <thead>
            <th colspan="3">ニュース一覧</th>
        </thead>
        <!-- テーブル本体 -->
        <tbody>
          {{-- urlを入力するためのform --}}
          <form action="{{ url('postUrl') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <tr>
              <td class="table-text">
                <input class="form-control" type="text" name="url" placeholder="https//www.sample.jp" value="{{old("url")}}">
                <input type="hidden" name="ee_id" value="{{$emergencyEvent->ee_id}}">
                <input name="tags" id="input-custom-dropdown" class="form-control news-tag" placeholder="タグ">
              </td>
              <td class="table-text">
                <input class="form-control" type="text" name="title" placeholder="タイトル" value="{{old("title")}}">
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
          {{-- urlを一つづつ取り出して表示 --}}
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
                        <input name="tags" id="input-custom-dropdown" class="form-control news-tag" placeholder="タグ"
                        value="@isset($siteUrl->tags_json)@foreach(json_decode($siteUrl->tags_json) as $tag)#{{$tag->tag_name}} @endforeach @endisset">
                    </td>
                    <td class="table-text">
                        <input class="form-control" type="text" name="title" value="{{ $siteUrl->title }}" placeholder="タイトル">
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
@endsection
