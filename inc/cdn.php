<?php

namespace CDN;

require_once __DIR__ . '/../vendor/autoload.php';

/*
 *
 * Get the IDs of all the images on the CDN
 *
 */
function getImageIds ( $type ) {

	// Set up access to the CDN
	\Cloudinary::config( [
		"cloud_name" => "vsa",
		"api_key" => "826445639995552",
		"api_secret" => "Y8_jVPB1z7cQhuZJ1OiLwuMfjlM"
	] );

	$cloudinary = new \Cloudinary\Api();
	$imagePublicIds = [ ];
	$nextCursor = '';

	// You can only fetch the images in small batches, hence we cumulatively build
	// the list of public image IDs
	do {

		// Fetch a batch of images
		$resources__currentBatch = $cloudinary->resources( [
			'resource_type' => 'image',
			'type' => 'upload',
			'prefix' => $type,
			'max_results' => 500,
			'next_cursor' => $nextCursor
		] )->getArrayCopy();

		// Append the public ids to the cumulative list
		$imagePublicIds__currentBatch = array_map( function ( $resource ) {
			return $resource[ 'public_id' ];
		}, $resources__currentBatch[ 'resources' ] );
		$imagePublicIds = array_merge( $imagePublicIds, $imagePublicIds__currentBatch );

		// Store a reference to the next batch of images ( if there are more )
		$nextCursor = $resources__currentBatch[ 'next_cursor' ] ?? null;

	} while ( ! empty( $nextCursor ) );

	return $imagePublicIds;

}



/*
 *
 * Upload the images to the CDN
 *
 */
function uploadImage ( $from, $to ) {

	// Set up access to the CDN
	\Cloudinary::config( [
		"cloud_name" => "vsa",
		"api_key" => "826445639995552",
		"api_secret" => "Y8_jVPB1z7cQhuZJ1OiLwuMfjlM"
	] );

	return \Cloudinary\Uploader::upload( $from, [
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



/*
 *
 * Delete a set of images from the CDN
 *
 */
function deleteImages ( $imageSet ) {

	// Set up access to the CDN
	\Cloudinary::config( [
		"cloud_name" => "vsa",
		"api_key" => "826445639995552",
		"api_secret" => "Y8_jVPB1z7cQhuZJ1OiLwuMfjlM"
	] );

	$cloudinary = new \Cloudinary\Api();

	return $cloudinary->delete_resources( $imageSet );

}
