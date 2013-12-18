<?php namespace Anchor\Core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Config;

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

		// Include the routes file for anchor
		include __DIR__.'/../../routes.php';

		// Include the theme functions
		foreach (Config::get('view.paths') as $path) {

			$path .= DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR . 'functions.php';

			if (is_readable($path)) {
				include $path;
			}
		}

		// Load the site config into the config object
		$meta = \Anchor\Core\Models\Metadata::lists('value', 'key');
		Config::set('meta', $meta);

		$pages = \Anchor\Core\Models\Page::where('show_in_menu', true)->get();
		\Registry::set('menu', $pages->getIterator());
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
