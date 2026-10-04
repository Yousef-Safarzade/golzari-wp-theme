<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class golzari_contact extends WP_Widget
{

    public function __construct() {

        parent::__construct(
            'golzari_contact',
            __('Golzari Contact Info', 'your-theme'),
        );

    }




    public function widget( $args, $instance ) {

        echo $args['before_widget'];


        if ( ! empty( $instance['address'] ) ) {

            printf("<div class='golzari-contact-info-item-container'>

                                <div class='golzari-contact-info-item-title-container'>
                                
                                    <span class='golzari-contact-info-item-icon'>%s</span>
                                    
                                    <p class='golzari-contact-info-item-title'>%s</p>
                                    
                                </div>
                                
                                <div class='golzari-contact-info-item-content-container'>
                                
                                    <p class='golzari-contact-info-item-content'>%s</p>
                                
                                </div>
        
                    </div>" , \src\GolzarHelper::print_svg(IMG_PATH . "/location.svg" , false ) , 'نشانی' , $instance['address']);


        }




        if ( ! empty( $instance['phone'] ) ) {

            printf("<div class='golzari-contact-info-item-container'>

                                <div class='golzari-contact-info-item-title-container'>
                                
                                    <span class='golzari-contact-info-item-icon'>%s</span>
                                    
                                    <p class='golzari-contact-info-item-title'>%s</p>
                                    
                                </div>
                                
                                <div class='golzari-contact-info-item-content-container'>
                                
                                    <p class='golzari-contact-info-item-content'>%s</p>
                                
                                </div>
        
                    </div>" , \src\GolzarHelper::print_svg(IMG_PATH . "/phone.svg" , false) , 'شماره تماس' , $instance['phone']);

        }



        echo $args['after_widget'];

    }




    public function form($instance) {

        $address = $instance['address'] ?? '';

        $phone = $instance['phone'] ?? '';


        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('address') ); ?>">
                Address
            </label>

            <input
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id('address') ); ?>"
                name="<?php echo esc_attr( $this->get_field_name('address') ); ?>"
                type="text"
                value="<?php echo esc_attr( $address ); ?>"
            />
        </p>


        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('phone') ); ?>">
                Phone
            </label>

            <input
                class="widefat"
                id="<?php echo esc_attr( $this->get_field_id('phone') ); ?>"
                name="<?php echo esc_attr( $this->get_field_name('phone') ); ?>"
                type="text"
                value="<?php echo esc_attr( $phone ); ?>"
            />
        </p>


        <?php


    }



    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['address'] = sanitize_text_field(
            $new_instance['address']
        );


        $instance['phone'] = sanitize_text_field(
            $new_instance['phone']
        );



        return $instance;
    }

}

add_action( 'widgets_init', function() {

    register_widget( 'golzari_contact' );


} );