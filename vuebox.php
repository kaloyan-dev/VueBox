<?php
/*
|--------------------------------------------------------------------------
| Library Name: VueBox
| Library URI: https://github.com/lceberg/VueBox
| Description: A WordPress library for adding custom fields and menu pages
| Version: 1.0.0 (major.minor.bugfix)
| Author: Kaloyan Ivanov
| Author URI: https://github.com/lceberg
|--------------------------------------------------------------------------
*/

if ( ! defined( 'VUEBOX_THEME_PATH' ) ) {
	define( 'VUEBOX_THEME_PATH', get_bloginfo( 'stylesheet_directory' ) );
}

include_once( 'functions/helpers.php' );

include_once( 'class/VueBoxContainer.php' );
include_once( 'class/VueBoxContainerBox.php' );
include_once( 'class/VueBox.php' );

$field_types = array(
	'text',
);

foreach ( $field_types as $field_type ) {
	$field_file_name = ucwords( $field_type );

	include_once( "class/VueBox_{$field_file_name}.php" );
}

function vuebox_scripts_and_styles() {
	$vuebox_path = vuebox_path( __FILE__ );
	$vuebox_css  = $vuebox_path . '/assets/css/';
	$vuebox_js   = $vuebox_path . '/assets/js/';

	wp_enqueue_script( 'vuebox-vue', $vuebox_js . 'vue.min.js' );
	wp_enqueue_script( 'vuebox-fields', $vuebox_js . 'vuebox-fields.js', array( 'vuebox-vue' ) );
	wp_enqueue_script( 'vuebox-app', $vuebox_js . 'vuebox.js', array( 'vuebox-vue', 'vuebox-fields' ) );

	wp_enqueue_style( 'vuebox-css', $vuebox_css . 'vuebox.css' );

}
add_action( 'admin_enqueue_scripts', 'vuebox_scripts_and_styles' );