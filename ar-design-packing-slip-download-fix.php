<?php
/**
 * Plugin Name: Ar Design Packing Slip Download Fix
 * Description: Pridáva tlačidlo na stiahnutie dodacieho listu do detailu WooCommerce objednávky po jeho vygenerovaní.
 * Version: 0.1.0
 * Author: Arpád Horák
 * Update URI: https://github.com/Arpad70/woocommerce_ar-design-packing-slip-download-fix
 * Requires at least: 6.7
 * Requires PHP: 8.0
 * Text Domain: ar-design-packing-slip-download-fix
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ARD_PACKING_SLIP_FIX_VERSION', '0.1.0' );
define( 'ARD_PACKING_SLIP_FIX_FILE', __FILE__ );
define( 'ARD_PACKING_SLIP_FIX_BASENAME', plugin_basename( __FILE__ ) );
define( 'ARD_PACKING_SLIP_FIX_PATH', plugin_dir_path( __FILE__ ) );
define( 'ARD_PACKING_SLIP_FIX_URL', plugin_dir_url( __FILE__ ) );
define( 'ARD_PACKING_SLIP_FIX_GITHUB_REPOSITORY', 'Arpad70/woocommerce_ar-design-packing-slip-download-fix' );
define( 'ARD_PACKING_SLIP_FIX_SLUG', 'ar-design-packing-slip-download-fix' );

require_once ARD_PACKING_SLIP_FIX_PATH . 'bootstrap/autoload.php';

ArDesign\PackingSlipDownloadFix\Support\Autoloader::register();

register_activation_hook( ARD_PACKING_SLIP_FIX_FILE, array( 'ArDesign\\PackingSlipDownloadFix\\Application\\Bootstrap', 'activate' ) );
register_deactivation_hook( ARD_PACKING_SLIP_FIX_FILE, array( 'ArDesign\\PackingSlipDownloadFix\\Application\\Bootstrap', 'deactivate' ) );

ArDesign\PackingSlipDownloadFix\Application\Bootstrap::boot()->run();
