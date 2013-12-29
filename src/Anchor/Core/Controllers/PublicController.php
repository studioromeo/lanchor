<?php

namespace Anchor\Core\Controllers;

use Controller;
use Config;
use View;
use Input;
use Redirect;
use Registry;
use Anchor\Core\Models\Post;
use Anchor\Core\Models\Page;
use Anchor\Core\Models\Category;

class PublicController extends Controller {

    public function home()
    {
        $home_page = Config::get('meta.home_page');
        $posts_page = Config::get('meta.posts_page');
        if ($home_page != $posts_page) {
            return $this->page($home_page);
        }

        return $this->postArchive();
    }

    public function postArchive()
    {
        $posts = Post::where('status', 'published')->paginate(Config::get('meta.posts_per_page'));
        $page  = Page::find(Config::get('meta.posts_page'));
        Registry::set('paginator', $posts);
        Registry::set('posts', $posts->getIterator());
        Registry::set('page', $page);
        Registry::set('total_posts', $posts->getTotal());

        return View::make('theme::posts', compact('posts'));
    }

    public function article($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        Registry::set('article', $post);
        Registry::set('category', Category::find($post->category));
        Registry::set('comments', $post->comments()->orderBy('date', 'desc')->get()->getIterator());

        return View::make('theme::article', compact('posts'));
    }

    public function categoryArchive($slug)
    {
        $posts = Category::whereSlug($slug)->first()
            ->posts()->where('status', 'published')
            ->paginate(Config::get('meta.posts_per_page'));

        Registry::set('paginator', $posts);
        Registry::set('posts', $posts->getIterator());
        Registry::set('total_posts', $posts->getTotal());

        return View::make('theme::posts', compact('posts'));
    }

    public function page($slug)
    {
        if (is_numeric($slug)) {
            $page = Page::find($slug);
        } else {
            $page = Page::whereSlug(basename($slug))->first();
        }

        Registry::set('page', $page);

        return View::make('theme::page', compact('page'));
    }
}
