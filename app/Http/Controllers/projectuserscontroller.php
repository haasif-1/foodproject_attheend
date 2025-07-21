<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class projectuserscontroller extends Controller
{
 function userlist()
{
    // The more direct way to get users with the 'user' role
    $userRole = Role::findByName('user');
    $agents = $userRole->users;

    return view('pages.userlist', compact('agents'));
}

public function deleteuser($id)
{
    $user = User::find($id);
    if ($user) {
        $user->delete();
        return response()->json(['status' => 'success']);
    }
    return response()->json(['status' => 'error']);
}


function  edituser($id){
    $user = User::find($id);
    return view('pages.updateuser',['edit'=> $user ]);


}

function  datauser(){

    $user = Auth::user();
    return view('pages.mydata',["data"=>$user]);

}

function  changepassword(){

    $user = Auth::user();
return view('pages.changepassword',["data"=>$user]);

}

function  savenewpass(Request $req,$id){

    $data= $req->validate([
        'password' => 'required',
    ]);
    $user = user::findOrFail($id);
    $user->update([

        'password' => $data['password'],

    ]);

    $user = Auth::user();
    return view('pages.userpage',["data"=>$user]);

}

function updatauserinfo(){

    $user = Auth::user();
    return  view('pages.updatemyselfdata',["edit"=>$user]);

}

public function edituserinfo(Request $req, $id)
{
    $validated = $req->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
    ]);

    $user = user::findOrFail($id);
    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);
    return view('pages.userpage',["data"=>$user]);
}


public function updateuser(Request $request, $id)
{
    $user = User::find($id);
    if ($user) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'User updated successfully.']);
    }

    return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
}


    }
