<?php

/**
 * Hide the Dragons
 *
 * @package     HideTheDragons
 * @author      Jesse Petersen
 * @license     GPL-2.0+
 * Idea formed from Cliff Seal's Multi-WordCamp presentation on cleaner admins and his examples of things to hide from clients. Functions found within that presentation and other resources - Cliff is the idea-maker.
 *
 * @wordpress-plugin
 * Plugin Name: Hide the Dragons
 * Plugin URI:  https://www.genesisthe.me/hide-the-dragons-plugin
 * Description: Hide the dangerous "dragons" in the dashboard that will bite and devour a site without proper WordPress know-how.
 * Version:     1.0.0
 * Author:      Jesse Petersen
 * Author URI:  https://www.genesisthe.me
 * Text Domain: hidethedragons
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */



namespace HideTheDragons;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_admin() ) {

    require_once(__DIR__ . '/admin/actions.php');
    require_once(__DIR__ . '/admin/hide-them.php');

    $build = new construct_dragon_killer_class();
    $build->hidethedragons_construct_dragon_killer();

}
