<?php 
global $boxshop_theme_options, $post;

get_header();
$expiry = get_post_meta( get_the_ID(), '_careers_expiry_date', true ); 
$date_format = get_option( 'date_format' );
$expiry_date_formatted = '';
if ( ! empty( $expiry ) ) {
	$expiry_formatted = date_i18n( $date_format, strtotime( $expiry ) );
}
$time = strtotime($expiry_formatted);
$current_time = strtotime(date($date_format)); //echo $time; echo '<br>' . $current_time; 

$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */
$show_blog_thumbnail = $boxshop_theme_options['ts_blog_details_thumbnail'];
$extra_class = "";
$page_column_class = boxshop_page_layout_columns_class($boxshop_theme_options['ts_blog_details_layout']);

boxshop_breadcrumbs_title(true, $boxshop_theme_options['ts_blog_details_title'], get_the_title());
if(isset($boxshop_theme_options['ts_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$boxshop_theme_options['ts_breadcrumb_layout'];
}

if( $post_format == 'gallery' ){
	$gallery = get_post_meta($post->ID, 'ts_gallery', true);
	$gallery_ids = explode(',', $gallery);
	if( is_array($gallery_ids) && has_post_thumbnail() ){
		array_unshift($gallery_ids, get_post_thumbnail_id());
	}
	
	if( !has_post_thumbnail() && empty($gallery) ){
		$show_blog_thumbnail = 0;
	}
}

if( ($post_format === false || $post_format == 'standard') && !is_singular('ts_feature') ){
	if( !has_post_thumbnail() ){
		$show_blog_thumbnail = 0;
	}
}
?>
<div id="content" class="page-container container-post <?php echo esc_attr($extra_class) ?>">
	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
		<?php if( is_active_sidebar($boxshop_theme_options['ts_blog_details_left_sidebar']) ): ?>
			<?php dynamic_sidebar( $boxshop_theme_options['ts_blog_details_left_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
	<!-- end left sidebar -->
	
	<!-- main-content -->
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">
		<article class="single single-post career">
			<!-- Blog Thumbnail -->
			<?php /* if( $show_blog_thumbnail ): ?>
				<div class="entry-format">
					<?php if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){ ?>
						<figure class="<?php echo ('gallery' == $post_format)?'gallery loading':'' ?>">
							<?php 
							
							if( $post_format == 'gallery' ){
								foreach( $gallery_ids as $gallery_id ){
									echo wp_get_attachment_image( $gallery_id, 'boxshop_blog_thumb', 0, array('class' => 'thumbnail-blog') );
								}
							}
						
							if( ($post_format === false || $post_format == 'standard') && !is_singular('ts_feature') ){
								the_post_thumbnail('boxshop_blog_thumb', array('class' => 'thumbnail-blog'));
							}
							
							?>
						</figure>
					<?php 
					}
					
					if( $post_format == 'video' ){
						$video_url = get_post_meta($post->ID, 'ts_video_url', true);
						if( $video_url != '' ){
							echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
						}
					}
					
					if( $post_format == 'audio' ){
						$audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
						if( strlen($audio_url) > 4 ){
							$file_format = substr($audio_url, -3, 3);
							if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
								echo do_shortcode('[audio '.$file_format.'="'.esc_url($audio_url).'"]');
							}
							else{
								echo do_shortcode('[ts_soundcloud url="'.esc_url($audio_url).'" width="100%" height="166"]');
							}
						}
					}

					?>
				</div>
			<?php endif; */ ?>
			<div class="entry-content <?php echo !$show_blog_thumbnail?'no-thumbnail':'' ?>">
			<div class="entry-content <?php echo !$show_blog_thumbnail?'no-featured-image':'' ?>">
			
			<div class="entry-info">
				<!-- Blog Title -->
				<?php if( $boxshop_theme_options['ts_blog_title'] ): ?>
				<header>
					<h3 class="heading-title entry-title">
						<?php the_title(); ?> <?php if($time > $current_time || $time == $current_time ): echo '<div class="status open">Open</div>'; else:  echo '<div class="status closed">Closed</div>';  endif; ?>
					</h3>
				</header>
				<?php endif; ?>
				
					<div class="entry-meta <?php echo esc_attr($boxshop_theme_options['ts_blog_date']?'has-datetime':''); ?> <?php echo esc_attr($boxshop_theme_options['ts_blog_author']?'has-author':''); ?>">
					
					
						<div class="published-on">
							<span><strong>Published on: </strong><span><?php the_date(); ?></span></span>
						</div>

						<!-- Last Date for to Apply -->
						<span class="last-date-apply">
							<strong>Expiry date:</strong> 
							<?php 
								echo $expiry_formatted;
							?>
						</span>

						<!-- Blog Author -->
						<?php /* if( $boxshop_theme_options['ts_blog_author'] ): ?>
							<span class="vcard author"><strong><?php esc_html_e('Post by ', 'boxshop'); ?></strong><?php the_author_posts_link(); ?></span>
						<?php endif; */ ?>
						
						
						<!-- Blog view -->
						<?php if( $boxshop_theme_options['ts_blog_view'] && function_exists('ts_post_view_count') ): ?>
						<span class="view-count">
							<i class="pe-7s-look"></i>
							<span class="number">
								<?php echo get_careers_views($post->ID); ?>
							</span>
						</span>
						<?php endif; ?>
					
					
				
					</div>
				
				
			
			
			<?php
			$categories_list = get_the_category_list(', ');
			if ( ($categories_list && $boxshop_theme_options['ts_blog_categories']) || $boxshop_theme_options['ts_blog_read_more']): 
			?>
			<div class="entry-bottom">
				
				
				<!-- Blog Categories -->
				<?php 
				if ($categories_list && $boxshop_theme_options['ts_blog_categories']): ?>
				<div class="cats-link">
					<span><?php esc_html_e('Categories: ', 'boxshop'); ?></span>
					<span class="cat-links"><?php echo trim($categories_list); ?></span>
				</div>
				<?php endif; ?>
			</div>
			
			<?php endif; ?>
			
	
				
				<!-- Blog Content -->
				<?php if( $boxshop_theme_options['ts_blog_details_content'] ): ?>
				<div class="content-wrapper">
				<div class="job-description"><strong>Job details:</strong></div>
					<div class="full-content"><?php the_content(); ?></div>
					<?php wp_link_pages(); ?>
				</div>
				<?php endif; ?>
				<div class="apply-form-wrapper">
				<?php 
					if($time > $current_time || $time == $current_time ){
						echo '<div class="apply-form">Apply Now</div><div style="display:none;" class="form">';
							echo do_shortcode("[gravityform id='2' title='false' description='false' ajax='true']");
						echo '</div>'; 
					}else{
						echo '<div class="closed-message">The job has been expired.</div>';
					}
				?>
				</div>

				<div class="meta-bottom-wrapper">
					<?php if( $boxshop_theme_options['ts_blog_details_categories'] != 0 || $boxshop_theme_options['ts_blog_details_sharing'] != 0 ): ?>
					<div class="meta-bottom-1 <?php echo esc_attr($boxshop_theme_options['ts_blog_details_categories']?'has-categories':''); ?> <?php echo esc_attr($boxshop_theme_options['ts_blog_details_sharing']?'has-social':''); ?>">
						<!-- Blog Categories -->
						<?php
						$categories_list = get_the_category_list(', ');
						if ( $categories_list && $boxshop_theme_options['ts_blog_details_categories'] ):
						?>
						<div class="cats-link">
							<span class="cat-title"><?php esc_html_e('Categories: ', 'boxshop'); ?></span>
							<span class="cat-links"><?php echo trim($categories_list); ?></span>
						</div>
						<?php endif; ?>
						
						<!-- Blog Sharing -->
						<?php if( $boxshop_theme_options['ts_blog_details_sharing'] && function_exists('ts_template_social_sharing') ): ?>
						<div class="social-sharing">
							<?php ts_template_social_sharing(); ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					
					<?php 
					$tags_list = get_the_tag_list('', ' '); 
					if ( $tags_list && $boxshop_theme_options['ts_blog_details_tags'] ):
					?>
					<div class="meta-bottom-2">
						<!-- Blog Tags -->
						<div class="tags-link">
							<span class="tag-links">
								<?php echo trim($tags_list); ?>
							</span>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- Blog Author -->
			<?php /* if( $boxshop_theme_options['ts_blog_details_author_box'] && get_the_author_meta('description') ) : ?>
			<div class="entry-author">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 100, 'mystery' ); ?>
				</div>	
				<div class="author-info">		
					<span class="author"><?php the_author_posts_link();?></span>
					<span class="role"><?php echo boxshop_get_user_role( get_the_author_meta('ID') ); ?></span>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div>
			</div>
			<?php endif; */ ?>	
			
			
			<!-- Next Prev Blog -->
			<div class="single-navigation">
			<?php
				// previous_post_link('%link', esc_html__('Prev post', 'boxshop'));
				// next_post_link('%link', esc_html__('Next post', 'boxshop'));
			?>
			</div>
			
			<!-- Related Posts-->
			<?php 
			// if( !is_singular('ts_feature') && $boxshop_theme_options['ts_blog_details_related_posts'] ){
			// 	get_template_part('templates/related-posts');
			// }
			?>
			
			
		</article>
	</div><!-- end main-content -->
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
		<?php if( is_active_sidebar($boxshop_theme_options['ts_blog_details_right_sidebar']) ): ?>
			<?php dynamic_sidebar( $boxshop_theme_options['ts_blog_details_right_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
	<!-- end right sidebar -->	
</div>
<script>
	jQuery('.apply-form').click(function(){
		jQuery(this).hide();
		jQuery(this).next().show();
	})

</script>
<?php get_footer(); ?>