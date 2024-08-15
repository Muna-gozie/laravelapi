<?php

namespace App\Http\Controllers;

use App\Models\Post;
//use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

//use http\Client\Request;

class PostController extends Controller implements HasMiddleware
{
    // this function ensures that auth:sanctum authentication middleware i.e (to protect the api route against users without api token) and  is applied on all methods of this class except (index and show) methods. HasMiddleware interface must be implemented for this to work.

    public static function middleware(){
        return [
            new Middleware('auth:sanctum', except: ['index','show'])
        ];
    }
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

        $post = $request->user()->post()->create($fields);

        return $post;
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
        // Gate: authorize parameters includes, method name, user, and post but the user is gotten automatically by the Gate class
        Gate::authorize('modify', $post);
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
        Gate::authorize('modify', $post);
        $post->delete();

        return ['message' => 'Post deleted successfully'];
    }
}
