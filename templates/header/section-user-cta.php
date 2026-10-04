<?php

if ( get_current_user_id() ) { ?>


    <?php

    $current_user = wp_get_current_user();


    $user_drop_down_items = array(
        'dashboard' => array('label' => 'حساب کاربری' , 'icon' => 'dashboard-profile.svg' , 'url' =>  get_permalink( get_option('woocommerce_myaccount_page_id') ) ),
        'orders' => array('label' => 'تراکنش ها' , 'icon' => 'dashboard-orders.svg' , 'url' => wc_get_account_endpoint_url( get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' ) ) ),
        'edit-account' => array('label' => 'ویرایش اطلاعات' , 'icon' => 'dashboard-edit-account.svg' , 'url' => wc_get_account_endpoint_url( get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' ) )  ),
        'customer-logout' => array('label' => 'خروج' , 'icon' => 'dashboard-logout.svg' , 'url' => wc_get_account_endpoint_url( get_option( 'woocommerce_logout_endpoint', 'customer-logout' ) ) ),
    );

    ?>

    <div class="golzari-header-user-info-cta logged-in">

        <div class="golzari-header-user-info-cta-icon">

            <?php \src\GolzarHelper::print_svg(IMG_PATH . "/dashboard-profile.svg"); ?>

        </div>

        <div class="golzari-header-user-info-cta-arrow">

            <?php \src\GolzarHelper::print_svg(IMG_PATH . "/arrow-down.svg"); ?>

        </div>

        <div class="golzari-header-user-info-drop-down">

            <ul class="golzari-header-user-info-drop-down-list">

                    <?php foreach ($user_drop_down_items as $item){ ?>

                        <li class="golzari-header-user-info-drop-item">

                            <a class="golzari-header-user-info-drop-item-link" href="<?php echo $item['url']; ?>">

                                <span class="golzari-header-user-info-drop-down-icon">

                                    <?php \src\GolzarHelper::print_svg(IMG_PATH . "/" . $item['icon'] , true); ?>

                                </span>

                                <span class="golzari-header-user-info-drop-down-ititle"><?php echo $item['label'] ?></span>

                            </a>


                        </li>

                    <?php } ?>

            </ul>

        </div>

    </div>

<?php } else { ?>

    <div class="golzari-header-user-info-cta guest-mode">

        <div class="golzari-header-user-info-cta-icon">

            <?php \src\GolzarHelper::print_svg(IMG_PATH . "/dashboard-profile.svg"); ?>

        </div>

        <div class="golzari-header-user-info-cta-text">

            <a href="?login=true" class="digits-login-modal">

                ورود / ثبت نام

            </a>

            
        </div>

        </div>

    </div>

<?php }