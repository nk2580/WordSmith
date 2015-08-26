<?php
function application_autoloader( $class ) {
	$class = strtolower( $class );
	$class_filename = $class . '.php';
	$class_root = dirname( __FILE__ );
	$directories = new RecursiveDirectoryIterator( $class_root );
	foreach ( new RecursiveIteratorIterator( $directories )as $file ) {
		if ( strtolower( $file->getFilename() ) == $class_filename ) {
			$full_path = $file->getRealPath();
			$path_cache[$class] = $full_path;
			require_once $full_path;
			break;
		}
	}
}

spl_autoload_register( 'application_autoloader' );
