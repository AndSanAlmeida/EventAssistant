<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use Spatie\GoogleCalendar\Event as GoogleCalendarObject;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    public function createEvent($id)
    {   
        $eventId = Event::findOrFail($id);

        $event = new GoogleCalendarObject;

        $event->name = $eventId->name;
        $event->startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $eventId->date.' '.$eventId->hour);
        $event->endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $eventId->date.' '.$eventId->hour)->addHour();

        $event->save();
        return redirect()->back()->with('success', 'This Event was been added correctly to your Google Calendar!');
    }
}
