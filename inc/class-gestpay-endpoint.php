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

/*
 * @see https://woocommerce.wordpress.com/2016/04/21/tabbed-my-account-pages-in-2-6/
 */
class Gestpay_Endpoint {

    /**
     * Plugin actions.
     */
    public function __construct() {

        load_plugin_textdomain( 'gestpay-for-woocommerce', false, dirname( plugin_basename( GESTPAY_MAIN_FILE ) ) . "/languages" );

        $this->title = __( 'Stored Cards', 'gestpay-for-woocommerce' );

        // Actions used to insert a new endpoint in the WordPress.
        add_action( 'init', array( $this, 'add_endpoint' ) );
        add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );

        // Change the My Accout page title.
        add_filter( 'the_title', array( $this, 'endpoint_title' ) );

        // Add new tab/page into the My Account page.
        add_filter( 'woocommerce_account_menu_items', array( $this, 'new_menu_items' ) );
    }

    /**
     * Register new endpoint to use inside My Account page.
     *
     * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
     */
    public function add_endpoint() {
        add_rewrite_endpoint( GESTPAY_ACCOUNT_TOKENS_ENDPOINT, EP_ROOT | EP_PAGES );

        // Required to load the endpoint.
        flush_rewrite_rules();
    }

    /**
     * Add new query var.
     *
     * @param array $vars
     * @return array
     */
    public function add_query_vars( $vars ) {
        $vars[] = GESTPAY_ACCOUNT_TOKENS_ENDPOINT;

        return $vars;
    }

    /**
     * Set endpoint title.
     *
     * @param string $title
     * @return string
     */
    public function endpoint_title( $title ) {
        global $wp_query;

        $is_endpoint = isset( $wp_query->query_vars[ GESTPAY_ACCOUNT_TOKENS_ENDPOINT ] );

        if ( $is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
            // New page title.
            $title = $this->title;

            remove_filter( 'the_title', array( $this, 'endpoint_title' ) );
        }

        return $title;
    }

    /**
     * Insert the new endpoint into the My Account menu.
     *
     * @param array $items
     * @return array
     */
    public function new_menu_items( $items ) {
        // Remove the logout menu item.
        $logout = $items['customer-logout'];
        unset( $items['customer-logout'] );

        // Insert your custom endpoint.
        $items[ GESTPAY_ACCOUNT_TOKENS_ENDPOINT ] = $this->title;

        // Insert back the logout item.
        $items['customer-logout'] = $logout;

        return $items;
    }

}

new Gestpay_Endpoint();