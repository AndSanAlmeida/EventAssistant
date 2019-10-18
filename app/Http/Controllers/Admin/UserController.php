<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.users.index')->with('users', User::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Não edita a própria conta
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You cannot manage your own permissions.');
        }

        return view('admin.pages.users.edit')->with(['user' => User::find($id), 'roles' => Role::all()]);
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
        // Não edita a própria conta
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You cannot manage your own permissions.');
        }

        $user = User::find($id);
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Your permissions has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Não edita a própria conta
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You cannot delete your own account.');
        }

        User::destroy($id);
        return redirect()->route('admin.users.index')->with('success', 'User has been deleted.');
    }
}
