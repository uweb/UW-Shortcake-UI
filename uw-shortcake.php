<?php
/*
Plugin Name: UW Shortcake 
Version: 0.1.0
Description: Shortcake-powered shortcodes designed for the UW-2014 theme. 	Initially Shortcake Bakery, then expanded to incorporate more uw-2014 theme shortcodes.   
Author: UWeb
Author URI: http://www.washington.edu/marketing/web-design/
Text Domain: uw-shortcake
*/

require_once dirname( __FILE__ ) . '/inc/class-uw-shortcake.php';

define( 'UW_SHORTCAKE_VERSION', '0.1.0' );
define( 'UW_SHORTCAKE_URL_ROOT', plugin_dir_url( __FILE__ ) );
/**
 * Load the Shortcake Bakery
 */
// @codingStandardsIgnoreStart
function UW_Shortcake() {
	return UW_Shortcake::get_instance();
}
// @codingStandardsIgnoreEnd
add_action( 'after_setup_theme', 'UW_Shortcake' );

?>