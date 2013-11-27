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

Route::get('/', function() {
    $posts = Anchor\Core\Models\Post::all();
    Registry::put('posts', $posts->getIterator(), 0);

    return View::make('default/posts', compact('posts'));
});

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

    Route::resource('users', 'Anchor\\Core\\Controllers\\UserController');
    Route::get('users/{user}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\UserController@destroy',
        'as'   => 'admin.users.delete'
    ));
});
