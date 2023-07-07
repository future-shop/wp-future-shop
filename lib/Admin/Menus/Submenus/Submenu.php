<?php
/**
 * Administration submenus
 *
 * @package FutureShop\WordPress
 * @author Future Shop <support@futureshop.cloud>
 * @since 0.0.1
 */

namespace FutureShop\WordPress\Admin\Menus\Submenus;

use FutureShop\WordPress\Admin\Menus\Menu;

/**
 * Abstract class for submenus
 */
abstract class Submenu {

	/**
	 * Page Title
	 *
	 * @var string $title The title of the submenu page.
	 */
	protected $title;

	/**
	 * Page slug
	 *
	 * @var string $slug The slug of the submenu page.
	 */
	protected $slug;

	/**
	 * Class constructor
	 *
	 * @param string $title The title of the submenu page.
	 * @param string $slug The slug of the submenu page.
	 */
	public function __construct( $title, $slug ) {
		$this->title = $title;
		$this->slug  = Menu::SLUG . '-' . $slug;
	}

	/**
	 * Init function for Actions and Filters
	 *
	 * @return void
	 */
	public function init() {
		\add_action( 'admin_menu', [ $this, 'add_submenu_page' ] );
	}

	/**
	 * Add submenu page.
	 *
	 * @return void
	 */
	public function add_submenu_page() {
		\add_submenu_page(
			Menu::SLUG,
			$this->title,
			$this->title,
			Menu::CAPABILITY,
			$this->slug,
			[ $this, 'render' ]
		);
	}

	/**
	 * Abstract render function for submenu page.
	 *
	 * @return void
	 */
	abstract public function render();
}
