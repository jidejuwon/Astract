<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Message;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index(Request $request){
        $status = strtolower($request->status);

        if($status == ""){
            $user = User::orderBy('total','desc')->orderBy('created_at','desc')
                ->leftjoin('messages','users.id' , '=', 'messages.user_id')
                ->selectRaw("name, email, phone, IFNULL(COUNT(messages.id),0) as total, status, is_verified,users.created_at, users.id")
                ->groupBy('email')
                ->paginate(10);
            return view('admin.index')->with('users',$user);

        }else if($status == "pending" or $status == "active"){

            $user = User::where('status' , $status)->orderBy('total','desc')->orderBy('created_at','desc')
                ->leftjoin('messages','users.id' , '=', 'messages.user_id')
                ->selectRaw("name, email, phone, IFNULL(COUNT(messages.id),0) as total, status, is_verified,users.created_at, users.id")
                ->groupBy('email')
                ->paginate(50);

            return view('admin.index')->with(['users'=> $user,'status' => $status]);

        }else{
            return back()->with('info', 'Filter only on user status')->withInput();
        }

    }

    public function analysis(){
        $result['pending'] = self::taskAnalysis('pending');
        $result['done'] = self::taskAnalysis('done');
        $result['overdue'] = self::taskAnalysis('overdue');

        // dd($result);

        $user  = User::all()->count();

        return view('admin.analysis')->with(['task' => $result, 'users' => $user]);
    }

    private function taskAnalysis($status){
        $task = Task::where('status',$status)->count();
        return (int)$task;
    }

}
