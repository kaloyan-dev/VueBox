<?php

class VueBoxContainerBox {

	public $options = array(
		'type'   => 'custom-fields',
		'screen' => array( 'post' ),
		'fields' => array(),
	);

	public function type( $type ) {
		$this->options['type'] = $type;

		return $this;
	}

	public function screen( $screen ) {
		$this->options['screen'] = (array) $screen;

		return $this;
	}

	public function fields( $fields ) {
		$this->options['fields'] = (array) $fields;

		return $this;
	}
}