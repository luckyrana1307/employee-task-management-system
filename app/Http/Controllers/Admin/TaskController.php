<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Category;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function index(){
        $tasks = Task::with('tag')->latest()->get();
        return view('admin.tasks.index',compact('tasks'));
    }

    public function add()
    {
        $categories = Category::all();
        $tag = Tag::all();
        $employees = Employee::latest()->get();
        return view('admin.tasks.create', compact('employees', 'tag','categories'));

    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'employee' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'status' => 'required',
            'date' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $tasks = new Task();

            $tasks->title = $request->title;
            $tasks->content = $request->content;
            $tasks->emp_id = $request->employee;
            $tasks->category_id = $request->category_id;
            $tasks->tag_id = $request->tag_id;
            $tasks->content = $request->content;
            $tasks->date = $request->date;
            $tasks->status = $request->status;
            $result = $tasks->save();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => ['Task add successfully']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => ['Task not add successfully']
                ]);
            }
        }
    }

    public function delete(Request $request){
        $result=Task::findOrFail($request->id)->delete();
        if($result){
            return response()->json([
                'success'=>true,
                'message'=>['Task delete Successfully']
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>['Task not delete Successfully']
            ]);
        }
    }

    public function edit($id){
        $task=Task::findOrFail($id);
        $employees = Employee::latest()->get();
        $categories = Category::all();
        $tag = Tag::all();
        return view('admin.tasks.update',compact(['task','employees','categories','tag']));
    }


    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'employee' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'status' => 'required',
            'date' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $tasks = Task::findOrFail($request->id);
            $tasks->title = $request->title;
            $tasks->content = $request->content;
            $tasks->emp_id = $request->employee;
            $tasks->category_id = $request->category_id;
            $tasks->tag_id = $request->tag_id;
            $tasks->content = $request->content;
            $tasks->date = $request->date;
            $tasks->status = $request->status;
            $result = $tasks->save();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => ['Task update successfully']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => ['Task not update successfully']
                ]);
            }
        }
    }
}