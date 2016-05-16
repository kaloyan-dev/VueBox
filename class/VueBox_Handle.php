<?php

class VueBox_Handle extends VueBox {

	function __construct() {
		$this->data['fields'] = array();
		$this->data['labels'] = __( 'Add Entry', 'vuebox' );
	}

	public function add_fields( $fields ) {
		if ( $this->data['type'] !== 'repeater' ) {
			return $this;
		}

		$this->data['fields'] = $fields;

		return $this;
	}

	public function set_labels( $labels ) {
		$this->data['labels'] = $labels;
	}
}