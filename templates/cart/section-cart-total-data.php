<div class="golzari-cart-total-data">

    <div class="golzari-cart-total-item items-cost">

                                <span class="golzari-cart-total-item-label">

                                     مبلغ سبد خرید

                                </span>

        <span class="golzari-cart-total-item-value">


                                    <?php printf(" %s" , WC()->cart->get_total_ex_tax()  ) ?>

                                    <span class="golzari-cart-total-item-value-placeholder">

                                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/text-loading.svg"); ?>

                                    </span>

                                </span>

    </div>



    <div class="golzari-cart-total-item tax-cost">

                                <span class="golzari-cart-total-item-label">

                                   مالیات

                                </span>

        <span class="golzari-cart-total-item-value">

                                    <?php printf("%s %s" , number_format ( WC()->cart->get_total_tax() ), 'تومان' ) ?>

                                    <span class="golzari-cart-total-item-value-placeholder">

                                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/text-loading.svg"); ?>

                                    </span>

                                </span>

    </div>




    <div class="golzari-cart-total-item total-cost">

                                <span class="golzari-cart-total-item-label">

                                   مبلغ قابل پرداخت

                                </span>

        <span class="golzari-cart-total-item-value">


                                    <?php

                                    printf(" %s" , WC()->cart->get_total()  ) ?>

                                    <span class="golzari-cart-total-item-value-placeholder">

                                        <?php \src\GolzarHelper::print_svg(IMG_PATH . "/text-loading.svg"); ?>

                                    </span>

                                </span>

    </div>




</div>