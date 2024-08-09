<?php

namespace App\Http\Controllers;

use App\Models\Post;
//use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

//use http\Client\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([
            'title' => ['required','unique:posts','max:255'],
            'body' => 'required|max:255'
        ]);

//        $result= Post::create($fields);
//        return $result;

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $fields = $request->validate([
            'title' => ['required','unique:posts','max:255'],
            'body' => 'required|max:255'
        ]);

        $result = $post->update($fields);

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return ['message' => 'Post deleted successfully'];
    }
}
