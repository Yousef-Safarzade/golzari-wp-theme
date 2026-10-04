jQuery(document).ready(function($){


    startImageCarouselFlickity();



});


function startImageCarouselFlickity(){

    if( $(".golzari-image-carousel-images").length < 1 ){

        return false;

    }

    var $testimonialFlickity  = $(".golzari-image-carousel-images").flickity({
        pageDots: false,
        rightToLeft: true,
        prevNextButtons: false,
        groupCells: 1,
        contain: true,
        autoplay:5000,

    });


    $(".golzari-image-carousel-arrow.next-arrow").on("click",function (){

        $testimonialFlickity.flickity('next');

    });


    $(".golzari-image-carousel-arrow.prev-arrow").on("click",function (){

        $testimonialFlickity.flickity('previous');

    });




}