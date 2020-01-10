<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\File;
use App\Event;
use Image;

class FileController extends Controller
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
            
            return redirect()->route('public.dashboard')->with('success', 'Your file was been uploaded with success!');

        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while adding File! Try again.');
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
        $file_object = File::findOrFail($id);

        // Verifica se o Evento Pertence ao User
        if(Auth::user()->id == $file_object->event->user_id) {

            $data = request()->validate([
                'caption' => ['required', 'string', 'min:6', 'max:30'],
                'file' => ['mimes:pdf,jpeg,png', 'file', 'max:1024'],
                'event_id' => ['required'],
            ]);

            // Verifica se existe File ou Não
            if (isset($data['file'])) {

                // Apaga o Ficheiro Antigo
                $file_path = "/storage/".$file_object->file;
                unlink(public_path().$file_path);

                // Store de um Novo File
                $file_path = $data['file']->store('files', 'public');

                // Get Extension After Store
                $info = pathinfo($file_path);
                $ext = $info['extension'];

                // Save
                if ($ext == 'jpeg' || $ext == 'png') {
                    $fileImage = Image::make(public_path("storage/{$file_path}"));
                    $fileImage->save();
                }
            }

            $file_object->caption = $request->caption;
            $file_object->file = $file_path ?? $file_object->file; // Ou coloca o Novo File ou fica com o Antigo
            $file_object->event_id = $request->event_id;
            $file_object->update();
            
            return redirect()->route('public.events.edit', $file_object->event_id)->with('success', 'Your file was been updated with success!');

        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while updating File! Try again.');
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
        $file_object = File::findOrFail($id);

        if (Auth::user()->id == $file_object->event->user_id) {

            $file_path = "/storage/".$file_object->file;

            if ($file_object && $file_path) {
                unlink(public_path().$file_path);
                $file_object->delete();
                return redirect()->back()->with('success', 'File was been deleted with success.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong while deleting File! Try Again.');
            }

        } else {
            return redirect()->back()->with('warning', 'You have no permissions! Try Again.');
        }
    }
}
