<?php

namespace src;

class GolzariWoocommerceHelper
{


    public function define_hooks(){

        add_action('wp_ajax_glozari_add_to_cart', [$this,'glozari_add_to_cart'] );

        add_action('wp_ajax_nopriv_glozari_add_to_cart', [$this,'glozari_add_to_cart']);

        add_action('wp_ajax_golzari_apply_coupon', [$this,'golzari_apply_coupon_ajax']);

        add_action('wp_ajax_nopriv_golzari_apply_coupon', [$this,'golzari_apply_coupon_ajax']);

        add_action('wp_ajax_golzari_remove_coupon_from_cart', [$this,'golzari_remove_coupon_from_cart_ajax']);

        add_action('wp_ajax_nopriv_golzari_remove_coupon_from_cart', [$this,'golzari_remove_coupon_from_cart_ajax']);

        add_action('wp_ajax_golzari_update_cart_item_quantity', [$this,'golzari_update_cart_item_quantity_ajax']);

        add_action('wp_ajax_nopriv_golzari_update_cart_item_quantity', [$this,'golzari_update_cart_item_quantity_ajax']);

        add_filter('woocommerce_checkout_fields' , [$this,'golzari_checkout_fields'] , PHP_INT_MAX);

        add_action('template_redirect', [$this,'redirect_checkout_page_for_guest_users']);

        add_action('template_redirect', [$this,'check_for_ticket_pdf_generation']);

        remove_action('woocommerce_thankyou', 'woocommerce_order_details_table', 10);

    }





    public function glozari_add_to_cart() {

        if ( empty( $_POST['product_id'] ) ) {

            wp_Send_json_error(

                'No product_id specified',

            );

        }



        if ( empty( $_POST['quantity'] ) ) {

            wp_Send_json_error(

                'No quantity specified',

            );

        }

        $product_id = absint($_POST['product_id']);

        $quantity   = wc_stock_amount($_POST['quantity']);

        wc_clear_notices();

        $result = \WC()->cart->add_to_cart($product_id, $quantity);

        wp_send_json([
            'success' => (bool) $result,
            'notices' => wc_get_notices('error'),
            'fragments' => apply_filters(
                'woocommerce_add_to_cart_fragments',
                []
            ),
            'cart_hash' => WC()->cart->get_cart_hash(),
        ],
            (bool) $result ? '200' : '500'
        );
    }




    public function golzari_apply_coupon_ajax() {


        if ( ! WC()->cart ) {

            wp_send_json_error(['message' => 'Cart is not available.']);

        }


        $coupon_code = isset($_POST['coupon_code'])
            ? wc_clean(wp_unslash($_POST['coupon_code']))
            : '';


        if ( empty($coupon_code) ) {

            wp_send_json_error(['message' => 'کد تخفیف معتبر وارد نمایید']);

        }


        $coupon_id = wc_get_coupon_id_by_code($coupon_code);

        if ( ! $coupon_id ) {

            wp_send_json_error(['message' => 'کد تخفیف نامعتبر می باشد']);

        }


        $coupon = new \WC_Coupon($coupon_id);

        $discounts = new \WC_Discounts(WC()->cart);

        $validity = $discounts->is_coupon_valid($coupon);

        if ( is_wp_error($validity) ) {

            wp_send_json_error(['message' => $validity->get_error_message()]);

        }

        $applied = WC()->cart->apply_coupon($coupon_code);

        if ( ! $applied ) {

            wp_send_json_error(['message' => 'The coupon could not be applied.']);

        }

        WC()->cart->calculate_totals();

        wp_send_json_success([
            'message' => 'Coupon applied successfully.',
            'coupon_code' => $coupon_code,
            'cart' => WC()->cart->get_cart(),
            'cart_total' => WC()->cart->get_total(),
            'cart_subtotal' => WC()->cart->get_cart_subtotal(),
            'discount_total' => WC()->cart->get_discount_total(),
            'coupons' => WC()->cart->get_applied_coupons(),
        ]);


    }




    public static function get_cart_coupon_codes(){

        if ( ! WC()->cart ) {

            return [];

        }

        $coupons = [];

        foreach ( WC()->cart->get_applied_coupons() as $coupon_code ) {

            $discount = WC()->cart->get_coupon_discount_amount(
                $coupon_code,
                false
            );

            $coupons[] = [
                'code'     => $coupon_code,
                'discount' => $discount,
            ];
        }

        return $coupons;

    }



    function golzari_remove_coupon_from_cart_ajax( $coupon_code ) {



        if ( ! WC()->cart ) {

            wp_send_json_error(['message' => 'Cart is not available.']);

        }


        $coupon_code = isset($_POST['coupon_code'])
            ? wc_clean(wp_unslash($_POST['coupon_code']))
            : '';


        if ( empty($coupon_code) ) {

            wp_send_json_error(['message' => 'Coupon code is required.']);

        }

        $coupon_code = wc_format_coupon_code( $coupon_code );

        if ( WC()->cart->has_discount( $coupon_code ) ) {

            WC()->cart->remove_coupon( $coupon_code );

            WC()->cart->calculate_totals();

            wp_send_json_success(["message" => "Coupon removed."]);

        }

        wp_send_json_error(["message" => "Invalid coupon code."]);



    }



