<?php
/*
Plugin Name: Helptux Election plugin
Plugin URI: https://github.com/pieterdp/wordpress-hx-election
Version: 0.1.0
Description: Create fancy pie charts with the election results.
Author: Pieter De Praetere
License: GPL3
 */

include_once(plugin_dir_path(__FILE__).'hx-shortcode.php');

function custom_js() {
    wp_register_script('hx_electionjs', plugin_dir_url(__FILE__).'js/election.js');
    wp_register_script('d3', 'https://d3js.org/d3.v4.min.js');
    wp_enqueue_script('hx_electionjs', plugin_dir_url(__FILE__).'js/election.js');
    wp_enqueue_script('d3', 'https://d3js.org/d3.v4.min.js');
}

/*
 * Hooks & registrations
 */
add_shortcode('hx_election', 'hx_election');
add_shortcode('hx_result', 'hx_result');
add_action('wp_enqueue_scripts', 'custom_js');