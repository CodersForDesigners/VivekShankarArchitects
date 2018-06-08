<?php

require_once __DIR__ . '/setup.php';
require_once __DIR__ . '/../parseStringsInObject.php';

function getProjects () {

	global $connection;

	return DB\getEntries( $connection, 'projects' );

}

function getProjectBySlug ( $slug ) {

	global $connection;

	$projects = DB\getEntriesWhere( $connection, 'projects', [ 'ID' => $slug ] );

	return parseStringsInObject( $projects[ 0 ] );

}

function getProjectsByTypology () {

	global $connection;

	$query = 'SELECT P.name, P.ID, P.Typology, P.location, P.`Featured Image`, T.Description AS `Type Description` FROM projects AS P, typologies AS T WHERE P.Typology = T.Name ORDER BY P.Typology DESC';
	// $query = 'SELECT name, ID, Typology, location, `featured image` FROM projects ORDER BY typology';
	// $query = 'SELECT name, type, `type description`, place, `featured images` FROM projects ORDER BY type';

	$projects = DB\raw( $connection, $query );

	// Parse the values that are JSON-encoded
	$projects = array_map( "parseStringsInObject", $projects );

	$projectsByTypology = [ ];
	foreach ( $projects as $project ) {
		$projectsByTypology[ $project[ 'Typology' ] ][ ] = $project;
	}

	return $projectsByTypology;

}
