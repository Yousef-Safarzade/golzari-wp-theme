<a class="golzari-ticket-container <?php echo $args['button_class']; ?>" href="
	<?php echo $args['permalink'] ?>" title="
	<?php echo $args['title'] ?>">
    <div class="ticket-poster-container"> <?php echo $args['image'] ?> </div>
    <div class="ticket-meta-container">
        <p class="ticket-title"> <?php echo $args['title'] ?> </p>

        <?php if(!$args['is_coming_soon']){ ?>

            <p class="ticket-date"> <?php echo $args['formatted_date'] ?> </p>

        <?php } else { ?>

                    <p class="ticket-date"> به زودی </p>


        <?php } ?>
    </div>
    <div class="ticket-cta" >

        <span class="ticket-cta-title"> <?php echo $args['button_title']  ?> </span>

            <span class="ticket-cta-icon">

                <?php


                    if (!$args['is_free'] && !$args['is_sold_out'] && !$args['is_coming_soon']){

                      \src\GolzarHelper::print_svg(IMG_PATH . "/basket.svg");

                    } else if ($args['is_sold_out']){

                        \src\GolzarHelper::print_svg(IMG_PATH . "/close.svg");

                    } else if ($args['is_coming_soon']){

                        \src\GolzarHelper::print_svg(IMG_PATH . "/info.svg");


                    } ?>

            </span>

    </div>
</a>