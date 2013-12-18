<?php

/**
 * Theme functions for meta
 */
function site_name() {
    return Config::get('meta.sitename');
}

function site_description() {
    return Config::get('meta.description');
}

function site_meta($key, $default = '') {
    return Config::get('meta.custom_' . $key, $default);
}
