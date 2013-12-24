<?php

/**
 * [has_comments description]
 * @return boolean [description]
 */
function has_comments() {
    $comments = Registry::get('comments');
    return (bool) $comments->count();
}

/**
 * [total_comments description]
 * @return [type] [description]
 */
function total_comments() {
    $comments = Registry::get('comments');
    return $comments->count();
}

/**
 * [comments description]
 * @return [type] [description]
 */
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

/**
 * [comment_id description]
 * @return [type] [description]
 */
function comment_id() {
    return Registry::prop('comment', 'id');
}

/**
 * [comment_time description]
 * @return [type] [description]
 */
function comment_time() {
    if($created = Registry::prop('comment', 'date')) {
        return $created->getTimestamp();
    }
}

/**
 * [comment_date description]
 * @return [type] [description]
 */
function comment_date() {
    if($date = Registry::prop('comment', 'date')) {
        return $date->format('jS F, Y');
    }
}

/**
 * [comment_name description]
 * @return [type] [description]
 */
function comment_name() {
    return Registry::prop('comment', 'name');
}

/**
 * [comment_email description]
 * @return [type] [description]
 */
function comment_email() {
    return Registry::prop('comment', 'email');
}

/**
 * [comment_text description]
 * @return [type] [description]
 */
function comment_text() {
    return Registry::prop('comment', 'text');
}

/**
 * [comments_open description]
 * @return [type] [description]
 */
function comments_open() {
    return Registry::prop('article', 'comments') ? true : false;
}

/**
 * @todo IMPLEMENT THIS
 */
function comment_form_notifications() {
    return '';
    // return Notify::read();
}

/**
 * [comment_form_url description]
 * @return [type] [description]
 */
function comment_form_url() {
    return URL::current();
}

/**
 * [comment_form_input_name description]
 * @param  string $extra [description]
 * @return [type]        [description]
 */
function comment_form_input_name($extra = '') {
    return '<input name="name" id="name" type="text" ' . $extra . ' value="' . Input::get('name') . '">';
}

/**
 * [comment_form_input_email description]
 * @param  string $extra [description]
 * @return [type]        [description]
 */
function comment_form_input_email($extra = '') {
    return '<input name="email" id="email" type="email" ' . $extra . ' value="' . Input::get('email') . '">';
}

/**
 * [comment_form_input_text description]
 * @param  string $extra [description]
 * @return [type]        [description]
 */
function comment_form_input_text($extra = '') {
    return '<textarea name="text" id="text" ' . $extra . '>' . Input::get('text') . '</textarea>';
}

/**
 * [comment_form_button description]
 * @param  string $text  [description]
 * @param  string $extra [description]
 * @return [type]        [description]
 */
function comment_form_button($text = 'Post Comment', $extra = '') {
    return '<button class="btn" type="submit" ' . $extra . '>' . $text . '</button>';
}
