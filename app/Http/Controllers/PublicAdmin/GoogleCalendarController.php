<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class GoogleCalendarController extends Controller
{
    public function createEvent()
    {
        // dd('Dentro');

        $event = new Event;

        $event->name = 'A new EventAssistant Event';
        $event->startDateTime = Carbon::now();
        $event->endDateTime = Carbon::now()->addHour();
        $event->addAttendee(['email' => 'andre.pirum@gmail.com']);
        // $event->addAttendee(['email' => 'anotherEmail@gmail.com']);

        $event->save()->with('Success', 'This Event was added correctly to your Google Calendar');

        // dd(Event::get());
        // return redirect()->back();
    }
}
