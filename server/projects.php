<?php

ini_set( "display_errors", 1 );
ini_set( "error_reporting", E_ALL );

// Continue processing this script even if
// the user closes the tab, or
// hits the ESC key
ignore_user_abort( true );

// Do not let this script timeout,
// because it will take a while
set_time_limit( 0 );

require_once __DIR__ . '/../inc/env.php';
require_once __DIR__ . '/../inc/db.php';


// Set the response body format type
header( 'Content-Type: application/json' );





$projects = null;
// try {
	$projects = json_decode( file_get_contents( 'php://input' ), true );
// 	if ( ! is_array( $projects ) ) {
// 		throw new Exception( 'Request body is not of the proper format.' )
// 	}
// } catch ( Exception $e ) {
// 	$clientResponse[ "message" ] = 'Invalid request body.';
// 	die( json_encode( $clientResponse ) );
// }


// Actually make the response now
ob_start();
$clientResponse[ "message" ] = 'Projects are being processed.';
// echo json_encode( $clientResponse );
header( 'Content-Encoding: none' );
header( 'Connection: close' );
header( 'Content-Length: ' . ob_get_length() );

// close off the connection to the client
// fastcgi_finish_request();
ob_end_flush();
ob_flush();
flush();


// Fetch all the images
$mediaDir = __DIR__ . '/../media/projects/';
foreach ( $projects as $project ) {
	// Make a dedicated folder for this project's images
	// mkdir( $mediaDir . $project[ 'slug' ] );
	foreach ( $project as $key => $value ) {
		if ( ! is_array( $value ) ) continue;
		foreach ( $value as $image ) {
			$imageURL = 'https://drive.google.com/uc?id=' . $image[ 'id' ];
			$filename = $image[ 'id' ] . '.' . explode( '/', $image[ 'mimeType' ] )[ 1 ];
			// $imageLocalPath = $mediaDir . $project[ 'slug' ] . $filename;
			$imageLocalPath = $mediaDir . $filename;
			if ( file_exists( $imageLocalPath ) ) continue;
			file_put_contents( $imageLocalPath, file_get_contents( $imageURL ) );
		}
	}
}

// Stringifying the array fields
foreach ( $projects as &$project ) {
	foreach ( $project as $key => $value ) {
		if ( is_array( $value ) )
			$project[ $key ] = json_encode( $value );
	}
}
unset( $project );
// file_put_contents( __DIR__ . '/../p.json', json_encode( $projects ) );
// exit;

/* -----
 * Setting up the db
 ----- */
$connection = DB\getConnection( [
	'host' => 'localhost',
	'username' => 'root',
	'password' => $productionEnv ? '95a9e9d5deeb8046fc4c530080afcdbe5a855d5c5de09056' : ''
] );
// Initialize the db in case it don't already exist
$connection->exec( file_get_contents( __DIR__ . '/../inc/Database setup.sql' ) );
// Drop the collection "projects__tmp" if it exists
DB\removeCollection( $connection, 'projects__tmp' );
// Seed the collection "projects__tmp"
DB\seedCollection( $connection, 'projects__tmp', $projects );
// Remove the main / primary "projects" collection
DB\removeCollection( $connection, 'projects' );
// Rename the "projects__tmp" collection to "projects"
DB\renameCollection( $connection, 'projects__tmp', 'projects' );
