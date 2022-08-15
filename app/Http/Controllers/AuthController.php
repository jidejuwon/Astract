<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware('guest')->except(['adminLogout','userLogout']);
    }

    public function userAuth(){
        return view('auth.user');
    }

    public function adminAuth(){
        return view('auth.admin');
    }

    public function registerUser(){
        return view('auth.register');
    }


    public function userLogin(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if(User::where(['email' => $request->email])->exists()){
            $user =  User::where('email',$request->email)->first();
            if($user->is_verified){
                if(Auth::guard('user')->attempt($credentials)){
                    return redirect()->route('home')->with('success',"welcome, $request->name");
                }
                return back()->with('error',"Inavlid credentials!")->withInput();
            }
            return back()->with('info',"Account not verified!")->withInput();
        }

        return back()->with('error',"Inavlid credentials!")->withInput();

    }

    public function adminLogin(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::guard("admin")->attempt($credentials)){
            return redirect()->route('admin.home')->with('success',"welcome, $request->name");
        }
        return back()->with('error',"Inavlid Credentials")->withInput();
    }


    public function userLogout(){
        Auth::guard('user')->logout();
        return redirect()->route('auth');
    }

    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth');
    }


}
