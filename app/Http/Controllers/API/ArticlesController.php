<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Validator;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  response()->json([
            'data' => Article::all()
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->only('title', 'content'), [
            'title' => [ 'required', 'string', 'min:3' ],
            'content' => [ 'required', 'string', 'min:3' ]
        ]);

        if( $validator->fails() )
        {

            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ])->setStatusCode( '422');
        }

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'status' => true,
            'data' => $article
        ])->setStatusCode( 201, 'Articles was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $article = Article::find( $id );

        if( ! $article )
        {
            return response()->json([
                'status' => false,
                'message' => 'Cant find article'
            ])->setStatusCode( 202, 'Not found art');
        }

        return response()->json([
            'status' => true,
            'data' => $article
        ])->setStatusCode( 200, 'Wery good, we found it');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id )
    {
//        dd( $request );

        $article = Article::find( $id );

        if( ! $article )
        {
            return response()->json([
                'status' => false,
                'message' => 'Cant find article'
            ])->setStatusCode( 202, 'Not found art');
        }

        $validator = Validator::make($request->only('title', 'content'), [
            'title' => [ 'required', 'string', 'min:3' ],
            'content' => [ 'required', 'string', 'min:3' ]
        ]);

        if( $validator->fails() )
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ])->setStatusCode( '422');
        }

//        dd( $validator->validated() );

        $article->update( $validator->validated() );

        return response()->json([
            'status' => true,
            'data' => $article
        ])->setStatusCode( 200, 'Wery good, we found it');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePatch(Request $request, int $id )
    {
//        dd( $request );

        if( count( $request->only( [ 'title', 'content' ] ) ) == 0)
        {
            return response()->json([
                'status' => false,
                'message' => 'All fields are empty'
            ])->setStatusCode( 422, 'Empty array');
        }

        $article = Article::find( $id );

        if( ! $article )
        {
            return response()->json([
                'status' => false,
                'message' => 'Cant find article'
            ])->setStatusCode( 202, 'Not found art');
        }

        $rules = [
            'title' => [ 'required', 'string', 'min:3' ],
            'content' => [ 'required', 'string', 'min:3' ]
        ];

        $real_rules = [];

        foreach( $request->only( [ 'title', 'content' ] ) as $key => $value )
        {
            $real_rules[$key] = $rules[ $key ];
        }

//        dd( $real_rules );

        $validator = Validator::make($request->only('title', 'content'), $real_rules);

//        dd( $validator->validated() );

        if( $validator->fails() )
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ])->setStatusCode( '422');
        }

        $article->update( $validator->validated() );

        return response()->json([
            'status' => true,
            'data' => $article
        ])->setStatusCode( 200, 'Wery good, we found it');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $article = Article::find( $id );

        if( ! $article )
        {
            return response()->json([
                'status' => false,
                'message' => 'Cant find article'
            ])->setStatusCode( 202, 'Not found art');
        }

        $article->delete();

        return response()->json([
            'status' => true,
            'message' => "deleted success"
        ])->setStatusCode( 200, 'Wery good, we deleted it');
    }
}
