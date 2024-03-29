<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    public function dashboard() {

        $usersCount = User::count();

        return view('admin.pages.dashboard', compact('usersCount'));
    }

    public function index()
    {
        $users = User::all();

        return view('admin.pages.users.index', compact('users'));
    }

    public function edit($id)
    {
        // Não edita a própria conta
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You cannot manage your own permissions.');
        }

        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.pages.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {   
        // Não edita a própria conta
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You can not manage your own permissions.');
        }

        $user = User::findOrFail($id);
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Your permissions has been updated.');
    }

    public function destroy($id)
    {
        // Não edita a própria conta
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You can not delete your own account.');
        }

        $user = User::findOrFail($id);

        // Fax o Detach da relação na tabela role_user quando apagamos um utilizador
        if ($user) {
            $user->roles()->detach();
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User has been deleted.');
        }

        return redirect()->route('admin.users.index')->with('warning', 'This user can not be deleted.');
    }
}
