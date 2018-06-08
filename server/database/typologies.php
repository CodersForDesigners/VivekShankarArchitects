<?php

/*
 *
 * This is the end-point for receiving Typologies from Google Sheets
 *
 */

ini_set( "display_errors", 1 );
ini_set( "error_reporting", E_ALL );

// Continue processing this script even if
// the user closes the tab, or
// hits the ESC key
ignore_user_abort( true );

// Do not let this script timeout,
// because it will take a while
set_time_limit( 0 );

require_once __DIR__ . '/../../inc/env.php';
require_once __DIR__ . '/../../inc/db.php';
require_once __DIR__ . '/../../inc/db/setup.php';


// Set the response body format type
header( 'Content-Type: application/json' );





$typologies = null;
// try {
	$typologies = json_decode( file_get_contents( 'php://input' ), true );
// 	if ( ! is_array( $typologies ) ) {
// 		throw new Exception( 'Request body is not of the proper format.' )
// 	}
// } catch ( Exception $e ) {
// 	$clientResponse[ "message" ] = 'Invalid request body.';
// 	die( json_encode( $clientResponse ) );
// }


// Actually make the response now
ob_start();
$clientResponse[ "message" ] = 'Typologies are being processed.';
echo json_encode( $clientResponse );
header( 'Content-Encoding: none' );
header( 'Connection: close' );
header( 'Content-Length: ' . ob_get_length() );

// close off the connection to the client
// fastcgi_finish_request();
ob_end_flush();
ob_flush();
flush();



// Prune out empty "Benefit" points
$typologies = array_map( function ( $typology ) {
	$typology[ 'Benefits' ] = array_filter( $typology[ 'Benefits' ], function ( $benefit ) {
		return ! empty( $benefit[ 'Title' ] );
	} );
	return $typology;
}, $typologies );

// Stringifying the array fields
foreach ( $typologies as &$typology ) {
	foreach ( $typology as $key => $value ) {
		if ( is_array( $value ) )
			$typology[ $key ] = json_encode( $value );
	}
}
unset( $typology );
// file_put_contents( __DIR__ . '/../t.json', json_encode( $typologies ) );
// exit;

/* -----
 * Setting up the db
 ----- */
// Drop the collection "typologies__tmp" if it exists
DB\removeCollection( $connection, 'typologies__tmp' );
// Seed the collection "typologies__tmp"
DB\seedCollection( $connection, 'typologies__tmp', $typologies );
// Remove the main / primary "typologies" collection
DB\removeCollection( $connection, 'typologies' );
// Rename the "typologies__tmp" collection to "typologies"
DB\renameCollection( $connection, 'typologies__tmp', 'typologies' );
