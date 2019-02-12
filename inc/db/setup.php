<?php

require_once __DIR__ . '/../env.php';
require_once __DIR__ . '/../db.php';

if ( $productionEnv ) {
	$dbCredentials = require_once __DIR__ . '/../../environment/configuration/database.php';
	$dbUser = $dbCredentials[ 'user' ];
	$dbPassword = $dbCredentials[ 'password' ];
}
else {
	$dbUser = 'root';
	$dbPassword = '';
}

$connection = DB\getConnection( [
	'host' => 'localhost',
	'username' => $dbUser,
	'password' => $dbPassword
] );
// "Use" the database
$connection->exec( file_get_contents( __DIR__ . '/setup.sql' ) );
