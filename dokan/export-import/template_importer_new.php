<?php
$permalink = get_permalink();
$parser = new Dokan_WXR_Parser();

?>

<?php do_action( 'dokan_dashboard_wrap_start' ); ?>

<div class="dokan-dashboard-wrap">
	<?php

        /**
         *  dokan_dashboard_content_before hook
         *  dokan_tools_content_before hook
         *
         *  @hooked get_dashboard_side_navigation
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_before' );
        do_action( 'dokan_tools_content_before' );
    ?>

	<div class="dokan-dashboard-content dokan-withdraw-content">
		<?php

            /**
             *  dokan_tools_content_inside_before hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_tools_content_inside_before' );
        ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="dokan-dashboard-header">
			    <h1 class="entry-title"><?php _e( 'Tools', 'dokan' ); ?></h1>
			</header><!-- .-->

			<div id="tab-container">
				<ul class="dokan_tabs">
                                    <?php if ( current_user_can( 'dokan_import_product' ) ): ?>
                                            <li class="active">
                                                <a href="#import" data-toggle="tab">
                                                    <?php _e( 'Import', 'dokan' ); ?>
                                                </a>
                                            </li>
                                    <?php endif ?>

                                    <?php if ( current_user_can( 'dokan_export_product' ) ): ?>
                                            <li>
                                                <a href="#export" data-toggle="tab">
                                                    <?php _e( 'Export', 'dokan' ); ?>
                                                </a>
                                            </li>
                                    <?php endif ?>
				</ul>

				<!-- Tab panes -->
				<div class="tabs_container">
                    <?php if ( current_user_can( 'dokan_import_product' ) ): ?>
    				  	<div class="import_div tab-pane active" id="import">
                            
                            <header class="dokan-import-export-header">
    					    	<h1 class="entry-title"><?php _e( 'Import CSV', 'dokan' ); ?></h1>
								<p style="font-style: italic;margin-top: -10px;margin-bottom: 20px;">
									<a download style="color:#F05025;" href="https://cutemesh.com/wp-content/uploads/2023/05/Example-Sheet.csv">Here</a> is an example sheet you can use a reference to import products.
								</p>
    					    </header>
                                            <a href="<?php echo dokan_get_navigation_url( 'tools/csv-import' ) ?>" class="dokan-btn dokan-btn-theme">
                                                <?php _e( 'Import CSV', 'dokan' ) ?>
                                            </a>

    				  	</div>
                    <?php endif ?>
                    <?php if ( current_user_can( 'dokan_export_product' ) ): ?>
                                <div class="export_div tab-pane" id="export">
                                   
                                    <header class="dokan-import-export-header">
                                        <h1 class="entry-title"><?php _e( 'Export CSV', 'dokan' ); ?></h1>
                                    </header>
                                    <a href="<?php echo dokan_get_navigation_url( 'tools/csv-export' ) ?>" class="dokan-btn dokan-btn-theme">
                                        <?php _e( 'Export CSV', 'dokan' ) ?>
                                    </a>

                                </div>
                    <?php endif ?>

				</div>
			</div>

		</article>

		<?php

            /**
             *  dokan_tools_content_inside_after hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_tools_content_inside_after' );
        ?>

    </div><!-- .dokan-dashboard-content -->

	 <?php
        /**
         *  dokan_dashboard_content_after hook
         *  dokan_tools_content_after hook
         *
         *  @since 2.4
         */
        do_action( 'dokan_dashboard_content_after' );
        do_action( 'dokan_tools_content_after' );
    ?>

</div><!-- .dokan-dashboard-wrap -->

<?php do_action( 'dokan_dashboard_wrap_end' ); ?>

<script>
    (function($){
        $(document).ready(function(){
            $('#tab-container').easytabs();
        });
    })(jQuery)
</script>