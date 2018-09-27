<?php

/**
 * Gestpay for WooCommerce
 *
 * Copyright: © 2013-2016 MAURO MASCIA (www.mauromascia.com - info@mauromascia.com)
 * Copyright: © 2017-2018 Axerve S.p.A. - Gruppo Banca Sella (https://www.axerve.com - ecommerce@sella.it)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$base_stuff = array(
    'enabled' => array(
        'title' => $this->gw->strings['gateway_enabled'],
        'type' => 'checkbox',
        'label' => $this->gw->strings['gateway_enabled_label'],
        'default' => 'yes'
    ),
    'title' => array(
        'title' => $this->gw->strings['gateway_title'],
        'type' => 'text',
        'description' => $this->gw->strings['gateway_title_label'],
        'default' => "Carta di credito"
    ),
    'description' => array(
        'title' => $this->gw->strings['gateway_desc'],
        'type' => 'textarea',
        'description' => $this->gw->strings['gateway_desc_label'],
        'default' => "Paga in tutta sicurezza con GestPay."
    ),
);

$gateway = array();

if ( ! empty( $_GET['section'] ) && 'wc_gateway_gestpay_consel' == $_GET['section'] ) {

    $gateway['param_consel_id_merchant'] = array(
        'title' => $this->gw->strings['gateway_consel_id'],
        'type' => 'text',
        'label' => '',
    );

    $gateway['param_consel_merchant_pro'] = array(
        'title' => $this->gw->strings['gateway_consel_code'],
        'type' => 'text',
        'description' => $this->gw->strings['gateway_consel_merchant_pro'],
    );

} // end is wc_gateway_gestpay_consel

$cards = $this->get_cards_settings();

$gateway_params = array_merge( $base_stuff, $gateway, $cards );

return apply_filters( 'gestpay_gateway_parameters', $gateway_params );
