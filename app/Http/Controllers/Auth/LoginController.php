<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(request $request)
    {
    	$this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if(auth()->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1 ])){
            return redirect()->intended('admin');
        }else{
            return redirect()->back()->with('alert', 'Silahkan Approve ke Admin');
        }	
    }
}
