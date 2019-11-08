<?php
/**
 * Plugin Name: WooCommerce Whitelabel
 * Version: 2.0.23
 * Plugin URI: https://github.com/Seravo/woocommerce-whitelabel
 * Description: whitelabel shipping service for WooCommerce. Integrates Posti, Smartship, Matkahuolto, DB Schenker and others. Version 2 breaks 1.x pricing settings.
 * Author: Seravo
 * Author URI: https://seravo.com/
 * Text Domain: woo-whitelabel
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

// Prevent direct access to this script
if ( ! defined('ABSPATH') ) {
  exit;
}

/**
 * Autoloader loads nothing but Pakettikauppa libraries. The classname of the generated autoloader is not unique,
 * whitelabel forks use the same autoloader which results in a fatal error if the main plugin and a whitelabel plugin
 * co-exist.
 */
if ( ! class_exists('\Pakettikauppa\Client') ) {
  require_once 'vendor/autoload.php';
}

require_once 'core/class-core.php';

class Woo_Pakettikauppa_Whitelabel extends \Woo_Pakettikauppa_Core\Core {
  public $prefix = 'woo_whitelabel';

  public function __construct( $config = [] ) {
    parent::__construct($config);

    add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ));
    add_action('woocommerce_before_checkout_form', array( $this, 'enqueue_frontend_scripts' ));

    add_action(
      'init',
      function() {
      if ( apply_filters('woo_whitelabel_enable_setup_wizard', true) && current_user_can('manage_woocommerce') ) {
          add_action('admin_enqueue_scripts', array( $this, 'enqueue_setup_scripts' ));
      }
      }
    );
  }

  public function can_load() {
    if ( class_exists('Wc_Pakettikauppa') ) {
      add_action(
        'admin_notices',
        function() {
          echo '<div class="notice notice-error">';
          echo '<p>' . $this->text->activated_core_plugin_error() . '</p>';
          echo '</div>';
        }
      );

      return false;
    }

    return true;
  }

  public function enqueue_setup_scripts() {
    wp_enqueue_style('woo_whitelabel_admin_setup', $this->dir_url . 'whitelabel/assets/admin-setup.css', array(), $this->version);
    wp_enqueue_style('wp-admin');
    wp_enqueue_style('buttons');
  }

  public function enqueue_admin_scripts() {
    // wp_enqueue_style('woo_whitelabel_admin', $this->dir_url . 'whitelabel/assets/admin.css', array(), $this->version);
    // wp_enqueue_script('woo_whitelabel_admin_js', $this->dir_url . 'assets/js/admin.js', array( 'jquery' ), $this->version, true);
  }

  public function enqueue_frontend_scripts() {
    // wp_enqueue_style('woo_whitelabel', $this->dir_url . '/whitelabel/assets/frontend.css', array(), $this->version);
    // wp_enqueue_script('woo_whitelabel_js', $this->dir_url . '/assets/js/frontend.js', array( 'jquery' ), $this->version, true);
  }

  protected function load_shipment_class() {
    require_once 'core/class-shipment.php';
    require_once 'whitelabel/classes/class-shipment.php';

    $shipment = new \Woo_Pakettikauppa_Whitelabel\Shipment($this);
    $shipment->load();

    return $shipment;
  }

  public function load_textdomain() {
    parent::load_textdomain();

    load_plugin_textdomain(
      'woo-whitelabel',
      false,
      dirname($this->basename) . '/whitelabel/languages/'
    );
  }

  protected function load_text_class() {
    require_once 'core/class-text.php';
    require_once 'whitelabel/classes/class-text.php';

    return new \Woo_Pakettikauppa_Whitelabel\Text($this);
  }
}

$instance = new Woo_Pakettikauppa_Whitelabel(
  [
    'root' => __FILE__,
    'version' => get_file_data(__FILE__, array( 'Version' ), 'plugin')[0],
    'shipping_method_name' => 'whitelabel_shipping_method',
    'vendor_name' => 'whitelabel',
    'vendor_url' => 'https://www.whitelabel.fi/',
    'vendor_logo' => 'whitelabel/assets/logo.png',
    'setup_background' => 'whitelabel/assets/setup.jpg',
    'setup_page' => 'wcwhitelabel-setup',
  ]
);
