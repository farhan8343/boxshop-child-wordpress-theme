<?php
$heading = get_sub_field('slider_heading');
if(have_rows('slider_images')){
    echo '<div class="swiper image-slider-swipper"><div class="swiper-wrapper">';
    while(have_rows('slider_images')): the_row();
        echo '<div class="image-holder swiper-slide"><img src="'.get_sub_field("slider_image").'"><h2>'.$heading.'</h2></div>';
    endwhile;
    echo '</div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>';
}