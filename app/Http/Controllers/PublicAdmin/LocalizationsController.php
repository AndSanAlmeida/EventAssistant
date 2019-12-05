<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Event;
use App\Localization;

class LocalizationsController extends Controller
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
    public function create(Event $event)
    {
        if (Auth::user()->id != $event->user_id) {
            return redirect()->back();
        }
        
        return view('public.pages.localizations.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'localization' => ['required', 'string', 'min:6', 'max:30'],
            'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'], 
            'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ], [
            'latitude.regex' => 'Latitude value appears to be incorrect format.',
            'longitude.regex' => 'Longitude value appears to be incorrect format.'
        ]);

        if (!$data->fails()) {

            $localization = new Localization();
            $localization->fill($request->all());
            $localization->save();

            return redirect()->route('public.dashboard')->with('success', 'Your localization was added with success!');

        } else {
            return redirect()->back()->withErrors($data->errors())->withInput()->with('error', 'Something went wrong adding the localization! Try Again.');
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
    public function edit(Localization $localization)
    {
        if (Auth::user()->id != $localization->event->user_id) {
            return redirect()->back();
        }

        return view('public.pages.localizations.edit', compact('localization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localization = Localization::findOrFail($id);
        if ($localization) {
            $localization->delete();
            return redirect()->back()->with('success', 'Localization has been deleted.');
        }

        return redirect()->back()->with('warning', 'This localization cant be deleted.');
    }
}
