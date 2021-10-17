<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EmergencyEvent;
use Illuminate\Contracts\View\View;

class EmergencyEventController extends Controller
{
    /**
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id): View
    {
        $emergencyEvent = EmergencyEvent::findOrFail($id);

        return view('event.show', [
            'emergencyEvent' => $emergencyEvent,
        ]);
    }
}
