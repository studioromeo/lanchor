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

Route::get('/', array(
    'uses' => 'Anchor\\Core\\Controllers\\PublicController@home',
));

// @todo Don't fetch this from the database!
$posts_page = Anchor\Core\Models\Page::find(Config::get('meta.posts_page'));
Route::get($posts_page->slug, array(
    'uses' => 'Anchor\\Core\\Controllers\\PublicController@postArchive',
    'as'   => 'posts.index'
));

Route::get($posts_page->slug.'/{slug}', array(
    'uses' => 'Anchor\\Core\\Controllers\\PublicController@article',
    'as' => 'posts.show',
));

Route::get('/category/{slug}', array(
    'uses' => 'Anchor\\Core\\Controllers\\PublicController@categoryArchive',
    'as' => 'category.index'
));

Route::group(array('prefix' => 'admin'), function()
{
    Route::get('/', function() {
        return Redirect::route('admin.posts.index');
    });

    Route::resource('posts', 'Anchor\\Core\\Controllers\\PostController');
    Route::get('posts/{post}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\PostController@destroy',
        'as'   => 'admin.posts.delete'
    ));

    Route::get('posts/category/{category}', array(
        'uses' => 'Anchor\\Core\\Controllers\\PostController@filterByCategory',
        'as'   => 'admin.posts.filter.category'
    ));

    Route::resource('comments', 'Anchor\\Core\\Controllers\\CommentController');
    Route::get('comments/{comment}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\CommentController@destroy',
        'as'   => 'admin.comments.delete'
    ));

    Route::get('comments/status/{status}', array(
        'uses' => 'Anchor\\Core\\Controllers\\CommentController@filterByStatus',
        'as'   => 'admin.comments.filter.status'
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

    Route::resource('extend/fields', 'Anchor\\Core\\Controllers\\ExtendController');
    Route::get('extend/fields/{key}/delete', array(
        'uses' => 'Anchor\\Core\\Controllers\\ExtendController@destroy',
        'as'   => 'admin.extend.fields.delete'
    ));
});

/**
 * IMPORTANT: This is the catch all route, it must be placed last
 */
Route::get('{slug}', array(
    'uses' => 'Anchor\\Core\\Controllers\\PublicController@page'
))->where('slug', '.*');
