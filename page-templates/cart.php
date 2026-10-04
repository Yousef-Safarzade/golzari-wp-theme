<?php
/*
 * Template Name: Golzari Cart Page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

$coupon_codes = \src\GolzariWoocommerceHelper::get_cart_coupon_codes();

$cart_items = \src\GolzariWoocommerceHelper::golzari_get_cart_product_objects();

$currency = get_woocommerce_currency();

?>

    <main id="content" class="<?php post_class(); ?>">

        <div class="page-content">

            <div class="golzari-cart-container">

                <?php if(empty($cart_items)){ ?>

                    <?php get_template_part('templates/cart/section' , 'empty-cart' ); ?>

                <?php } else { ?>

                    <div class="golzari-cart-title">

                        سبد خرید شما

                    </div>

                    <div class="golzari-cart-content">

                        <div class="golzari-cart-items">

                            <?php foreach ( $cart_items as $cart_item ) { ?>

                                <?php get_template_part('templates/cart/section' , 'cart-item' , array('cart_item' => $cart_item)); ?>

                            <?php } ?>

                        </div>

                        <div class="golzari-cart-sidebar">

                            <?php get_template_part('templates/cart/section' , 'cart-total-data' ); ?>

                            <?php if( !empty($coupon_codes) ){ ?>

                                <?php get_template_part('templates/cart/section' , 'applied-coupons' , array('coupon_codes' => $coupon_codes)); ?>

                            <?php } ?>

                            <?php get_template_part('templates/cart/section' , 'coupon-form' ); ?>


                            <?php if( is_user_logged_in() ){ ?>


                                    <a class="golzari-procceed-checkout-button" href="<?php echo wc_get_checkout_url(); ?>">
                                        صفحه پرداخت
                                    </a>


                            <?php } else { ?>

                                <a class="golzari-procceed-checkout-button digits-login-modal" href="?login=true">
ورود / ثبت نام
                                </a>

                            <?php } ?>




                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </main>

<?php

get_footer();