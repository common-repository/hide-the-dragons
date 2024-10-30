<?php

/**
 * Call the functions
 *
 * @package     HideTheDragons
 * @since       1.0.0
 * @author      Jesse Petersen
 * @link        https://www.genesisthe.me
 * @license     GPL-2.0+
 *
 */

namespace HideTheDragons;

// Disable the WordPress Dashboard File Editor and Plugin File Editor

if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}
if ( ! defined( 'DISALLOW_FILE_MODS' ) ) {
	define( 'DISALLOW_FILE_MODS', true );
}

/**
 * Plugin class.
 */
class hide_the_dragons_init {

    const VERSION = '1.0.0';

	protected $plugin_slug = 'hidethedragons';

	protected static $instance = null;

	protected $plugin_screen_hook_suffix = null;

    public static function get_instance() {
	    // If the single instance hasn't been set, set it now.
	    if ( null == self::$instance ) {
	    	self::$instance = new self;
    	}
    	return self::$instance;
    }

}

hide_the_dragons_init::get_instance();
