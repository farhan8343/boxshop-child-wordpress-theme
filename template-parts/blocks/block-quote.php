<?php

$background = get_sub_field('background_image');
$quote = get_sub_field('quote');
$name = get_sub_field('name');

if(!empty($quote) || !empty($name)):
    echo '<div style="background: url('.$background.')" class="quote-section">';
        echo '<div class="quote">'.$quote.'</div>';
        echo '<div class="name">'.$name.'</div>';
    echo '</div>';

endif;