<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

global $product;

defined( 'ABSPATH' ) || exit;

$product_data = \src\GolzariSingleTicket::get_single_ticket_data();



?>


<div id="product-<?php the_ID(); ?>" class="<?php echo $product_data['classes'] ?>">

    <div class="thumbnail-container">

        <img alt="<?php echo $product_data['product_title'] ?>" class="ticket-thumbnail" src="<?php echo $product_data['thumbnail'] ?>">

    </div>

    <div class="content-container">

        <div class="ticket-title">

            <h1><?php echo $product_data['product_title'] ?></h1>

            <div class="ticket-seats-data-container">

                <?php if($product_data['free_seats'] && !$product_data['is_coming_soon'] ){ ?>

                    <div class="tickets-seats">ظرفیت آزاد</div>

                <?php } else if($product_data['is_available'] && !$product_data['is_coming_soon'] ){ ?>

                            <div class="tickets-seats"> <?php printf("ظرفیت %s نفر", \src\GolzarHelper::englishToPersianNumber($product_data['total_seats']) ); ?> </div>

                        <?php if($product_data['should_show_seats'] ){ ?>

                            <div class="tickets-remaining-seats"> <?php printf('%s بلیط باقی مانده', \src\GolzarHelper::englishToPersianNumber($product_data['remaining_seats']) ) ?> </div>

                        <?php } ?>

                <?php }  else if ( !$product_data['is_available'] && !$product_data['is_coming_soon'] ) { ?>

                            <div class="tickets-seats"> <?php printf("ظرفیت تکمیل" ); ?> </div>

                <?php } ?>

            </div>

        </div>

        <div class="ticket-meta-container">


            <?php if(!empty($product_data['ticket_date'])){ ?>

                <div class="meta-data-item" id="ticket-date-meta">

                    <div class="meta-title-container">

                    <span class="meta-title-icon">

                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/calendar.svg"); ?>

                    </span>

                        <div class="meta-title-text">

                            تاریخ

                        </div>

                    </div>

                    <div class="meta-value-container">

                        <?php echo parsidate( 'l  j  M ماه', $product_data['ticket_date'] ) ?>

                    </div>

                </div>

            <?php } ?>







            <?php if(!empty($product_data['ticket_time'])){ ?>

                <div class="meta-data-item" id="ticket-time-meta">

                    <div class="meta-title-container">

                        <span class="meta-title-icon">


                            <?php \src\GolzarHelper::print_svg(IMG_PATH . "/calendar.svg"); ?>


                        </span>

                        <div class="meta-title-text">

                            ساعت

                        </div>

                    </div>

                    <div class="meta-value-container">

                        <?php echo \src\GolzarHelper::englishToPersianNumber(sprintf('%02d:00', $product_data['ticket_time'] )); ?>

                    </div>

                </div>

            <?php } ?>








            <?php if(!empty($product_data['ticket_location'])){ ?>

            <div class="meta-data-item" id="ticket-location-meta">

                <div class="meta-title-container">

                        <span class="meta-title-icon">


                            <?php \src\GolzarHelper::print_svg(IMG_PATH . "/location.svg"); ?>


                        </span>

                    <div class="meta-title-text">

                        مکان

                    </div>

                </div>

                <div class="meta-value-container">

                    <?php echo \src\GolzarHelper::englishToPersianNumber($product_data['ticket_location'] ); ?>

                </div>

            </div>

        </div>

        <?php } ?>












        <div class="description-container">

            <h3 class="description-title">توضیحات</h3>

            <p class="ticket-description">

                <?php echo $product_data['description']; ?>

            </p>

        </div>



        <div class="ticket-location-container">

            <h3 class="location-title">موقعیت روی نقشه</h3>

            <div class="location-map-container">

                <?php echo \src\GolzariSingleTicket::sanatize_neshan_map_iframe($product_data['map_iframe']); ?>

            </div>


        </div>






        <div class="purchase-button-wrap">


            <?php
            if ($product_data['is_available'] && !$product_data['is_coming_soon']) {
                get_template_part('templates/input', 'quantity', array('min'=>'1' , 'max'=>$product_data['remaining_seats']));
            }
            ?>


            <a class="purchase-button-container <?php echo $product_data['is_coming_soon']  ? 'coming-soon' : '' ; ?> <?php echo !$product_data['is_available'] || $product_data['is_coming_soon']  ? 'disabled' : '' ; ?>" href="<?php echo $product_data['is_available'] && !$product_data['is_coming_soon'] ? $product_data['cart_url'] : '#' ?>" title="<?php echo $product_data['product_title'] ?>"  data-product-id="<?php echo get_the_ID(); ?>">

                <div class="purchase-icon">

                    <?php if($product_data['is_available'] && !$product_data['is_coming_soon']){ ?>

                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/basket.svg"); ?>

                    <?php } else if($product_data['is_coming_soon']) { ?>

                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/info.svg"); ?>

                    <?php } else { ?>

                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/close.svg"); ?>

                    <?php } ?>

                </div>

                <div class="purchase-text">

                    <?php

                    if($product_data['is_available'] && !$product_data['is_coming_soon']){

                        if($product_data['is_free']){

                            printf( "<span class='first-step'>%s</span>" , 'خرید رایگان' );

                        } else{

                            printf( "<span class='first-step'>%s / %s</span>" , 'خرید بلیط' , $product_data['price'] );

                        }


                        printf( "<span class='ready-step'>%s</span>" , 'تکمیل خرید' );


                    } else if($product_data['is_coming_soon']) {

                        printf( "فروش به زودی" );

                    } else {

                        printf( "اتمام بلیط" );


                    }

                    ?>

                </div>

            </a>

        </div>

        <div id="error-wrap">


        </div>







    </div>


</div>