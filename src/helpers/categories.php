<?php

/**
 * Get the total number of categories
 * @return integer
 */
function total_categories() {
    if( ! $categories = Registry::get('categories')) {
        $categories = \Anchor\Core\Models\Category::all();

        Registry::set('categories', $categories->getIterator());
    }

    return $categories->count();
}

/**
 * Moves the pointer in the Category ArrayIterator and saves it
 * into the registry. Returns boolean if there are more categories.
 * @return boolean
 */
function categories() {

    if( ! total_categories()) return false;

    $items = Registry::get('categories');

    if($result = $items->valid()) {
        // register single category
        Registry::set('category', $items->current());

        // move to next
        $items->next();
    }

    return $result;
}

/**
 * Get the category ID
 * @return integer
 */
function category_id() {
    return Registry::prop('category', 'id');
}

/**
 * Get the category title
 * @return string
 */
function category_title() {
    return Registry::prop('category', 'title');
}

/**
 * Get the category slug
 * @return string
 */
function category_slug() {
    return Registry::prop('category', 'slug');
}

/**
 * Get the category description
 * @return string
 */
function category_description() {
    return Registry::prop('category', 'description');
}

/**
 * Get the category archive url
 * @return string
 */
function category_url() {
    return URL::route('category.index', array('slug' => category_slug()));
}

/**
 * Get the number of posts assigned to the category
 * @return integer
 */
function category_count() {
    return Anchor\Core\Models\Category::find(category_id())
        ->posts()->where('status', 'published')->count();
}
