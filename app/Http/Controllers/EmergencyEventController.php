<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EmergencyEvent;
use App\Models\SiteUrl;
use App\Models\Tag;
use App\Models\EmergencyEventTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;

class EmergencyEventController extends Controller
{
    /**
     * Display index page.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $emergencyEvents = EmergencyEvent::all()->sortByDesc('event_date');

        return view('event.index', [
            'emergencyEvents' => $emergencyEvents,
        ]);
    }


    /**
     *Display event page.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id): View
    {
        $emergencyEvent = EmergencyEvent::findOrFail($id);

        return view('event.show', [
            'emergencyEvent' => $emergencyEvent,
        ]);
    }


    /**
     * Display admin page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function admin(): View
    {
        $emergencyEvents = EmergencyEvent::all()->sortByDesc('event_date');

        return view('admin.post', [
            'emergencyEvents' => $emergencyEvents,
        ]);
    }


    /**
     * Display category page.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function category(int $id): View
    {
        $tag = Tag::find($id);

        return view('event.category', [
            'tag' => $tag,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Object
     */
    public function post(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'event_title' => 'required|max:255',
            'event_date' => 'required|max:255'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/admin')
                ->withInput()
                ->withErrors($validator);
        }

        $emergencyEvent = new EmergencyEvent();
        $emergencyEvent->event_title = $request->event_title;
        $emergencyEvent->event_date = $request->event_date;
        $emergencyEvent->save();

        if ($request->tags) {
            //tag付けに関して
            // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
            preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠 - 々 ー ( ) %\']+)/u', $request->tags, $match);
            // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
            $tags = [];
            foreach ($match[1] as $tag) {
                // firstOrCreateメソッドで、tags_tableのtag_nameカラムに該当のない$tagは新規登録される。
                $record = Tag::firstOrCreate(['tag_name' => $tag]);
                array_push($tags, $record);// $recordを配列に追加します(=$tags)
            };

            // 投稿に紐付けされるタグのidを配列化
            $tagsId = [];
            foreach ($tags as $tag) {
                array_push($tagsId, $tag->id);
            };
            // 投稿にタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
            $emergencyEvent->tags()->attach($tagsId);
        }

        session()->flash('flash_message', 'イベントを登録しました。');
        return redirect('admin');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmergencyEvent  $emergencyEvent
     * @return Object
     */
    public function destroy(EmergencyEvent $emergencyEvent)
    {
        $emergencyEvent->delete();

        return redirect('admin');
    }


    /**
     * Update a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Object
     */
    public function update(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'event_title' => 'required|max:255',
            'event_date' => 'required|max:255'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/admin')
                ->withInput()
                ->withErrors($validator);
        }

        $emergencyEvent = EmergencyEvent::find($request->ee_id);
        $emergencyEvent->event_title = $request->event_title;
        $emergencyEvent->event_date = $request->event_date;
        $emergencyEvent->save();

        EmergencyEventTag::where("emergency_event_ee_id", $request->ee_id)->delete();

        if ($request->tags) {
            //tag付けに関して
            // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
            preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠 - 々 ー ( ) %\']+)/u', $request->tags, $match);
            // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
            $tags = [];
            foreach ($match[1] as $tag) {
                 // firstOrCreateメソッドで、tags_tableのtag_nameカラムに該当のない$tagは新規登録される。
                $record = Tag::firstOrCreate(['tag_name' => $tag]);
                array_push($tags, $record);// $recordを配列に追加します(=$tags)
            };

            // 投稿に紐付けされるタグのidを配列化
            $tagsId = [];
            foreach ($tags as $tag) {
                array_push($tagsId, $tag->id);
            };

        // 投稿にタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
            $emergencyEvent->tags()->syncWithoutDetaching($tagsId);
        }

        session()->flash('flash_message', 'イベントを変更しました。');
        return redirect('admin');
    }


    /**
     * Display edit content.
     *
     * @param  \App\Models\EmergencyEvent  $emergencyEvent
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EmergencyEvent $emergencyEvent): View
    {
        $emergencyEvents = EmergencyEvent::all()->sortByDesc('event_date');
        return view('admin.post', [
            'emergencyEvent' => $emergencyEvent,
            'emergencyEvents' => $emergencyEvents,
        ]);
    }


    /**
     * Display edit url content.
     *
     * @param  \App\Models\EmergencyEvent  $emergencyEvent
     * @return \Illuminate\Contracts\View\View
     */
    public function editUrl(EmergencyEvent $emergencyEvent): View
    {
        $siteUrls = $emergencyEvent->siteUrls;
        return view('admin.editUrl', [
            'siteUrls' => $siteUrls,
            'emergencyEvent' => $emergencyEvent,
        ]);
    }
}
