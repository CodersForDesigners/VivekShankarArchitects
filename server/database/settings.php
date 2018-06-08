<?php

/*
 *
 * This is the end-point for receiving Settings from Google Sheets
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





$settings = null;
// try {
	$settings = json_decode( file_get_contents( 'php://input' ), true );
// 	if ( ! is_array( $settings ) ) {
// 		throw new Exception( 'Request body is not of the proper format.' )
// 	}
// } catch ( Exception $e ) {
// 	$clientResponse[ "message" ] = 'Invalid request body.';
// 	die( json_encode( $clientResponse ) );
// }


// Actually make the response now
ob_start();
$clientResponse[ "message" ] = 'Settings are being processed.';
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
// require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/html/vendor/autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../inc/mailer.php';


/*
 *
 * Image Fetching and Processing
 * Fetch the images that are new and compress them
 *
 */
$errors = [ ];
// Get a list of all the images
$images = [ ];
$imageFields = [ 'Home Featured Images' ];
foreach ( $settings as $setting ) {
	foreach ( $setting as $key => $value ) {
		if ( ! in_array( $key, $imageFields ) ) continue;
		foreach ( $value as $image ) {
			$images[ ] = $image;
		}
	}
}
$images = array_values( array_unique( $images, SORT_REGULAR ) );


// Get a list of all the image URLs
$imageURLs = array_map( function ( $image ) {
	return 'https://drive.google.com/uc?id=' . $image[ 'id' ];
}, $images );
// Get a list of all the image file-names that will be created
$imageFiles = array_map( function ( $image ) {
	return 'settings/' . $image[ 'id' ];
}, $images );

// Set up access to the CDN
Cloudinary::config( [
	"cloud_name" => "vsa",
	"api_key" => "826445639995552",
	"api_secret" => "Y8_jVPB1z7cQhuZJ1OiLwuMfjlM"
] );

// Upload the images to the CDN
// function uploadToCDN ( $from, $to ) {

// 	return Cloudinary\Uploader::upload( $from, [
// 		// 'folder' => '',
// 		'public_id' => $to,
// 		'invalidate' => true,
// 		'async' => true,
// 		// 'eager' => [
// 		// 	[
// 		// 		'if' => 'iw >= 1600',
// 		// 		'width' => 1600,
// 		// 		// 'crop' => 'scale',
// 		// 		'fetch_format' => 'auto'
// 		// 	],
// 		// 	[
// 		// 		'if' => 'iw >= 1200',
// 		// 		'width' => 1200,
// 		// 		// 'crop' => 'scale',
// 		// 		'fetch_format' => 'auto'
// 		// 	],
// 		// 	[
// 		// 		'if' => 'iw >= 800',
// 		// 		'width' => 800,
// 		// 		// 'crop' => 'scale',
// 		// 		'fetch_format' => 'auto'
// 		// 	],
// 		// 	[
// 		// 		'if' => 'iw >= 400',
// 		// 		'width' => 400,
// 		// 		// 'crop' => 'scale',
// 		// 		'fetch_format' => 'auto'
// 		// 	]
// 		// ],
// 		// 'eager_async' => true
// 	] );

// }
// foreach ( $images as $index => $image ) {
// 	$sourcePath = $imageURLs[ $index ];
// 	$targetPath = $imageFiles[ $index ];
// 	try {
// 		uploadToCDN( $sourcePath, $targetPath );
// 	} catch ( Exception $e ) {
// 		$errors[ ] = $e->getMessage();
// 	}
// }
// // If there were errors, send out an e-mail to them ( and us )
// if ( ! empty( $errors ) ) {
// 	// Send a mail to us
// 	Mailer\sendMessage( [
// 		'name' => 'Aditya',
// 		'email' => 'adityabhat@lazaro.in',
// 		'subject' => '[!] VSA :: Something went wrong',
// 		'message' => implode( '\n\n', $errors )
// 	] );
// 	// Send a mail to them
// 	// Mailer\sendMessage( [
// 	// 	'name' => 'Vivek',
// 	// 	'email' => 'vivekvsdp@gmail.com',
// 	// 	'subject' => 'Website – There was an error during publishing',
// 	// 	'message' => 'Please try publishing again.\nIf the issue persists, then contact Aditya at 7760118668.\n\nThis message was auto-generated.'
// 	// ] );
// 	exit;
// }

// // Finally, remove the images that are not is use anymore
// $cloudinary = new Cloudinary\Api();
// $resources = $cloudinary->resources( [
// 	'resource_type' => 'image',
// 	'type' => 'upload',
// 	'prefix' => 'settings'
// ] );
// $imagePublicIds = array_map( function ( $resource ) {
// 	return $resource[ 'public_id' ];
// }, $resources->getArrayCopy()[ 'resources' ] );


// $imagesToBeRemoved = array_diff( $imagePublicIds, $imageFiles );
// $cloudinary->delete_resources( $imagesToBeRemoved );









// // Stringifying the array fields
foreach ( $settings as &$setting ) {
	foreach ( $setting as $key => $value ) {
		if ( is_array( $value ) )
			$setting[ $key ] = json_encode( $value );
	}
}
unset( $setting );


// /* -----
//  * Setting up the db
//  ----- */
// Drop the collection "settings__tmp" if it exists
DB\removeCollection( $connection, 'settings__tmp' );
// Seed the collection "settings__tmp"
DB\seedCollection( $connection, 'settings__tmp', $settings );
// Remove the main / primary "settings" collection
DB\removeCollection( $connection, 'settings' );
// Rename the "settings__tmp" collection to "settings"
DB\renameCollection( $connection, 'settings__tmp', 'settings' );
