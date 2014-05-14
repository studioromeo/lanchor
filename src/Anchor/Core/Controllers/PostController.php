<?php

namespace Anchor\Core\Controllers;

use Controller;
use Config;
use View;
use Input;
use Redirect;
use Anchor\Core\Models\Post;
use Anchor\Core\Models\Category;

use Anchor\Core\Forms\PostForm;

class PostController extends Controller
{
	protected $post;
	protected $category;
	protected $postForm;

	public function __construct(Post $post, Category $category, PostForm $postForm)
	{
		$this->post = $post;
		$this->category = $category;
		$this->postForm = $postForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts      = Post::orderBy('updated_at', 'desc')->paginate(Config::get('meta.posts_per_page'));
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
		$posts      = Category::whereSlug($slug)->first()->posts()->paginate(Config::get('meta.posts_per_page'));
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
		$this->postForm->validate(Input::all());
		$this->post->fill(Input::all())->save();

		return Redirect::route('admin.posts.index')
			->with('message', 'core::posts.created');
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
		$this->postForm->fill([':id' => $id])->validate(Input::all());
		$this->post->findOrFail($id)->update(Input::all());

		return Redirect::route('admin.posts.edit', array($id))
			->with('message', 'core::posts.updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->post->destroy($id);
		return Redirect::route('admin.posts.index')
			->with('message', 'core::posts.deleted');
	}
}
