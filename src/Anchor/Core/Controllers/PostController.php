<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Anchor\Core\Models\Post;

class PostController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::all();

		return View::make('core::posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('core::posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		Post::create(Input::all());

		return Redirect::route('admin.posts.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// nah we dont use this !@@%$£%$&%
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);
		return View::make('core::posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// updates a post PUT method
		$post = Post::find($id);

		$post->fill(Input::all());
		$post->save();

		return Redirect::route('admin.posts.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Remove the post!
		Post::destroy($id);
		return Redirect::route('admin.posts.index');
	}
}
