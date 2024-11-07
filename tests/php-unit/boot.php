<?php

declare( strict_types=1 );

$tests_dir  = str_replace( '\\', '/', __DIR__ );
$lib_dir    = dirname( $tests_dir, 2 );
$vendor_dir = "{$lib_dir}/vendor";
$autoload   = "{$vendor_dir}/autoload.php";

if ( ! is_file( $autoload ) ) {
	die( 'Please install via Composer before running tests.' );
}

putenv( 'TESTS_DIR=' . $tests_dir );
putenv( 'LIB_DIR=' . $lib_dir );
putenv( 'VENDOR_DIR=' . $vendor_dir );

error_reporting( E_ALL ); // phpcs:ignore

require_once "{$lib_dir}/vendor/antecedent/patchwork/Patchwork.php";

if ( ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
	define( 'PHPUNIT_COMPOSER_INSTALL', $autoload );
	require_once $autoload;
}

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', "{$vendor_dir}/roots/wordpress-no-content/" );
}

unset( $tests_dir, $lib_dir, $vendor_dir, $autoload );
