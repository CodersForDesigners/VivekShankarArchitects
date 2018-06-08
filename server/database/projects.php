<?php

/*
 *
 * This is the end-point for receiving Projects from Google Sheets
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
// $clientResponse[ "data" ] = $projects;
echo json_encode( $clientResponse );
header( 'Content-Encoding: none' );
header( 'Connection: close' );
header( 'Content-Length: ' . ob_get_length() );

// close off the connection to the client
// fastcgi_finish_request();
ob_end_flush();
ob_flush();
flush();





/*
 *
 * Pull in necessary dependencies
 *
 */
require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/vendor/autoload.php';

require_once __DIR__ . '/../../inc/mailer.php';

// TinyPNG API Keys
$tinyPNGKeyDBFile = __DIR__ . '/tinyPNG-API-keys.json';
$tinyPNGApiKeys = json_decode( file_get_contents( $tinyPNGKeyDBFile ), true );


/*
 *
 * Image Fetching and Processing
 * Fetch the images that are new and compress them
 *
 */
$errors = [ ];
// Get a list of all the images
$images = [ ];
$imageFields = [ 'Featured Image', 'Finished Project', '3D Renders', 'Concept Drawings' ];
foreach ( $projects as $project ) {
	foreach ( $project as $key => $value ) {
		if ( ! in_array( $key, $imageFields ) ) continue;
		foreach ( $value as $image ) {
			$images[ ] = $image;
		}
	}
}
$images = array_values( array_unique( $images, SORT_REGULAR ) );

// Get a list of all the images that need to be fetched
// ( i.e. that don't already exist locally )
$mediaDirectory = __DIR__ . '/../../media/projects/';
$imagesToBeFetched = array_filter( $images, function ( $image ) {
	global $mediaDirectory;
	$filename = $image[ 'id' ] . '.' . explode( '/', $image[ 'mimeType' ] )[ 1 ];
	$imageLocalPath = $mediaDirectory . $filename;
	return ! file_exists( $imageLocalPath );
} );

// Get a list of all the image URLs
$imageURLs = array_map( function ( $image ) {
	return 'https://drive.google.com/uc?id=' . $image[ 'id' ];
}, $imagesToBeFetched );
// Get a list of all the image file-names that will be created
$imageFiles = array_map( function ( $image ) {
	return $image[ 'id' ] . '.' . explode( '/', $image[ 'mimeType' ] )[ 1 ];
}, $imagesToBeFetched );


// Fetch the images and store them in a temporary directory
$mediaDirectoryTemporary = __DIR__ . '/../../media/tmp/';
foreach ( $imagesToBeFetched as $index => $image ) {
	$imageLocalPath = $mediaDirectoryTemporary . $imageFiles[ $index ];
	try {
		file_put_contents(
			$imageLocalPath,
			file_get_contents( $imageURLs[ $index ] )
		);
	} catch ( Exception $e ) {
		$errors[ ] = $e->getMessage();
	}
}


// Compress the images and move them over to the primary directory
function compressImage ( $sourcePath, $targetPath ) {

	global $tinyPNGApiKeys;

	foreach ( $tinyPNGApiKeys as $apiKey ) {
		if ( ! $apiKey[ 'limitReached' ] ) {
			try {
				Tinify\setKey( $apiKey[ 'key' ] );
				Tinify\fromFile( $sourcePath )->toFile( $targetPath );
			} catch( Tinify\AccountException $e ) {
				$apiKey[ 'limitReached' ] = true;
				continue;
			}
			break;
		}
	}

}
foreach ( $imagesToBeFetched as $index => $image ) {
	$sourcePath = $mediaDirectoryTemporary . $imageFiles[ $index ];
	$targetPath = $mediaDirectory . $imageFiles[ $index ];
	try {
		compressImage( $sourcePath, $targetPath );
	} catch ( Exception $e ) {
		$errors[ ] = $e->getMessage();
	}
}

// If there were errors, send out an e-mail to them ( and us )
if ( ! empty( $errors ) ) {
	// Send a mail to us
	Mailer\sendMessage( [
		'name' => 'Aditya',
		'email' => 'adityabhat@lazaro.in',
		'subject' => '[!] VSA :: Something went wrong',
		'message' => implode( '\n\n', $errors )
	] );
	// Send a mail to them
	Mailer\sendMessage( [
		'name' => 'Vivek',
		'email' => 'vivekvsdp@gmail.com',
		'subject' => 'Website – There was an error during publishing',
		'message' => 'Please try publishing again.\nIf the issue persists, then contact Aditya at 7760118668.\n\nThis message was auto-generated.'
	] );
	exit;
}

// Remove the temporary images
foreach ( $imagesToBeFetched as $index => $image ) {
	$filePath = $mediaDirectoryTemporary . $imageFiles[ $index ];
	@unlink( $filePath );
}
// Finally, remove the images that do not exist
$imageFilesCurrentInMediaDirectory = array_slice( scandir( $mediaDirectory ), 2 );
$imageFilesToBeRemoved = array_diff( $imageFilesCurrentInMediaDirectory, $imageFiles );
foreach ( $imageFilesToBeRemoved as $file ) {
	@unlink( $file );
}





// Stringifying the array fields
foreach ( $projects as &$project ) {
	foreach ( $project as $key => $value ) {
		if ( is_array( $value ) )
			$project[ $key ] = json_encode( $value );
	}
}
unset( $project );

/* -----
 * Setting up the db
 ----- */
// Drop the collection "projects__tmp" if it exists
DB\removeCollection( $connection, 'projects__tmp' );
// Seed the collection "projects__tmp"
DB\seedCollection( $connection, 'projects__tmp', $projects );
// Remove the main / primary "projects" collection
DB\removeCollection( $connection, 'projects' );
// Rename the "projects__tmp" collection to "projects"
DB\renameCollection( $connection, 'projects__tmp', 'projects' );
