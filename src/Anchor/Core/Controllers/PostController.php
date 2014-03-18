<?php

namespace Anchor\Core\Controllers;

use Controller;
use Config;
use View;
use Input;
use Redirect;
use Anchor\Core\Models\Post;
use Anchor\Core\Models\Category;
use Anchor\Core\Services\ValidationException;

class PostController extends Controller
{

	protected $post;
	protected $category;

	public function __construct(Post $post, Category $category)
	{
		$this->post = $post;
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts      = $this->post->orderBy('updated_at', 'desc')->paginate(Config::get('meta.posts_per_page'));
		$categories = $this->category->all();

		return View::make('core::posts.index', compact('posts', 'categories'));
	}

	/**
	 * //
	 *
	 * @return Response
	 */
	public function filterByCategory($slug)
	{
		$posts      = $this->category->whereSlug($slug)->first()->posts()->paginate(Config::get('meta.posts_per_page'));
		$categories = $this->category->all();

		return View::make('core::posts.index', compact('posts', 'categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = $this->category->lists('title', 'id');
		return View::make('core::posts.create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try
		{
			$this->post->fill(Input::all())->isValid()->save();

			return Redirect::route('admin.posts.index')
				->with('message', 'core::posts.created');
		}
		catch(ValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = $this->post->find($id);
		$categories = $this->category->lists('title', 'id');

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
		// $rules = array(
		// 	'title' => 'required',
		// 	'slug'  => "required|alpha_dash|unique:posts,slug,{$id}"
		// );

		// $validator = \Validator::make(Input::all(), $rules, \Lang::get('core::posts'));

		// if ($validator->fails()) {
		// 	return Redirect::back()->withErrors($validator)->withInput();
		// }

		try
		{
			$this->post->findOrFail($id)->update(Input::all());

			return Redirect::route('admin.posts.edit', array($id))
				->with('message', 'core::posts.updated');
		}
		catch(ValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
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
		$this->post->destroy($id);
		return Redirect::route('admin.posts.index')
			->with('message', 'core::posts.deleted');
	}
}
