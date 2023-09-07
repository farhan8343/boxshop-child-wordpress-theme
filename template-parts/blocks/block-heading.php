<?php 

$heading = get_sub_field('heading');
if(!empty($heading)):
    echo '<div class="heading-section"><h2>'.$heading.'</h2></div>';
endif;