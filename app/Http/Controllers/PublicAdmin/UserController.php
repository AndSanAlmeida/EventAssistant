<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Image;

class UserController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   
        if (Auth::user()->id != $user->id) {
            return redirect()->route('home');
        }

        return view('public.pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->id != $user->id) {
            return redirect()->route('home');
        }

        return view('public.pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required|min:2|max:30',
            'email' => 'required|email|unique:users,email,'.$user->id, //Verifica se o email inserido já esiste
            'avatar' => 'file|image| max:1000',
        ]);

        if (request('avatar')) {
            $avatarPath = request('avatar')->store('profile', 'public');

            $avatar = Image::make(public_path("storage/{$avatarPath}"))->fit(300, 300);
            $avatar->save();

            $avatarArray = ['avatar' => $avatarPath];
        }

        auth()->user()->update(array_merge(
            $data,
            $avatarArray ?? []
        ));

        return redirect()->route('publicAdmin.user.show', $user->id);
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

    public function editPassword(User $user)
    {
        if (Auth::user()->id != $user->id) {
            return redirect()->route('home');
        }

        return view('public.pages.user.editPassword', compact('user'));
    }

    public function updatePassword(User $user)
    {
        return 'Update Password';
    }
}
