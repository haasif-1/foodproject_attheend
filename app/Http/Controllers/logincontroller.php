<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logincontroller extends Controller
{
    function login(Request $req){
        $data= $req->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

            if (Auth::user()->hasRole('admin')) {

                return redirect()->route('admin_dashboard');
            } 
            
            elseif (Auth::user()->hasRole('user')) {

                $userdata = Auth::user();
                return view('pages.userpage',compact('userdata'));
            }
        }

        else {

            return back()->withErrors(['email' => 'Invalid credentials']);  // Show an error
        }


    }
}
