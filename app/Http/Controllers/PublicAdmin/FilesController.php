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
            'file' => ['required', 'mimes:pdf,jpeg,png', 'file', 'max:1024'],
            'event_id' => ['required'],
        ]);        

        if(!$data->fails()) {

            if (request('file')) {

                // Store
                $filePath = request('file')->store('files', 'public');

                // Get Extension After Store
                $info = pathinfo($filePath);
                $ext = $info['extension'];

                if ($ext == 'jpeg' || $ext == 'png') {
                    $fileImage = Image::make(public_path("storage/{$filePath}"));
                    $fileImage->save();
                }
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
    public function edit(File $file)
    {
        if (Auth::user()->id != $file->event->user_id) {
            return redirect()->back();
        }

        return view('public.pages.files.edit', compact('file'));
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
        $file = File::findOrFail($id);

        // Verifica se o Evento Pertence ao User
        if(Auth::user()->id == $file->event->user_id) {

            $data = request()->validate([
                'caption' => ['required', 'string', 'min:6', 'max:30'],
                'file' => ['required', 'mimes:pdf,jpeg,png', 'file', 'max:1024'],
                'event_id' => ['required'],
            ]);   

            if (request('file')) {

                // Store
                $filePath = request('file')->store('files', 'public');

                // Get Extension After Store
                $info = pathinfo($filePath);
                $ext = $info['extension'];

                if ($ext == 'jpeg' || $ext == 'png') {
                    $fileImage = Image::make(public_path("storage/{$filePath}"));
                    $fileImage->save();
                }
            }

            $file = new File();
            $file->event_id = $request->event_id;
            $file->caption = $request->caption;
            $file->file = $filePath;
            $file->update();
            
            return redirect()->route('public.events.edit', $file->event_id)->with('success', 'Your file was updated with success!');

        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong with your Update! Try again.');
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
        $file = File::findOrFail($id);
        $image_path = "/storage/".$file->file;

        if ($file && $image_path) {
            unlink(public_path().$image_path);
            $file->delete();
            return redirect()->back()->with('success', 'File has been deleted.');
        }

        return redirect()->back()->with('warning', 'This file cant be deleted.');
    }
}
