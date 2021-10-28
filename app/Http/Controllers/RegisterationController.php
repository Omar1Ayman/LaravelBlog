<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterationController extends Controller
{
    public function showform(){
        return view('registration.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email'=>'required|email',
            'password'=>'required',
            'image' =>'required|image|mimes:png,jpg,jpeg'
        ]);

        $path = Storage::putFile('user_image' , $request->file('image'));
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $path
        ]);
        $user->roles()->attach(Role::where('name' , 'User')->first());
        Auth::login($user);

        return redirect('/');

    }
    

}
