<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->get();

        return view('admin.tag.index', compact('tags'));
    }

    public function add()
    {
        return view('admin.tag.create');
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
            $tags = new Tag();
            $tags->name = $request->name;
            $tags->save();

            return response()->json([
                'success' => true,
                'message' => ['tag add successfully']
            ]);
        }
    }



    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.update', compact('tag'));
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
            $tag = Tag::findOrFail($request->id);
            $tag->name = $request->name;
            $tag->save();

            return response()->json([
                'success' => true,
                'message' => ['tag Update successfully']
            ]);
        }
    }


    public function delete(Request $request)
    {
        $tag = Tag::findOrFail($request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => ['tag delete successfully']
        ]);
    }
}
