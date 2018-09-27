=== Gestpay for WooCommerce ===
Contributors: easynolo
Tags: woocommerce, payment gateway, payment, credit card, gestpay, gestpay starter, gestpay pro, gestpay professional, banca sella, sella.it, easynolo, axerve, iframe, direct payment gateway
Requires at least: 4.0.1
Tested up to: 4.9.8
Stable tag: 20180927
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
WC requires at least: 2.6
WC tested up to: 3.4

Gestpay for WooCommerce extends WooCommerce providing the payment gateway for Gestpay by Axerve (Banca Sella).

== Description ==

Gestpay for WooCommerce is a payment gateway for WooCommerce which allows you to use Gestpay on your WooCommerce-powered website.

There are four operational modes in this plugin, which depends on Gestpay version you are using:

* Gestpay Starter
* Gestpay Professional
* Gestpay Professional On Site
* Gestpay Professional iFrame

[Click here to read the full usage documentation on Gestpay](http://docs.gestpay.it/plugins/gestpay-for-woocommerce/ "Gestpay for WooCommerce - Usage Documentation").

== Actions and filters list ==

Here is a list of filters and actions used in this plugin:

= Actions =

* gestpay_before_processing_order
* gestpay_after_order_completed
* gestpay_after_order_failed
* gestpay_before_order_settle
* gestpay_order_settle_success
* gestpay_order_settle_fail
* gestpay_before_order_refund
* gestpay_order_refund_success
* gestpay_order_refund_fail
* gestpay_before_order_delete
* gestpay_order_delete_success
* gestpay_order_delete_fail

= Filters =

* gestpay_gateway_parameters
* gestpay_encrypt_parameters
* gestpay_settings_tab
* gestpay_my_cards_template
* gestpay_cvv_fancybox

== Installation ==

1. Ensure you have the WooCommerce 2.6+ plugin installed
2. Search "Gestpay for WooCommerce" or upload and install the zip file, in the same way you'd install any other plugin.
3. Read the [usage documentation on Gestpay](http://docs.gestpay.it/plugins/gestpay-for-woocommerce/ "Gestpay for WooCommerce - Usage Documentation").

== Changelog ==

= 20180927 =
* Feature - Added apiKey authentication method option
* Checks - Verified compatibility with WooCommerce 3.4.5

= 20180809 =
* Fix recurring payments with iFrame/Tokenization
* Checks - Verified compatibility with Wordpress 4.9.8, WooCommerce 3.4.4 and WooCommerce Subscriptions 2.3.3

= 20180606 =
* Fix - The JS on configuration page must distinguish between Pro and On-Site/iFrame options.
* Checks - Verified compatibility with Wordpress 4.9.6 and WooCommerce 3.4.2

= 20180516 =
* Fix - HTML slashes must be escaped inside JS.
* Fix - No need to instantiate the SOAP Client of order actions in the constructor.
* Feature - Added the ability to temporarily use unsecure Crypt URL when TLS 1.2 is not available.
* Feature - Added an option to enable On-Site merchants to set the withAuth parameter to "N".

= 20180426 =
* Fix typo in the JS of the TLS check

= 20180412 =
* Feature - Added compatibility with WC Sequential Order Numbers Pro.
* Security - Added TLS 1.2 checks for redirect and iFrame versions: prevent old and unsecure browsers to proceed with the payment.
* Fix - Show an error if required fields are not filled on the On-Site version (S2S).
* Fix - Prevent Fatal Errors if WooCommerce is inactive.
* Fix - Save transaction key on phase I
* Checks - Verified compatibility with Wordpress 4.9.4/.5 and WooCommerce 3.3.4/.5.

= 20180108 =
* Fix - Consel Merchant Pro parameter is now changed to be an input box on which the merchant can add the custom code given by Consel.

= 20171217 =
* Feature - Added help text near the CVV field (for it/en languages) for "on site" and iframe versions.
* Feature - Added Consel Customer Info parameter.

= 20171125 =
* Fix - Updated test URLs from testecomm.sella.it to sandbox.gestpay.net
* Checks - Verified compatibility with Wordpress 4.9 and WooCommerce 3.2.5

= 20170920 =
* Fix Custom Info parameter.

= 20170602 =
* Fix error "-1" that happens when using the S2S notify URL.
* Verified compatibility with WooCommerce Subscriptions 2.2.7

= 20170508 =
* Fix - Moved ini_set( 'serialize_precision', 2 ) to the Helper, to avoid rounding conflicts.
* Checks - Verified compatibility with WooCommerce v 3.0.5

= 20170502 =
* Fix - Verify if class WC_Subscriptions_Cart exists before disabling extra Gestpay payment types.

= 20170427 =
* Checks - Verified compatibility with WooCommerce version 2.6.14 and 3.0.4
* Checks - Verified compatibility with WooCommerce Subscriptions version 2.1.4 and 2.2.5
* Feature - Added support for Tokenization+Authorization (here called "On-Site") and iFrame services.
* Feature - Added support for 3D Secure and not 3D Secure payments.
* Feature - Added endpoint to handle cardholder's cards/tokens for the "On-Site" version.
* Feature - Added Refund/Settle/Delete S2S actions for transactions.
* Feature - Added more filters and actions.
* Feature - Disable extra Gestpay payment methods when paying a subscription.
* Fix - Correctly loading of plugin localization.
* Fix - Show/Hide Pro options on the configuration page.
* Fix - Removed extra payment "upmobile", which is not used anymore.

= 20170224 =
* First public release.