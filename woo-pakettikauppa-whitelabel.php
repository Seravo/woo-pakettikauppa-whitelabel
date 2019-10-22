<?php
/**
 * Plugin Name: WooCommerce Whitelabel
 * Version: 2.0.23
 * Plugin URI: https://github.com/Seravo/woocommerce-whitelabel
 * Description: whitelabel shipping service for WooCommerce. Integrates Posti, Smartship, Matkahuolto, DB Schenker and others. Version 2 breaks 1.x pricing settings.
 * Author: Seravo
 * Author URI: https://seravo.com/
 * Text Domain: wc-whitelabel
 * Domain Path: /languages/
 * License: GPL v3 or later
 *
 * WC requires at least: 3.4
 * WC tested up to: 3.7.0
 *
 * Copyright: © 2017 Seravo Oy
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Seravo\WooCommerce\Whitelabel;

// Prevent direct access to this script
if ( ! defined('ABSPATH') ) {
  exit;
}

/**
 * Autoloader loads nothing but Pakettikauppa libraries. The classname of the generated autoloader is not unique,
 * whitelabel forks use the same autoloader which results in a fatal error if the main plugin and a whitelabel plugin
 * co-exist.
 */
if (!class_exists('\Pakettikauppa\Client')) {
  require_once 'vendor/autoload.php';
}

require_once 'core/class-core.php';

class Woo_Pakettikauppa_Whitelabel extends \Seravo\WooCommerce\Pakettikauppa\Core {
  protected function maybe_load_setup_wizard() {
    // die("maybe?");
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
    if ( $page === 'wcwhitelabel-setup' ) {
      $this->load_setup_wizard_class();
    }
  }

  public function load_textdomain() {
    load_plugin_textdomain(
      'wc-whitelabel',
      false,
      dirname(plugin_basename(__FILE__)) . '/languages/'
    );
  }


  protected function load_admin_class() {
    require_once 'core/class-admin.php';
    require_once 'whitelabel/class-admin.php';

    $admin = new Admin($this);
    $admin->load();

    return $admin;
  }
}

$instance = new Woo_Pakettikauppa_Whitelabel(
  [
    'root' => __FILE__,
    'version' => get_file_data(__FILE__, array( 'Version' ), 'plugin')[0],
    'shipping_method_name' => 'whitelabel_shipping_method',
    'vendor_name' => 'whitelabel',
    'vendor_url' => 'https://www.whitelabel.fi/',
    'vendor_logo' => 'assets/img/whitelabel-logo.png',
    'setup_background' => 'assets/img/whitelabel-background.jpg',
  ]
);

