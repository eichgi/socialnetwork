<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;

class CommentsLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Comment $comment)
    {
        $comment->likes()->create([
            'user_id' => auth()->id(),
        ]);

        //It's the same than above
        /*Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $comment->id,
            'likeable_type' => get_class($comment)
        ]);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return void
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->likes()->where([
            'user_id' => auth()->id(),
        ])->delete();

        //It's the same than above
        /*Like::where([
            'user_id' => auth()->id(),
            'likeable_id' => $comment->id,
            'likeable_type' => get_class($comment)
        ])->delete();*/
    }
}
