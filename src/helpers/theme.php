<?php

function customised()
{
    return false;
}

function search_url()
{
    return '';
}

function search_term()
{
    return '';
}

function twitter_account()
{
    return false;
}

function article_title()
{
    return Registry::prop('article', 'title', 'test123');
}

function posts()
{
    $posts = Registry::get('posts');

    if($result = $posts->valid()) {
        // register single post
        Registry::put('article', $posts->current(), 0);

        // move to next
        $posts->next();
    }
    // back to the start
    else $posts->rewind();

    return $result;
}

function has_posts()
{
    return Registry::get('posts')->count() > 0;
}

function page_title()
{
    return 'stub';
}

function site_name()
{
    return 'stub';
}

function site_description()
{
    return 'site_description';
}

function article_url()
{
    $article = Registry::get('article');
    return $article->slug;
}

function article_markdown()
{
    $article = Registry::get('article');
    return $article->html;
}

function article_time()
{
    return time();
}

function relative_time()
{
    return 'whut';
}

function article_author()
{
    return 'whut';
}

function posts_per_page()
{
    return 5;
}

function has_pagination()
{
    return false;
}
