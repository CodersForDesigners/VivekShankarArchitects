<?php

require_once __DIR__ . '/../env.php';
require_once __DIR__ . '/../db.php';

$connection = DB\getConnection( [
	'host' => 'localhost',
	'username' => 'root',
	'password' => $productionEnv ? '95a9e9d5deeb8046fc4c530080afcdbe5a855d5c5de09056' : ''
] );
// "Use" the database
$connection->exec( file_get_contents( __DIR__ . '/setup.sql' ) );
