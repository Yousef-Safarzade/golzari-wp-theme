<div id="<?php echo $args['cart_item']['key']; ?>" class="golzari-cart-item" data-cart-key="<?php echo $args['cart_item']['key']; ?>">

    <div class="golzari-cart-item-image-holder">

        <?php $image_url = wp_get_attachment_url( $args['cart_item']['product']->get_image_id(), 'full'); ?>

        <img fetchpriority="high" class = "golzari-cart-item-image" src="<?php echo $image_url; ?>" alt="<?php echo $args['cart_item']['product']->get_name(); ?>">

    </div>

    <div class="golzari-cart-item-meta-data">

        <div class="golzari-cart-item-title">

            <?php echo $args['cart_item']['product']->get_title(); ?>

        </div>

        <div class="golzari-cart-item-description">

            <?php if ( \src\GolzariWoocommerceHelper::is_it_ticket_product($args['cart_item']['product']->get_id()) ){ ?>



                <?php if(!empty($args['cart_item']['product']->get_meta('ticket_location')) ){ ?>

                    <div class="golzari-ticket-meta-data ticket-address">

                        <span class="golzari-ticket-meta-data-icon">

                            <?php \src\GolzarHelper::print_svg(IMG_PATH . "/cart-ticket-address.svg" ); ?>

                        </span>


                            <span class="golzari-ticket-meta-data-value">

                                <?php echo $args['cart_item']['product']->get_meta('ticket_location') ?>

                        </span>

                    </div>


                <?php } ?>


                <?php if( !empty($args['cart_item']['product']->get_meta('ticket_date')) && !empty($args['cart_item']['product']->get_meta('ticket_time')) ) { ?>

                    <div class="golzari-ticket-meta-data ticket-date">

                     <span class="golzari-ticket-meta-data-icon">

                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/cart-ticket-date.svg" ); ?>

                    </span>


                        <span class="golzari-ticket-meta-data-value">

                        <?php

                            printf(
                                    '%s - %s' ,
                                    parsidate( 'l  j  M  Y', $args['cart_item']['product']->get_meta('ticket_date') ),
                                    'ساعت ' . \src\GolzarHelper::englishToPersianNumber( sprintf('%02d:00', $args['cart_item']['product']->get_meta('ticket_time') ) )
                            );

                        ?>

                    </span>

                    </div>


                <?php } ?>


            <?php } else { ?>

                <div class="golzari-ticket-meta-data ticket-short-description">

                        <span class="golzari-ticket-meta-data-value">

                                <?php echo $args['cart_item']['product']->get_short_description(); ?>

                        </span>

                </div>

           <?php } ?>

        </div>

        <div class="golzari-cart-item-price">

            <?php if($args['cart_item']['product']->get_price() == 0){ ?>

                <bdi>رایگان</bdi>

            <?php } else { ?>

                <?php echo $args['cart_item']['product']->get_price_html(); ?>

            <?php  } ?>


        </div>

    </div>

    <div class="golzari-cart-item-quantity-input <?php echo $args['cart_item']['quantity'] === 1 ? 'single-quantity' : ''  ?>" >

        <div class="golzari-cart-item-quantity-input-button increase">

            <div class="golzari-cart-item-quantity-input-button-icon">

                <?php \src\GolzarHelper::print_svg(IMG_PATH . "/plus.svg") ?>

            </div>

        </div>

        <input type="text" value="<?php echo $args['cart_item']['quantity'] ?>" class="golzari-cart-item-quantity-input-value">

        <div class="golzari-cart-item-quantity-input-button decrease">

            <div class="golzari-cart-item-quantity-input-button-icon">

                <?php \src\GolzarHelper::print_svg(IMG_PATH . "/minus.svg") ?>

            </div>

            <div class="remove-cart-item-icon-holder">

                <?php \src\GolzarHelper::print_svg(IMG_PATH . "/remove-cart-item.svg") ?>

            </div>

        </div>

    </div>


</div>