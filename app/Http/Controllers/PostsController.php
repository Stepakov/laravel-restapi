<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $posts = Post::all();
//        $result = [];
//
//        foreach( $posts as $post )
//        {
//            $p[ 'id' ] = $post->id;
//            $p[ 'title' ] = $post->title;
////            $p[ 'body' ] = $post->body;
//            $p[ 'comments' ] = Comment::
//                    where( 'article_id', $post->id )
//                    ->select( 'body', 'article_id' )
//                    ->get();
//            $result[] = $p;
//        }
        $posts = Post::all();

//        dd( $posts->count() );

        return response()->json([
            'posts' => PostResource::collection( $posts )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd( $request->only( [ 'title', 'body' ] ) );

        $post = Post::create( $request->only( [ 'title', 'body' ] ) );

        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $post = Post::find( $id );

        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->update( $request->only( [ 'title', 'body' ] ) );

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return true;
    }
}
