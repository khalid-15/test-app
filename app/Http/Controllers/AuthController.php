<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(){
        return Inertia::render('Auth/Login',[]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => ['required' , 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::user()->is_admin){
                // Redirect to Admins/Admins
                return redirect('/admin/admins');
            }elseif (Auth::user()->is_confirmed) {
                return redirect('/dashboard');
                # code...
            }
         }

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
