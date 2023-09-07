<?php 
$separator = get_sub_field('separator_icon');
if(have_rows('image_blocks')):
    echo '<div class="image-blocks-section">';
    while(have_rows('image_blocks')): the_row();
        echo '<div class="image-block">';
        if(!empty(get_sub_field('image'))):
            echo '<img src="'.get_sub_field("image").'">';
        endif;
        if(!empty(get_sub_field('heading'))):
            echo '<h3>'.get_sub_field("heading").'</h3>';
        endif;
        if(!empty(get_sub_field('description'))):
            echo '<p>'.get_sub_field("description").'</p>';
        endif;
        if(have_rows('social_profiles')):
            echo '<ul class="social-profiles">';
                while(have_rows("social_profiles")): the_row();
                    echo '<li><a href="'.get_sub_field("link").'"><i class="fa fa-'.get_sub_field("platform").'"></i></a></li>';
                endwhile;   
            echo '</ul>';
        endif;
        echo '</div>';
    endwhile;
    echo '</div>';
endif;