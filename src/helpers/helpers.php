<?php

/**
 * Theme helpers functions
 */
function full_url($url = '')
{
    return url($url);
}

function base_url($url = '')
{
    return url($url);
}

/**
 * @todo Implement this
 */
function theme_url($file = '')
{
    return asset('themes/default/' . ltrim($file, '/'));
}

/**
 * @todo Implement this
 */
function theme_include($file)
{
    echo View::make('default/' . $file)->render();
}

function asset_url($extra = '')
{
    return asset('packages/anchor/core/' . ltrim($extra, '/'));
}

function current_url()
{
    return URL::current();
}

/**
 * @todo Implement this
 */
function rss_url()
{
    return base_url('feeds/rss');
}

//  Custom function helpers
/**
 * @todo Implement this
 */
function bind($page, $fn) {
    // Events::bind($page, $fn);
}

/**
 * @todo Implement this
 */
function receive($name = '') {
    // return Events::call($name);
}

/**
 * @todo Implement this
 */
function body_class() {
    $classes = array();

    //  Get the URL slug
    $parts = Request::segments();
    $classes[] = count($parts) ? trim(current($parts)) : 'index';

    //  Is it a posts page?
    if(is_postspage()) {
        $classes[] = 'posts';
    }

    //  Is it the homepage?
    if(is_homepage()) {
        $classes[] = 'home';
    }

    return trim(implode(' ', array_unique($classes)));
}

// page type helpers
/**
 * @todo IMPLEMENT THIS
 */
function is_homepage() {
    return true;
    return Registry::prop('page', 'id') == Config::get('meta.home_page');
}

/**
 * @todo IMPLEMENT THIS
 */
function is_postspage() {
    return true;
    return Registry::prop('page', 'id') == Config::get('meta.posts_page');
}

function is_article() {
    return Registry::get('article') !== null;
}

function is_page() {
    return Registry::get('page') !== null;
}
