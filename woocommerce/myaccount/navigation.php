<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );

$current_user = wp_get_current_user();

$full_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;

$phone_number = get_user_meta($current_user->ID, 'digits_phone', true);

if ( ! $phone_number ) {

    $phone_number = $current_user->phone_number;
}

?>

<nav class="woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">



	<ul>


        <li class="user-info-navigation-item">

            <div class="user-info-avatar-container">

                <img src="<?php echo IMG_URL . "/dashboard_default_avatar.png" ?>" class="user-info-avatar">

            </div>

            <div class="user-info-data-container">

                <span class="user-info-full-name">

                    <?php echo $full_name; ?>

                </span>


                <?php if(!empty($phone_number)){ ?>

                    <span class="user-info-phone">

                        <?php  echo \src\GolzarHelper::englishToPersianNumber(str_replace("+98","",$phone_number)); ?>

                    </span>

                <?php } ?>




            </div>


        </li>


        <?php

        $navigation_map = array(

            'dashboard' => array('label' => 'حساب کاربری' , 'icon' => 'dashboard-profile.svg'),
            'orders' => array('label' => 'تراکنش ها' , 'icon' => 'dashboard-orders.svg'),
            'downloads' => array('label' => 'دانلودها' , 'icon' => 'dashboard-download.svg'),
            'edit-address' => array('label' => 'آدرس ها' , 'icon' => 'dashboard-address.svg'),
            'edit-account' => array('label' => 'ویرایش اطلاعات' , 'icon' => 'dashboard-edit-account.svg'),
            'customer-logout' => array('label' => 'خروج' , 'icon' => 'dashboard-logout.svg'),


        );

        ?>

		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>

            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">

				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?>>


                    <span class="navigation-item-icon">

                       <?php \src\GolzarHelper::print_svg(IMG_PATH . "/" . $navigation_map[ $endpoint ]['icon'] ); ?>

                    </span>

                    <span class="navigation-item-title">


                       <?php echo esc_html( $navigation_map[ $endpoint ]['label'] ); ?>

                    </span>



				</a>

			</li>

		<?php endforeach; ?>

	</ul>

</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
