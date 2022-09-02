<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:user'],['except' => ['userTask','destroyTask','updateTask']]);
        $this->middleware(['auth:admin'],['only' => ['userTask','destroyTask','updateTask']]);

    }

    public function index(){
        $task = Task::where('user_id',Auth::user()->id)
            ->join('categories','tasks.category_id','=','categories.id')
            ->addselect('categories.title as cat_title','tasks.title as title','deadline','tasks.status as status','tasks.id as id')
            ->orderBy('tasks.created_at','desc')
            ->paginate(5);
        $category = Category::where('status','active')->get(['id','title']);
        return view('user.task')->with(['tasks' => $task,'category' => $category]);
    }

    public function userTask(){
        $task = Task::orderBy('tasks.created_at','desc')
            ->join('users','users.id','=','tasks.user_id')
            ->join('categories','categories.id','=','tasks.category_id')
            ->addSelect('tasks.title as title','categories.title as category','name','deadline','tasks.status as status','tasks.id as id')
            ->paginate(5);

        return view('admin.task')->with(['tasks' => $task]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'cat_id' => 'required|string',
            'deadline' => 'required|date|after:today',
            'status' => 'required|string|in:pending,done,overdue'
        ]);

        if($validator->fails()){
            foreach($validator->errors()->all() as $error){
                return back()->with('error', $error)->withInput();
            }
        }

        Task::create([
            'title' => $request->title,
            'user_id' => $request->user()->id,
            'category_id' => $request->cat_id,
            'deadline' => $request->deadline,
            'status' => $request->status
        ]);

        return back()->with('success', 'Task create successful');
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'task_id' => 'required|string',
            'status' => 'required|string|in:pending,done,overdue'
        ]);

        if($validator->fails()){
            foreach($validator->errors()->all() as $error){
                return back()->with('error', $error)->withInput();
            }
        }

        Task::where('id',$request->task_id)->update(['status'=>$request->status]);
        return back()->with('success',"category update successful!");
    }

    public function updateTask(Request $request){
        $validator = Validator::make($request->all(),[
            'task_id' => 'required|string',
            'status' => 'required|string|in:pending,done,overdue'
        ]);

        if($validator->fails()){
            foreach($validator->errors()->all() as $error){
                return back()->with('error', $error)->withInput();
            }
        }

        Task::where('id',$request->task_id)->update(['status'=>$request->status]);
        return back()->with('success',"category update successful!");
    }

    public function destroy(Request $request){

        Task::where('id', $request->task_id)->delete();
        return back()->with('success',"category delete successful!");
    }

    public function destroyTask(Request $request){

        Task::where('id', $request->task_id)->delete();
        return back()->with('success',"category delete successful!");
    }



    public function analysis(){
        $result['pending'] = self::taskAnalysis('pending');
        $result['done'] = self::taskAnalysis('done');
        $result['overdue'] = self::taskAnalysis('overdue');


        return view('user.analysis')->with(['task' => $result]);
    }

    private function taskAnalysis($status){
        $task = Task::where(['status' => $status, "user_id" => Auth::user()->id])->count();
        return (int)$task;
    }



}
