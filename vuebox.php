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
include_once( 'class/VueBox_Handle.php' );

function vuebox_scripts_and_styles() {
	$vuebox_path = vuebox_path( __FILE__ );
	$vuebox_css  = $vuebox_path . '/assets/css/';
	$vuebox_js   = $vuebox_path . '/assets/js/';

	wp_enqueue_script( 'vuebox-vue', $vuebox_js . 'vue.min.js', false, '1.0.0', true );
	wp_enqueue_script( 'vuebox-fields', $vuebox_js . 'vuebox-fields.js', array( 'vuebox-vue' ), '1.0.0', true );
	wp_enqueue_script( 'vuebox-app', $vuebox_js . 'vuebox.js', array( 'vuebox-vue', 'vuebox-fields' ), '1.0.0', true );

	wp_enqueue_style( 'vuebox-css', $vuebox_css . 'vuebox.css' );

}
add_action( 'admin_enqueue_scripts', 'vuebox_scripts_and_styles' );