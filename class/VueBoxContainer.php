<?php

class VueBoxContainer {

	public $data = array(
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

	public static function set( $type, $name, $title ) {

		if ( ! $type || ! $name ) {
			return;
		}

		$name = strtolower( preg_replace( '~[^\w]~', '_', $name ) );

		if ( ! $title ) {
			$title = vuebox_generate_title( $name );
		}

		$container_name = str_replace( '_', ' ', $type );
		$container_name = ucwords( $container_name );
		$container_name = str_replace( ' ', '', $container_name );
		$container_name = "VueBox{$container_name}";
		$container      = new $container_name;

		$container->data['type']  = $type;
		$container->data['name']  = $name;
		$container->data['title'] = $title;

		return $container;
	}
}