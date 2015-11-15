<?php

class VueBoxContainer {

	public static function set( $type ) {

		$container = new VueBoxContainerBox;

		$container->type( $type );

		return $container;
	}
}