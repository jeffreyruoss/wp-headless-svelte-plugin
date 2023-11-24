<?php
/*
Plugin Name: WP Headless Svelte Plugin
Description: This plugin is a very basic boilerplate for a headless WordPress plugin with a Svelte frontend.
Version: 1.0
Author: Jeff Ruoss
Author URI: https://jeffruoss.com
Text Domain: wp-headless-svelte-plugin
*/

/** RESAVE PERMALINKS in wp-admin: settings > permalinks */

function wphsp_add_rewrite_rule() {
    add_rewrite_rule('^wphsp/?$', 'index.php?wphsp=1', 'top');
}
add_action('init', 'wphsp_add_rewrite_rule');

function wphsp_query_vars($vars) {
    $vars[] = 'wphsp';
    return $vars;
}
add_filter('query_vars', 'wphsp_query_vars');

function wphsp_parse_request($wp) {
    if (array_key_exists('wphsp', $wp->query_vars)) {
        include plugin_dir_path(__FILE__) . 'app/dist/index.html';
        exit;
    }
}
add_action('parse_request', 'wphsp_parse_request');
