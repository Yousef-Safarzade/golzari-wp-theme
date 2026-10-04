<?php

namespace src;

use Liquid\Template;

class GolzariSingleTicket
{



    public static function get_single_ticket_data(){

        global $product;

        $product_data = [];

        $product_data['product_title'] = $product->get_title();

        $product_data['description'] = $product->get_description();

        $product_data['price'] = $product->get_price_html();

        $product_data['cart_url'] = $product->add_to_cart_url();

        $product_data['stock_status'] = $product->get_stock_status();

        $product_data['is_available'] = $product_data['stock_status'] == 'instock';

        $product_data['remaining_seats'] = $product->get_stock_quantity();

        $product_data['total_seats'] = $product->get_meta('number_of_seats');

        $product_data['should_show_seats'] = (int)$product_data['total_seats'] > (int)$product_data['remaining_seats'];

        $product_data['ticket_date'] = $product->get_meta('ticket_date');

        $product_data['is_coming_soon'] = $product->get_meta('coming_soon');

        $product_data['ticket_time'] = $product->get_meta('ticket_time');

        $product_data['ticket_location'] = $product->get_meta('ticket_location');

       $product_data['map_iframe'] = $product->get_meta('neshan_map_iframe');

       $product_data['classes'] = implode(" " , wc_get_product_class( '', $product ) );

       $product_data['thumbnail'] = get_the_post_thumbnail_url( $product->get_id(), 'full' );

       $product_data['is_free'] = $product->get_price() < 1;

       $product_data['free_seats'] = $product->get_meta('free_seats');

       return $product_data;


    }




    public static function sanatize_neshan_map_iframe($map_string){

        if( empty($map_string) ){

            return '';

        }

        $dom = new \DOMDocument();

        libxml_use_internal_errors(true);

        $dom->loadHTML($map_string, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        libxml_clear_errors();

        $iframe = $dom->getElementsByTagName('iframe')->item(0);

        if ($iframe) {

            $iframe->removeAttribute('width');

            $iframe->removeAttribute('height');
        }

        return $dom->saveHTML();

    }







    public static function generate_ticket_pdf($ticket_data) : void{

        $template_content = self::read_ticket_template_file_content();

        if ( empty($template_content) ){

            return;

        }

        $template = new Template();

        $template->parse($template_content);

        $pdf_content = $template->render($ticket_data);

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();

        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();

        $fontData = $defaultFontConfig['fontdata'];


        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                CHILD_THEME_PATH . '/assets/fonts/',
            ]),
            'fontdata' => $fontData + [ // lowercase letters only in font key
                    'vazirmatn' => [
                        'R' => 'IRYekan.ttf',
                        'I' => 'IRYekan.ttf',
                        'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
                        'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
                    ]
                ],
            'default_font' => 'vazirmatn'
        ]);


        $mpdf->WriteHTML($pdf_content);

        $mpdf->Output();

    }





    public static function read_ticket_template_file_content(){

        $content = file_get_contents(TEMPLATE_PATH . '/ticketPDF/ticket_template.liquid');

        return !$content ? false : $content;


    }


}