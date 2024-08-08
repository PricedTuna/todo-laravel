<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("category.index", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|min:2",
            "color" => "required|min:3"
        ]);

        $category = new Category;
        $category->title = $request->title;
        $category->color = $request->color;
        $category->save();

        return redirect()->route("category.index")->with("success","Category created successfully");
    }

    public function show($id){
        $category = Category::find($id);
        return view("category.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if($category){
            return view("category.edit", compact("category"));
        }

        return redirect()->back()->with("error","Category not found");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|min:2",
            "color" => "required|min:3"
        ]);

        $category = Category::find($id);
        $category->title = $request->title;
        $category->color = $request->color;
        $category->save();

        return redirect()->route("category.index")->with("success","Category updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $category = Category::find($id);

        if( $category ){
            $category->delete();
            return redirect()->back()->with("success","Ctegory deleted successfully");
        }
    }
}
