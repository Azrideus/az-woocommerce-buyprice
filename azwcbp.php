<?php

/**
 *
 * @link              URI
 * @since             1.0.0
 * @package           az-wc-bp
 *
 * @wordpress-plugin
 * Plugin Name:       AZ-WC-Buyprice
 * Plugin URI:        URI
 * Description:       Add buyprice for wc products
 * Version:           1.0.1
 * Author:            Azrideus
 * Author URI:        URI
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       az-wc-bp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 */
// define('AZWCBP_VERSION', '1.0.0');

//use your own custom meta name here
$azwcbp_metaname = '_amadeus_buyprice';

/* ------------------------------- actual code ------------------------------ */
add_filter('woocommerce_product_options_general_product_data', 'azwcbp_return_meta');
add_filter('woocommerce_process_product_meta', 'azwcbp_process_product_meta');

function azwcbp_return_meta() {
    $args = array(
        'id'          => $GLOBALS['azwcbp_metaname'],
        'label'       => __('Buyprice', 'cfwc'),
        'class'       => 'cfwc-custom-field',
        'desc_tip'    => true,
        'description' => __('Buyprice', 'ctwc'),
    );
    woocommerce_wp_text_input($args);
}

function azwcbp_process_product_meta($post_id) {

    $product = wc_get_product($post_id);
    $wcbp    = isset($_POST[$GLOBALS['azwcbp_metaname']]) ? $_POST[$GLOBALS['azwcbp_metaname']] : '';

    $product->update_meta_data($GLOBALS['azwcbp_metaname'], sanitize_text_field($wcbp));

    $product->save();
}