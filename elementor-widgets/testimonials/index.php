<?php

class golzari_testimonials_widget extends \Elementor\Widget_Base {

    const CATEGORY = 'tickets';


    public function get_name(): string {

        return 'golzari_testimonials';

    }

    public function get_title(): string {

        return esc_html( 'Show Testimonials' );

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

        return ['golzari-testimonials-script' , 'golzari-flickity'];

    }

    public function get_style_depends(): array {

        return ['golzari-testimonials-style','golzari-flickity-style']  ;


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


        for($i = 1; $i <= 6; $i++) {

            $this->add_control(
                'author_'.$i,
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__( 'Author ' . $i, 'textdomain' ),
                    'placeholder' => esc_html__( 'Author Name', 'textdomain' ),
                ]
            );


            $this->add_control(
                'job_title_'.$i,
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__( 'Job Title ' . $i, 'textdomain' ),
                    'placeholder' => esc_html__( 'Job Title', 'textdomain' ),
                ]
            );


            $this->add_control(
                'content_'.$i,
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__( 'Content ' . $i, 'textdomain' ),
                    'placeholder' => esc_html__( 'Content', 'textdomain' ),
                ]
            );



            $this->add_control(
                'date_'.$i,
                [
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label' => esc_html__( 'Date ' . $i, 'textdomain' ),
                    'placeholder' => esc_html__( 'Date', 'textdomain' ),
                    'separator' => 'after',
                ]
            );


        }


        $this->end_controls_section();





    }

    protected function render(): void {

        $settings = $this->get_settings_for_display();

        $this->render_testimonials($settings);



    }

    protected function content_template(): void {

        echo file_get_contents(WIDGETS_PATH . "/testimonials/content-template.html" );

    }


    private function render_testimonials($settings){



        printf("<div class='golzari-testimonials-main-wrapper'>");

        printf("<div class='golzari-testimonial-main-header'>
                            
                            <div class='golzari-testimonial-main-title'>
                                %s
                            </div>
                            
                            <div class='golzari-testimonial-arrow-navigation'>
                                
                                <span class='golzari-testimonial-arrow prev-arrow'>
                                    %s
                                </span>
                                
                                <span class='golzari-testimonial-arrow next-arrow'>
                                    %s
                                </span>
                             
                            </div>

                        </div>",'نظرات بازدیدکنندگان', \src\GolzarHelper::print_svg(IMG_PATH . "/next-circle-arrow.svg" , false) , \src\GolzarHelper::print_svg(IMG_PATH . "/next-circle-arrow.svg" , false));

        printf("<div class='golzari-testimonials'>");

            for($i = 1; $i <= 6; $i++) {

                if( empty($settings['content_'.$i]) ){

                    continue;

                }

                $item = [
                   'author' => $settings['author_'.$i],
                   'job_title' => $settings['job_title_'.$i],
                   'content' => $settings['content_'.$i],
                   'date' => $settings['date_'.$i],
                ];

                $rating_string = '';


                for($r = 1; $r <= 6; $r++) {

                    $rating_string .= \src\GolzarHelper::print_svg(IMG_PATH . "/rating-star.svg", false);

                }



                printf("<div class='golzari-testimonials-item'>
                                    
                                    <div class='golzari-testimonial-header-section'>
                                    
                                        <div class='golzari-testimonial-author'>
                                        
                                            <span class='golzari-testimonial-author-name'>%s</span>
                                            
                                            <span class='golzari-testimonial-author-job-title'>%s</span>
                                            
                                        </div>
                                        
                                        <div class='golzari-testimonial-rating'>
                                        
                                            %s
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class='golzari-testimonial-content-section'>
                                        
                                        <p class='golzari-testimonial-content'>%s</p>
                                        
                                    </div>
                                    
                                    <div class='golzari-testimonial-footer-section'>
                                    
                                        <p class='golzari-testimonial-date'>%s</p>
                                    
                                    </div>

                                </div>" , $item["author"], $item["job_title"], $rating_string , $item["content"] , $item["date"]);

            }


        printf("</div>");

        printf("</div>");



    }




}



add_action( 'wp_enqueue_scripts', function () {

    wp_register_style( 'golzari-testimonials-style' , WIDGETS_URL."/testimonials/styles.min.css" , [] , THEME_VERSION );

    wp_register_script( 'golzari-testimonials-script' , WIDGETS_URL."/testimonials/scripts.min.js" , [] , THEME_VERSION );

    wp_register_script( 'golzari-flickity', JS_URL ."/flickity.pkgd.min.js" , ['jquery'] , THEME_VERSION , true );

    wp_register_style( 'golzari-flickity-style' , CSS_URL ."/flickity.min.css" , [] , THEME_VERSION );

});


