// Customize stock status display on single product pages
add_filter('woocommerce_get_availability_text', 'wpsh_custom_stock_status', 10, 2);
function wpsh_custom_stock_status($availability, $product) {
    // Check if the product is in stock
    if ($product->is_in_stock()) {
        $availability = __('In Stock: Yes', 'woocommerce');
    } else {
        $availability = __('In Stock: No', 'woocommerce');
    }
    return $availability;
}