    public static function golzari_get_cart_product_objects() {

        $products = array();

        if ( ! WC()->cart ) {

            return $products;

        }

        foreach ( WC()->cart->get_cart() as $cart_item ) {

            $product = $cart_item['data'];

            if ( $product instanceof \WC_Product ) {

                $products[] = [ 'product' => $product , 'quantity' => $cart_item['quantity'] , 'key' => $cart_item['key'] ];

            }

        }



        return $products;

    }




    public static function golzari_update_cart_item_quantity_ajax() {

        if ( ! WC()->cart ) {

            wp_send_json_error(['message' => 'Cart is not available.']);
        }

        $cart_item_key = isset($_POST['cart_item_key'])
            ? wc_clean(wp_unslash($_POST['cart_item_key']))
            : '';

        $quantity = isset($_POST['quantity'])
            ? wc_stock_amount($_POST['quantity'])
            : 0;

        if ( ! $cart_item_key ) {

            wp_send_json_error(['message' => 'Cart item key is missing.']);

        }

        if ( $quantity < 0 ) {

            wp_send_json_error(['message' => 'Invalid quantity.']);

        }

        // Update quantity
        $updated = WC()->cart->set_quantity(
            $cart_item_key,
            $quantity,
            true
        );

        if ( false === $updated ) {

            wp_send_json_error(['message' => 'Unable to update cart item.']);

        }

        // Recalculate totals
        WC()->cart->calculate_totals();

        wp_send_json_success([
            'cart_item_key'         => $cart_item_key,
            'quantity'              => $quantity,
            'cart_total'            => WC()->cart->get_cart_total(),
            'cart_total_ex_tax'     => WC()->cart->get_total_ex_tax(),
            'cart_tax'              => WC()->cart->get_total_tax(),
            'is_empty'              => WC()->cart->is_empty(),
        ]);

    }





    public static function is_it_ticket_product($product_id) {


        if ( empty( $product_id ) ) {

            return false;

        }

        return has_term( 'tickets', 'product_cat', $product_id );


    }




    public static function golzari_checkout_fields($fields){

        unset( $fields['billing']['billing_company'] );

        unset( $fields['billing']['billing_address_2'] );

        unset( $fields['billing']['billing_phone'] );

        unset( $fields['billing']['billing_country'] );

        unset( $fields['billing']['billing_address_1'] );

        unset( $fields['billing']['billing_city'] );

        unset( $fields['billing']['billing_state'] );

        unset( $fields['billing']['billing_postcode'] );

        unset( $fields['billing']['billing_email'] );

        unset( $fields['billing']['order_comments'] );

        return $fields;

    }



    public static function redirect_checkout_page_for_guest_users(){

        if (is_checkout() && !is_user_logged_in()) {

            wp_safe_redirect(home_url('/'));

            exit;

        }

    }





    public static function return_order_data_for_pdf_generation($order_id){

        $order = wc_get_order( $order_id );

        if ( ! $order ) {
            return false;
        }

        $customer_id    = $order->get_customer_id();

        $phone_number   = get_user_meta($customer_id, 'digits_phone', true);

        if ( !empty($phone_number) ) {

            $phone_number = str_replace("+98", "", $phone_number);

            $phone_number= GolzarHelper::englishToPersianNumber($phone_number);

        }

        $order_date     = parsidate( 'l  j  M  Y', $order->get_date_created() );

        $tickets = array();

        $order_items = $order->get_items();

        foreach ( $order_items as $order_item ) {

            $product = $order_item->get_product();

            if( self::is_it_ticket_product( $product->get_id() ) ) {

                $tickets[] = self::extract_ticket_product_data( $product->get_id() );

            }

        }


        return array(
            "orderCode"                     => GolzarHelper::englishToPersianNumber($order_id),
            'ticketBuyerName'               => $order->get_billing_first_name() . " " . $order->get_billing_last_name(),
            'ticketBuyerPhoneNumber'        => $phone_number,
            "orderTotalCost"                => GolzarHelper::englishToPersianNumber($order->get_total()) . " " . get_woocommerce_currency_symbol(),
            "orderDate"                     => $order_date,
            "tickets"                       => $tickets,
            "orderQuantity"                 => GolzarHelper::englishToPersianNumber($order->get_item_count()),
        );

    }




    public static function extract_ticket_product_data($product_id){

        $product = wc_get_product($product_id);

        if(!$product){

            return false;

        }

        $ticket_date = $product->get_meta('ticket_date');

        return array(
            "ticketImageURL" => get_the_post_thumbnail_url( $product->get_id(), 'full' ),
            "ticketTitle" => $product->get_title(),
            "ticketDate" =>  parsidate( 'l  j  M  Y', $ticket_date ),
            "ticketAddress" => $product->get_meta('ticket_location'),
            "ticketDescription" => $product->get_description()
        );


    }




    public static function check_for_ticket_pdf_generation(){

        if ( isset($_GET['generate_order_pdf']) ){

            $user_id = get_current_user_id();

            $order_id = $_GET['order_id'];

            if ( !empty( $order_id ) && !empty( $user_id ) ) {

                $order_object = wc_get_order( $order_id );

                if ( $order_object && $order_object->get_user_id() == $user_id ) {

                    $ticket_data = self::return_order_data_for_pdf_generation($order_id);

                    \src\GolzariSingleTicket::generate_ticket_pdf($ticket_data);

                    exit();

                }

            }

        }

    }

}



add_action( 'after_setup_theme', function () {

    ( new \src\GolzariWoocommerceHelper() )->define_hooks();

});