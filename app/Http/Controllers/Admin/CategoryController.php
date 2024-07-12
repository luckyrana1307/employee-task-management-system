<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();

        return view('admin.category.index', compact('category'));
    }

    public function add()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $categories = new Category();
            $categories->name = $request->name;
            $categories->save();

            return response()->json([
                'success' => true,
                'message' => ['Category add successfully']
            ]);
        }
    }



    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.category.update', compact('categories'));
    }



    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $categories = Category::findOrFail($request->id);
            $categories->name = $request->name;
            $categories->save();

            return response()->json([
                'success' => true,
                'message' => ['categories Update successfully']
            ]);
        }
    }


    public function delete(Request $request)
    {
        $departments = Category::findOrFail($request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => ['Category delete successfully']
        ]);
    }
}
