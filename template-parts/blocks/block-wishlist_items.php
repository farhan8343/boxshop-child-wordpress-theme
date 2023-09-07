<?php 
$heading = get_sub_field('heading');
$products = array();//echo '<pre>'; print_r($wishlist); echo '</pre>';
if ( $wishlist && $wishlist->has_items() ) :
    foreach ( $wishlist_items as $item ) :
        $products[] = $item->get_product_id();
    endforeach;
endif;

if(!empty($products)):
    echo '<div class="wishlist-items-section"><h2>'.$heading.'</h2>';
    echo do_shortcode('[products ids="'.implode(",",$products).'"]');
    echo '</div>';
endif;