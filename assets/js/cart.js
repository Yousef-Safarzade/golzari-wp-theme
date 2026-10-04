jQuery(document).ready(function ($){


    handleSubmitCouponCodeButton();

    handleRemoveCouponCodeButtonClick();

    handleCartItemQunatityButtonsClick();







});



function handleSubmitCouponCodeButton(){


    if ( $(".golzari-coupon-code-submit").length < 1){

        return false;

    }


    $(".golzari-coupon-code-submit").on("click",function(e){

        e.preventDefault();

        let $button = $(this);

        let $input = $(".golzari-coupon-code-input");

        const inputValue = $input.val();

        console.log(inputValue);

        if ( inputValue !== '' ){

            $.ajax({

                url: wc_add_to_cart_params.ajax_url,

                type: 'POST',

                data: {

                    action: 'golzari_apply_coupon',

                    coupon_code: inputValue

                },

                beforeSend: function (){

                    $button.addClass('doing-ajax');

                },

                success: function(response) {

                    $button.removeClass('doing-ajax');

                    if (response.success) {

                        window.location.reload();

                    } else {


                        $.toast({
                            text: response.data.message,
                            heading: 'عملیات ناموفق بود',
                            showHideTransition: 'fade',
                            hideAfter: 5000,
                            position: 'bottom-right',
                            stack: false,
                            icon: 'error',
                            textAlign: 'right'

                        })


                    }
                }

            });





        }

    });

}




function handleRemoveCouponCodeButtonClick(){

    if ( $(".golzari-applied-coupons-item-remove").length < 1){

        return false;

    }


    $(".golzari-applied-coupons-item-remove").on("click",function (){

        let $button = $(this);

        let code = $(this).attr('data-code');

        if ( code !== ''){

            $.ajax({

                url: wc_add_to_cart_params.ajax_url,

                type: 'POST',

                data: {

                    action: 'golzari_remove_coupon_from_cart',

                    coupon_code: code

                },

                beforeSend: function (){

                    $button.addClass('doing-ajax');

                },

                success: function(response) {

                    $button.removeClass('doing-ajax');

                    if (response.success) {

                        window.location.reload();

                    } else {

                        console.log(response.data.message);

                    }
                }

            });

        }

    });



}



function handleCartItemQunatityButtonsClick(){

    if( $(".golzari-cart-item-quantity-input").length < 1){

        return false;

    }


    $(".golzari-cart-item-quantity-input .golzari-cart-item-quantity-input-button.increase").on("click",function (){

        const itemKey = $(this).closest(".golzari-cart-item").attr("data-cart-key");

        let $parent = $(this).closest(".golzari-cart-item-quantity-input");

        let $input = $parent.find(".golzari-cart-item-quantity-input-value");

        let currentValue = parseInt($input.val());

        let newValue = currentValue + 1;

        $parent.removeClass("single-quantity");

        $input.val(newValue);

        update_cart_item_quantity(itemKey,newValue);

    });



    $(".golzari-cart-item-quantity-input .golzari-cart-item-quantity-input-button.decrease").on("click",function (){


        const itemKey = $(this).closest(".golzari-cart-item").attr("data-cart-key");

        console.log(itemKey);

        let $parent = $(this).closest(".golzari-cart-item-quantity-input");

        let $input = $parent.find(".golzari-cart-item-quantity-input-value");

        let currentValue = parseInt($input.val());

        if( currentValue === 1){

            update_cart_item_quantity(itemKey,0);

            return false;

        }

        let newValue = currentValue - 1;

        if( newValue === 1){

            $parent.addClass("single-quantity");

        }

        $input.val(newValue);

        update_cart_item_quantity(itemKey,newValue);


    });


}



function update_cart_item_quantity(cartItemKey,quantity){



    $.ajax({
        url: wc_add_to_cart_params.ajax_url,
        type: 'POST',
        data: {
            action: 'golzari_update_cart_item_quantity',
            cart_item_key: cartItemKey,
            quantity: quantity
        },

        beforeSend : function(){

            $(".golzari-cart-content").addClass("doing-ajax");

        },
        success: function(response) {

            if (response.success) {

                $("#" + response.data.cart_item_key ).find(".golzari-cart-item-quantity-input-value").val(response.data.quantity);

                $(".golzari-cart-total-item.items-cost .golzari-cart-total-item-value").html(response.data.cart_total);

                $(".golzari-cart-total-item.tax-cost .golzari-cart-total-item-value").html(response.data.cart_tax);

                $(".golzari-cart-total-item.total-cost .golzari-cart-total-item-value").html(response.data.cart_total);

                if(response.data.quantity === 0 ){

                    $("#" + response.data.cart_item_key ).remove();

                }

                if( response.data.is_empty === true ){

                    window.location.reload();

                }

                $(".golzari-cart-content").removeClass("doing-ajax");


            } else {

                console.error(response.data.message);

                $(".golzari-cart-content").removeClass("doing-ajax");

            }

        },

        error: function(xhr) {

            console.error('AJAX error:', xhr);

        }
    });





}