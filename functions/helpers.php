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
	$file_path  = str_replace( apply_filters( 'vuebox_path_base', STYLESHEETPATH ), '', dirname( $file ) );

	return VUEBOX_THEME_PATH . $file_path;
}

function vuebox_render_field( $field, $post_fields = false, $parent_name = false, $subfield_index = 0 ) {
	$type           = $field->data['type'];
	$name           = $field->data['name'];
	$title          = $field->data['title'];
	$subfields      = array();
	$subfields_data = '';

	if ( $parent_name ) {
		$name  = $parent_name . '[' . $subfield_index . ']' . $name;
		$value = get_post_meta( $_GET['post'], "_{$parent_name}[{$subfield_index}]{$name}", true );
	}

	if ( $type !== 'repeater' ) {
		$title .= ':';
	} else {
		$subfields      = $field->data['fields'];
		$subfields_data = json_encode( $field->data['fields'] );
	}

	$value = '';

	if ( $post_fields ) {
		if ( empty ( $_GET['post'] ) ) {
			break;
		}

		$value = get_post_meta( $_GET['post'], "_{$name}", true );
	} else {
		$value = get_option( $name );			
	}

	if ( $type !== 'repeater' ): ?>					
		<vuebox-<?php echo $type; ?>
			title="<?php echo $title; ?>"
			name="<?php echo $name; ?>"
			value="<?php echo $value; ?>">
		</vuebox-<?php echo $type; ?>>
	<?php else: ?>
		<vuebox-<?php echo $type; ?>
			title="<?php echo $title; ?>"
			name="<?php echo $name; ?>"
			subfields="<?php echo $subfields_data; ?>">

			<div class="vuebox-repeater-fieldwrap">
				<?php
					$subfield_index = 0;

					foreach ( $subfields as $subfield ):
						vuebox_render_field( $subfield, $post_fields, $name, $subfield_index );
					endforeach;
				?>
			</div>
		</vuebox-<?php echo $type; ?>>
	<?php endif;
}

function vuebox_render_fields( $fields_class, $fields, $post_fields = false ) {
	foreach ( $fields_class->data['fields'] as $field ):
		vuebox_render_field( $field, $post_fields );
	endforeach;
}
