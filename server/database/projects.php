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


// Get a list of all the image URLs
$imageURLs = array_map( function ( $image ) {
	return 'https://drive.google.com/uc?id=' . $image[ 'id' ];
}, $images );
// Get a list of all the image file-names that will be created
$imageFiles = array_map( function ( $image ) {
	return 'projects/' . $image[ 'id' ];
}, $images );

// Set up access to the CDN
Cloudinary::config( [
	"cloud_name" => "vsa",
	"api_key" => "826445639995552",
	"api_secret" => "Y8_jVPB1z7cQhuZJ1OiLwuMfjlM"
] );

// Upload the images to the CDN
function uploadToCDN ( $from, $to ) {

	return Cloudinary\Uploader::upload( $from, [
		// 'folder' => '',
		'public_id' => $to,
		'invalidate' => true,
		// 'async' => true,
		// 'async' => true,
		// 'eager' => [
		// 	[
		// 		'if' => 'iw >= 1600',
		// 		'width' => 1600,
		// 		// 'crop' => 'scale',
		// 		'fetch_format' => 'auto'
		// 	],
		// 	[
		// 		'if' => 'iw >= 1200',
		// 		'width' => 1200,
		// 		// 'crop' => 'scale',
		// 		'fetch_format' => 'auto'
		// 	],
		// 	[
		// 		'if' => 'iw >= 800',
		// 		'width' => 800,
		// 		// 'crop' => 'scale',
		// 		'fetch_format' => 'auto'
		// 	],
		// 	[
		// 		'if' => 'iw >= 400',
		// 		'width' => 400,
		// 		// 'crop' => 'scale',
		// 		'fetch_format' => 'auto'
		// 	]
		// ],
		// 'eager_async' => true
	] );

}
foreach ( $images as $index => $image ) {
	// a simple throttling thing-a-ma-bob so the cloudinary can breathe
	// when fetching images from Google Drive
	if ( $index % 3 == 0 ) {
		usleep( 0.5 * 1000000 );
	}

	$sourcePath = $imageURLs[ $index ];
	$targetPath = $imageFiles[ $index ];
	try {
		uploadToCDN( $sourcePath, $targetPath );
	} catch ( Exception $e ) {
		$errors[ ] = $sourcePath . ' (' . $images[ $index ][ 'name' ] . '): \n<br>' . $e->getMessage();
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
 * Finally, remove the images that are not is use anymore
 *
 */
$imagePublicIds = [ ];
$cloudinary = new Cloudinary\Api();
$nextCursor = '';

// You can only fetch the images in small batches, hence we cumulatively build
// the list of public image IDs
do {

	// Fetch a batch of images
	$resources__currentBatch = $cloudinary->resources( [
		'resource_type' => 'image',
		'type' => 'upload',
		'prefix' => 'projects',
		'max_results' => 500,
		'next_cursor' => $nextCursor
	] )->getArrayCopy();

	// Append the public ids to the cumulative list
	$imagePublicIds__currentBatch = array_map( function ( $resource ) {
		return $resource[ 'public_id' ];
	}, $resources__currentBatch[ 'resources' ] );
	$imagePublicIds = array_merge( $imagePublicIds, $imagePublicIds__currentBatch );

	// Store a reference to the next batch of images ( if there are more )
	$nextCursor = $resources__currentBatch[ 'next_cursor' ];

} while ( ! empty( $nextCursor ) );


$imagesToBeRemoved = array_diff( $imagePublicIds, $imageFiles );
if ( ! empty( $imagesToBeRemoved ) ) {
	$cloudinary->delete_resources( $imagesToBeRemoved );
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
