<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Event;
use Auth;
use Image;
use Hash;

class UsersController extends Controller
{   

    public function dashboard()
    {   
        return view('public.pages.dashboard');
    }

    public function show(User $user)
    {   
        if (Auth::user()->id != $user->id) {
            return redirect()->back();
        }

        return view('public.pages.user.show', compact('user'));
    }

    public function edit()
    {   
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            return view('public.pages.user.edit', compact('user'));
        }        
    }

    public function update(Request $request)
    {   
        $user = User::find(Auth::user()->id);
        // dd($request);
        if ($user) {

            // Se o Email for igual ao existente
            if (Auth::user()->email === $request['email']) {

                // Não verifica se o email é UNIQUE
                $data = request()->validate([
                    'name' => ['required', 'string', 'min:2', 'max:30'],
                    //Verifica se o email inserido já existe
                    'email' => ['required', 'string', 'email', 'max:40'], 
                    'avatar' => ['file', 'image', 'max:1000'],
                ]);
            } else {
                // Verifica se o email é UNIQUE
                $data = request()->validate([
                    'name' => ['required', 'string', 'min:2', 'max:30'],
                    //Verifica se o email inserido já existe
                    'email' => ['required', 'string', 'email', 'max:40', 'unique:users'], 
                    'avatar' => ['file', 'image', 'max:1000'],
                ]);
            }

            if (request('avatar')) {
                $avatarPath = request('avatar')->store('profile', 'public');

                $avatar = Image::make(public_path("storage/{$avatarPath}"))->fit(600, 600);
                $avatar->save();

                $avatarArray = ['avatar' => $avatarPath];
            }

            auth()->user()->update(array_merge(
                $data,
                $avatarArray ?? []
            ));

            return redirect()->route('public.user.show', $user)->with('success', 'Your profile has been updated!');

        } else {
            return redirect()->back()->with('error', 'An error has occurred. Its not possible to update this user.');
        }        
    }

    public function passwordEdit()
    {
        if (Auth::user()) {
            return view('public.pages.user.editPassword');
        } else {
            return redirect()->back();
        }        
    }

    public function passwordUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user) {

            $validate = $request->validate([
                'oldPassword' => 'required',
                'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:8'
            ]);            

            if (Hash::check($request['oldPassword'], $user->password) && $validate) {
                
                $user->password = Hash::make($request['password']);
                $user->save();

                return redirect()->route('public.user.show', $user)->with('success', 'Your password has been updated!');

            } else {
                return redirect()->back()->with('error', 'The entered password does not match your current password!');
            }
        }
    }

    // Ajax Email Validation
    public function checkEmail($email) {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'containsError' => false
            ]);
        } else {
            return response()->json([
                'containsError' => true,
                'error' => 'The email has already been taken.'
            ]);
        }
    }
}