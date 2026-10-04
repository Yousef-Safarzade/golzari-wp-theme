<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$viewport_content = apply_filters( 'hello_elementor_viewport_content', 'width=device-width, initial-scale=1' );

$enable_skip_link = apply_filters( 'hello_elementor_enable_skip_link', true );

$skip_link_url = apply_filters( 'hello_elementor_skip_link_url', '#content' );

?>

<!doctype html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php get_template_part('./templates/header/index'); ?>
