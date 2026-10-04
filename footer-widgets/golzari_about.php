<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class golzari_about extends WP_Widget
{

    public function __construct() {

        parent::__construct(
            'golzari_about',
            __('About Golzari Widget', 'your-theme'),
        );

    }




    public function widget( $args, $instance ) {

        echo $args['before_widget'];


        if ( ! empty( $instance['image_url'] ) ) {

            printf('<img src="%1$s" alt="%2$s" />', $instance['image_url'], $instance['title']);

        }


        if ( ! empty( $instance['title'] ) ) {

            printf("<p class='golzari-about-widget-title'>%s</p>", $instance['title']);

        }

        if ( ! empty( $instance['description'] ) ) {

            printf("<p class='golzari-about-widget-description'>%s</p>", $instance['description']);

        }

        echo $args['after_widget'];

    }




    public function form($instance) {

        $title = $instance['title'] ?? '';

        $image_url = $instance['image_url'] ?? '';

        $description = $instance['description'] ?? '';

        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
                Title
            </label>

            <input
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
                name="<?php echo esc_attr( $this->get_field_name('title') ); ?>"
                type="text"
                value="<?php echo esc_attr( $title ); ?>"
            />
        </p>


        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('description') ); ?>">
                Description
            </label>

            <input
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id('description') ); ?>"
                name="<?php echo esc_attr( $this->get_field_name('description') ); ?>"
                type="text"
                value="<?php echo esc_attr( $description ); ?>"
            />
        </p>



        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('description') ); ?>">
                Image URL
            </label>

            <input
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id('image_url') ); ?>"
                name="<?php echo esc_attr( $this->get_field_name('image_url') ); ?>"
                type="text"
                value="<?php echo esc_attr( $image_url ); ?>"
            />
        </p>

        <?php


    }



    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title'] = sanitize_text_field(
            $new_instance['title']
        );


        $instance['description'] = sanitize_text_field(
            $new_instance['description']
        );


        $instance['image_url'] = sanitize_text_field(
            $new_instance['image_url']
        );

        return $instance;
    }

}

add_action( 'widgets_init', function() {

    register_widget( 'golzari_about' );


} );