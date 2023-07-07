<?php
/**
 * Dashboard submenu
 *
 * @package FutureShop\WordPress
 * @author Future Shop <support@futureshop.cloud>
 * @since 0.0.1
 */

namespace FutureShop\WordPress\Admin\Menus\Submenus;

use FutureShop\WordPress\Admin\Menus\Menu;

/**
 * Dashboard class
 */
class Dashboard extends Submenu {

	/**
	 * Class constructor
	 */
	public function __construct() {
		parent::__construct(
			__( 'Dashboard', 'future-shop' ),
			'dashboard',
		);
	}

	/**
	 * Render for the submenu callback.
	 *
	 * @return void
	 */
	public function render() {
		echo \wp_kses_post( '<div class="wrap" id="future-shop">Dashboard</div>' );
	}
}
