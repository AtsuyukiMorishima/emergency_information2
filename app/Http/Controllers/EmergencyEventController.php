<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EmergencyEvent;
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
        $emergencyEvents = EmergencyEvent::all();

        return view('event.index', [
            'emergencyEvents' => $emergencyEvents,
        ]);
    }

    /**
     *
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
        $emergencyEvents = EmergencyEvent::all();

        return view('admin.post', [
            'emergencyEvents' => $emergencyEvents,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
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

        redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmergencyEvent  $emergencyEvent
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\View\View
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

        return redirect('admin');
    }


    /**
     * Display edit content.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EmergencyEvent $emergencyEvent): View
    {
        $emergencyEvents = EmergencyEvent::all();
        return view('admin.post', [
            'emergencyEvent' => $emergencyEvent,
            'emergencyEvents' => $emergencyEvents,
        ]);
    }


    /**
     * Display edit content.
     *
     * @param int $id
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
