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
    wp_register_style('bootstrap_4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
    wp_register_style('datatables', 'https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css');
    wp_register_style('iconic', 'https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css');
    wp_register_style('election', plugin_dir_url(__FILE__).'css/election.css');

    wp_enqueue_style('bootstrap_4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
    wp_enqueue_style('datatables', 'https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css');
    wp_enqueue_style('iconic', 'https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css');
    wp_enqueue_style('election', plugin_dir_url(__FILE__).'css/election.css');

    wp_register_script('jquery_3', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    wp_register_script('poppler', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');
    wp_register_script('bootstrap_4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
    wp_register_script('datatables', 'https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js');
    wp_register_script('d3', 'https://d3js.org/d3.v4.min.js');
    wp_register_script('hx_electionjs', plugin_dir_url(__FILE__).'js/election.js');

    wp_enqueue_script('jquery_3', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    wp_enqueue_script('poppler', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');
    wp_enqueue_script('bootstrap_4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
    wp_enqueue_script('datatables', 'https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js');
    wp_enqueue_script('d3', 'https://d3js.org/d3.v4.min.js');
    wp_enqueue_script('hx_electionjs', plugin_dir_url(__FILE__).'js/election.js');
}

/*
 * Hooks & registrations
 */
add_shortcode('hx_election', 'hx_election');
add_shortcode('hx_result', 'hx_result');
add_action('wp_enqueue_scripts', 'custom_js');
