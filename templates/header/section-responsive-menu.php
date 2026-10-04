<div class="responsive-menu hidden-desktop">

    <div class="responsive-menu-container">

        <div class="responsive-menu-top-section">

            <div class="responsive-menu-logo">

                <?php echo get_custom_logo(); ?>

            </div>

            <div class="responsive-menu-close-button">

                <?php \src\GolzarHelper::print_svg(IMG_PATH . "/close-responsive-menu.svg" ); ?>

            </div>

        </div>

        <div class="responsive-menu-bottom-section">

            <?php wp_nav_menu(
                    array(
                            'theme_location' => 'primary_menu' ,
                            'after' => sprintf('<span class="responsive-menu-item-arrow">%s</span>' , \src\GolzarHelper::print_svg(IMG_PATH . "/arrow-down.svg"  , false) ),
                    )
            ); ?>

        </div>

    </div>

</div>