<?php
$autoload_path = __DIR__ . '/vendor/autoload.php';

if ( file_exists( $autoload_path ) ) {
    require_once( $autoload_path );
}

if (class_exists('Timber')) {
    new DanzerpressChild\DanzerpressChild();
}