<?php

require_once __DIR__ . '/setup.php';
require_once __DIR__ . '/../parseStringsInObject.php';

function getSettings () {

	global $connection;

	$settings = DB\getEntries( $connection, 'settings' );

	return parseStringsInObject( $settings[ 0 ] );

}
