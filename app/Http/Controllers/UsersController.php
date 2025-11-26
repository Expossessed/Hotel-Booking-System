<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    

    public function view()
    {
        $users = User::all();
        return view('admin.viewUsers', compact('users'));
    }

    public function deleteUser($id){
        $users = User::findOrFail($id);
        $users->delete();

        return back()->with('success message','User Deleted Successfully');
    }

    public function updateUserForm($id){
        $users = User::findOrFail($id);
        return view('admin.updateUser', compact('users'));

    }

    public function updateUser(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        $users = User::findOrFail($id);
        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return back();
    }

    
    

    
    
}
