<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class usercontroller extends Controller
{
    function register(Request $req){
        $data= $req->validate([
            'name' => 'required',
            'email' => 'email | required',
            'password' => 'required',
        ]);

        $user = User::firstOrCreate(
            ['email' => $data['email']],
            ['name' => $data['name'],
            'password' => $data['password']
            ]
        );

        $role = Role::findById(2);
        $user -> assignRole($role);

        if($user){
            return redirect()->route('login');
        }

}

// function addnewuser(Request $req){
//     $data= $req->validate([
//         'name' => 'required',
//         'email' => 'email | required',
//         'password' => 'required',
//     ]);

//     $user = User::firstOrCreate(
//         ['email' => $data['email']],
//         ['name' => $data['name'],
//         'password' => bcrypt($data['password'])]
//     );

//     $role = Role::findById(2);
//     $user -> assignRole($role);

//     if($user){
//         return redirect()->route('admin_dashboard');
//     }

// }
// }
