<?php

function vuebox_path( $file ) {
	$file_path  = str_replace( STYLESHEETPATH, '', dirname( $file ) );

	return VUEBOX_THEME_PATH . $file_path;
}

function vuebox_generate_title( $name ) {
	return ucwords( str_replace( '_', ' ', $name ) );
}