<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index(){
        $category = Category::orderBy('created_at','desc')
            ->paginate(5);
        return view('admin.category')->with('category', $category);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'status' => 'required|string|in:pending,done,overdue'
        ]);

        if($validator->fails()){
            foreach($validator->errors()->all() as $error){
                return back()->with('error', $error)->withInput();
            }
        }

        Category::create([
            'title' => $request->title,
            'status' => $request->status
        ]);

        return back()->with('success',"category create successful!");
    }
}
