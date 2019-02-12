<?php

/*
 *
 * REFERENCES:
 * 	https://www.taniarascia.com/create-a-simple-database-app-connecting-to-mysql-with-php/
 *
 */

namespace DB;

/* -----
 * Get a database connection
 ----- */
function raw ( $connection, $query ) {

	try {
		$statement = $connection->prepare( $query );
		$statement->execute();
		$result = $statement->fetchAll( \PDO::FETCH_ASSOC );
	}
	catch ( \PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return $result;

}

/* -----
 * Get a database connection
 ----- */
function getConnection ( $parameters = [ ] ) {

	extract( $parameters );
	// default values
	$host = ! empty( $host ) ? $host : 'localhost';
	$username = ! empty( $username ) ? $username : 'root';
	$password = ! empty( $password ) ? $password : '';
	$options = ! empty( $options ) ? $options : [
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
		\PDO::ATTR_PERSISTENT => true, // what does this do?
		// ensures that numbers aren't converted to strings when reading
		\PDO::ATTR_EMULATE_PREPARES => false,
		\PDO::ATTR_STRINGIFY_FETCHES => false,
		\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'"
	];

	try {
		$connection = new \PDO( 'mysql:host' . $host, $username, $password, $options );
	}
	catch ( \PDOException $e ) {
		return $e->getMessage();
	}

	return $connection;

}

/* -----
 * Remove a collection
 ----- */
function removeCollection ( $connection, $collection ) {

	try {
		$statement = $connection->prepare( 'DROP TABLE IF EXISTS ' . $collection );
		$statement->execute();
	}
	catch ( \PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return TRUE;

}

/* -----
 * Rename a collection
 ----- */
function renameCollection ( $connection, $oldCollection, $newCollection ) {

	try {
		$statement = $connection->prepare( "RENAME TABLE `${oldCollection}` TO `${newCollection}`");
		$statement->execute();
	}
	catch ( \PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return TRUE;

}

/* -----
 * Get entries from a given collection
 ----- */
function clearEntries ( $connection, $collection ) {

	try {
		$statement = $connection->prepare( 'TRUNCATE ' . $collection );
		$statement->execute();
	}
	catch ( \PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return TRUE;

}

/* -----
 * Get entries from a given collection
 ----- */
function getEntries ( $connection, $collection, ...$options ) {

	// default values
	// $options = ! empty( $options ) ? $options : [ \PDO::FETCH_NUM ];
	$options = ! empty( $options ) ? $options : [ \PDO::FETCH_ASSOC ];

	$query = 'SELECT * FROM ' . $collection;

	try {
		$statement = $connection->prepare( $query );
		$statement->execute();
		$entries = $statement->fetchAll( ...$options );
	}
	catch ( \PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return $entries;

}

/* -----
 * Get entries from a given collection where...
 ----- */
function getEntriesWhere ( $connection, $collection, $filters = [ ] ) {

	$query = 'SELECT * FROM ' . $collection;
	// filter out any clauses that have no values, i.e. they match any value
	$filters = array_filter( $filters );
	if ( ! empty( $filters ) ) {
		$clauses = [ ];
		foreach ( $filters as $key => $clause_and_value ) {
			if ( is_string( $clause_and_value ) ) {
				$clause_and_value = '"' . $clause_and_value . '"';
			}
			$clauses[ ] = $key . ' = ' . $clause_and_value;
		}
		$query .= ' WHERE ' . implode( ' AND ', $clauses );
	}

	try {
		$statement = $connection->prepare( $query );
		$statement->execute();
		$entries = $statement->fetchAll( \PDO::FETCH_ASSOC );
	}
	catch ( \PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return $entries;

}

/* -----
 * Add an entry to a given collection
 ----- */
function addEntry ( $connection, $collection, $entry ) {

	// Get the names of the fields of the collection
	try {
		$statement = $connection->prepare( 'DESCRIBE ' . $collection );
		$statement->execute();
		$collectionFields = $statement->fetchAll();
	}
	catch ( \PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	$fieldNames = [ ];
	$fieldValues = [ ];
	foreach ( $entry as $field => $value ) {
		$fieldNames[ ] = $field;
		$fieldValues[ ] = $value;
	}
	$validFieldNames = array_map( function ( $name ) {
		return preg_replace( '/\W/', '_', $name );
	}, $fieldNames );
	$fieldNames = array_map( function ( $name ) {
		return "`$name`";
	}, $fieldNames );

	// Insert the values into the collection
	$sql = sprintf(
		'INSERT INTO %s (%s) VALUES (%s)',
		$collection,
		implode( ', ', $fieldNames ),
		':' . implode( ', :', $validFieldNames )
	);
	$data = array_combine( $validFieldNames, $fieldValues );

	try {
		$connection->prepare( $sql )->execute( $data );
	}
	catch ( \PDOException $e ) {
		// echo $e->getMessage();
		return FALSE;
	}

	return TRUE;

}

/* -----
 * Create a collection based on the given data
 ----- */
function seedCollection ( $connection, $collection, $dataset ) {

	// Derive a schema off the data and create a table from it
	$columns = array_keys( $dataset[ 0 ] );

	// Construct table create command
	$columnDeclarations = [ ];
	foreach ( $columns as $name ) {
		$columnDeclarations[ ] = "`${name}` TEXT";
	}
	$dbCreateTableStatement = 'CREATE TABLE IF NOT EXISTS ' . $collection . ' ( ' . implode( ', ', $columnDeclarations ) .	' )';

	// Create the collection
	$connection->exec( $dbCreateTableStatement );

	// Now, seed the collection
	foreach ( $dataset as $data ) {
		addEntry( $connection, $collection, $data );
	}

	return TRUE;

}
