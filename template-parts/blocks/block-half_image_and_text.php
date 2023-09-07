<?php

$image = get_sub_field('image');
$content = get_sub_field('content');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');
$image_position = get_sub_field('image_position');


if(!empty($image) || !empty($content) || !empty($button_text)):
    echo '<div class="half-image-section '.$image_position.'">';
        if(!empty($image)):
            echo '<div class="image-side"><img src="'.$image.'"></div>';
        endif;
        if(!empty($content) || !empty($button_text)):
            echo '<div class="content-side"><div class="content">'.$content.'</div>';
            if(!empty($button_text)):
                echo '<a class="btn btn-primary" href="'.$button_link.'">'.$button_text.'</a>';
            endif;
            echo '</div>';
        endif;
    echo '</div>';
endif;
