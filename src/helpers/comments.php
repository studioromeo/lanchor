<?php

/**
    Theme functions for comments
    @todo Implement this!
*/

function has_comments() {

    return false;

    if( ! $itm = Registry::get('article')) {
        return false;
    }

    if( ! $comments = Registry::get('comments')) {
        $comments = Comment::where('status', '=', 'approved')->where('post', '=', $itm->id)->get();

        $comments = new Items($comments);

        Registry::set('comments', $comments);
    }

    return $comments->length();
}

function total_comments() {
    if( ! has_comments()) return 0;

    $comments = Registry::get('comments');

    return $comments->length();
}

// loop comments
function comments() {
    if( ! has_comments()) return false;

    $comments = Registry::get('comments');

    if($result = $comments->valid()) {
        // register single comment
        Registry::set('comment', $comments->current());

        // move to next
        $comments->next();
    }

    return $result;
}

// single comments
function comment_id() {
    return Registry::prop('comment', 'id');
}

function comment_time() {
    if($time = Registry::prop('comment', 'date')) {
        return Date::format($time,'U');
    }
}

function comment_date() {
    if($date = Registry::prop('comment', 'date')) {
        return Date::format($date);
    }
}

function comment_name() {
    return Registry::prop('comment', 'name');
}

function comment_email() {
    return Registry::prop('comment', 'email');
}

function comment_text() {
    return Registry::prop('comment', 'text');
}

function comments_open() {
    return Registry::prop('article', 'comments') ? true : false;
}

// form elements
/**
 * @todo IMPLEMENT THIS
 */
function comment_form_notifications() {
    return '';
    // return Notify::read();
}

function comment_form_url() {
    return URL::current();
}

function comment_form_input_name($extra = '') {
    return '<input name="name" id="name" type="text" ' . $extra . ' value="' . Input::get('name') . '">';
}

function comment_form_input_email($extra = '') {
    return '<input name="email" id="email" type="email" ' . $extra . ' value="' . Input::get('email') . '">';
}

function comment_form_input_text($extra = '') {
    return '<textarea name="text" id="text" ' . $extra . '>' . Input::get('text') . '</textarea>';
}

function comment_form_button($text = 'Post Comment', $extra = '') {
    return '<button class="btn" type="submit" ' . $extra . '>' . $text . '</button>';
}
