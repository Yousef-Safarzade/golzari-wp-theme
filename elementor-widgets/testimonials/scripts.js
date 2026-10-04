jQuery(document).ready(function($){


    startTestimonialFlickity();



});


function startTestimonialFlickity(){

    if( $(".golzari-testimonials").length < 1 ){

        return false;

    }

    var $testimonialFlickity  = $(".golzari-testimonials").flickity({
        draggable: true,
        pageDots: false,
        rightToLeft: true,
        contain:true,
        prevNextButtons: false,

    });


    $(".golzari-testimonial-arrow.next-arrow").on("click",function (){

        $testimonialFlickity.flickity('next');

    });


    $(".golzari-testimonial-arrow.prev-arrow").on("click",function (){

        $testimonialFlickity.flickity('previous');

    });




}