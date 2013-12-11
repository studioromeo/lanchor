<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'posts.index', function() {
    $posts = Anchor\Core\Models\Post::all();
    Registry::put('posts', $posts->getIterator(), 0);

    return View::make('default/posts', compact('posts'));
}));

Route::get('/{category}', array('as' => 'category.index', function($slug) {
    $posts = Anchor\Core\Models\Category::whereSlug($slug)->first()->posts()->where('status', 'published')->get();
    Registry::put('posts', $posts->getIterator(), 0);

    return View::make('default/posts', compact('posts'));
}));

Route::group(array('prefix' => 'admin'), function()
{
    Route::resource('posts', 'Anchor\\Core\\Controllers\\PostController');
    Route::get('posts/{post}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\PostController@destroy',
        'as'   => 'admin.posts.delete'
    ));

    Route::get('posts/category/{category}', array(
        'uses' => 'Anchor\\Core\\Controllers\\PostController@filterByCategory',
        'as'   => 'admin.posts.filter.category'
    ));

    Route::resource('categories', 'Anchor\\Core\\Controllers\\CategoryController');
    Route::get('categories/{category}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\CategoryController@destroy',
        'as'   => 'admin.categories.delete'
    ));

    Route::resource('pages', 'Anchor\\Core\\Controllers\\PageController');
    Route::get('pages/{page}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\PageController@destroy',
        'as'   => 'admin.pages.delete'
    ));

    Route::get('pages/status/{status}', array(
        'uses' => 'Anchor\\Core\\Controllers\\PageController@filterByStatus',
        'as'   => 'admin.pages.filter.status'
    ));

    Route::resource('users', 'Anchor\\Core\\Controllers\\UserController');
    Route::get('users/{user}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\UserController@destroy',
        'as'   => 'admin.users.delete'
    ));

    Route::get('extend', array('as' => 'admin.extend.index', function() {
        return View::make('core::extend/index');
    }));

    Route::resource('extend/variables', 'Anchor\\Core\\Controllers\\MetadataController');
    Route::get('extend/variables/{key}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\MetadataController@destroy',
        'as'   => 'admin.extend.metadata.delete'
    ));

    Route::get('extend/metadata', array(
        'uses' => 'Anchor\\Core\\Controllers\\MetadataController@show',
        'as'   => 'admin.extend.metadata.show'
    ));

    Route::post('extend/metadata', array(
        'uses' => 'Anchor\\Core\\Controllers\\MetadataController@saveSettings',
        'as'   => 'admin.extend.metadata.save'
    ));
});
