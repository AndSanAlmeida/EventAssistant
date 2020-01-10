<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Event;
use App\Localization;

class LocalizationController extends Controller
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
            'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'hour' => ['required', 'date_format:H:i'],
        ], [
            'latitude.regex' => 'Latitude value appears to be incorrect format.',
            'longitude.regex' => 'Longitude value appears to be incorrect format.'
        ]);

        if (!$data->fails()) {

            $localization = new Localization();
            $localization->fill($request->all());
            $localization->save();

            return redirect()->route('public.dashboard')->with('success', 'Your localization was been added with success!');

        } else {
            return redirect()->back()->withErrors($data->errors())->withInput()->with('error', 'Something went wrong while adding localization! Try Again.');
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
        } else {
            return view('public.pages.localizations.edit', compact('localization'));
        }
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
        $localization_object = Localization::findOrFail($id);

        if (Auth::user()->id == $localization_object->event->user_id) {

            $data = Validator::make($request->all(), [
                'localization' => ['required', 'string', 'min:6', 'max:30'],
                'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'], 
                'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'hour' => ['required', 'date_format:H:i'],
            ], [
                'latitude.regex' => 'Latitude value appears to be incorrect format.',
                'longitude.regex' => 'Longitude value appears to be incorrect format.'
            ]);

            if (!$data->fails()) {

                $localization_object->fill($request->all());
                $localization_object->update();

                return redirect()->route('public.events.edit', $localization_object->event_id)->with('success', 'Your localization was been updated with success!');

            } else {
                return redirect()->back()->withErrors($data->errors())->withInput()->with('error', 'Something went wrong while updating localization! Try Again.');
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
        $localization_object = Localization::findOrFail($id);

        if (Auth::user()->id == $localization_object->event->user_id) {

            if ($localization_object) {
                $localization_object->delete();
                return redirect()->back()->with('success', 'Localization was been deleted with success.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong while deleting Localization! Try Again.');
            }

        } else {
            return redirect()->back()->with('warning', 'You have no permissions! Try Again.');
        }
    }
}
