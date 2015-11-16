<?php

class VueBoxContainerBox {

	public $data = array(
		'type'        => 'custom-fields',
		'name'        => '',
		'title'       => '',
		'screen'      => array( 'post' ),
		'fields'      => array(),
		'field_names' => array(),
	);

	public function screen( $screen ) {
		$this->data['screen'] = (array) $screen;

		return $this;
	}

	public function fields( $fields ) {
		$this->data['fields'] = (array) $fields;

		if ( $this->data['type'] === 'custom-fields' ) {
			add_action( 'add_meta_boxes', array( $this, 'init_meta_box' ) );
		} else {
			// Add menu page support
		}

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
		<div id="vuebox-<?php echo $container_id; ?>" class="vuebox-container">
			<?php

			foreach ( $this->data['fields'] as $field ):
				$type  = $field['type'];
				$name  = $field['name'];
				$title = $field['title'] . ':';
				$value = '';

				if ( $this->data['type'] === 'custom-fields' ) {
					if ( empty ( $_GET['post'] ) ) {
						break;
					}

					$value = get_post_meta( $_GET['post'], "_{$name}", true );
				} else {
					$value = get_option( $name );
				}

				?>
				
				<vuebox-<?php echo $type; ?> title="<?php echo $title; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>"></vuebox-<?php echo $type; ?>>				
			<?php endforeach; ?>
		</div>
		<?php
	}
}