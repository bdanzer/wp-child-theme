<?php
$autoload_path = __DIR__ . '/vendor/autoload.php';

if ( file_exists( $autoload_path ) ) {
    require_once( $autoload_path );
}

new DanzerpressChild\DanzerpressChild();