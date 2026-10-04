jQuery(document).ready(function (){

    var elem = document.querySelector('.main-carousel');

    var flkty = new Flickity( elem, {

        autoPlay : 10000,

        fade: true,

        pageDots: true,

        contain: true,

        wrapAround: false

    });

})