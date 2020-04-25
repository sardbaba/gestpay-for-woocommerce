<?php

/**
 * Gestpay for WooCommerce
 *
 * Copyright: © 2017-2020 Axerve S.p.A. - Gruppo Banca Sella (https://www.axerve.com - ecommerce@sella.it)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Gateway_Gestpay_PAYPAL extends WC_Gateway_Gestpay {

    public function __construct() {

        $this->set_this_gateway_params( 'Gestpay PayPal' );
        $this->paymentType = 'PAYPAL';
        $this->Helper->init_gateway( $this );
        $this->set_this_gateway();
        $this->add_actions();

        if ( $this->Helper->is_subscriptions_active() ) {
            include_once $this->Helper->plugin_dir_path . '/inc/class-gestpay-subscriptions.php';
            $this->Subscr = new Gestpay_Subscriptions( $this );

            add_action( 'gestpay_after_order_completed', array( $this, 'maybe_save_token_after_order_completed' ), 10, 2 );

            // process scheduled subscription payments
            add_action( 'woocommerce_scheduled_subscription_payment_wc_gateway_gestpay_paypal', array( $this->Subscr, 'process_subscription_renewal_payment' ), 10, 2 );
        }

        add_filter( 'gestpay_encrypt_parameters', array( $this, 'add_extra_encrypt_parameters' ), 10, 2 );
    }

    /**
     * Add description of goods or services associated with the billing agreement.
     * This field is required for each recurring payment billing agreement (if using MerchantInitiatedBilling as the billing type),
     * that means you can use a different agreement for each subscription/order.
     * PayPal recommends that the description contain a brief summary of the billing agreement terms and conditions
     * (but this only makes sense when the billing type is MerchantInitiatedBilling, otherwise
     * the terms will be incorrectly displayed for all agreements). For example, buyer is billed at "9.99 per month for 2 years".
     *
     * @see https://docs.gestpay.it/soap/alternative-payments/paypal/
     * @see https://api.gestpay.it/#encrypt-example-paypal
     */
    public function add_extra_encrypt_parameters( $params, $order ) {

        if ( $this->is_payment_type_ok( $params ) && $this->Helper->is_a_subscription() && function_exists( 'wcs_cart_price_string' ) ) {

            $cart = WC()->cart;
            $desc = wp_kses_post( wcs_cart_price_string( $cart->get_cart_subtotal(), $cart ) );

            $params->payPalBillingAgreementDescription = substr( strip_tags( $desc ), 0, 127 ); // Max lenght 127
        }

        return $params;
    }

    /**
     * Maybe store the token.
     * @see also maybe_save_token() @ /inc/class-gestpay-iframe.php
     */
    function maybe_save_token_after_order_completed( $order, $xml_response ) {

        if ( $order->get_payment_method() != 'wc_gateway_gestpay_paypal' ) {
            return;
        }

        if ( ! $this->save_token ) {
            $this->Helper->log_add( '[PayPal] TOKEN storage is disabled.' );
            return;
        }

        $order_id = $order->get_id();

        if ( ! $this->Helper->is_subscription_order( $order ) ) {
            // With PayPal, there is no need to store the token if the order does not contains a subscription
            // because it will not be used to pay other orders as is possible with the On-Site version.
            $this->Helper->log_add( '[PayPal] Order #'.$order_id.' does not contains a subscription and the token will not be saved.' );
            return;
        }

        $resp = $this->Helper->set_order_token( $order, $xml_response );
        if ( empty( $resp ) ) {
            $this->Helper->log_add( '[PayPal] Failed to save the token for Order #'.$order_id );
        }
    }
}