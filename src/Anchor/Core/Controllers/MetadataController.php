<?php

namespace Anchor\Core\Controllers;

use Controller;
use View;
use Input;
use Redirect;
use Config;
use Anchor\Core\Models\Metadata;
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
		foreach (Config::get('view.paths') as $path) {
			$themes = Themes::lists($path);
		}

		$meta = Metadata::whereIn('key', array(
			'auto_published_comments',
			'comment_moderation_keys',
			'comment_notifications',
			'description',
			'home_page',
			'posts_page',
			'posts_per_page',
			'sitename',
			'theme'
		))->lists('value', 'key');

		return View::make('core::metadata/show', compact('meta', 'themes'));
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
			'auto_published_comments' => true,
			'comment_moderation_keys' => false,
			'comment_notifications' => true,
			'description' => false,
			// 'home_page' => false,
			// 'posts_page' => false,
			'posts_per_page' => false,
			'sitename' => false,
			'theme' => false
		);

		foreach ($settings as $setting => $toggle) {
			$metadata = Metadata::findOrFail($setting);
			$metadata->value = ($toggle ? Input::has($setting) : Input::get($setting));
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
