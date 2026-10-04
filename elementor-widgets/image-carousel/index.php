<?php

class golzari_image_carousel extends \Elementor\Widget_Base {

    const CATEGORY = 'tickets';


    public function get_name(): string {

        return 'golzari_image_carousel';

    }

    public function get_title(): string {

        return esc_html( 'Show Image Carousel' );

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

        return ['golzari-lightbox','golzari-image-carousel-script' , 'golzari-flickity' ];

    }

    public function get_style_depends(): array {

        return ['golzari-image-carousel-style','golzari-flickity-style' , 'golzari-lightbox-style']  ;


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
            'main_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Main Title' . $i, 'textdomain' ),
                'placeholder' => esc_html__( 'Enter your title', 'textdomain' ),
            ]
        );


        for($i = 1; $i <= 10; $i++) {

            $this->add_control(
                'image_'.$i,
                [
                    'label' => esc_html__( 'Image '. $i, 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => '',
                    ],
                    'separator' => 'after',

                ]
            );


        }


        $this->end_controls_section();





    }

    protected function render(): void {

        $settings = $this->get_settings_for_display();

        $this->render_image_carousel($settings);



    }

    protected function content_template(): void {

        echo file_get_contents(WIDGETS_PATH . "/testimonials/content-template.html" );

    }


    private function render_image_carousel($settings){



        printf("<div class='golzari-image-carousel-main-wrapper'>");

        printf("<div class='golzari-image-carousel-main-header'>
                            
                            <div class='golzari-image-carousel-main-title'>
                                %s
                            </div>
                            
                            <div class='golzari-image-carousel-arrow-navigation'>
                                
                                <span class='golzari-image-carousel-arrow prev-arrow'>
                                    %s
                                </span>
                                
                                <span class='golzari-image-carousel-arrow next-arrow'>
                                    %s
                                </span>
                             
                            </div>

                        </div>",$settings['main_title'], \src\GolzarHelper::print_svg(IMG_PATH . "/next-circle-arrow.svg" , false) , \src\GolzarHelper::print_svg(IMG_PATH . "/next-circle-arrow.svg" , false));

        printf("<div class='golzari-image-carousel-images'>");

            for($i = 1; $i <= 10; $i++) {

                if( empty($settings['image_'.$i]['url']) ) {

                    continue;

                }

                printf("<a class='golzari-image-carousel-item' style='background-image: url(%s)' data-lightbox='gallery' href='%s'></a>" , $settings['image_'.$i]['url'] , $settings['image_'.$i]['url'] );


            }


        printf("</div>");

        printf("</div>");



    }




}



add_action( 'wp_enqueue_scripts', function () {

    wp_register_style( 'golzari-image-carousel-style' , WIDGETS_URL."/image-carousel/styles.min.css" , [] , THEME_VERSION );

    wp_register_script( 'golzari-image-carousel-script' , WIDGETS_URL."/image-carousel/scripts.min.js" , ['golzari-flickity' , 'golzari-lightbox' ] , THEME_VERSION );

    wp_register_script( 'golzari-flickity', JS_URL ."/flickity.pkgd.min.js" , ['jquery'] , THEME_VERSION , true );

    wp_register_script( 'golzari-lightbox', JS_URL ."/lightbox3.min.js" , ['jquery'] , THEME_VERSION , true );

    wp_register_style( 'golzari-flickity-style' , CSS_URL ."/flickity.min.css" , [] , THEME_VERSION );

    wp_register_style( 'golzari-lightbox-style' , CSS_URL ."/lightbox3.css" , [] , THEME_VERSION );

});


