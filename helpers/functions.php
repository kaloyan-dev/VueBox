<?php

function vuebox_path( $file ) {
	$file_path  = str_replace( STYLESHEETPATH, '', dirname( $file ) );

	return VUEBOX_THEME_PATH . $file_path;
}