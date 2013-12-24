<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Config;
use Anchor\Core\Models\Comment;

class CommentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comment::orderBy('date', 'desc')->paginate(Config::get('meta.posts_per_page'));
        return View::make('core::comments.index', compact('comments'));
    }

    /**
     *
     *
     * @return Response
     */
    public function filterByStatus($status)
    {
        $comments = Comment::whereStatus($status)->paginate(Config::get('meta.posts_per_page'));
        return View::make('core::comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return View::make('core::comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $comment = Comment::find($id);

        $comment->fill(Input::all());
        $comment->save();

        return Redirect::route('admin.comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        return Redirect::route('admin.comments.index');
    }

}
