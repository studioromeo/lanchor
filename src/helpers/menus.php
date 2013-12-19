<?php

/**
 * @todo Implement this
 */

/*
    Theme functions for menus
*/
function has_menu_items() {
    $pages = Registry::get('menu');
    return $pages->count();
}


function menu_items() {
    $pages = Registry::get('menu');

    if($result = $pages->valid()) {
        Registry::set('menu_item', $pages->current());

        $pages->next();
    }

    // back to the start
    if( ! $result) $pages->rewind();

    return $result;
}

/*
    Object props
*/
function menu_id() {
    return Registry::prop('menu_item', 'id');
}

/**
 * @todo IMPLEMENT THIS
 */
function menu_url() {

        $segments = (array) Registry::prop('menu_item', 'slug');
        $parent = Registry::prop('menu_item', 'parent');

        while($parent) {
            $page = Anchor\Core\Models\Page::findOrFail($parent);
            $segments[] = $page->slug;
            $parent = $page->parent;
        }

        return URL::to(implode('/', array_reverse($segments)));
}

/**
 * @todo IMPLEMENT THIS
 */
function menu_relative_url() {
    return '';
    if($page = Registry::get('menu_item')) {
        return $page->relative_uri();
    }
}

function menu_name() {
    return Registry::prop('menu_item', 'name');
}

function menu_title() {
    return Registry::prop('menu_item', 'title');
}

/**
 * @todo IMPLEMENT THIS
 */
function menu_active() {
    return '';
    if($page = Registry::get('menu_item')) {
        return $page->active();
    }
}

function menu_parent() {
    return Registry::prop('menu_item', 'parent');
}

/*
    HTML Builders
*/
function menu_render($params = array()) {
    $html = '';
    $menu = Registry::get('menu');

    // options
    $parent = isset($params['parent']) ? $params['parent'] : 0;
    $class = isset($params['class']) ? $params['class'] : 'active';

    foreach($menu as $item) {
        if($item->parent == $parent) {
            $attr = array();

            if($item->active()) $attr['class'] = $class;

            $html .= '<li>';
            $html .= Html::link($item->relative_uri(), $item->name, $attr);
            $html .= menu_render(array('parent' => $item->id));
            $html .= '</li>' . PHP_EOL;
        }
    }

    if($html) $html = PHP_EOL . '<ul>' . PHP_EOL . $html . '</ul>' . PHP_EOL;

    return $html;
}
