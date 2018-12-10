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

// Set the timezone
date_default_timezone_set( 'Asia/Kolkata' );

// Do not let this script timeout,
// because it will take a while
set_time_limit( 0 );


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
require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../inc/env.php';
require_once __DIR__ . '/../../inc/db.php';
require_once __DIR__ . '/../../inc/db/setup.php';
require_once __DIR__ . '/../../inc/cdn.php';
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

// Get the IDs of all the images currently on Cloudinary
$imagePublicIds__PriorToUpload = CDN\getImageIds( 'settings' );

// Get a list of all the image file-names that are from the request
$imageFiles = array_map( function ( $image ) {
	return 'settings/' . $image[ 'id' ];
}, $images );

// Get a list of all the image file-names that actually need to be created / uploaded; i.e. that aren't on the CDN already
$imagesToBeCreated = array_diff( $imageFiles, $imagePublicIds__PriorToUpload );

// Get a list of all the URLs ( on Google ) of the images that are to be uploaded
$imageURLs = [ ];
foreach ( $images as $image ) {
	if ( in_array( 'settings/' . $image[ 'id' ], $imagesToBeCreated ) )
		$imageURLs[ ] = 'https://drive.google.com/uc?id=' . $image[ 'id' ];
}

// Iterate over every image and upload them; one by one
foreach ( $imagesToBeCreated as $index => $imagePath ) {
	try {
		CDN\uploadImage( $imageURLs[ $index ], $imagePath );
	} catch ( \Exception $e ) {
		$errors[ ] = $imagePath . ' : \n<br>' . $e->getMessage();
	}
}
// If there were errors, send out an e-mail to them ( and us )
if ( ! empty( $errors ) ) {
	// Send a mail to us
	Mailer\sendMessage( [
		'name' => 'Aditya',
		'email' => 'adityabhat@lazaro.in',
		'subject' => '[!] VSA :: Something went wrong in ' . __FILE__,
		'message' => implode( '<br><br>', $errors )
	] );
	// Send a mail to them
	// Mailer\sendMessage( [
	// 	'name' => 'Vivek',
	// 	'email' => 'vivekvsdp@gmail.com',
	// 	'subject' => 'Website – There was an error during publishing',
	// 	'message' => 'Please try publishing again.\nIf the issue persists, then contact Aditya at 7760118668.\n\nThis message was auto-generated.'
	// ] );
	exit;
}


/*
 *
 * Finally, remove the images that are not in use anymore
 *
 */
$imagesToBeRemoved = array_diff( $imagePublicIds__PriorToUpload, $imageFiles );
if ( ! empty( $imagesToBeRemoved ) ) {
	$setsOfImagesToBeRemoved = array_chunk( $imagesToBeRemoved, 91 );
	foreach ( $setsOfImagesToBeRemoved as $imageSet ) {
		CDN\deleteImages( $imageSet );
	}
}





// Stringifying the array fields
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





/*
 *
 * Log the deployment
 *
 */
file_put_contents( '/tmp/deploy-settings.log', json_encode( [
	'status' => 'done',
	'timestamp' => date( 'Y/m/d H:i:s' )
], JSON_PRETTY_PRINT ) );
file_put_contents( '/tmp/deploy-settings-images-create.log', json_encode( [
	'images' => $imagesToBeCreated
], JSON_PRETTY_PRINT ) );
file_put_contents( '/tmp/deploy-settings-images-remove.log', json_encode( [
	'images' => $imagesToBeRemoved
], JSON_PRETTY_PRINT ) );

// Prepare the mail
$timestamp = date( 'Y/m/d H:i:s' );
$imagesAdded = implode( '<br>', array_map( function ( $imageId ) {
	return 'https://drive.google.com/uc?id=' . $imageId;
}, $imagesToBeCreated ) );
$imagesRemoved = implode( '<br>', array_map( function ( $imageId ) {
	return 'https://drive.google.com/uc?id=' . $imageId;
}, $imagesToBeRemoved ) );

$message = <<<MARK
Successfully deployed settings at {$timestamp}.
<br>
The following images were added:
<br>
{$imagesAdded}
<br><br><br><br><br>
The following images were removed:
<br>
{$imagesRemoved}
MARK;

Mailer\sendMessage( [
	'name' => 'Aditya',
	'email' => 'adityabhat@lazaro.in',
	'subject' => 'VSA :: Deployment Log',
	'message' => $message
] );
