<?php
/**
 *	Template Name: Careers Template
 */	
global $boxshop_page_datas, $boxshop_theme_options;
get_header();

$extra_class = "";

$page_column_class = boxshop_page_layout_columns_class($boxshop_page_datas['ts_page_layout']);

$show_breadcrumb = ( !is_home() && !is_front_page() && isset($boxshop_page_datas['ts_show_breadcrumb']) && absint($boxshop_page_datas['ts_show_breadcrumb']) == 1 );
$show_page_title = ( !is_home() && !is_front_page() && absint($boxshop_page_datas['ts_show_page_title']) == 1 );

if( ($show_breadcrumb || $show_page_title) && isset($boxshop_theme_options['ts_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$boxshop_theme_options['ts_breadcrumb_layout'];
}

boxshop_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());
	
?>
<div class="page-template blog-template page-container container-post <?php echo esc_attr($extra_class) ?> blog-list-style">
	<!-- Page slider -->
	<?php if( $boxshop_page_datas['ts_page_slider'] && $boxshop_page_datas['ts_page_slider_position'] == 'before_main_content' ): ?>
	<div class="top-slideshow">
		<div class="top-slideshow-wrapper">
			<?php boxshop_show_page_slider(); ?>
		</div>
	</div>
	<?php endif; ?>

	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
		<?php if( is_active_sidebar($boxshop_page_datas['ts_left_sidebar']) ): ?>
			<?php dynamic_sidebar( $boxshop_page_datas['ts_left_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>			
	
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
		<div class="filters">
			<form method="get" action="" id="category-filter-form">
				<?php 
				$applied_filter = '';
				$terms = get_terms( array(
					'taxonomy' => 'career-category',
					'hide_empty' => false,
				) );
				$choices = array();
				foreach ( $terms as $term ) {
					
					if($term->slug == $_GET['career-category']){
						$applied_filter = $term->name;
						$choices[] = array(
							'text' => $term->name,
							'value' => $term->slug,
							'selected' => 'selected="selected"'
						);
					}else{
						$choices[] = array(
							'text' => $term->name,
							'value' => $term->slug,
							'selected' => ''
						);
					}
				}
				?>
				<select name="career-category" id="careers-categories">
					<option value="">Filter by Category</option>
					<?php 
						foreach($choices as $term){
							printf('<option %s value="%s">%s</option>',$term['selected'],$term['value'],$term['text']);
						}
					?>
				</select>
				<input type="submit" value="Filter">
				<?php if(isset($_GET['career-category']) && !empty($_GET['career-category'])){ ?>
				<input type="button" value="Clear Filter" onclick="clearForm()">
				<?php } ?>
			</form>
			<?php if(isset($_GET['career-category']) && !empty($_GET['career-category'])){ ?>
				<div class="current-filter"> Showing result for category <span>"<?php echo $applied_filter; ?>"</span> </div>
			<?php } ?>
			<script>
				
				function clearForm() {
					document.getElementById("category-filter-form").reset();  // Reset form values
					window.location.href = window.location.pathname;  // Clear URL parameters
				}
				
			</script>

		</div>
		<div id="primary" class="site-content blog-list-style">
			
			<?php if( get_the_content() ): ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
			<?php endif; ?>
			
			<?php	
				$paged = 1;
				if( is_paged() ){
					$paged = get_query_var('page');
					if( !$paged ){
						$paged = get_query_var('paged');
					}
				}
				$args = array('post_type'=>'careers', 'paged'=>$paged);

				if(isset($_GET['career-category']) && !empty($_GET['career-category'])){
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'career-category',  
							'field' => 'slug',
							'terms' => $_GET['career-category'],  
						)
					);
				}
				$posts = new WP_Query( $args );
				if( $posts->have_posts() ):
					echo '<div class="list-posts herehere">';
					while( $posts->have_posts() ) : $posts->the_post();
						get_template_part( 'careers-content', get_post_format() ); 
					endwhile;
					echo '</div>';
					
					wp_reset_postdata();
				else:
					echo '<div style="margin: 50px 0px; text-align:center;" class="alert alert-error">'.esc_html__('Sorry. There are no careers to display', 'boxshop').'</div>';
				endif;
				
				boxshop_pagination($posts);
			?>

		</div>
	</div>
	
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
		<?php if( is_active_sidebar($boxshop_page_datas['ts_right_sidebar']) ): ?>
			<?php dynamic_sidebar( $boxshop_page_datas['ts_right_sidebar'] ); ?>
		<?php endif; ?>
		</aside>
	<?php endif; ?>	
		
</div><!-- #container -->
<?php get_footer(); ?>