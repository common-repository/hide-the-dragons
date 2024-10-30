<?php

/**
 * Hide the dragons
 *
 * @package     HideTheDragons
 * @since       1.0.0
 * @author      Jesse Petersen
 * @link        https://www.genesisthe.me
 * @license     GPL-2.0+
 *
 */

namespace HideTheDragons;

class construct_dragon_killer_class {

    // Initialize
    public static function init() {
        $self = new self();
        add_action( 'wp_loaded', array( $self, 'hidethedragons_construct_dragon_killer' ) );
    }

    // List of functions used
    public function hidethedragons_construct_dragon_killer() {

        // Adding something nice
        add_action( 'admin_init', array( $this, 'hidethedragons_add_editor_capabilities' ) );

        // Admin toolbar
        add_action( 'wp_before_admin_bar_render', array( $this, 'hidethedragons_remove_admin_bar_dragons' ) );
        add_action( 'admin_menu', array( $this, 'hidethedragons_remove_menu_dragons' ), 999 );
        add_filter( 'plugin_action_links_wordpress-seo/wp-seo.php', array( $this, 'hidethedragons_hide_wpseo_links' ), 11 );

        // Nags
        add_action( 'customize_register', array( $this, 'hidethedragons_remove_customizer_nags' ), 20 );
        add_action( 'init', array( $this, 'hidethedragons_remove_dashboard_nags' ) );

        // Dragons
        add_action( 'admin_init', array( $this, 'hidethedragons_disable_dashboard_widgets' ) );
        add_filter( 'plugin_row_meta', array( $this, 'hidethedragons_hide_plugin_details' ), 10, 2 );
        add_filter( 'show_advanced_plugins', '__return_false' );
        add_filter( 'all_plugins', array( $this, 'hidethedragons_filter_plugins' ) );

    }

    public function hidethedragons_remove_menu_dragons() {
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'sucuriscan' );
        remove_menu_page( 'w3tc_dashboard' );
        remove_menu_page( 'amazon-web-services' );
        remove_submenu_page( 'options-general.php', 'wpmandrill' );
        remove_submenu_page( 'plugins.php', 'cloudflare' );
    }

    public function hidethedragons_remove_admin_bar_dragons() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('w3tc-faq');
        $wp_admin_bar->remove_menu('w3tc-support');
    }

    public function hidethedragons_disable_dashboard_widgets() {
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
    }

    public function hidethedragons_remove_dashboard_nags() {
        remove_action( 'admin_notices', 'woothemes_updater_notice' );
    }

    public function hidethedragons_remove_customizer_nags() {
        global $wp_customize;
        $wp_customize->remove_section( get_template() . '_theme_info');
    }

    public function hidethedragons_hide_plugin_details( $links, $file ) {
        $links = array();
        return $links;
    }

    public function hidethedragons_hide_plugin_links( $links ) {
        if ( !empty($links['deactivate']) ) {
            $links = array(
                'deactivate' => $links['deactivate']
            );
        }
        return $links;
    }

    public function hidethedragons_filter_plugins( $plugins ) {
        if ( current_user_can( 'edit_users' ) ) {

            return $plugins;

        }   else {

            $hidden = array(
                'Hide the Dragons'
            );

            if (!isset($_GET['seeplugins']) || $_GET['seeplugins'] !== 'fisho') {
                foreach ($plugins as $key => &$plugin) {
                    if (in_array($plugin['Name'], $hidden)) {
                        unset($plugins[$key]);
                    }
                }
            }
            return $plugins;
        }

    }


    // Give Editors the ability to access widgets, menus, Customizer, background, header
    public function hidethedragons_add_editor_capabilities() {
        $role_object = get_role( 'editor' );
        $role_object->add_cap( 'edit_theme_options' );
    }
}