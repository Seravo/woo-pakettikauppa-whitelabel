<?php

namespace Seravo\WooCommerce\Whitelabel;

class Admin extends \Seravo\WooCommerce\Pakettikauppa\Admin {
  public function __construct( \Seravo\WooCommerce\Pakettikauppa\Core $plugin ) {
    parent::__construct($plugin);

  }

  // public function add_settings_link( $links ) {
  //   $url  = admin_url('admin.php?page=wc-settings&tab=shipping&section=' . $this->core->shippingmethod);
  //   $link = sprintf('<a href="%1$s">%2$s</a>', $url, esc_attr__('Settings'));

  //   return array_merge(array( $link ), $links);
  // }
}
