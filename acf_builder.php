<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<style>
    .page-container{
        padding-top:0px !important;
    }
    .back-to-all-wishlists{
        display:none !important;
    }
</style>
<?php
    
	$blocks = array(
        'slider_images',
        'image_blocks_with_separator',
        'quote',
        'heading',
        'half_image_and_text',
        'testimonials',
        'blog',
        'wishlist_items'
    ); 
    if(have_rows('acf_builder',$post_id)): 
        while(have_rows('acf_builder',$post_id)): the_row();
            $layout = get_row_layout();
            if(in_array(get_row_layout(), $blocks)){
                if($layout == 'wishlist_items'){ echo 'template-parts/blocks/block-'.$layout.'.php';
                    include('template-parts/blocks/block-'.$layout.'.php');
                }else{
                    get_template_part('template-parts/blocks/block', $layout);
                }
                
            }
        endwhile;
    endif;
?>
<script>
    if(jQuery('.swiper').length > 0){
        const swiper = new Swiper('.swiper', {
            speed: 400,
            spaceBetween: 0,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        // Listen for slideChange event
        swiper.on('slideChange', function () {
            // Reset zoom on all images
            document.querySelectorAll('.swiper-slide img').forEach(function (img) {
            img.classList.remove('zoomed');
            });

            // Apply zoom to the active slide's image
            var activeSlideImage = swiper.slides[swiper.activeIndex].querySelector('img');
            activeSlideImage.classList.add('zoomed');
        });
    }
    if(jQuery('.testimonial-section').length > 0){
        const swiperTestinomial = new Swiper('.testimonial-section', {
            slidesPerView: 1,
            speed: 400,
            spaceBetween: 0,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
			breakpoints: {
				
				767: {
				  slidesPerView: 2,
				}
			},
            pagination: {
                el: '.swiper-pagination', 
                clickable: true 
            },
        });
        
    }
</script>