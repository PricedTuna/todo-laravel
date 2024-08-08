<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    //

    public function index(){
        $todos = Todo::all();
        $categories = Category::all();

        return view('todos.index', compact('todos','categories'));
    }

    public function store(Request $request){

        $request->validate([
            "title"         => "required|min:4",
            "category_id"   => "required|exists:categories,id"
        ]);

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Task created successfully');
    }

    public function edit($id){
        $todo = Todo::find($id);
        
        if($todo) {
            return view('todos.edit', compact('todo'));
        }

        return redirect()->back()->with('error', 'Task not found');
    }

    public function update(Request $request, $id){
        $request->validate([
            "title"         => "required|min:4",
            "category_id"   => "required|exists:categories,id"
        ]);

        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();
        return redirect()->route("todos")->with("success","Task edited successfully");
    }

    public function delete($id){
        $todo = Todo::find($id);
        
        if($todo) {
            $todo->delete();
            return redirect()->back()->with('success','Task deleted successfully');
        }
    }
}
