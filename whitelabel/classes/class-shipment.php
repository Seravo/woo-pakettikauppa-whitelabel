<?php

namespace Woo_Pakettikauppa_Whitelabel;

class Shipment extends \Woo_Pakettikauppa_Core\Shipment {
  public function __construct ( \Woo_Pakettikauppa_Core\Core $plugin ) {
    parent::__construct( $plugin );

    $this->id = 'woo_whitelabel_shipment';
  }

  public function get_pickup_point_methods() {
    $methods = array(
      '2103'  => 'Posti',
      '2711'  => 'Posti International',
    );

    return $methods;
  }

  public function create_shipment( \WC_Order $order, $service_id = null, $additional_services = null ) {

    error_log(print_r($service_id, true));
    error_log('service id missing? cause JS?');

    parent::create_shipment($order, $service_id, $additional_services);
  }
}
