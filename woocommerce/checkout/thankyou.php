<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order golzari-container-width">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );

		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>


            <div class="order-error-container">

                <div class="order-error-icon-container">

                    <img class="order-error-icon" src="<?php echo IMG_URL . "/order-error-icon.png"; ?>">

                </div>


                <h1 class="order-error-main-title golzari-h3">
                    مشکلی در پردازش سفارش شما اتفاق افتاده
                </h1>


                <p class="order-error-sub-title golzari-body-medium">

                    برای پیگیری بیشتر لطفا با تیم پشتیبانی سایت ارتباط برقرار کنید

                </p>


                <a class="order-error-contact-support">

                    <span class="order-error-button-titles">
                        ارتباط با تیم پشتیبانی
                    </span>

                </a>


            </div>


		<?php else : ?>


            <div class="order-success-container">

                <div class="order-success-container-icon-container">

                    <img class="order-success-icon" src="<?php echo IMG_URL . "/order-success.png"; ?>">

                </div>


                <h1 class="order-success-main-title golzari-h3">
                    خرید شما با موفقیت انجام شد.
                </h1>


                <p class="order-success-sub-title golzari-body-medium">

                    برای مشاهده تراکنش و رسید خرید به حساب کاربری مراجعه کنید.

                </p>


                <a class="order-success-download-ticket" href=" <?php echo GENERATE_ORDER_PDF_URL . "&order_id={$order->get_id()}" ?> " target="_blank" >

                    <div class="order-success-button-titles" >
                        دانلود بلیط
                    </div>

                    <span class="order-success-button-icon">

                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/order-success-download-icon.svg"); ?>

                    </span>

                </a>


            </div>



		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>

		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

	<?php endif; ?>

</div>
