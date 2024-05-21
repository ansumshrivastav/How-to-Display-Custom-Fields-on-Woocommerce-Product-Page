// Add custom field to WooCommerce backend under Shipping tab for simple products
add_action('woocommerce_product_options_shipping', 'wpsh_add_text_field_shipping');
function wpsh_add_text_field_shipping() {
    woocommerce_wp_text_input(array(
        'id'            => '_shipping_time',
        'label'         => __('Custom Shipping Info', 'woocommerce'),
        'description'   => __('Enter shipping information here.', 'woocommerce'),
        'desc_tip'      => 'true',
        'type'          => 'text'
    ));
}

// Save custom field values
add_action('woocommerce_admin_process_product_object', 'wpsh_save_field', 10, 1);
function wpsh_save_field($product) {
    if (isset($_POST['_shipping_time'])) {
        $product->update_meta_data('_shipping_time', sanitize_text_field($_POST['_shipping_time']));
    }
}

// Display this custom field on WooCommerce single product pages
add_action('woocommerce_single_product_summary', 'wpsh_display_on_single_product_page', 25);
function wpsh_display_on_single_product_page() {
    global $product;

    // Is a WC product
    if (is_a($product, 'WC_Product')) {
        // Get meta
        $text = $product->get_meta('_shipping_time');
        // NOT empty
        if (!empty($text)) {
            echo '<div class="woocommerce-message">Shipping Time: ' . $text . '</div>';
        }
    }
}
