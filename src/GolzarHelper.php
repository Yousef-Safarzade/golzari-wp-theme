<?php

namespace src;

class GolzarHelper
{


    public static function print_svg($path , $echo = true)
    {

        if (!is_readable($path) || pathinfo($path, PATHINFO_EXTENSION) !== 'svg') {
            return;
        }


        if($echo){

            echo file_get_contents($path);

        } else {

            return file_get_contents($path);


        }

    }



    public static function englishToPersianNumber($input)
    {

        var_dump($input);

        return strtr($input, [
            '0' => '۰',
            '1' => '۱',
            '2' => '۲',
            '3' => '۳',
            '4' => '۴',
            '5' => '۵',
            '6' => '۶',
            '7' => '۷',
            '8' => '۸',
            '9' => '۹',
        ]);

    }




}