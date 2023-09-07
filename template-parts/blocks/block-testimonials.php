<?php 

$background = get_sub_field('background_image');
$heading = get_sub_field('heading');

if(have_rows('quotes')):
    echo '<div style="background: url('.$background.')" class="testimonial-section"><h2>'.$heading.'</h2><div class="swiper-wrapper">';

        while(have_rows('quotes')): the_row();
            echo '<div class="swiper-slide testimonial-slide">';
                echo '<div class="quote">'.get_sub_field("quote").'</div>';
                echo '<div class="name">'.get_sub_field("name").'</div>';
            echo '</div>';
        endwhile;
    echo '</div><div class="swiper-pagination"></div></div>';
endif;