<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Event;
use Auth;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        if (Auth::user()->id != $event->user_id) {
            return redirect()->back();
        }

        return view('public.pages.events.index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public.pages.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'min:6', 'max:30'],
            'date' => ['required', 'date'],
            'hour' => ['required', 'date_format:H:i'],
            'website' => ['url', 'nullable'],
        ]);

        // Cria uma slug do name e gera uma random string no fim
        $slug = str_slug(request('name'), '-') . '-' . Str::random(48); 
        
        // Data Actual
        $currentDate = date("Y-m-d");
        
        if (request('date') <= $currentDate) {
            return redirect()->back()->withInput()->with('error', 'You cannot insert an older date! Try again.');
        } else {

            // Dá o user autenticado e vai aos eventos e faz create
            auth()->user()->events()->create(array_merge(
                $data,
                ['slug' => $slug]
            ));

            return redirect()->route('public.dashboard')->with('success', 'Event was created with success! You can now Add Files and Localizations to it.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        $event = Event::where('id', $id)
                      ->where('slug', $slug)
                      ->firstOrFail();

        if(! $event) {
            return redirect()->back();
        }

        return view('public.pages.events.show', compact('event'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if (Auth::user()->id != $event->user_id) {
            return redirect()->back();
        }  
          
        return view('public.pages.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   

        $event = Event::findOrFail($id);

        if (Auth::user()->id == $event->user_id) {

            $data = request()->validate([
                'name' => ['required', 'string', 'min:6', 'max:30'],
                'date' => ['required', 'date'],
                'hour' => ['required', 'date_format:H:i'],
                'website' => ['url', 'nullable'],
                'active' => ['required', 'boolean']
            ]);

            // Data Actual
            $currentDate = date("Y-m-d");
            
            if (request('date') <= $currentDate) {
                return redirect()->back()->withInput()->with('error', 'You cannot insert an older date! Try again.');
            } else {

                auth()->user()->events()->update($data);

                return redirect()->route('public.dashboard')->with('success', 'Event was updated with success!');

            } 
        } else {
            return redirect()->back()->with('warning', 'You have no permissions! Try Again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if (Auth::user()->id == $event->user_id) {
            if ($event) {
                $event->delete();
                return redirect()->back()->with('success', 'Event was been deleted with success.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong while deleting Event! Try Again.');
            }
        } else {
            return redirect()->back()->with('warning', 'You have no permissions! Try Again.');
        }
    }
}
