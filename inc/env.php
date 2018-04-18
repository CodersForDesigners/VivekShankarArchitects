<?php

if ( getenv( 'ENV' ) == 'production' ) {
	$productionEnv = true;
} else {
	$productionEnv = false;
}
