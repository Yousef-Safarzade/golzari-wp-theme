<?php

namespace src;

class GolzariScripts
{

    public function define_hooks(){

        add_action( 'wp_enqueue_scripts' , [$this,'load_main_styles'] );

        add_action( 'wp_enqueue_scripts', [$this,'load_single_ticket_product_scripts'] );

        add_action( 'wp_enqueue_scripts', [$this,'load_cart_page_scripts'] );

        add_action( 'wp_enqueue_scripts', [$this,'load_checkout_page_scripts'] );

        add_action( 'wp_enqueue_scripts', [$this,'load_my_account_scripts'] );

        add_action( 'wp_enqueue_scripts', [$this,'load_main_scripts'] );

        add_action( 'wp_enqueue_scripts', [$this,'load_thank_you_page_scripts'] );



    }




    public function load_main_styles() : void{

        wp_enqueue_style('hello-elementor-parent', THEME_URL . '/style.css', [], THEME_VERSION );

        wp_enqueue_style( 'golzari-main',  CSS_URL . "/main.min.css" ,  [ 'hello-elementor-parent' ], THEME_VERSION );

        wp_enqueue_style( 'golzari-art-theme',  get_stylesheet_uri(),  [ 'hello-elementor-parent' ], THEME_VERSION );






    }



    public function load_single_ticket_product_scripts(){


        if ( ! is_product() ) {
            return;
        }



        global $post;

        if ( ! has_term( 'tickets', 'product_cat', $post ) ) {

            return;

        }



        wp_enqueue_style(
            'golzari-tickets',
            CSS_URL . '/single-product-tickets.min.css',
            [],
            THEME_VERSION
        );


        wp_enqueue_style(
            'golzari-font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css',
            [],
            THEME_VERSION
        );


        wp_enqueue_script(
            'golzari-single-ticket',
            JS_URL . '/single-ticket.min.js',
            ['jquery'],
            THEME_VERSION,
            true
        );


        wp_localize_script('golzari-single-ticket', 'localizedData',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'cartUrl' => wc_get_cart_url(),
                'cartQuantity'=> \WC()->cart->get_cart_contents_count()
            )
        );



    }


    public function load_cart_page_scripts(){


        if ( get_page_template_slug() !== 'page-templates/cart.php' ) {
            return;
        }



        wp_enqueue_script(
            'golzari-toast',
            JS_URL . '/jquery.toast.min.js',
            ['golzari-jquery'],
            THEME_VERSION,
            true
        );


        wp_enqueue_script(
            'golzari-cart',
            JS_URL . '/cart.min.js',
            THEME_VERSION,
            true
        );


        wp_enqueue_style(
            'golzari-cart',
            CSS_URL . "/cart.min.css" ,
            [],
            THEME_VERSION
        );

        wp_enqueue_style(
            'golzari-toast',
            CSS_URL . "/jquery.toast.min.css" ,
            [],
            THEME_VERSION
        );


    }





    public static function load_checkout_page_scripts() {

        if( !is_checkout() || !empty( is_wc_endpoint_url('order-received') ) ) {

            return false;

        }


        wp_enqueue_style(
            'golzari-checkout',
            CSS_URL . '/checkout.min.css',
            [],
            THEME_VERSION
        );








    }


















    public function load_main_scripts(){

        wp_enqueue_script(
            'golzari-jquery',
            JS_URL . '/jquery.min.js',
            THEME_VERSION,
            true
        );


        wp_enqueue_script(
            'golzari-main',
            JS_URL . '/main.min.js',
            ['golzari-jquery'],
            THEME_VERSION,
            true
        );








        wp_localize_script('golzari-main', 'localizedData',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'cartUrl' => wc_get_cart_url(),
                'cartQuantity'=> \WC()->cart->get_cart_contents_count()
            )
        );


    }



    public function load_my_account_scripts(){

        global $wp;

        // If NOT My account dashboard page
        if( is_account_page()  ) {

            wp_enqueue_style(
                'golzari-my-account',
                CSS_URL . '/my-account.min.css',
                [],
                THEME_VERSION
            );

        }


    }




    public static function load_thank_you_page_scripts(){

        if ( is_checkout() && !empty( is_wc_endpoint_url('order-received') ) ) {


            wp_enqueue_style(
                'golzari-thank-you-page',
                CSS_URL . "/thank-you-page.min.css" ,
                [],
                THEME_VERSION
            );


            wp_enqueue_style(
                'golzari-checkout',
                CSS_URL . '/thankyou.min.css',
                [],
                THEME_VERSION
            );





        }



    }


}


add_action( 'after_setup_theme', function () {

    ( new \src\GolzariScripts() )->define_hooks();

});