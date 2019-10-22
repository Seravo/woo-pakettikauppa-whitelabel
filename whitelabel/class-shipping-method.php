<?php

namespace Seravo\WooCommerce\Whitelabel;

class Shipping_Method extends \Seravo\WooCommerce\Pakettikauppa\Shipping_Method {
  /**
   * @var Core
   */
  // public static $core = null;

  public function init() {
    var_dump("overriden init");
    // die("when $core is overriden, the plugin stops working, because it's set to null and it should contain methods");
  }
}
