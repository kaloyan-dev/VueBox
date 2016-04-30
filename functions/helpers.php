<?php

function vuebox( $field, $post_id = false ) {
	$value = '';

	if ( $post_id ) {
		$value = get_post_meta( $post_id, "_{$field}", true );
	} else {
		$value = get_option( $field );
	}

	return $value;
}

function vuebox_generate_title( $name ) {
	return ucwords( str_replace( '_', ' ', $name ) );
}

function vuebox_path( $file ) {
	$stylesheet_path = str_replace( '\\' ,'/', apply_filters( 'vuebox_path_base', STYLESHEETPATH ) );
	$file_path       = str_replace( '\\' ,'/', dirname( $file ) );
	$new_file_path   = str_replace( $stylesheet_path, '', $file_path );

	return VUEBOX_THEME_PATH . $new_file_path;
}

function vuebox_render_field( $field, $post_fields = false, $parent_name = false, $subfield_index = 0 ) {
	$type           = $field->data['type'];
	$name           = $field->data['name'];
	$title          = $field->data['title'];
	$caption        = $field->data['caption'];
	$subfields      = array();
	$subfields_data = '';

	if ( $parent_name ) {
		if ( isset( $_GET['post'] ) ) {
			$parent_data = get_post_meta( $_GET['post'], "_{$parent_name}", true );
		} else {
			$parent_data = get_option( "_{$parent_name}", true );
		}

		$value = isset( $parent_data[$subfield_index][$name] ) ? $parent_data[$subfield_index][$name] : '';
		$name  = $parent_name . '[' . $subfield_index . '][' . $name . ']';
	}

	if ( $type !== 'repeater' ) {
		$title .= ':';
	} else {
		$subfields      = $field->data['fields'];
		$subfields_data = json_encode( $field->data['fields'] );
	}

	if ( $post_fields ) {
		if ( empty ( $_GET['post'] ) ) {
			break;
		}

		if ( ! $parent_name ) {
			$value = get_post_meta( $_GET['post'], "_{$name}", true );			
		}

	} else {
		$value = get_option( $name );			
	}

	if ( $type !== 'repeater' ) {
		include( VUEBOX_ROOT . "/fields/vuebox-{$type}.php" );
		return;
	}
	
	$fieldsets = count( $value ) > 1 ? count( $value ) : 1;
	include( VUEBOX_ROOT . "/fields/vuebox-repeater.php" );
}

function vuebox_render_fields( $fields_class, $fields, $post_fields = false ) {
	foreach ( $fields_class->data['fields'] as $field ):
		vuebox_render_field( $field, $post_fields );
	endforeach;
}
