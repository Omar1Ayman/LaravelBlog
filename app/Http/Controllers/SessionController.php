<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function showform(){
        return view('registration.login');
    }

    public function store(Request $request){
        if(! Auth::attempt(['email' => $request->email ,'password' => $request->password])){
           return back()->withErrors([
               'message' => 'email or password is not valid'
           ]);
           
        }
        return redirect('/');
    }

    public function destroy(){
        Auth::logout();
        return redirect('/');
    }

}
