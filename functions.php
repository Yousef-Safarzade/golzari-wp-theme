<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


require_once __DIR__ . '/vendor/autoload.php';



require_once get_stylesheet_directory() . '/src/constants.php';

require_once (CHILD_THEME_PATH . '/src/GolzariScripts.php');

require_once (CHILD_THEME_PATH . '/src/GolzarHelper.php');

require_once (CHILD_THEME_PATH . '/src/GolzariSingleTicket.php');

require_once (CHILD_THEME_PATH . '/src/GolzariWoocommerceHelper.php');

require_once (CHILD_THEME_PATH . '/footer-widgets/golzari_about.php');

require_once (CHILD_THEME_PATH . '/footer-widgets/golzari_contact.php');

require_once (CHILD_THEME_PATH . '/src/GolzariPdfHelper.php');


add_action('template_redirect',function(){

    if( !isset($_GET['generate_sample_pdf'])){

        return false;

    }

    $ticket_data = \src\GolzariWoocommerceHelper::return_order_data_for_pdf_generation("315");

    \src\GolzariSingleTicket::generate_ticket_pdf($ticket_data);
    
});








add_action( 'elementor/widgets/register', function ( $widgets_manager ) {

    require_once WIDGETS_PATH . '/show-tickets/index.php';

    $widgets_manager->register( new \golzari_show_tickets_widget() );

} );





add_action( 'elementor/widgets/register', function ( $widgets_manager ) {

    require_once WIDGETS_PATH . '/home-slider/index.php';

    $widgets_manager->register( new \golzari_home_slider_widget() );

} );



add_action( 'elementor/widgets/register', function ( $widgets_manager ) {

    require_once WIDGETS_PATH . '/testimonials/index.php';

    $widgets_manager->register( new \golzari_testimonials_widget() );

} );




add_action( 'elementor/widgets/register', function ( $widgets_manager ) {

    require_once WIDGETS_PATH . '/image-carousel/index.php';

    $widgets_manager->register( new \golzari_image_carousel() );

} );

























add_action( 'after_setup_theme', function(){

    register_nav_menus( array(
        'primary_menu' => __( 'Primary Menu', 'text_domain' ),
        'primary_menu_responsive'  => __( 'Primary Menu Responsive', 'text_domain' ),
    ) );


}, 0 );


function mytheme_register_footer_widgets() {

    $footers = [
        'Footer 1',
        'Footer 2',
        'Footer 3',
        'Footer 4'
    ];

    foreach ($footers as $index => $footer) {

        register_sidebar([
            'name'          => __($footer, 'mytheme'),
            'id'            => 'footer-' . ($index + 1),
            'description'   => __('Footer widget area', 'mytheme'),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="footer-widget-title">',
            'after_title'   => '</h3>',
        ]);

    }



}

add_action('widgets_init', 'mytheme_register_footer_widgets');



