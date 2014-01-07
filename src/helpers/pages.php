<?php

/**
 *  Theme functions for pages
 */

/**
 * Get the page ID
 * @return integer
 */
function page_id() {
    return Registry::prop('page', 'id');
}

function page_url() {
    if($page = Registry::get('page')) {
        return route('page.show', array('slug' => $page->slug));
    }
}

/**
 * Get the page slug
 * @return string
 */
function page_slug() {
    return Registry::prop('page', 'slug');
}

/**
 * Get the page name
 * @return string
 */
function page_name() {
    return Registry::prop('page', 'name');
}

/**
 * Get the page title
 * @param  string $default
 * @return string
 */
function page_title($default = '') {
    if($title = Registry::prop('article', 'title')) {
        return $title;
    }

    if($title = Registry::prop('page', 'title')) {
        return $title;
    }

    return $default;
}

/**
 * Get and parse the page's content
 * @return string
 */
function page_content() {
    return parse(Registry::prop('page', 'content'));
}

/**
 * Get the page status
 * @return string
 */
function page_status() {
    return Registry::prop('page', 'status');
}

/**
 * @todo IMPLEMENT THIS
 */
function page_custom_field($key, $default = '') {
    $id = Registry::prop('page', 'id');

    if($extend = Extend::field('page', $key, $id)) {
        return Extend::value($extend, $default);
    }

    return $default;
}
