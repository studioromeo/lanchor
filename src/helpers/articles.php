<?php

/**
 * Get the article ID
 * @return integer
 */
function article_id() {
    return Registry::prop('article', 'id');
}

/**
 * Get the article title
 * @return string
 */
function article_title() {
    return Registry::prop('article', 'title');
}

/**
 * Get the article slug
 * @return string
 */
function article_slug() {
    return Registry::prop('article', 'slug');
}

// function article_previous_url() {
//     $page = Registry::get('posts_page');
//     $query = Post::where('created', '<', Registry::prop('article', 'created'));

//     if($query->count()) {
//         $article = $query->sort('created', 'desc')->fetch();
//         $page = Registry::get('posts_page');

//         return base_url($page->slug . '/' . $article->slug);
//     }
// }

// function article_next_url() {
//     $page = Registry::get('posts_page');
//     $query = Post::where('created', '>', Registry::prop('article', 'created'));

//     if($query->count()) {
//         $article = $query->sort('created', 'asc')->fetch();
//         $page = Registry::get('posts_page');

//         return base_url($page->slug . '/' . $article->slug);
//     }
// }

/**
 * Get the url for article detail
 * @return string
 */
function article_url() {
    return URL::route('posts.show', array('slug' => article_slug()));
}

/**
 * Get the article description
 * @return string
 */
function article_description() {
    return Registry::prop('article', 'description');
}

/**
 * Parses a markdown string and output HTML
 * @param  string $string
 * @return string
 */
function parse($string) {
    return \Michelf\Markdown::defaultTransform($string);
}

/**
 * Gets the article content in HTML format
 * @return string
 */
function article_html() {
    return parse(Registry::prop('article', 'html'), false);
}

function article_markdown() {
    return parse(Registry::prop('article', 'html'));
}

/**
 * Get the article's custom css
 * @return string
 */
function article_css() {
    return Registry::prop('article', 'css');
}

/**
 * Get the article's custom javascript
 * @return string
 */
function article_js() {
    return Registry::prop('article', 'js');
}

/**
 * Get the article UNIX timestamp
 * @return integer
 */
function article_time() {
    if($created = Registry::prop('article', 'created_at')) {
        return $created->getTimestamp();
    }
}

/**
 * Get the article created date
 * @return string 1st January, 2013
 */
function article_date() {
    if($created = Registry::prop('article', 'created')) {
        return $created->format('jS F, Y');
    }
}

/**
 * Get the article status
 * @return string
 */
function article_status() {
    return Registry::prop('article', 'status');
}

/**
 * Get the article's category title
 * @return string
 */
function article_category() {
    $category = Registry::get('category');
    return $category->title;
}

/**
 * Get the article's category slug
 * @return string
 */
function article_category_slug() {
    $category = Registry::get('category');
    return $category->slug;
}

/**
 * @todo IMPLEMENT THIS
 */
function article_category_url() {
    $category = Registry::get('category');
    return '';
}

/**
 * @todo IMPLEMENT THIS
 */
function article_total_comments() {
    return Registry::prop('article', 'total_comments');
}

/**
 * @todo IMPLEMENT THIS
 */
function article_author() {
    return Registry::prop('article', 'author_name');
}

/**
 * @todo IMPLEMENT THIS
 */
function article_author_id() {
    return Registry::prop('article', 'author_id');
}

/**
 * @todo IMPLEMENT THIS
 */
function article_author_bio() {
    return Registry::prop('article', 'author_bio');
}

/**
 * @todo Implement this
 */
function article_custom_field($key, $default = '') {
    return '';
    // $id = Registry::prop('article', 'id');

    // if($extend = Extend::field('post', $key, $id)) {
    //     return Extend::value($extend, $default);
    // }

    // return $default;
}

/**
 * Check if the article has custom CSS or Javascript
 * @return boolean
 */
function customised() {
    if($itm = Registry::get('article')) {

        return $itm->js or $itm->css;
    }

    return false;
}
