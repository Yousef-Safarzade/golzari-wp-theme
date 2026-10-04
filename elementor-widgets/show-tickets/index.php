<?php

class golzari_show_tickets_widget extends \Elementor\Widget_Base {

    const CATEGORY = 'tickets';


    public function get_name(): string {

        return 'show-tickets';

    }

    public function get_title(): string {

        return esc_html( 'Show Tickets' );

    }

    public function get_icon(): string {

        return 'eicon-posts-grid';

    }

    public function get_categories(): array {

        return [ 'woocommerce-elements' ];

    }

    public function get_keywords(): array {

        return [ 'ticket', 'woocommerce' , 'product' ];

    }



    public function get_script_depends(): array {

        return []  ;

    }

    public function get_style_depends(): array {

        return ['golzari-show-tickets-style']  ;


    }

    public function has_widget_inner_wrapper(): bool {

        return true;

    }

    protected function is_dynamic_content(): bool {

        return true;

    }

    protected function register_controls(): void {

        $this->start_controls_section(
            'content',
            [
                'label' => 'Settings',
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => 'Products',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 8,
                'min' => 1,
                'max' => 50,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => 'Columns',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 4,
                'options' => [
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                ],
            ]
        );

        $this->end_controls_section();





    }

    protected function render(): void {

        $settings = $this->get_settings_for_display();

        $tickets = $this->get_tickets_product($settings['posts_per_page']);

        $this->render_tickets($tickets, $settings);



    }

    protected function content_template(): void {

        echo file_get_contents(WIDGETS_PATH . "/show-tickets/content-template.html" );

    }



    private function get_tickets_product($count){

        $query_args = [
            'post_type' => 'product',
            'posts_per_page' => $count,
            'fields' => 'ids',
            'tax_query' => [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    =>  self::CATEGORY ,
                ]
            ]
        ];

        return get_posts($query_args);

    }



    private function render_tickets($tickets,$settings){

        if( empty( $tickets ) ){

            echo "<div class='no-ticket-found'>متاسفانه موردی برای نمایش وجود ندارد</div>";

            return;

        }

        $class = sprintf('golzari-show-tickets-container col-%s ',$settings['columns']);

        ob_start();

        ?>

       <div class="golzari-show-tickets-container col-4 <?php echo $class; ?>">

            <?php foreach ($tickets as $ticket) {

                $product = wc_get_product($ticket);

                $product_price = $product->get_price();

                $ticket_date = $product->get_meta('ticket_date');

                $product_data = [
                    'title'             => $product->get_title(),
                    'permalink'         => $product->get_permalink(),
                    'is_free'           => !$product_price || $product_price == 0,
                    'price'             => !$product_price || $product_price == 0  ? 'رایگان' : $product->get_price_html(),
                    'image'             => $product->get_image('full'),
                    'formatted_date'    => parsidate( 'l  j  M  Y', $ticket_date ),
                    'is_sold_out'       => $product->get_stock_status() === 'outofstock' ? true : false,
                    'is_coming_soon'    =>  $product->get_meta('coming_soon')

                ];



                $button_class = '';

                $button_class =   $product_data['is_free'] ? ' is-free ' : '' ;

                $button_class .=   $product_data['is_sold_out'] ? ' is-sold-out ' : '' ;

                $button_class .=   $product_data['is_coming_soon'] ? ' is-coming-soon ' : '' ;

                $product_data['button_class'] = $button_class ;

                if ( $product_data['is_coming_soon'] ){

                    $button_title = 'به زودی';

                } else {


                    if ( $product_data['is_sold_out'] ){

                        $button_title = 'اتمام ظرفیت';

                    } else if ( $product_data['is_free'] ){

                        $button_title = 'رایگان';

                    } else {

                        $button_title = 'خرید بلیط';

                    }

                }



                $product_data['button_title'] = $button_title;

                get_template_part('elementor-widgets/show-tickets/content-template' , '' , $product_data);

             } ?>

        </div>

        <?php

        echo ob_get_clean();
    }





}



add_action( 'wp_enqueue_scripts', function () {

    wp_register_style( 'golzari-show-tickets-style' , WIDGETS_URL."/show-tickets/styles.min.css" , [] , THEME_VERSION );

});


