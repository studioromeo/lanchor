<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Config;
use Anchor\Core\Models\Metadata;
use Anchor\Core\Models\Page;
use Anchor\Core\Services\Themes;

class MetadataController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$metadata = Metadata::where('key', 'LIKE', 'custom_%')->get();
		return View::make('core::extend/metadata/index', compact('metadata'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('core::extend/metadata/create');
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
		$themes = Themes::lists(public_path() . '/themes/');

		$meta = Metadata::where('key', 'NOT LIKE', 'custom_%')->lists('value', 'key');
		$pages = Page::lists('name', 'id');

		return View::make('core::extend/metadata/show', compact('meta', 'themes', 'pages'));
	}

	/**
	 * Saves the settings
	 * @todo  there must be a better way
	 *
	 * @return Response
	 */
	public function saveSettings()
	{
		$settings = array(
			'auto_published_comments',
			'comment_moderation_keys',
			'comment_notifications',
			'description',
			'home_page',
			'posts_page',
			'posts_per_page',
			'sitename',
			'theme'
		);

		foreach ($settings as $setting) {
			$metadata = Metadata::findOrFail($setting);
			$metadata->value = Input::get($setting, false);
			$metadata->save();
		}

		return Redirect::route('admin.extend.metadata.show');
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
		return View::make('core::extend/metadata/edit', compact('meta'));
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
