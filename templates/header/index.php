<header class="golzari-header">

    <div class="golzari-header-container">

        <div class="golzari-header-logo">

            <?php echo get_custom_logo(); ?>

        </div>

        <div class="golzari-header-main-menu hidden-mobile hidden-tablet">

            <?php wp_nav_menu( array( 'theme_location' => 'primary_menu' ) ); ?>

        </div>

        <div class="golzari-header-meta-section">

            <?php get_template_part('/templates/header/section' , 'cart-icon'); ?>

            <?php get_template_part('/templates/header/section' , 'user-cta' ); ?>

            <?php get_template_part('/templates/header/section' , 'responsive-menu-button' ); ?>

        </div>

    </div>

    <?php get_template_part('/templates/header/section' , 'responsive-menu' ); ?>

</header>