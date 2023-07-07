<?php
/**
 * Settings submenu
 *
 * @package FutureShop\WordPress
 * @author Future Shop <support@futureshop.cloud>
 * @since 0.0.1
 */

namespace FutureShop\WordPress\Admin\Menus\Submenus;

use FutureShop\WordPress\Admin\Menus\Menu;

/**
 * Submenu class
 */
class Settings extends Submenu {

	/**
	 * Class constructor
	 */
	public function __construct() {
		parent::__construct(
			__( 'Settings', 'future-shop' ),
			'settings',
		);
	}

	/**
	 * Render for the submenu callback.
	 *
	 * @return void
	 */
	public function render() {
		echo \wp_kses_post( '<div class="wrap" id="future-shop">Settings</div>' );
	}
}
