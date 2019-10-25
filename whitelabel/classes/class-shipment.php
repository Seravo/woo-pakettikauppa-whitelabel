<?php

namespace Woo_Pakettikauppa_Whitelabel;

class Shipment extends \Woo_Pakettikauppa_Core\Shipment {
  public function __construct( \Woo_Pakettikauppa_Core\Core $plugin ) {
    parent::__construct($plugin);
  }

  public function get_pickup_point_methods() {
    $methods = array(
      '2103'  => 'Posti',
      '2711'  => 'Posti International',
    );

    return $methods;
  }
}
