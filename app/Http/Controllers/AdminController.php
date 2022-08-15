<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index(){
        $user = User::orderBy('total','desc')->orderBy('created_at','desc')
            ->leftjoin('messages','users.id' , '=', 'messages.user_id')
            ->selectRaw("name, email, phone, IFNULL(COUNT(messages.id),0) as total, status, is_verified,users.created_at, users.id")
            ->groupBy('email')
            ->paginate(5);;
        return view('admin.index')->with('users',$user);
    }

   public function messages(){
        $message = Message::orderBy('messages.created_at','desc')
            ->join('users', 'users.id', '=','messages.user_id')
            ->selectRaw("name, DATE(messages.created_at) as date, TIME(messages.created_at) as time, message")
            ->paginate(5);
        return view('admin.message')->with('messages', $message);
   }


}
