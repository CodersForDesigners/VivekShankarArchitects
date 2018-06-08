<?php

function parseStringsInObject ( $object ) {

	foreach ( $object as $key => $value ) {
		if ( is_string( $value ) && strpos( $value, '[' ) === 0 ) {
		// if ( is_string( $value ) && $value[ 0 ] == '[' ) {
			$object[ $key ] = json_decode( $value, true );
		}
	}

	return $object;

}
