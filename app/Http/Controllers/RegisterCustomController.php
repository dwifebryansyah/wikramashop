<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class RegisterCustomController extends Controller
{
    public function register(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0,
        ]);

        $user->roles()->attach(Role::where('id', $request->role_id)->first());

        return redirect('signIn');
    }
}
