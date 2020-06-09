<?php
/**
 * Plugin Name: PayPal PDF
 * Description: Emails a PDF reciept
 * Version:     1.0.0
 * Author:      Alphaweb
 * Author URI:  https://alphaweb.com
 * License: GPLv2
 * Text Domain: paypal-pdf
 *
 * @package PayPalPDF
 */

/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'PPPDF_VERSION' ) ) {
	define( 'PPPDF_VERSION', '1.0.0' );
}

if ( ! defined( 'PPPDF_MAIN_FILE' ) ) {
	define( 'PPPDF_MAIN_FILE', __FILE__ );
}

if ( ! defined( 'PPPDF_URL' ) ) {
	define( 'PPPDF_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'PPPDF_DIR' ) ) {
	define( 'PPPDF_DIR', plugin_dir_path( __FILE__ ) );
}

/**
 * Main initiation class
 *
 * @since  1.0.0
 */
final class PayPalPDF {

	/**
	 * Singleton instance of plugin
	 *
	 * @var PayPalPDF
	 * @since  1.0.0
	 */
	protected static $single_instance = null;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  1.0.0
	 * @return PayPalPDF A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin
	 *
	 * @since  1.0.0
	 */
	protected function __construct() {}

	/**
	 * Add hooks and filters
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function hooks() {

		$this->includes();
		add_action( 'init', array( $this, 'init' ) );

	}

	/**
	 * Activate the plugin
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function activate() {
		// Make sure any rewrite functionality has been loaded.
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function deactivate() {}

	/**
	 * Init hooks
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function init() {
	}

	/**
	 * The includes function.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function includes() {
		require_once PPPDF_DIR . '/vendor/autoload.php';
		require_once PPPDF_DIR . 'includes/functions.php';
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  1.0.0
	 * @param string $field Field to get.
	 * @throws Exception Throws an exception if the field is invalid.
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
			case 'docs':
			case 'component':
				return $this->$field;
			default:
				throw new Exception( 'Invalid ' . __CLASS__ . ' property: ' . $field );
		}
	}

}

/**
 * Grab the PayPalPDF object and return it.
 * Wrapper for PayPalPDF::get_instance()
 *
 * @since  1.0.0
 * @return PayPalPDF  Singleton instance of plugin class.
 */
function paypal_pdf() {
	return PayPalPDF::get_instance();
}

// Kick it off.
add_action( 'plugins_loaded', array( paypal_pdf(), 'hooks' ), 999 );

register_activation_hook( __FILE__, array( paypal_pdf(), 'activate' ) );
register_deactivation_hook( __FILE__, array( paypal_pdf(), 'deactivate' ) );
