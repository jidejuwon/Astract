<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->only(['messages']);
        $this->middleware('auth:user')->only(['userMessage','sendMessage']);
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
