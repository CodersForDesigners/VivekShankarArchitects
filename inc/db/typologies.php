<?php

require_once __DIR__ . '/setup.php';
require_once __DIR__ . '/../parseStringsInObject.php';

function getTypologies () {

	global $connection;

	return DB\getEntries( $connection, 'typologies' );

}

function getTypologyByName ( $name ) {

	global $connection;

	$typologies = DB\getEntriesWhere( $connection, 'typologies', [ 'name' => $name ] );

	return parseStringsInObject( $typologies[ 0 ] );

}
