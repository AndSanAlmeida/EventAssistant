<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use Spatie\GoogleCalendar\Event as GoogleCalendarObject;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    public function create($id)
    {   
        $eventId = Event::findOrFail($id);

        if ($eventId) {

            $event = new GoogleCalendarObject;

            $event->name = $eventId->name;
            $event->startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $eventId->date.' '.$eventId->hour);
            $event->endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $eventId->date.' '.$eventId->hour)->addHour();
            $event->colorId = 4;
            $event->description = '<a href="'.route('public.events.show', ['id'=>$eventId->id,'slug'=>$eventId->slug]).'" title="'.$eventId->name.'" target="_blank">Event Link | '.$eventId->name.'</a>';
            $event->save();

            return redirect()->back()->with('success', 'This Event was been added correctly to your Google Calendar!');

        } else {
            return redirect()->back()->with('warning', 'An error occured while trying to add the event to your calendar! Try Again.');
        }
    }
}
