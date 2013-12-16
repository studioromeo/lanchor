<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Anchor\Core\Models\Page;

class PagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = Page::orderBy('updated_at', 'desc')->get();
		return View::make('core::pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$pages = array('None') + Page::lists('title', 'id');

		return View::make('core::pages.create', compact('pages'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$page = new Page;
		$page->fill(Input::all());
		$page->show_in_menu = Input::has('show_in_menu');

		/**
		 * @todo this doesn't work in the old anchor 0.9
		 */
		$page->menu_order = 0;

		$page->save();

		return Redirect::route('admin.pages.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = Page::find($id);
		$pages = array('None') + Page::lists('title', 'id');

		return View::make('core::pages.edit', compact('page', 'pages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$page = Page::find($id);

		$page->fill(Input::all());
		$page->save();

		return Redirect::route('admin.pages.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Page::destroy($id);
		return Redirect::route('admin.pages.index');
	}

}
