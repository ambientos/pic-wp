<?php

/**
 * Plugin Name: AG Pic Site
 * Description: Special plugin for Pic site
 * Version: 0.1
 * Author: Anton Grakhov
 * Author URI: https://grakhov.dev/
 * Tested up to: 5.2
 * Text Domain: pics
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin prefix for constants
 *
 * @var string
 */
$plugin_prefix = 'AG_Pic_Site\\';


/**
 * Plugin folder name
 */
$plugin_folder_name = 'ag-pic-site';


/**
 * Main constants
 */
define( $plugin_prefix . 'TEXT_DOMAIN', 'pics' );
define( $plugin_prefix . 'PLUGIN_FOLDER', WP_PLUGIN_DIR . '/' . $plugin_folder_name );
define( $plugin_prefix . 'PLUGIN_URI', plugins_url( $plugin_folder_name ) );


/**
 * Autoload classes
 */
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	include __DIR__ . '/vendor/autoload.php';

	$plugin_classname = $plugin_prefix . 'Plugin';

	new $plugin_classname();
}
