<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EmergencyEvent;
use App\Models\SiteUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;

class SiteUrlController extends Controller
{
    /**
     * Update a newly posted url in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Object
     */
    public function postUrl(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
            // 'title' => 'required',
            'ee_id' => 'required'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/edit/url/' . $request->ee_id)
                ->withInput()
                ->withErrors($validator);
        }
        // $tags = [];
        // if ($request->tags) {
        //     //tag付けに関して
        //     // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        //     preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠 - 々 ー ( ) %\']+)/u', $request->tags, $match);
        //     // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
        //     $tags = [];
        //     foreach ($match[1] as $index => $tag) {
        //         // firstOrCreateメソッドで、tags_tableのtag_nameカラムに該当のない$tagは新規登録される。
        //         $record = (['tag_id' => $index, 'tag_name' => $tag]);
        //         array_push($tags, $record);// $recordを配列に追加します(=$tags)
        //     };
        // }

        $siteUrl = new SiteUrl();
        $siteUrl->ee_id = $request->ee_id;
        // $siteUrl->title = $request->title;
        $siteUrl->url = $request->url;
        // $siteUrl->tags_json = json_encode($tags);
        $siteUrl->save();

        session()->flash('flash_message', 'URLを追加しました。');
        return redirect('/edit/url/' . $request->ee_id);
    }

    /**
     * Update a newly posted url in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Object
     */
    public function updateUrl(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
            // 'title' => 'required',
            'site_id' => 'required'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/edit/url/' . $request->site_id)
                ->withInput()
                ->withErrors($validator);
        }
        // $tags = [];
        // if ($request->tags) {
        //     //tag付けに関して
        //     // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        //     preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠 - 々 ー ( ) %\']+)/u', $request->tags, $match);
        //     // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
        //     foreach ($match[1] as $index => $tag) {
        //         // firstOrCreateメソッドで、tags_tableのtag_nameカラムに該当のない$tagは新規登録される。
        //         $record = (['tag_id' => $index, 'tag_name' => $tag]);
        //         array_push($tags, $record);// $recordを配列に追加します(=$tags)
        //     };
        // }

        $siteUrl = SiteUrl::find($request->site_id);
        // $siteUrl->title = $request->title;
        $siteUrl->url = $request->url;
        // $siteUrl->tags_json = json_encode($tags);
        $siteUrl->save();

        session()->flash('flash_message', 'ニュースを変更しました。');
        return redirect('/edit/url/' . $siteUrl->emergencyEvent->ee_id);
    }

    // public function category(Request $request)
    // {
    //     $ee_id = $request->ee_id;
    //     $site_id = $request->site_id;
    //     $tag_id = $request->tag_id;
    //     $siteUrl = SiteUrl::find($site_id);
    //     $category = "地震";
    //     $json = json_decode($siteUrl->tags_json);
    //     // foreach (json_decode($siteUrl->tags_json) as $index => $tag) {
    //     //     if ($index == 1) {
    //     //         $category = $tag->tag_name;
    //     //         break;
    //     //     } else {
    //     //         $category = $index;
    //     //     }
    //     // }
    //     $categorySiteUrls = SiteUrl::where('ee_id', $ee_id)->where('tags_json->tag_name', $category)->get();

    //     return view('event.showCategory', [
    //         'categorySiteUrls' => $categorySiteUrls,
    //         'category' => $category,
    //         'ee_id' => $ee_id,
    //     ]);
    // }
}
