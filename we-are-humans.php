<?php
/*
Plugin Name: We are humans
Description: Show your contribution as a human or a team of humans
Tags: human, humans, humans.txt, humanstxt
Version: 0.5.3
Author: Carl Conrad
Author URI: https://carlconrad.net
License: GPL2
Text Domain: we-are-humans
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once( 'include/settings.php' );

function we_are_humans_header_meta() {
    echo '<link type="text/plain" rel="author" href="'. esc_url( get_home_url() ).'/humans.txt" />';
}
if ( get_option( 'wearehumans_meta' ) ) add_action('wp_head', 'we_are_humans_header_meta');

if ( is_admin() ){
	  add_action( 'admin_menu', 'wearehumans_options_page' );
	  add_action( 'admin_init', 'register_wearehumans_settings' );
}

register_uninstall_hook( __FILE__, 'wearehumans_uninstall' );

function wearehumans_uninstall() {
	unregister_setting( 'we-are-humans', 'wearehumans_text' );
	unregister_setting( 'we-are-humans', 'wearehumans_meta' );
}