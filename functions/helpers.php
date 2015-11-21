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

function vuebox_render_fields( $fields_class, $fields, $post_fields = false ) {
	foreach ( $fields_class->data['fields'] as $field ):
		$type           = $field->data['type'];
		$name           = $field->data['name'];
		$title          = $field->data['title'];
		$subfields_data = '';

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
							$subfield_type  = $subfield->data['type'];
							$subfield_title = $subfield->data['title'];
							$subfield_name  = $name . '[' . $subfield_index . ']' . $subfield->data['name'];
							$subfield_value = get_post_meta( $_GET['post'], "_{$name}[{$subfield_index}]{$subfield_name}", true ); ?>
							<vuebox-<?php echo $subfield_type; ?>
								title="<?php echo $subfield_title; ?>"
								name="<?php echo $subfield_name; ?>"
								value="<?php echo $subfield_value; ?>">
							</vuebox-<?php echo $subfield_type; ?>>

							<?php
						endforeach;
					?>
				</div>
			</vuebox-<?php echo $type; ?>>
		<?php endif;
	endforeach;
}