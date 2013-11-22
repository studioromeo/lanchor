<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Anchor\Core\Models\Post;
use Anchor\Core\Models\Category;

class PostController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts      = Post::orderBy('updated_at', 'desc')->get();
		$categories = Category::all();

		return View::make('core::posts.index', compact('posts', 'categories'));
	}

	/**
	 * //
	 *
	 * @return Response
	 */
	public function filterByCategory($slug)
	{
		$posts      = Category::whereSlug($slug)->first()->posts;
		$categories = Category::all();

		return View::make('core::posts.index', compact('posts', 'categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::lists('title', 'id');
		return View::make('core::posts.create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$post = new Post;
		$post->fill(Input::all());
		$post->author = 1;
		$post->comments = (bool) Input::get('comments');
		$post->save();

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
		$categories = Category::lists('title', 'id');

		return View::make('core::posts.edit', compact('post', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$post = Post::find($id);

		$post->fill(Input::all());
		$post->comments = (bool) Input::get('comments');
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
