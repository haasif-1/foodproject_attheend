<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;


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


// function  edituser($id){
//     $user = User::find($id);
//     return view('pages.updateuser',['edit'=> $user ]);


// }

function  datauser(){

    $user = Auth::user();
    return view('pages.mydata',["data"=>$user]);

}

public function changePassword(Request $request, $id)
{
    $request->validate([
        'new_password' => 'required|min:3|confirmed',
    ]);

    $user = User::findOrFail($id);
    $user->password = bcrypt($request->new_password);
    $user->save();

    return response()->json(['status' => 'success']);
}


public function showEditForm($id)
{
    $user = User::findOrFail($id);

    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);
}

public function updateUserInfo(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return response()->json([
        'status' => 'success',
        'updated_user' => [
            'name' => $user->name,
            'email' => $user->email,
        ]
    ]);
}


// public function updateuser(Request $request, $id)
// {
//     $user = User::find($id);
//     if ($user) {
//         $user->name = $request->name;
//         $user->email = $request->email;
//         $user->save();
//         return response()->json(['status' => 'success', 'message' => 'User updated successfully.']);
//     }

//     return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
// }


    }
