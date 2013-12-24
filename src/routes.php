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

$home_page  = Config::get('meta.home_page');
$posts_page = Config::get('meta.posts_page');

if ($home_page != $posts_page) {
    Route::get('/', function() use ($home_page) {
        $page = Anchor\Core\Models\Page::find($home_page);
        Registry::set('page', $page);

        return View::make('default/page', compact('page'));
    });
}

$posts_page = Anchor\Core\Models\Page::find($posts_page);
Route::get('/{posts_slug?}', array('as' => 'posts.index', function() {
    $posts = Anchor\Core\Models\Post::where('status', 'published')->paginate(Config::get('meta.posts_per_page'));
    Registry::set('paginator', $posts);
    Registry::set('posts', $posts->getIterator());
    Registry::set('total_posts', $posts->getTotal());

    return View::make('default/posts', compact('posts'));
}))->where(array('posts_slug' => $posts_page->slug));

Route::get($posts_page->slug.'/{slug}', array('as' => 'posts.show', function($slug) {
    $post = Anchor\Core\Models\Post::whereSlug($slug)->firstOrFail();
    Registry::set('article', $post);
    Registry::set('category', Anchor\Core\Models\Category::find($post->category));
    Registry::set('comments', $post->comments()->orderBy('date', 'desc')->get()->getIterator());

    return View::make('default/article', compact('posts'));
}));

Route::get('/category/{slug}', array('as' => 'category.index', function($slug) {
    $posts = Anchor\Core\Models\Category::whereSlug($slug)->first()
        ->posts()->where('status', 'published')->paginate(Config::get('meta.posts_per_page'));
    Registry::set('posts', $posts->getIterator());
    Registry::set('total_posts', $posts->getTotal());

    return View::make('default/posts', compact('posts'));
}));

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
});


/**
 * IMPORTANT: This is the catch all route, it must be placed last
 */
Route::get('{uri}', function($uri) {
    $page = Anchor\Core\Models\Page::whereSlug(basename($uri))->first();
    Registry::set('page', $page);

    return View::make('default/page', compact('page'));
})->where('uri', '.*');
