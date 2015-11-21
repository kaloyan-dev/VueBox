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
		} else  {
			add_action( 'admin_menu', array( $this, 'init_menu_page' ) );
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

	public function init_menu_page() {
		add_menu_page(
			$this->data['title'],
			$this->data['title'],
			'manage_options',
			'vuebox-' . sanitize_title( $this->data['title'] ),
			array( $this, 'render_menu_page' )
		);
	}

	public function render_meta_box() {
		$container_id = str_replace( '_', '-', $this->data['name'] ); ?>
		<div id="vuebox-<?php echo $container_id; ?>" class="vuebox-container">
			<?php
				foreach ( $this->data['fields'] as $field ):
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

					if ( empty ( $_GET['post'] ) ) {
						break;
					}

					$value = get_post_meta( $_GET['post'], "_{$name}", true );

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
										$subfield_name  = $name . '_' . $subfield_index . '_' . $subfield->data['name'];
										$subfield_value = get_post_meta( $_GET['post'], "_{$name}_{$subfield_index}_{$subfield_name}", true ); ?>
										<vuebox-<?php echo $subfield_type; ?>
											title="<?php echo $subfield_title; ?>"
											name="<?php echo $subfield_name; ?>"
											value="<?php echo $subfield_value; ?>">
										</vuebox-<?php echo $subfield_type; ?>>

										<?php
										$subfield_index++;
									endforeach;
								?>
							</div>
						</vuebox-<?php echo $type; ?>>
					<?php endif;
				endforeach;
			?>
		</div>
		<?php
	}

	public function render_menu_page() {
		$container_id = str_replace( '_', '-', $this->data['name'] ); ?>
		<div id="vuebox-<?php echo $container_id; ?>" class="vuebox-container">
			<div class="wrap">
				<h2><?php echo $this->data['title']; ?></h2>

				<form action="<?php echo add_query_arg( 'page', 'vuebox-' . sanitize_title( $this->data['title'] ) ); ?>" method="post">
					<?php
						foreach ( $this->data['fields'] as $field ):
							$type  = $field['type'];
							$name  = $field['name'];
							$title = $field['title'] . ':';
							$value = get_option( $name );
							?>
							
							<vuebox-<?php echo $type; ?> title="<?php echo $title; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>"></vuebox-<?php echo $type; ?>>				
						<?php endforeach;
					?>
					<div class="vuebox-form-actions">
						<input type="submit" class="button button-primary" value="<?php _e( 'Save Options', 'vuebox' ); ?>" />
					</div>
				</form>
			</div>
		</div>
	<?php
	}
}