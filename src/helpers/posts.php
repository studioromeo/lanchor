<?php

/**
 * Checks if there are posts in the collection
 * @return boolean
 */
function has_posts() {
	return Registry::get('total_posts', 0) > 0;
}

/**
 * Moves the pointer in the Posts ArrayIterator and saves it
 * into the registry. Returns boolean if there are more posts.
 * @return boolean
 */
function posts() {
	$posts = Registry::get('posts');

	if($result = $posts->valid()) {
		// register single post
		Registry::set('article', $posts->current());

		// move to next
		$posts->next();
	}
	// back to the start
	else $posts->rewind();

	return $result;
}

/**
 * Get the paginator link for newer posts
 * @param  string $text
 * @param  string $default
 * @return string
 */
function posts_next($text = 'Next &rarr;', $default = '') {

	$paginator = Registry::get('paginator');
	$presenter = new Anchor\Core\Pagination\SimplePresenter($paginator);

	return $presenter->getPrevious($text);

	// $total = Registry::get('total_posts');
	// $offset = Registry::get('page_offset');
	// // $per_page = Config::meta('posts_per_page');
	// $page = Registry::get('page');
	// $url = base_url($page->slug . '/');

	// // filter category
	// if($category = Registry::get('post_category')) {
	// 	$url = base_url('category/' . $category->slug . '/');
	// }

	// $pagination = new Paginator(array(), $total, $offset, $per_page, $url);

	// return $pagination->prev_link($text, $default);
}

/**
 * Get the paginator link for older posts
 * @param  string $text
 * @param  string $default
 * @return string
 */
function posts_prev($text = '&larr; Previous', $default = '') {

	$paginator = Registry::get('paginator');
	$presenter = new Anchor\Core\Pagination\SimplePresenter($paginator);

	return $presenter->getNext($text);


	// $total = Registry::get('total_posts');
	// $offset = Registry::get('page_offset');
	// // $per_page = Config::meta('posts_per_page');
	// $page = Registry::get('page');
	// $url = base_url($page->slug . '/');

	// // filter category
	// if($category = Registry::get('post_category')) {
	// 	$url = base_url('category/' . $category->slug . '/');
	// }

	// $pagination = new Paginator(array(), $total, $offset, $per_page, $url);

	// return $pagination->next_link($text, $default);
}

/**
 * Get the total number of posts
 * @return integer
 */
function total_posts() {
	return Registry::get('total_posts');
}

/**
 * Check if pagination is required
 * @return boolean
 */
function has_pagination() {
	return Registry::get('total_posts') > Config::get('meta.posts_per_page');
}

/**
 * Get the posts per page
 * @return integer
 */
function posts_per_page() {
	return min(Registry::get('total_posts'), Config::get('meta.posts_per_page'));
}
