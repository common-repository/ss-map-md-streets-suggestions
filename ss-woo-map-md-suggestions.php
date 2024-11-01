<?php
/**
 * Plugin Name: Streets Suggestions via map.md for WooCommerce
 * Plugin URI: https://wpsimplesolutions.com
 * Description: Woocommerce - Auto suggest street address using map.md API during the Checkout process
 * Version: 1.0.2
 * Requires at least: 5.6
 * Requires PHP: 7.4.3
 * Author: WP Simple Solutions
 * Author URI: https://wpsimplesolutions.com
 * Developer: Alexandru Burca
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ss-woo-map-md
 * Domain Path: /languages
 * 
 * WC tested up to: 8.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

defined( 'SSWOOMAPMD_URL' ) or define( 'SSWOOMAPMD_URL',  plugin_dir_url( __FILE__ ) );
defined( 'SSWOOMAPMD_BASE' ) or define( 'SSWOOMAPMD_BASE', plugin_basename( __FILE__ ) );
defined( 'SSWOOMAPMD_PATH' ) or define( 'SSWOOMAPMD_PATH', plugin_dir_path( __FILE__ ) );

$pluginData = get_file_data(SSWOOMAPMD_PATH.basename(SSWOOMAPMD_BASE), array('version' => 'Version', 'text-domain' => 'Text Domain', 'name' => 'Plugin Name'), 'plugin');
defined( 'SSWOOMAPMD_VERSION' ) or define( 'SSWOOMAPMD_VERSION', $pluginData['version'] );
defined( 'SSWOOMAPMD_NAME' ) or define( 'SSWOOMAPMD_NAME', $pluginData['name'] );

require_once SSWOOMAPMD_PATH . '/includes/ss-func.php';
require_once SSWOOMAPMD_PATH . '/includes/woo-product-setting-sec.php';
require_once SSWOOMAPMD_PATH . '/includes/ss-checkout-logic.php';

add_action( 'init', 'SSWooMapMDTextDomain' );

/**
 * Check if WooCommerce is active
**/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
    new SSWooMapMD_Settings_Section;
    new SSWooMapMD_Checkout_Logic;
    add_filter( 'plugin_action_links_' . SSWOOMAPMD_BASE, 'SSWooMapMDSettingsLink' );
else:
    add_action( 'admin_notices', 'SSWooMapMDNoWooFoundNotice' );
endif;