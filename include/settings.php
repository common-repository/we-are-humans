<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wearehumans_options_page() {
	add_options_page( 'We are humans', 'We are humans', 'manage_options', 'we-are-humans', 'wearehumans_options_page_html');
}

function wearehumans_options_page_html() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'we-are-humans' ) );
	}
	echo '<style>.we-are-humans-warning {background-color:yellow;padding:5px;text-align:center;}</style>';
	echo '<div class="wrap">';
	echo '<h1>'. __( 'We are humans', 'we-are-humans' ).'</h1>';
	echo '<h2>'. __( 'What is humans.txt?', 'we-are-humans' ).'</h2>';
	echo '<p>'. __( 'It is an initiative for knowing the people behind a website. It is a TXT file that contains information about the different people who have contributed to building the website.', 'we-are-humans' ).'</p>';
	echo '<p>'. __( 'For more information about the humans.txt initiative, please visit the <a href="http://humanstxt.org/" target="_blank">humans.txt web site</a>.', 'we-are-humans' ).'</p>';
	echo '<form method="post" action="options.php">';
	settings_fields( 'we-are-humans' );
	echo '<h2>'. __( 'Settings', 'we-are-humans' ).'</h2>';
	echo '<table>';
	echo '<tbody>';
	echo '<tr><td valign="top"><label for="wearehumans_text">'. __('text', 'we-are-humans' ) .' </td><td><textarea  name="wearehumans_text" type="text" id="wearehumans_text" rows="10" cols="50">'. esc_attr( get_option( 'wearehumans_text' ) ) .'</textarea></label></td></tr>';
	echo '<tr><td colspan="2"><label for="wearehumans_meta"><input name="wearehumans_meta" type="checkbox" id="wearehumans_meta" value="1" ' . checked( 1, get_option( 'wearehumans_meta' ), false ) . ' />'. __( 'Add meta link in header', 'we-are-humans' ).'</label></td></tr>';
	echo '<tr><td colspan="2">';
	submit_button();
	echo '</td></tr>';
	echo '</tbody>';
	echo '</form>';
	echo '</div>';
	
	$path = get_home_path();
	$filename= $path .'/humans.txt';
	file_put_contents( $filename, "\xEF\xBB\xBF". esc_attr( get_option( 'wearehumans_text' ) ) ); 
}

function register_wearehumans_settings() {
	register_setting( 'we-are-humans', 'wearehumans_text', 'wearehumans_options_sanitize_text_field' );
	register_setting( 'we-are-humans', 'wearehumans_meta' );
}

function wearehumans_options_sanitize_text_field( $input ) {
	$input = sanitize_text_field( $input );
	return $input;
}