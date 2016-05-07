<?php

class VueBoxCustomFields extends VueBoxContainer {

	public function fields( $fields ) {
		$this->data['fields'] = (array) $fields;

		add_action( 'add_meta_boxes', array( $this, 'init_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_post_meta' ) );

		return $this;
	}

	public function init_meta_box() {

		foreach ( $this->data['screen'] as $screen ) {
			add_meta_box(
				$this->data['name'],
				$this->data['title'],
				array( $this, 'render_meta_box' ),
				$screen
			);
		}
	}

	public function render_meta_box() {
		$container_id = str_replace( '_', '-', $this->data['name'] ); ?>
		<div id="vuebox-<?php echo $container_id; ?>" class="vuebox-container" v-cloak>
			<?php vuebox_render_fields( $this, $this->data['fields'], true ); ?>
		</div>
		<?php
	}

	public function save_post_meta( $post_id ) {
		foreach ( $this->data['fields'] as $field ) {
			$field_name = $field->data['name'];

			if ( empty( $_POST[$field_name] ) ) {
				return;
			}

			update_post_meta( $post_id, '_' . $field_name, $_POST[$field_name] );
		}
	}

}
