<?php

class golzari_home_slider_widget extends \Elementor\Widget_Base {

    const CATEGORY = 'slider';


    public function get_name(): string {

        return 'home-slider';

    }

    public function get_title(): string {

        return esc_html( 'Home Slider' );

    }

    public function get_icon(): string {

        return 'eicon-posts-grid';

    }

    public function get_categories(): array {
        return [ self::CATEGORY ];
    }

    public function get_keywords(): array {

        return [ 'slider'  ];

    }



    public function get_script_depends(): array {

        return ['golzari-home-slider-script','golzari-flickity' , 'golzari-flickity-fade']  ;

    }

    public function get_style_depends(): array {

        return ['golzari-home-slider-style','golzari-flickity-style','golzari-flickity-fade-style']  ;


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


        for($i = 1; $i <= 5; $i++) {

            $this->add_control(
                    'title_'.$i,
                    [
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label' => esc_html__( 'Title ' . $i, 'textdomain' ),
                            'placeholder' => esc_html__( 'Enter your title', 'textdomain' ),
                    ]
            );


            $this->add_control(
                    'description_'.$i,
                    [
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label' => esc_html__( 'Description ' . $i, 'textdomain' ),
                            'placeholder' => esc_html__( 'Enter your title', 'textdomain' ),
                    ]
            );



            $this->add_control(
                    'cta_title_'.$i,
                    [
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label' => esc_html__( 'CTA Title ' . $i, 'textdomain' ),
                            'placeholder' => esc_html__( 'Enter your title', 'textdomain' ),
                    ]
            );


            $this->add_control(
                    'cta_link_'.$i,
                    [
                            'label' => esc_html__( 'CTA Link '. $i, 'textdomain' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'options' => [ 'url' ],
                            'default' => [
                                    'url' => '',
                                    'is_external' => false,
                                    'nofollow' => true,
                            ],

                    ]
            );



            $this->add_control(
                    'image_'.$i,
                    [
                            'label' => esc_html__( 'Image '. $i, 'textdomain' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'default' => [
                                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                            ],
                            'separator' => 'after',

                    ]
            );






        }



        $this->end_controls_section();





    }

    protected function render(): void {

        $settings = $this->get_settings_for_display();

        $this->render_home_slider($settings);



    }

    protected function content_template(): void {

        echo file_get_contents(WIDGETS_PATH . "/home-slider/content-template.html" );

    }






    private function render_home_slider($settings){

        ob_start();

        ?>

       <div class="golzari-home-slider-container">

           <div class="main-carousel">

               <?php for($i = 1; $i <= 5; $i++) {


                   $slide_settings = array(
                       'title' => $settings['title_'.$i],
                       'description' => $settings['description_'.$i],
                       'cta_title' => $settings['cta_title_'.$i],
                       'cta_link' => $settings['cta_link_'.$i],
                       'image' => $settings['image_'.$i],
                   );

                   if ( empty( $slide_settings['title'] ) ) {

                       continue;

                   }


                   printf('<div class="golzari-home-slider-item slide-%s">

                                        <div class="golzari-home-slider-item-inner">
                                        
                                                <div class="golzari-home-slider-item-content">
                                                
                                                    <h3 class="golzari-home-slider-item-title">%s</h3>
                                                    
                                                    <p class="golzari-home-slider-item-description">%s</p>
                                                    
                                                    <a class="golzari-home-slider-item-link" href="%s">
                                                    
                                                        <span class="golzari-home-slider-item-link-icon">%s</span>

                                                        <span class="golzari-home-slider-item-link-title">%s</span>
                                                        
                                                    </a>
                                                    
                                                </div>
                                            
                                                <div class="golzari-home-slider-item-image" style="background-image: url(%s);"></div>
                                                                                            
                                            </div>
                                        
                                        </div>' ,$i,  $slide_settings['title'] , $slide_settings['description'] , $slide_settings['cta_link']['url'] ,    \src\GolzarHelper::print_svg(IMG_PATH . "/basket.svg" , false ) , $slide_settings['cta_title'] , $slide_settings['image']['url']  );





               } ?>


           </div>

        </div>

        <?php

        echo ob_get_clean();
    }





}



add_action( 'wp_enqueue_scripts', function () {

    wp_register_script( 'golzari-flickity', JS_URL ."/flickity.pkgd.min.js" , ['jquery'] , THEME_VERSION , true );

    wp_register_script( 'golzari-flickity-fade', JS_URL ."/flickity-fade.min.js" , ['jquery','golzari-flickity'] , THEME_VERSION , true );

    wp_register_script( 'golzari-home-slider-script', WIDGETS_URL."/home-slider/scripts.min.js" , ['jquery'] , THEME_VERSION , true );




    wp_register_style( 'golzari-flickity-style' , CSS_URL ."/flickity.min.css" , [] , THEME_VERSION );

    wp_register_style( 'golzari-flickity-fade-style' , CSS_URL ."/flickity-fade.min.css" , [] , THEME_VERSION );

    wp_register_style( 'golzari-home-slider-style' , WIDGETS_URL."/home-slider/styles.min.css" , [] , THEME_VERSION );



});


