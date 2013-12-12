<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Anchor\Core\Models\Metadata;

class MetadataController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$metadata = Metadata::where('key', 'LIKE', 'custom_%')->get();
		return View::make('core::metadata/index', compact('metadata'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('core::metadata/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$metadata = new Metadata;
		$metadata->fill(Input::all());
		$metadata->key = 'custom_' . $metadata->key;

		$metadata->save();

		return Redirect::route('admin.extend.variables.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show()
	{
		$meta = Metadata::whereIn('key', array(
			'auto_published_comments',
			'comment_moderation_keys',
			'comment_notifications',
			'current_migration',
			'date_format',
			'description',
			'home_page',
			'last_update_check',
			'posts_page',
			'posts_per_page',
			'sitename',
			'theme',
			'update_version'
		))->lists('value', 'key');

		return View::make('core::metadata/show', compact('meta'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$meta = Metadata::find($id);
		return View::make('core::metadata/edit', compact('meta'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$metadata = Metadata::find($id);

		$metadata->fill(Input::all());
		$metadata->key = 'custom_' . $metadata->key;
		$metadata->save();

		return Redirect::route('admin.extend.variables.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Metadata::destroy($id);
		return Redirect::route('admin.extend.variables.index');
	}

}
