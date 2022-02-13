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
            'ee_id' => 'required'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/edit/url/' . $request->ee_id)
                ->withInput()
                ->withErrors($validator);
        }

        $siteUrl = new SiteUrl();
        $siteUrl->ee_id = $request->ee_id;
        $siteUrl->url = $request->url;
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
            'site_id' => 'required'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/edit/url/' . $request->site_id)
                ->withInput()
                ->withErrors($validator);
        }

        $siteUrl = SiteUrl::find($request->site_id);
        $siteUrl->url = $request->url;
        $siteUrl->save();

        session()->flash('flash_message', 'URLを変更しました。');
        return redirect('/edit/url/' . $siteUrl->emergencyEvent->ee_id);
    }
}
