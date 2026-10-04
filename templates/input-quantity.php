<div class="quantity" >

    <input type="hidden" name="savedValue">

    <button id="leftBtn" class="show-minus">

        <svg id="trash"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

            <path d="M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

        </svg>

        <svg id="minus"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

            <path d="M6 12L18 12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

        </svg>

    </button>

    <span id="value">1</span>

    <button id="plusBtn">

        <svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

            <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

        </svg>

    </button>

</div>



<style>

    .quantity {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 120px;
        height: 52px;
        background: transparent;
        border: 1px solid #F05537;
        border-radius: 8px;
        flex-direction: row-reverse;
        box-sizing: border-box;
        padding: 0 19px;
    }

    .quantity button {
        width: 16px;
        border: none;
        background: none;
        cursor: pointer;
        font-size: 16px;
        color: #F05537;
        align-items: center;
        justify-content: center;
        transition: .2s;
        padding: 0 !important;
        height: 100%;
        display: flex;


    }


    .quantity span {
        flex: 1;
        text-align: center;
        font-size: 14px;
        font-weight: 600;
        color: #F05537;
        user-select: none;
    }



    .quantity button svg{
        width: 16px;
        height: 16px;
    }


    .quantity button svg path{
       stroke: #F05537;
    }




    .show-trash  #minus{
        display: none
    }

    .show-trash  #trash{
        display: block
    }


    .show-minus  #trash{
        display: none
    }

    .show-minus  #minus{
        display: block
    }


    #value{

        padding: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        height: 100%;
        width: 16px;

    }

</style>





<script>

    const maxValue = <?php echo $args['max'] ?>

    const valueEl = document.getElementById('value');

    const leftBtn = document.getElementById('leftBtn');

    const plusBtn = document.getElementById('plusBtn');

    let value = 1;

    function render(){

        valueEl.innerHTML = value;

    }

    plusBtn.addEventListener('click', () => {

        if( value < maxValue ){

            value++;

            render();


        }

    });

    leftBtn.addEventListener('click', () => {

        if(value < 2){

            value = 1;

        }else{

            value--;

        }

        render();

    });

    render();
</script>