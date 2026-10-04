<?php

$theme = wp_get_theme();

define('WEBSITE_URL', get_site_url() );

define('GENERATE_ORDER_PDF_URL' , WEBSITE_URL . "?generate_order_pdf");

define( 'THEME_PATH', get_template_directory() );

define( 'THEME_URL', get_template_directory_uri() );

define( 'CHILD_THEME_PATH', get_stylesheet_directory() );

define( 'CHILD_THEME_URL', get_stylesheet_directory_uri() );

define( 'WIDGETS_PATH', CHILD_THEME_PATH . '/elementor-widgets' );

define( 'WIDGETS_URL', CHILD_THEME_URL . '/elementor-widgets' );

define( 'ASSETS_PATH', CHILD_THEME_PATH . '/assets' );

define( 'ASSETS_URL', CHILD_THEME_URL . '/assets' );

define( 'CSS_PATH', ASSETS_PATH . '/css' );

define( 'CSS_URL', ASSETS_URL . '/css' );

define( 'JS_PATH', ASSETS_PATH . '/js' );

define( 'JS_URL', ASSETS_URL . '/js' );

define( 'IMG_PATH', ASSETS_PATH . '/images' );

define( 'IMG_URL', ASSETS_URL . '/images' );

define( 'FONT_PATH', ASSETS_PATH . '/fonts' );

define( 'FONT_URL', ASSETS_URL . '/fonts' );

define( 'ICON_PATH', ASSETS_PATH . '/icons' );

define( 'ICON_URL', ASSETS_URL . '/icons' );

define( 'INC_PATH', CHILD_THEME_PATH . '/inc' );

define( 'TEMPLATE_PATH', CHILD_THEME_PATH . '/templates' );

define( 'LANG_PATH', CHILD_THEME_PATH . '/languages' );

define( 'THEME_VERSION', $theme->get( 'Version' ) );