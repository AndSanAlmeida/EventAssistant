<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('public.pages.event.create');
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
            'hour' => ['required', 'date_format:H:i']
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        if ($event) {
            $event->delete();
            return redirect()->route('public.dashboard')->with('success', 'Event has been deleted.');
        }

        return redirect()->route('public.dashboard')->with('warning', 'This event can not be deleted.');
    }
}