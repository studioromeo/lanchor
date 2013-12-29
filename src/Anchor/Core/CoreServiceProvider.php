<?php namespace Anchor\Core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Config;
use View;

class CoreServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('anchor/core');

		AliasLoader::getInstance()->alias('Registry', 'Anchor\Core\Facades\Registry');

		$path = public_path() . '/themes/default/';
		View::addNameSpace('theme',$path);

		// Include the theme functions
		include $path . 'functions.php';

		// Load the site config into the config object
		$meta = \Anchor\Core\Models\Metadata::lists('value', 'key');
		Config::set('meta', $meta);

		$pages = \Anchor\Core\Models\Page::where('show_in_menu', true)->get();
		\Registry::set('menu', $pages->getIterator());

		// Include the routes file for anchor
		include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('registry', function() {
			return new \Anchor\Core\Services\Registry;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
