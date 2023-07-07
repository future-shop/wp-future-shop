<?php
/**
 * Plugin Name: Future Shop
 * Plugin URI:  https://futureshop.cloud/wordpress/
 * Description: AI powered ecommerce migrations and integrations.
 * Author: Future Shop
 * Author URI: https://futureshop.cloud/
 * Version: 0.0.1
 * License: MPL-2.0
 * License URI: https://www.mozilla.org/en-US/MPL/2.0/
 * Text Domain: future-shop
 *
 * @package FutureShop\WordPress
 * @author Future Shop <support@futureshop.cloud>
 */

namespace FutureShop\WordPress;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const AUTOLOADER = __DIR__ . '/vendor/autoload.php';

/**
 * Plugin Class
 *
 * Used to store common references, such as a file directory, for easy lookups.
 */
final class Plugin {
	/**
	 * Plugin version.
	 *
	 * @var array
	 */
	public static $version = '0.0.1';

	/**
	 * Plugin class instances.
	 *
	 * @var array
	 */
	private static $instances = [];

	/**
	 * Sets an instance in the registry with the specified key.
	 *
	 * @param string $key The key to associate with the instance.
	 * @param mixed  $instance The instance to be stored in the registry.
	 *
	 * @return void
	 */
	public static function set( $key, $instance ) {
		self::$instances[ $key ] = $instance;
	}

	/**
	 * Retrieves the instance from the registry associated with the specified key.
	 *
	 * @param string $key The key to retrieve the instance.
	 * @return mixed|null The instance associated with the key, or null if the key is not found.
	 */
	public static function get( $key ) {
		return self::$instances[ $key ] ?? null;
	}

	/**
	 * Retrieves all instances stored in the registry.
	 *
	 * @return array An array containing all instances stored in the registry.
	 */
	public static function instances() {
		return self::$instances;
	}

	/**
	 * Lookup a location relative to the main plugin directory.
	 *
	 * @param string  $loc The location, directory or file, to lookup.
	 * @param boolean $url True if requesting the URL, otherwise it is a path.
	 *
	 * @return string The location relative to the main plugin directory.
	 */
	public static function dir( $loc = '', $url = false ) {
		return ( true === $url ? \plugin_dir_url( __FILE__ ) : \plugin_dir_path( __FILE__ ) ) . $loc;
	}

	/**
	 * Alias for looking up a URL more easily.
	 *
	 * @param string $loc The location, directory or file, to reference.
	 *
	 * @return string The location relative to the main plugin directory, as a url.
	 */
	public static function url( $loc = '' ) {
		return self::dir( $loc, true );
	}

	/**
	 * Method for getting the plugin version, primarily for use in enqueues.
	 *
	 * @return string Plugin version.
	 */
	public static function version() {
		return ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : self::$version;
	}
}

if ( is_readable( AUTOLOADER ) ) {
	require_once AUTOLOADER;

	Plugin::set( 'Admin\Menus\Menu', new Admin\Menus\Menu() );
	Plugin::set( 'Admin\Menus\Submenus\Dashboard', new Admin\Menus\Submenus\Dashboard() );

	foreach ( Plugin::instances() as $key => $instance ) {
		if ( method_exists( $instance, 'init' ) ) {
			$instance->init();
		}
	}
}
