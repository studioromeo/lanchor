<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Anchor\Core\Models\Category;

class CategoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();
		return View::make('core::categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('core::categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$category = new Category;
		$category->fill(Input::all());
		$category->save();

		return Redirect::route('admin.categories.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = Category::find($id);

		return View::make('core::categories.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = Category::find($id);

		$category->fill(Input::all());
		$category->save();

		return Redirect::route('admin.categories.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// If only 1 left then throw error!

		Category::destroy($id);
		return Redirect::route('admin.categories.index');
	}

}
