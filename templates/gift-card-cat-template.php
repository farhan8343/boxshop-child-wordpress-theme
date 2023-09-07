<?php
/**
 *	Template Name: Gift card Template
 */	
get_header();
?>
<div class="page-container show_breadcrumb_v2 cstm-gift-parent">
    <div id="main-content" class="ts-col-24">
        <div class="woocommerce columns-4">
            
            <?php
                $paged= (get_query_var('paged' )) ? get_query_var('paged'):1;
                $per_page    = 48;                
                $cat_args = array(
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'hide_empty' => false,
                    'meta_query' => array(
                        array(
                            'key'     => 'gift_card_cat',     // Adjust to your needs!
                            'value'   => 'yes',   // Adjust to your needs!
                            'compare' => '=',         // Default
                        )
                    )
                );
                $number_of_series = count(get_terms( 'product_cat', $cat_args ));
                $offset      = $per_page * ( $paged - 1);
                $cat_args = array(
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'offset'       => $offset,
                    'number'       => $per_page,
                    'hide_empty' => false,
                    'meta_query' => array(
                        array(
                            'key'     => 'gift_card_cat',     // Adjust to your needs!
                            'value'   => 'yes',   // Adjust to your needs!
                            'compare' => '=',         // Default
                        )
                    )
                );
            
                $product_categories = get_terms( 'product_cat', $cat_args );
                if(!empty($product_categories)){
                    foreach ( $product_categories as $category ) {
                        $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                        $image_url = wp_get_attachment_url( $thumbnail_id );
                        ?>
                        <section class="product type-product post-8585 status-publish first instock product_cat-laptops-computers shipping-taxable purchasable product-type-simple">
                            <a href="<?=esc_url( get_category_link( $category->term_id ) )?>" class="gift-card-link">
                                <div class="product-wrapper">
                                    <div class="image-wrap">
                                        <img src="<?=$image_url?>" alt="<?=esc_html( $category->name )?>">
                                    </div>
                                    <div class="cat-name-content-container">
                                        <div class="cat-name-content">
                                            <h2><?=esc_html( $category->name )?></h2>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <?php
                    }
                }

                echo '<br />';
                echo '<nav class="ts-pagination">';
                $big = 999999;
                    echo paginate_links( array(
                        'base'         	=> esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) )
                        ,'format'       => ''
                        ,'add_args'     => ''
                        ,'current'      => max( 1, $paged )
                        ,'total'        => ceil( $number_of_series / $per_page )
                        ,'prev_text'    => '&larr;'
                        ,'next_text'    => '&rarr;'
                        ,'type'         => 'list'
                        ,'end_size'     => 3
                        ,'mid_size'     => 3
                    ) );
                echo '</nav>';
                // echo paginate_links( array(
                //     'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                //     'format'  => '?paged=%#%',
                //     'current' => $paged,
                //     'total'   => ceil( $number_of_series / $per_page ) // 3 items per page
                // ) );
            ?>
        </div>
    </div>
</div>
<?php
get_footer();