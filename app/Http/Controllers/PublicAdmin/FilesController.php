<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\File;
use App\Event;
use Image;

class FilesController extends Controller
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

        return view('public.pages.files.create', compact('event'));
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
            'caption' => ['required', 'string', 'min:6', 'max:30'],
            // 'file' => ['required', 'mimetypes:application/pdf,jpeg,png', 'file', 'max:1024'],
            'file' => ['required', 'image', 'file', 'max:1024'],
            'event_id' => ['required'],
        ]);        

        if(!$data->fails()) {

            if (request('file')) {

                $filePath = request('file')->store('files', 'public');

                $fileImage = Image::make(public_path("storage/{$filePath}"));
                $fileImage->save();
            }

            $file = new File();
            $file->event_id = $request->event_id;
            $file->caption = $request->caption;
            $file->file = $filePath;
            $file->save();
            
            return redirect()->route('public.dashboard')->with('success', 'Your file was uploaded with success!');

        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong with your Upload! Try again.');
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
        //
    }
}
