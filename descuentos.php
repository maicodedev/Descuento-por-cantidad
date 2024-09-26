add_action('woocommerce_cart_calculate_fees', 'descuento_por_rango_de_cantidad', 20);

function descuento_por_rango_de_cantidad() {
    global $woocommerce;

    // Obtén la cantidad total de productos en el carrito
    $cantidad_total = WC()->cart->get_cart_contents_count();
    $porcentaje_descuento = 0;

    // Define los descuentos por rango de cantidad
    if ($cantidad_total >= 5 && $cantidad_total <= 20) {
        $porcentaje_descuento = 5; // Descuento del 5%
    } elseif ($cantidad_total >= 21 && $cantidad_total <= 35) {
        $porcentaje_descuento = 10; // Descuento del 10%
    } elseif ($cantidad_total >= 36 && $cantidad_total <= 50) {
        $porcentaje_descuento = 15; // Descuento del 15%
    } elseif ($cantidad_total > 50) {
        $porcentaje_descuento = 20; // Descuento del 20%
    }

    // Aplica el descuento si corresponde
    if ($porcentaje_descuento > 0) {
        $descuento = ($woocommerce->cart->cart_contents_total * $porcentaje_descuento) / 100;
        $woocommerce->cart->add_fee('Descuento por cantidad', -$descuento);
    }
}
