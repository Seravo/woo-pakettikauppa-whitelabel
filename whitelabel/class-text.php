<?php

namespace Seravo\WooCommerce\Whitelabel;

class Text extends \Seravo\WooCommerce\Pakettikauppa\Text {
  public function __construct( \Seravo\WooCommerce\Pakettikauppa\Core $plugin ) {
    parent::__construct($plugin);
  }

  public function setup_title() {
    return esc_html__('WooCommerce Whitelabel &rsaquo; Setup Wizard', 'wc-whitelabel');
  }

  public function shipping_method_name() {
    return __('Whitelabel', 'wc-whitelabel');
  }

  public function setup_intro() {
    return esc_html__('Thank you for installing WooCommerce Whitelabel! This wizard will guide you through the setup process to get you started.', 'wc-whitelabel');
  }

  public function setup_shipping_info() {
    return sprintf(
      /*
       * translators:
       * %1$s: link to WooCommerce shipping zone setting page
       * %2$s: link to external WooCommerce documentation
       */
      __('Please configure the shipping methods of the currently active shipping zones to use Whitelabel shipping. Note that this plugin requires WooCommerce shipping zones and methods to be preconfigured in <a href="%1$s">WooCommerce > Settings > Shipping > Shipping zones</a>. For more information, visit <a target="_blank" href="%2$s">%2$s</a>.', 'wc-whitelabel'),
      esc_url(admin_url('admin.php?page=wc-settings&tab=shipping')),
      esc_attr('https://docs.woocommerce.com/document/setting-up-shipping-zones/')
    );
  }

  public function show_shipping_method() {
    return __('Show Whitelabel shipping method', 'wc-whitelabel');
  }
}
