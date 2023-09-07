<?php
global $boxshop_theme_options;

$header_classes = array();
if( isset($boxshop_theme_options['ts_enable_sticky_header']) && $boxshop_theme_options['ts_enable_sticky_header'] ){
	$header_classes[] = 'has-sticky';
}

$extra_class = array();
if( $boxshop_theme_options['ts_enable_tiny_shopping_cart'] == 0 ){
	$extra_class[] = 'hidden-cart';
}
else{
	$extra_class[] = 'show-cart';
	
}
if( $boxshop_theme_options['ts_enable_search'] == 0 ){
	$extra_class[] = 'hidden-search';
}
else{
	$extra_class[] = 'show-search';
}

if( has_nav_menu( 'vertical' ) ){
	$extra_class[] = 'has-vertical-menu';
}
?>
<header class="ts-header <?php echo esc_attr(implode(' ', $header_classes)); ?>">
	<div class="header-container">
		<div class="header-template  header-v5 <?php echo esc_attr(implode(' ', $extra_class)); ?>">
			<div class="header-top ">
				<div class="container">
					<div class="header-left">
						<span class="ic-mobile-menu-button visible-phone"><i class="fa fa-bars"></i></span>
						<?php if( $boxshop_theme_options['ts_header_contact_information'] ): ?>
						<div class="info-desc"><?php echo do_shortcode(stripslashes($boxshop_theme_options['ts_header_contact_information'])); ?></div>
						<?php endif; ?>
					</div>
					<div class="header-right">
						
						<span class="ts-group-meta-icon-toggle visible-phone"><i class="fa fa-cog"></i></span>
				
						<?php if( $boxshop_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
						<div class="shopping-cart-wrapper visible-vertical-ipad cart-mobile visible-phone"><?php echo boxshop_tiny_cart(); ?></div>
						<?php endif; ?>
						
						<div class="group-meta-header">
							
							<?php do_action('boxshop_before_group_meta_header'); ?>
							
							<?php if( $boxshop_theme_options['ts_enable_tiny_account'] ): ?>
							<div class="my-account-wrapper"><?php echo boxshop_tiny_account(); ?></div>
							<?php endif; ?>							
							<?php if( class_exists('YITH_WCWL') && $boxshop_theme_options['ts_enable_tiny_wishlist'] ): ?>
							<div class="my-wishlist-wrapper"><?php echo boxshop_tini_wishlist(); ?></div>
							<?php endif; ?>	
							<div class="my-wishlist-wrapper-new">								
								<a title="Events" href="<?=get_site_url().'/events'?>" class="tini-wishlist"><i class="fa fa-calendar"></i> Events</a>
							</div>	
							<div class="my-wishlist-wrapper-new">								
								<a title="Jobs" href="<?=get_site_url().'/careers-list'?>" class="tini-wishlist"><i class="fa fa-tasks"></i> Jobs</a>
							</div>	
							<?php if( $boxshop_theme_options['ts_header_currency'] ): ?>
							<div class="header-currency"><?php boxshop_woocommerce_multilingual_currency_switcher(); ?></div>
							<?php endif; ?>
							
							<?php if( $boxshop_theme_options['ts_header_language'] ): ?>
							<div class="header-language"><?php boxshop_wpml_language_selector(); ?></div>
							<?php endif; ?>

							<?php do_action('boxshop_after_group_meta_header'); ?>

						</div>
					</div>
				</div>
			</div>
			<div class="header-middle">
				<div class="container">
					<div class="logo-wrapper"><?php echo boxshop_theme_logo(); ?></div>
					
					
					<?php if( $boxshop_theme_options['ts_enable_search'] ): ?>
					<div class="search-wrapper"><?php boxshop_get_search_form_by_category_ttp(); ?></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="header-sticky header-bottom <?php echo has_nav_menu( 'vertical' )?'has-vertical-menu':''; ?>">
				<div class="container">
					<div class="header-left">
						<div class="menu-wrapper hidden-phone">				
							<div class="ts-menu">
								<?php 
									if ( has_nav_menu( 'vertical' ) ) {
										?>
										<div class="vertical-menu-wrapper">
											<div class="vertical-menu-heading"><?php echo boxshop_get_vertical_menu_heading(); ?></div>
											<?php
											wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Boxshop_Walker_Nav_Menu() ) );
											?>
										</div>
										<?php
									}
									if ( has_nav_menu( 'primary' ) ) {
										wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'primary','walker' => new Boxshop_Walker_Nav_Menu() ) );
									}
									else{
										wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper' ) );
									}
									
								?>
							</div>
						</div>
					</div>
					<div class="header-right">
						
						<?php if( $boxshop_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
							<div class="shopping-cart-wrapper hidden-vertical-ipad"><?php echo boxshop_tiny_cart(); ?></div>
						<?php endif; ?>
						
					</div>
				</div>
			</div>
			<div class="menu-wrapper visible-phone">				
				<div class="ts-menu">
					<?php 
						if ( has_nav_menu( 'vertical' ) ) {
							?>
							<div class="vertical-menu-wrapper">
								<div class="vertical-menu-heading"><?php echo boxshop_get_vertical_menu_heading(); ?></div>
								<?php
								wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Boxshop_Walker_Nav_Menu() ) );
								?>
							</div>
							<?php
						}
						
					?>
				</div>
			</div>
		</div>	
	</div>
</header>