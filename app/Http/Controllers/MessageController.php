<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin'])->only(['messages']);
        $this->middleware(['auth:user'])->only(['userMessage']);
    }

    public function messages(){
        $message = Message::orderBy('messages.created_at','desc')
            ->join('users', 'users.id', '=','messages.user_id')
            ->selectRaw("name, DATE(messages.created_at) as date, TIME(messages.created_at) as time, message")
            ->paginate(5);
        return view('admin.message')->with('messages', $message);
    }

    public function userMessage(){
        $user_id  = Auth()->id();

        $message = Message::where('user_id', $user_id)
            ->orderBy('messages.created_at','desc')
            ->join('users', 'users.id', '=','messages.user_id')
            ->selectRaw("name, DATE(messages.created_at) as date, TIME(messages.created_at) as time, message")
            ->paginate(5);
        return view('admin.message')->with('messages', $message);
    }
}
