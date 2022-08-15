<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Message;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user')->only(['index','sendMessage']);
        $this->middleware('auth:admin')->only(['verify','unverify','delete']);
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:8|same:password_confirmation',
            'password_confirmation' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            foreach($validator->errors()->all() as $error){
                return back()->with('error', $error)->withInput();
            }
        }

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),

        ]);

        return redirect()->route('auth')->with('success','Account created successful!, Awaiting verification from admin');

    }

    public function verify($user_id){
        User::where('id',$user_id)->update([
            'is_verified' => True,
            'status' => 'active'
        ]);
        return back()->with('success', 'User Verified successful');
    }

    public function unverify($user_id){

        User::where('id',$user_id)->update([
            'is_verified' => False,
            'status' => 'pending'
        ]);
        return back()->with('error', 'Access denied!');
    }

    public function delete($user_id){
        if(Auth()->user()->is_super){
            User::where('id',$user_id)->delete();
            Message::where('user_id',$user_id)->delete();
            return back()->with('success', 'User record remove successful!');
        }
        return back()->with('error', 'Access denied!');
    }

    public function index(){
        $user_id = Auth()->id();
        $message = Message::where('user_id',$user_id)
            ->orderBy('created_at','desc')
            ->paginate(5);
        return view('user.index')->with('messages', $message);
    }

    public function sendMessage(Request $request){
        $validator = Validator::make($request->all(),[
            'message' => 'required|string',
        ]);

        if($validator->fails()){
            foreach($validator->errors()->all() as $error){
                return back()->with('error', $error)->withInput();
            }
        }

        $user_id = Auth()->id();
        Message::create([
            'user_id' => $user_id,
            'message' => $request->message
        ]);

        return back()->with('success',"message sent to admin successful!");
    }

}
