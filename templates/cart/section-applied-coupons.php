<div class="golzari-applied-coupons">

    <?php foreach( $args['coupon_codes'] as $coupon_code ){ ?>

        <div class="golzari-applied-coupons-item">

            <div class="golzari-applied-coupons-item-badge">

                <?php \src\GolzarHelper::print_svg(IMG_PATH . "/applied-coupon-badge.svg"); ?>

            </div>

            <div class="golzari-applied-coupons-item-description">

                                    <span class="golzari-applied-coupons-item-description-content">

                                        <?php printf('%s  %s', number_format($coupon_code['discount']) , 'تومان از مبلغ قابل پرداخت کم شد.'  ); ?>


                                    </span>

                <span class="golzari-applied-coupons-item-description-coupon-code">

                                        <?php echo $coupon_code['code']; ?>

                                    </span>

            </div>


            <div class="golzari-applied-coupons-item-remove" data-code = "<?php echo $coupon_code['code']; ?>" >

                <?php \src\GolzarHelper::print_svg(IMG_PATH . "/remove-coupon-code.svg"); ?>

            </div>


        </div>


    <?php } ?>

</div>