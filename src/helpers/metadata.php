<?php

/**
 * Get the site name
 * @return string
 */
function site_name() {
    return Config::get('meta.sitename');
}

/**
 * Get the site description
 * @return string
 */
function site_description() {
    return Config::get('meta.description');
}

/**
 * Get a custom meta key from the meta table
 * @param  string $key
 * @param  string $default
 * @return string
 */
function site_meta($key, $default = '') {
    return Config::get('meta.custom_' . $key, $default);
}
