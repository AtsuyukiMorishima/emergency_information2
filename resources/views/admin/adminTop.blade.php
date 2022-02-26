@extends('layouts.app')

@section('content')

<!-- バリデーションエラーの表示に使用-->
@include('common.errors')
<!-- フラッシュメッセージの表示に使用-->
@include('common.flash')


    <div class="card shadow">
        <div class="card-body">
            <p class="card-text text-secondary">
                <div>災害イベント登録</div>
                @if (!Request::is('admin'))
                    {{-- 編集時の表示 --}}
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
                    {{-- /admin の時の表示 --}}
                    <form action="{{ url('post') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        タイトル<input  type="text" class="form-control" name="event_title" value="{{old("event_title")}}">
                        日時<input class="form-control" type="date" name="event_date" value="{{old("event_date")}}">
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
        <div class="card-body p-2">
            <table class="table table-striped task-table">
                <!-- テーブルヘッダ -->
                <thead>
                    <th colspan="5">イベント一覧</th>
                </thead>
                <!-- テーブル本体 -->
                <tbody>
                    @foreach ($emergencyEvents as $emergencyEvent)
                        <tr>
                            <!-- タイトル -->
                            <td class="table-text" colspan="2">
                                <div>
                                    <div>{{ $emergencyEvent->event_title }}</div>
                                    <div>{{ $emergencyEvent->event_date->format('y年n月j日') }}</div>
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
    @endif
    <script src="{{ asset('/js/tag.js') }}"></script>
@endsection
