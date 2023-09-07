<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php global $boxshop_theme_options, $boxshop_page_datas; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php if( isset($boxshop_theme_options['ts_responsive']) && $boxshop_theme_options['ts_responsive'] == 1 ): ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
	<?php endif; ?>

	<link rel="profile" href="//gmpg.org/xfn/11" />
	<?php 
	boxshop_theme_favicon();
	wp_head(); 
	?>
</head>
<body <?php body_class(); ?>>
<?php 
if( function_exists('wp_body_open') ){
	wp_body_open();
}
?>
<?php echo '<div style="display:none;" class="hierarchical_term_menu remove"><div class="menu-header"><span class="back"><i class="fa fa-angle-left"></i></span><span class="logo"><img class="menu-logo" src="https://cutemesh.com/wp-content/uploads/2020/04/Cuemesh-logo.png"></span><span class="current"></span><span class="close">x</span></div><div class="category-menu">'.hierarchical_term_tree(). '</div></div>'; ?>	
<style>
    /* Styling for the loader */
    #loader {
		border: 5px solid #f3f3f3;
		border-top: 5px solid #3498db;
		border-radius: 50%;
		width: 60px;
		height: 60px; 
		animation: spin 2s linear infinite;
		position: fixed;
		left: 50%;
		top: 50%;
		transform: translate(-50%,-50%);
	}
	#loader-wrapper:before{
		content:'';
		width:100vw;
		height:100vh;
		display:block;
		position:fixed;
		top:0;
		left:0;
		background:white;
	}
		 #loader-wrapper{
			 position:fixed;
			 z-index:99999999;
		 }
    @keyframes spin {
      0% { transform:  translate(-50%,-50%) rotate(0deg); }
      100% { transform:  translate(-50%,-50%) rotate(360deg); }
    }
  </style>
	<div id="loader-wrapper">
		<div id="loader"></div>
	</div>

  <script>
    // JavaScript to trigger the loader
    window.onload = function() {
      document.getElementById("loader-wrapper").style.display = "none";
    };
  </script>	
<div id="page" class="hfeed site">

	<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>

		<!-- Page Slider -->
		<?php if( is_page() && isset($boxshop_page_datas) ): ?>
			<?php if( $boxshop_page_datas['ts_page_slider'] && $boxshop_page_datas['ts_page_slider_position'] == 'before_header' ): ?>
			<div class="top-slideshow">
				<div class="top-slideshow-wrapper">
					<?php boxshop_show_page_slider(); ?>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="mobile-menu-wrapper">
			<span class="ic-mobile-menu-close-button"><i class="fa fa-remove"></i></span>
			<?php 
			if ( has_nav_menu( 'mobile' ) ) {
				wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'mobile' ) );
			}else{
				wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'primary') );
			}
			?>
		</div>
		
		<?php boxshop_get_header_template(); ?>
		
	<?php endif; ?>
	
	<?php do_action('boxshop_before_main_content'); ?>

	<div id="main" class="wrapper">