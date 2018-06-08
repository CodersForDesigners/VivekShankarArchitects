<?php

namespace Logger;

ini_set( "display_errors", 0 );
ini_set( "error_reporting", E_ALL );

function log ( $thing ) {
	echo '<pre style="white-space: pre-wrap;">';
	var_dump( $thing );
	echo '</pre>';
}
