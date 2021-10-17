<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EmergencyEvent;
use Illuminate\Contracts\View\View;

class EmergencyEventController extends Controller
{
    /** @return \Illuminate\Contracts\View\View */
    public function index(): View
    {
        $emergencyEvents = EmergencyEvent::all();

        return view('event.index', [
            'emergencyEvents' => $emergencyEvents,
        ]);
    }

    /**
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
}
