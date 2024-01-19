<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('image');
        if($request->hasFile('image'))
        {
            $path = Storage::putFile('public/images/posts', $request->file('image'));
            $data['image']=$path;
        }
        // dd(auth());

       $post =  Post::create($data);
    //    dd($post_id->id);

        return response()->json(['success'=>'Created Successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($posts);
        //
        $post = Post::findOrFail($id);
        $data = $request->except('image','_method');
        // dd($data);
        if($request->hasFile('image'))
        {
            $path = Storage::putFile('public/images/posts', $request->file('image'));
            Storage::delete($post->image);
            $data['image']=$path;
        }

       $post =  $post->update($data);

        return response()->json(['success'=>'Updated Successfully']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->delete();
        Storage::delete($post->image);

        return response()->json(['success'=>'Deleted Successfully']);

    }
}
