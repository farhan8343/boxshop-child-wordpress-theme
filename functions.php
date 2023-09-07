<?php
// Add this code in your theme's functions.php file or in a custom plugin.

// Register Custom Post Type
function custom_post_type_wishlist_template() {
    $labels = array(
        'name'                  => _x( 'Wishlist Templates', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Wishlist Template', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Wishlist Templates', 'text_domain' ),
        'name_admin_bar'        => __( 'Wishlist Template', 'text_domain' ),
        'archives'              => __( 'Wishlist Template Archives', 'text_domain' ),
        'attributes'            => __( 'Wishlist Template Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Wishlist Template:', 'text_domain' ),
        'all_items'             => __( 'All Wishlist Templates', 'text_domain' ),
        'add_new_item'          => __( 'Add New Wishlist Template', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Wishlist Template', 'text_domain' ),
        'edit_item'             => __( 'Edit Wishlist Template', 'text_domain' ),
        'update_item'           => __( 'Update Wishlist Template', 'text_domain' ),
        'view_item'             => __( 'View Wishlist Template', 'text_domain' ),
        'view_items'            => __( 'View Wishlist Templates', 'text_domain' ),
        'search_items'          => __( 'Search Wishlist Templates', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Wishlist Template', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Wishlist Template', 'text_domain' ),
        'items_list'            => __( 'Wishlist Templates list', 'text_domain' ),
        'items_list_navigation' => __( 'Wishlist Templates list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Wishlist Templates list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Wishlist Template', 'text_domain' ),
        'description'           => __( 'Custom post type for wishlist templates.', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true, // Set this to false to hide from the admin menu
        'show_in_menu'          => true, // Set this to false to hide from the admin menu
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-heart', // You can choose an icon from dashicons (https://developer.wordpress.org/resource/dashicons/)
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true, // Set this to true to exclude from search results
        'publicly_queryable'    => false, // Set this to false to disable front-end query for the post type
        'capability_type'       => 'post',
    );
    register_post_type( 'wishlist_template', $args );
}
add_action( 'init', 'custom_post_type_wishlist_template', 0 );

//echo 'fasdfasfd'; die();
// ==========================================
//======= register style sheet
function boxshop_child_register_scripts()
{
    $parent_style = 'boxshop-style';
	if($_GET['edit-mode'] == 'yes'){
		echo '<style>div#page > #main {
			display: block !important;
		}div#page > *,div#wpadminbar {
			display: none;
		}</style>';
	}
	
	wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.0.0');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css', array('boxshop-reset'), boxshop_get_theme_version());
    wp_enqueue_style(
        'boxshop-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style)
    );
	wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'));
    wp_enqueue_script('jquery-validate-js', get_stylesheet_directory_uri() . '/assets/js/jquery.validate.min.js', array('jquery'));
    wp_enqueue_script('cstm_frontend_script', get_stylesheet_directory_uri() . '/assets/js/custom_script.js', array(), '1.0.0', true);
    wp_enqueue_script('cstm_paginathing_script', get_stylesheet_directory_uri() . '/assets/js/paginathing.min.js', array(), '1.0.0', true);
    wp_enqueue_script('i_have_cookie', get_stylesheet_directory_uri() . '/assets/js/jquery.ihavecookies.js', array(), '1.0.0', true);
	wp_enqueue_script('custom-js',get_stylesheet_directory_uri().'/custom.js',array('jquery'),'1.0.0', true);
	?>
	
	<?php
}
add_action('wp_enqueue_scripts', 'boxshop_child_register_scripts');

// ==========================================
//======= register style sheet
function cstm_admin_style()
{
    wp_enqueue_style('cstm-admin-styles', get_stylesheet_directory_uri() . '/admin.css');
	wp_enqueue_script( 'custom_admin_script', get_stylesheet_directory_uri() . '/admin-script.js', array('jquery'), '1.0' );
}
add_action('admin_enqueue_scripts', 'cstm_admin_style');

function custom_admin_js() {
    echo '<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';
}
add_action('admin_footer', 'custom_admin_js');



// ===========================================================
//======= START change default post type name from Post to Blog
function revcon_change_post_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog';
    $submenu['edit.php'][5][0] = 'Blog';
    $submenu['edit.php'][10][0] = 'Add Blog';
    $submenu['edit.php'][16][0] = 'Blog Tags';
}
function revcon_change_post_object()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Blog';
    $labels->singular_name = 'Blog';
    $labels->add_new = 'Add Blog';
    $labels->add_new_item = 'Add Blog';
    $labels->edit_item = 'Edit Blog';
    $labels->new_item = 'Blog';
    $labels->view_item = 'View Blog';
    $labels->search_items = 'Search Blog';
    $labels->not_found = 'No Blog found';
    $labels->not_found_in_trash = 'No Blog found in Trash';
    $labels->all_items = 'All Blog';
    $labels->menu_name = 'Blog';
    $labels->name_admin_bar = 'Blog';
}

add_action('admin_menu', 'revcon_change_post_label');
add_action('init', 'revcon_change_post_object');
// ===========================================================
//======= END change default post type name from Post to Blog

// ================================================================
//======= remove dokan registration option from default WC reg form
remove_action('woocommerce_register_form', 'dokan_seller_reg_form_fields');

// ================================================================
//======= footer JS
function footer_js()
{
?>
    <script>
        jQuery(document).ready(function() {
            jQuery('.elay-css-full-reset .elay-boxed').removeClass('elay-boxed').addClass('elay-full');
            jQuery("#commentform .comment-form-attachment label").text('Click here to upload your resume');
            jQuery('.single-careers h3#comments, .single-careers .navigation, .single-careers .commentlist').remove();
            var activetext = jQuery('.dokan-dashboard-menu li.active a').text();
            // jQuery('.dokan-dashboard-content').prepend('<header class="dokan-dashboard-header '+activetext+'"><span class="left-header-content"><h1 class="entry-title">'+activetext+'</h1></span><div class="dokan-clearfix"></div></header>')
        });


        jQuery('.dokan-add-product-link a').removeClass('dokan-add-new-product');
        // Supermarket
        var get_supermarket_text = jQuery('.supermarket-wrap span.title-category').text();
        jQuery('.supermarket-wrap span.title-category').html('<a href="<?= get_site_url() . '/supermarket' ?>">' + get_supermarket_text + '</a>');

        // Auction
        var get_auction_text = jQuery('.auction-wrap span.title-category').text();
        jQuery('.auction-wrap span.title-category').html('<a href="<?= get_site_url() . '/auction' ?>">' + get_auction_text + '</a>');

        // Rental
        var get_rental_text = jQuery('.rental-wrap span.title-category').text();
        jQuery('.rental-wrap span.title-category').html('<a href="<?= get_site_url() . '/rental' ?>">' + get_rental_text + '</a>');

        // Grocery
        var get_grocery_text = jQuery('.grocery-wrap span.title-category').text();
        jQuery('.grocery-wrap span.title-category').html('<a href="<?= get_site_url() . '/grocery' ?>">' + get_grocery_text + '</a>');
    </script>
    <?php
    // set name of user in top right corner instead of my account text
    if (is_user_logged_in()) {
        global $current_user;
        get_currentuserinfo();
    ?>
        <script>
            jQuery(document).ready(function() {
                jQuery(".ts-tiny-account-wrapper .my-account span").html('<span><?php echo $current_user->display_name ?></span>');
            });
        </script>
    <?php
    }
    if (is_product_category() || is_shop()) {
        echo do_shortcode('[bsa_pro_ad_space id=14]');
    }
    if (is_product_category() || is_home() || is_front_page() || is_shop() || is_page(8325) || is_page(8381) || is_page(6558) || is_archive('forums')) {
        echo do_shortcode('[bsa_pro_ad_space id=15]');
    }
    ?>
    <!-- loader -->
    <div class="cstm-loading"></div>
    <div class="cstm-site-url" style="display: none;"><?= get_site_url(); ?></div>
    <script>
        var my_account_lik = jQuery('.cstm-site-url').text() + '/my-account';
        jQuery('#ts-login-form').attr('action', my_account_lik);
    </script>
    <script type="text/javascript">
        var options = {
            title: '🍪 Accept Cookies & Privacy Policy?',
            message: 'There are no cookies used on this site, but if there were this message could be customised to provide more details. Click the <strong>accept</strong> button below to see the optional callback in action...',
            delay: 600,
            expires: 1,
            link: 'https://cutemesh.com/privacy-and-policy/',
            onAccept: function() {
                var myPreferences = jQuery.fn.ihavecookies.cookie();
                console.log('Yay! The following preferences were saved...');
                console.log(myPreferences);
            },
            uncheckBoxes: true,
            acceptBtnLabel: 'Accept Cookies',
            moreInfoLabel: 'More information',
            cookieTypesTitle: 'Select which cookies you want to accept',
            fixedCookieTypeLabel: 'Essential',
            fixedCookieTypeDesc: 'These are essential for the website to work correctly.'
        }

        jQuery(document).ready(function() {
            jQuery('body').ihavecookies(options);

            if (jQuery.fn.ihavecookies.preference('marketing') === true) {
                console.log('This should run because marketing is accepted.');
            }

            jQuery('#ihavecookiesBtn').on('click', function() {
                jQuery('body').ihavecookies(options, 'reinit');
            });
        });
        setTimeout(() => {
            jQuery('.bsaProOrderingFormInner .bsa_img_inputs_load label').append(' (Max 2 MB of file)');
        }, 2000);
        jQuery('.single-careers .comments-area .comments-title h2.heading-title').text('Apply now');
    </script>
<?php
    // $store_user = dokan()->vendor->get( get_query_var( 'author' ) );
    // $store_info = $store_user->get_shop_info();
    // echo '$store_info '.$store_info ;
    // echo '$store_user->get_id()'.$store_user->get_id();
}
add_action('wp_footer', 'footer_js');

// ================================================================
//======= add extra regisration field in WC reg form
function wooc_extra_register_fields()
{ ?>
    <p class="form-row form-row-first">
        <label for="reg_billing_first_name"><?php _e('First name&nbsp', 'woocommerce'); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if (!empty($_POST['billing_first_name'])) esc_attr_e($_POST['billing_first_name']); ?>" />
    </p>
    <p class="form-row form-row-last">
        <label for="reg_billing_last_name"><?php _e('Last name&nbsp', 'woocommerce'); ?><span class="required">*</span></label>
        <input type="text" class="input-text" required pattern="\S+" title="White space not allow" name="billing_last_name" id="reg_billing_last_name" value="<?php if (!empty($_POST['billing_last_name'])) esc_attr_e($_POST['billing_last_name']); ?>" />
    </p>
    <div class="clear"></div>
<?php
    unset($_COOKIE['cutemesh_username']);
    unset($_COOKIE['cstm_value']);
}
add_action('woocommerce_register_form_start', 'wooc_extra_register_fields', 10);

function cstm_remember_me()
{
    if (!empty($_POST)) {
        if ($_POST['rememberme']) {
            $remembering_timespan = time() + (86400 * 8); // 86400 = 1 day
            setcookie('username_or_email', $_POST['username'], $remembering_timespan);
            setcookie('password', $_POST['password'], $remembering_timespan);
        } else {
            setcookie('username_or_email', null, strtotime('-1 day'));
            setcookie('password', null, strtotime('-1 day'));
        }
    }
}
add_action('wp_login', 'cstm_remember_me');

// ================================================================
//======= validate extra added regisration field in WC reg form
function wooc_validate_extra_register_fields($username, $email, $validation_errors)
{
    if (isset($_POST['billing_first_name']) && empty($_POST['billing_first_name'])) {
        $validation_errors->add('billing_first_name_error', __(' First name is required!', 'woocommerce'));
    }
    if (isset($_POST['billing_last_name']) && empty($_POST['billing_last_name'])) {
        $validation_errors->add('billing_last_name_error', __(' Last name is required!.', 'woocommerce'));
    }
    return $validation_errors;
}
add_action('woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3);

// ================================================================
//======= Below code save extra fields.
function wooc_save_extra_register_fields($customer_id)
{
    if (isset($_POST['billing_first_name'])) {
        //First name field which is by default
        update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']));
        // First name field which is used in WooCommerce
        update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
    }
    if (isset($_POST['billing_last_name'])) {
        // Last name field which is by default
        update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']));
        // Last name field which is used in WooCommerce
        update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
    }
}
add_action('woocommerce_created_customer', 'wooc_save_extra_register_fields');

// ================================================================
//======= news custom post type
function create_custom_post_type_news()
{
    $labels = array(
        'name'               => _x('News', 'post type general name'),
        'singular_name'      => _x('News', 'post type singular name'),
        'add_new'            => _x('Add New', 'book'),
        'add_new_item'       => __('Add New News'),
        'edit_item'          => __('Edit News'),
        'new_item'           => __('New News'),
        'all_items'          => __('All News'),
        'view_item'          => __('View News'),
        'search_items'       => __('Search News'),
        'not_found'          => __('No news found'),
        'not_found_in_trash' => __('No news found in the Trash'),
        'menu_name'          => 'News'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our news specific data',
        'public'        => true,
        'menu_position' => 6,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'has_archive'   => true,
    );
    register_post_type('news', $args);
}
add_action('init', 'create_custom_post_type_news');

// ================================================================
//======= careers custom post type
function create_custom_post_type_careers()
{
    $labels = array(
        'name'               => _x('Careers', 'post type general name'),
        'singular_name'      => _x('Careers', 'post type singular name'),
        'add_new'            => _x('Add New', 'book'),
        'add_new_item'       => __('Add New Careers'),
        'edit_item'          => __('Edit Careers'),
        'new_item'           => __('New Careers'),
        'all_items'          => __('All Careers'),
        'view_item'          => __('View Careers'),
        'search_items'       => __('Search Careers'),
        'not_found'          => __('No careers found'),
        'not_found_in_trash' => __('No careers found in the Trash'),
        'menu_name'          => 'Careers'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our careers specific data',
        'public'        => true,
        'menu_position' => 8,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'has_archive'   => true,
    );
    register_post_type('careers', $args);
}
add_action('init', 'create_custom_post_type_careers');


// ================================================================
//======= Announcements custom post type
function create_custom_post_type_announcements()
{
    $labels = array(
        'name'               => _x('Announcements', 'post type general name'),
        'singular_name'      => _x('Announcements', 'post type singular name'),
        'add_new'            => _x('Add New', 'book'),
        'add_new_item'       => __('Add New Announcements'),
        'edit_item'          => __('Edit Announcements'),
        'new_item'           => __('New Announcements'),
        'all_items'          => __('All Announcements'),
        'view_item'          => __('View Announcements'),
        'search_items'       => __('Search Announcements'),
        'not_found'          => __('No Announcements found'),
        'not_found_in_trash' => __('No announcements found in the Trash'),
        'menu_name'          => 'Announcements'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our announcements specific data',
        'public'        => true,
        'menu_position' => 9,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'has_archive'   => true,
    );
    register_post_type('announcements', $args);
}
add_action('init', 'create_custom_post_type_announcements');

// ================================================================
//======= count totaa no of views for news post type

function get_post_views($postID)
{
    $count_key = 'news_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function set_post_views($postID)
{
    $count_key = 'news_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count = $count + 1;
        // $count--;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
// remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// ================================================================
//======= count total no of views for careers post type

function get_careers_views($postID)
{
    $count_key = 'careers_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function set_careers_views($postID)
{
    $count_key = 'careers_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count = $count + 1;
        // $count--;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
// remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// ================================================================
//======= count total no of views for announcements post type

function get_announcements_views($postID)
{
    $count_key = 'announcements_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function set_announcements_views($postID)
{
    $count_key = 'announcements_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count = $count + 1;
        // $count--;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
// remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// ================================================================
//======= Exclude products from a particular category on the shop page
function custom_pre_get_posts_query_for_shop($q)
{
    if (is_shop()) {
        $tax_query = (array) $q->get('tax_query');
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array('event-rentals', 'event-centers', 'home-rental', 'car-rental'),
            'operator' => 'NOT IN'
        );
        $q->set('tax_query', $tax_query);
    }
}
add_action('woocommerce_product_query', 'custom_pre_get_posts_query_for_shop');

function bbloomer_premium_support_content()
{
    echo do_shortcode('woo-wallet');
}

add_action('woocommerce_account_woo-wallet_endpoint', 'bbloomer_premium_support_content', 10);

// ================================================================
//======= display subscription pack message to seller/vendsor only
function action_woocommerce_account_dashboard()
{
    global $post;
    $user_id            = dokan_get_current_user_id();
    $subscription_packs = dokan()->subscription->all();
    $user = wp_get_current_user();
    $roles = (array) $user->roles;
    if (in_array("seller", $roles)) {
        if (!$subscription_packs->have_posts()) {
            echo '<h5>' . __('No subscription pack has been found!', 'dokan') . '</h5>';
        }
    }
};
add_action('woocommerce_account_dashboard', 'action_woocommerce_account_dashboard', 9);

// =========================================================================
//======= redirect seller to dahsboard page when visit vendor register link
function redirect_user_to_vendor_dashboard()
{
	global $wp;
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $roles = (array) $user->roles;
        if (in_array("seller", $roles)) {
            if (is_page('8295')) {
                wp_redirect(get_site_url() . '/dashboard/', 301);
                exit();
            }
        }
    }
	if ($wp->request === 'my-account/manage-wishlist') {
        wp_redirect(home_url('/wishlist/manage'), 301);
        exit;
    }
	if(!is_user_logged_in()){
		if($wp->request == 'driver' || $wp->request == 'drivers-manager'){
			wp_redirect(get_site_url().'/my-account/?redirect-url='. get_site_url() . '/' . $wp->request);
		}
	}
	if(is_user_logged_in() && is_page('wishlist-intro')){
		//wp_redirect('https://cutemesh.com/wishlist');
		//die();
	}
	if(!is_user_logged_in() && is_page('wishlist')){
		wp_redirect('https://cutemesh.com/wishlist-intro');
		die();
	}
}
add_action('template_redirect', 'redirect_user_to_vendor_dashboard', 1);

// =============================================================================
//======= change post comment form text for careers and announcements post type
function wpdocs_comment_form_defaults($defaults)
{
    global $user_identity;
    $post_id = get_the_ID();
    $allowed_html = array(
        'div'    => array('class' => array()), 'p'    => array('class' => array()), 'span'    => array('class' => array()), 'a'     => array('href' => array(), 'title' => array(), 'rel' => array())
    );
    if (is_singular('careers')) {
        $defaults['title_reply'] = __('Submit your resume below');
        $defaults['comment_field'] = __('<div class="message-wrapper"><p><label>' . esc_html__('Paste your cover letter below', 'boxshop') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>');
    }
    if (is_singular('announcements')) {
        $defaults['title_reply'] = __('How may we help you? Please submit your question.');
        $defaults['comment_field'] = __('<div class="message-wrapper"><p><label>' . esc_html__('Enter your question below', 'boxshop') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>');
    }

    $defaults['logged_in_as'] = __('<p class="logged-in-as">' . sprintf(wp_kses(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'boxshop'), $allowed_html), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>');
    $defaults['label_submit'] = __('Submit');
    return $defaults;
}
add_filter('comment_form_defaults', 'wpdocs_comment_form_defaults');

// ==========================================================
//======= Add new extra fields in woocommerce checkout form
function cloudways_custom_checkout_fields($fields)
{
    $fields['cloudways_extra_fields'] = array(
        'cloudways_text_field' => array(
            'type' => 'textarea',
            'required'      => true,
            'label' => __('GhanaPost Digital Address'),
            'placeholder' => __('If in Ghana, this is your GhanaPost GPS Digital Address. For all other countries, this is your GPS location. Add it if necessary, for package delivery.')
        ),
        'cloudways_dropdown' => array(
            'type' => 'radio',
            'options' => array('Additional billing address' => __('Additional billing address'), 'Delivery address' => __('Delivery address')),
            'required'      => true,
            'label' => __('Digital address for : ')
        )
    );
    return $fields;
}
// add_filter( 'woocommerce_checkout_fields', 'cloudways_custom_checkout_fields' );
function cloudways_extra_checkout_fields()
{
    $checkout = WC()->checkout(); ?>
    <div class="extra-fields">
        <h3><?php echo "<h2>Additional address</h2>" ?></h3>
        <?php
        foreach ($checkout->checkout_fields['cloudways_extra_fields'] as $key => $field) : ?>
            <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
        <?php endforeach; ?>
    </div>
<?php }
// add_action( 'woocommerce_after_checkout_billing_form' ,'cloudways_extra_checkout_fields' );

// ==========================================================
//======= Add new extra fields in woocommerce checkout form
function bbloomer_display_checkbox_and_new_checkout_field($fields)
{
    $user = wp_get_current_user();
    // print_r(get_user_meta(1));die;
    //$digital_address = $user ? get_user_meta($user->ID, 'billing__digital_address', true) : '';
   // $is_additional_address = $user ? get_user_meta($user->ID, 'billing__is_additional_address', true) : '';
    $fields['digital_address'] = array(
        
		 'label' => __("
		 <span class='dgtl-span'>GhanaPost Digital Address</span> 
		 <span class='details-span'>
		 	
				<span>Provide your Digital address to see available shipping options at checkout.</span>
				<span>Purchases are delivered directly to the Digital address.</span>
				<span>Don't know your Digital Address? Use <a href='https://www.ghanapostgps.com/'>GhanaPost GPS App</a> to generate your Digital Address</span>
			
		</span>"),
        'placeholder'   => _x('Digital Address', 'placeholder', 'woocommerce'),
        'class'     => array('form-row-wide'),
        'clear'     => true,
		'required' => true,
        'priority'     => 200,
    );
    // $fields['is_additional_address'] = array(
    //     'type'      => 'radio',
    //     'label' => __('Above digital address for : '),
    //     'class'     => array('form-row-wide'),
    //     'clear'     => true,
    //     'priority'     => 200,
    //     'options' => array('Additional billing address' => __('Additional billing address'), 'Delivery address' => __('Delivery address')),
    // );
   // $fields['digital_address']['default'] = $digital_address;
   // $fields['is_additional_address']['default'] = $is_additional_address;
    return $fields;
}
add_filter('woocommerce_default_address_fields', 'bbloomer_display_checkbox_and_new_checkout_field');

// ==========================================================
//======= Save the Data of Custom Checkout WooCommerce Fields
function cloudways_save_extra_checkout_fields($order_id, $posted)
{
    // don't forget appropriate sanitization if you are using a different field type
    if (isset($posted['billing_digital_address'])) {
        update_post_meta($order_id, 'billing__digital_address', sanitize_text_field($posted['billing_digital_address']));
    }
    if (isset($posted['billing_is_additional_address']) && in_array($posted['billing_is_additional_address'], array('Additional billing address', 'Delivery address'))) {
        update_post_meta($order_id, 'billing__is_additional_address', $posted['billing_is_additional_address']);
    }
}
add_action('woocommerce_checkout_update_order_meta', 'cloudways_save_extra_checkout_fields', 10, 2);

// ==========================================================
//======= Display  the Data of  WooCommerce Custom Fields to User
function cloudways_display_order_data($order_id)
{  ?>
    <h2><?php echo "<h6>Additional address</h6>" ?></h2>
    <?php
    if (!empty(get_post_meta($order_id, 'billing__digital_address', true)) || !empty(get_post_meta($order_id, 'billing__is_additional_address', true))) {
    ?>
        <table class="shop_table_responsive additional_info">
            <tbody>
                <tr>
                    <th><?php _e('GhanaPost Digital address:'); ?></th>
                    <td><?php echo get_post_meta($order_id, 'billing__digital_address', true); ?></td>
                </tr>
                <tr>
                    <th><?php _e('Digital address for :'); ?></th>
                    <td><?php echo get_post_meta($order_id, 'billing__is_additional_address', true); ?></td>
                </tr>
            </tbody>
        </table>
    <?php
    } else {
        echo "<span>No additional address</span>";
    }
    ?>
<?php }
add_action('woocommerce_thankyou', 'cloudways_display_order_data', 20);
add_action('woocommerce_view_order', 'cloudways_display_order_data', 20);

// ==========================================================
//======= Display WooCommerce Admin Custom Order Fields
function cloudways_display_order_data_in_admin($order)
{  ?>
    <div class="order_data_column cstm-order-data" style="width:100%">
        <h4><?php _e('Additional address', 'woocommerce'); ?><a href="#" class="edit_address"><?php _e('Edit', 'woocommerce'); ?></a></h4>
        <div class="address">
            <?php
            echo '<p><strong>' . __('Digital address') . ':</strong>' . get_post_meta($order->id, 'billing__digital_address', true) . '</p>';
            echo '<p><strong>' . __('Digital address for ') . ':</strong>' . get_post_meta($order->id, 'billing__is_additional_address', true) . '</p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input(array('id' => 'billing__digital_address', 'label' => __('Digital address:'), 'wrapper_class' => 'billing_digital_address', 'name' => 'billing__digital_address')); ?>
            <?php
            // woocommerce_wp_radio(array(
            //     'id'            => '_is_additional_address',
            //     'wrapper_class' => 'show_if_simple',
            //     'label'         => __('Digital address for : ', 'my_theme_domain'),
            //     'options'       => array(
            //         'Additional billing address'    => 'Additional billing address',
            //         'Delivery address'    => 'Delivery address',
            //     ),
            //     'value'         => get_post_meta($order->id, 'billing__is_additional_address', true),
            //     'name' => 'billing_is_additional_address',
            // ));
            ?>
        </div>
    </div>
<?php }
add_action('woocommerce_admin_order_data_after_order_details', 'cloudways_display_order_data_in_admin');
function cloudways_save_extra_details($post_id, $post)
{
    update_post_meta($post_id, 'billing__digital_address', wc_clean($_POST['billing__digital_address']));
    update_post_meta($post_id, 'billing__is_additional_address', wc_clean($_POST['billing_is_additional_address']));
}
add_action('woocommerce_process_shop_order_meta', 'cloudways_save_extra_details', 45, 2);

// ==========================================================
//======= Add WooCommerce Custom Fields to Order Emails
function cloudways_email_order_meta_fields($fields, $sent_to_admin, $order)
{
    $fields['billing_digital_address'] = array(
        'label' => __('Digital address'),
        'value' => get_post_meta($order->id, 'billing__digital_address', true),
    );
    $fields['_is_additional_address'] = array(
        'label' => __('Digital address for'),
        'value' => get_post_meta($order->id, 'billing__is_additional_address', true),
    );
    return $fields;
}
add_filter('woocommerce_email_order_meta_fields', 'cloudways_email_order_meta_fields', 10, 3);

// ==========================================================
//======= Remove required field validation  for billing address
function cstm_remove_billing_fields($fields)
{
    unset($fields['billing_postcode']['required']);
    $fields['billing_country']['label'] = 'Country';
    return $fields;
}
// add_filter( 'woocommerce_billing_fields', 'cstm_remove_billing_fields', 10 );

// ==========================================================
//======= make required field validation for billing address's postcode
function cstm_customise_postcode_fields($address_fields)
{
    $address_fields['billing_postcode']['required'] = true;

    return $address_fields;
}
// add_filter( 'woocommerce_default_address_fields', 'cstm_customise_postcode_fields', 10 );

// ==========================================================
//======= add no script JS enable code
function cstm_msg_for_enable_js_in_browser($address_fields)
{
?>
    <noscript>
        <p id="NoJS">JavaScript is disabled on your browser. Please enable it for better user experience and functioning of site.</p>
    </noscript>
<?php
}
add_filter('wp_head', 'cstm_msg_for_enable_js_in_browser');

// add_filter( 'woocommerce_continue_shopping_redirect', 'bbloomer_change_continue_shopping', 10 );

// function bbloomer_change_continue_shopping() {
// 	return 'https://cutemesh.com/home-electronic/';
// }
add_action('woocommerce_proceed_to_checkout', 'boxshop_cart_continue_shopping_button_new', 10);

/* Continue Shopping button */
function boxshop_cart_continue_shopping_button_new()
{
    echo '<a href="' . get_site_url() . '/supermarket/" class="button continue-shopping-new">' . esc_html__('Continue Shopping', 'boxshop') . '</a>';
}

// ==========================================================
//======= Remove required field validation  for shipping address
function cstm_remove_shipping_fields($fields)
{
    unset($fields['shipping_postcode']['required']);
    $fields['shipping_country']['label'] = 'Country';
    return $fields;
}
add_filter('woocommerce_shipping_fields', 'cstm_remove_shipping_fields');

// ==========================================================
//======= set the priority of product tabs and remove custom tab
function reordered_tabs($tabs)
{
    $tabs['seller_enquiry_form']['priority'] = 99;
    $tabs['more_seller_product']['priority'] = 100;
    unset($tabs['ts_custom']);
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'reordered_tabs', 2);

// ==========================================================
//======= add Advertisement shortcode in product listing page (shop)
function cstm_place_ads_shortcode()
{
    echo do_shortcode('[bsa_pro_ad_space id=19]');
}
add_action('woocommerce_after_shop_loop', 'cstm_place_ads_shortcode');

// ==========================================================
//======= START add custom field in product category page at admin backend
//Product Cat Create page
function wh_taxonomy_add_new_meta_field()
{
?>
    <div class="form-field">
        <input type="checkbox" name="gift_card_cat" id="gift_card_cat" value="yes">
        <label for="gift_card_cat" style="display: inline-block;"> Is this gift card category?</label>
        <p class="description"><?php _e('Select checkbox if this is gift card category', 'wh'); ?></p>
    </div>
<?php
}
add_action('product_cat_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1);
add_action('product_cat_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1);

//Product Cat Edit page
function wh_taxonomy_edit_meta_field($term)
{

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field.
    $gift_card_cat = get_term_meta($term_id, 'gift_card_cat', true);
?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="gift_card_cat"><?php _e('Gift card', 'wh'); ?></label></th>
        <td>
            <input type="checkbox" name="gift_card_cat" id="gift_card_cat" value="yes" <?php echo (esc_attr($gift_card_cat) == 'yes') ? 'checked="checked"' : ''; ?>>
            <label for="gift_card_cat"> Is this gift card category?</label><br>
            <p class="description"><?php _e('Select checkbox if this is gift card category', 'wh'); ?></p>
        </td>
    </tr>
<?php
}
add_action('edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1);

// Save extra taxonomy fields callback function.
function wh_save_taxonomy_custom_meta($term_id)
{
    $gift_card_cat = filter_input(INPUT_POST, 'gift_card_cat');
    update_term_meta($term_id, 'gift_card_cat', $gift_card_cat);
}
//======= END add custom field in product category page at admin backend
// =====================================================================

// ==========================================================
//======= Display background ads on Home page
// function cstm_home_background_ads() { 
//     if(is_front_page()){
//         echo do_shortcode('[bsa_pro_ad_space id=23 padding_top="60" padding_left="60"]');
//     }    
// }
// add_action( 'wp_head', 'cstm_home_background_ads');

// add_filter( 'dokan_cart_shipping_packages', 'hide_shipping_weight_based', 10, 1 );

function hide_shipping_weight_based($package)
{
    echo '<pre>';
    print_r($package);
    echo '</pre>';
    die;
}
function my_hide_shipping_when_free_is_available($rates, $packages)
{
    $cart_content = WC()->cart->get_cart();
    $seller_pack = array();
    $packages = array();

    foreach ($cart_content as $key => $item) {
        // If individual seller product shipping is disable then out from here
        if (\WeDevs\DokanPro\Shipping\Methods\ProductShipping::is_product_disable_shipping($item['product_id'])) {
            continue;
        }

        $post_author = get_post_field('post_author', $item['data']->get_id());
        $seller_pack[$post_author][$key] = $item;
    }
    $more_than_seller = array();
    foreach ($seller_pack as $seller_id => $pack) {
        $packages[] = array(
            'contents'        => $pack,
            'contents_cost'   => array_sum(wp_list_pluck($pack, 'line_total')),
            'applied_coupons' => WC()->cart->get_applied_coupons(),
            'user'            => array(
                'ID' => get_current_user_id(),
            ),
            'seller_id'       =>  $seller_id,
            'destination'     => array(
                'country'     => WC()->customer->get_shipping_country(),
                'state'       => WC()->customer->get_shipping_state(),
                'postcode'    => WC()->customer->get_shipping_postcode(),
                'city'        => WC()->customer->get_shipping_city(),
                'address'     => WC()->customer->get_shipping_address(),
                'address_2'   => WC()->customer->get_shipping_address_2()
            )
        );
        $more_than_seller[] = $seller_id;
    }
    if (count(array_unique($more_than_seller)) > 1) {
        unset($rates['flat_rate:3']);
    }
    return $rates;
}
// add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 10, 2 );

// add_action( 'woocommerce_cart_calculate_fees','woocommerce_custom_surcharge' );
function woocommerce_custom_surcharge($cart)
{
    global $woocommerce;
    echo '<pre>';
    print_r($cart);
    echo '</pre>';
    die;
    echo "hello here";
    die;
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    $county     = array('US');
    $percentage     = 0.01;

    if (in_array($woocommerce->customer->get_shipping_country(), $county)) :
        $surcharge = ($woocommerce->cart->cart_contents_total + $woocommerce->cart->shipping_total) * $percentage;
        $woocommerce->cart->add_fee('Surcharge', $surcharge, true, '');
    endif;
}

function getLatLong()
{
    $address = 'White House, Pennsylvania Avenue Northwest, Washington, DC, United States';
    // if(!empty($address)){
    // Formatted address
    $formattedAddr = str_replace(' ', '+', $address);
    // Send request and receive json data by address
    $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddr . '&sensor=true_or_false&key=AIzaSyDeZRLWPQST-zStJIVWfKHtrUrnAYewR10');
    $output = json_decode($geocodeFromAddr);
    // Get latitude and longitute from json data
    $data['latitude']  = $output->results[0]->geometry->location->lat;
    $data['longitude'] = $output->results[0]->geometry->location->lng;
    // Return latitude and longitude of the given address
    // print_r($output);
    //     if(!empty($data)){
    //         return $data;
    //     }else{
    //         return false;
    //     }
    // }else{
    //     return false;   
    // }

    $curl = curl_init();


    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.farassi.com/prices",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => "{\"from\":{\"longitude\":21.192572,\"latitude\":72.799736},\"to\":{\"longitude\":21.16708,\"latitude\":72.86569}}",

        CURLOPT_HTTPHEADER => array(

            "accept: application/json",

            "content-type: application/json"

        ),

    ));


    $response = curl_exec($curl);

    $err = curl_error($curl);


    curl_close($curl);

    // echo "hello hre";
    if ($err) {

        echo "cURL Error #:" . $err;
    } else {

        echo $response;
    }
}
// add_action('wp_footer', 'getLatLong');

add_filter('woocommerce_product_add_to_cart_text', 'bbloomer_archive_custom_cart_button_text');

function bbloomer_archive_custom_cart_button_text()
{
    global $product;
    if (
        has_term('car-rental', 'product_cat', $product->ID)
        || has_term('event-rentals', 'product_cat', $product->ID)
        || has_term('event-centers', 'product_cat', $product->ID)
        || has_term('home-rental', 'product_cat', $product->ID)
        || has_term('rental', 'product_cat', $product->ID)
    ) {
        return 'Rent now';
    } else if (has_term('auction', 'product_cat', $product->ID)) {
        return 'Bid now';
    } else {
        return 'Add to cart';
    }
}

add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text');
function woocommerce_custom_single_add_to_cart_text()
{
    global $product;
    if (
        has_term('car-rental', 'product_cat', $product->ID)
        || has_term('event-rentals', 'product_cat', $product->ID)
        || has_term('event-centers', 'product_cat', $product->ID)
        || has_term('home-rental', 'product_cat', $product->ID)
        || has_term('rental', 'product_cat', $product->ID)
    ) {
        return 'Rent now';
    } else if (has_term('auction', 'product_cat', $product->ID)) {
        return 'Bid now';
    } else {
        return 'Add to cart';
    }
}
// START cqategories selection based on module
/**
 * Set admin-ajax.php on the front side (by default it is available only for Backend)
 */
add_action('wp_head', 'pluginname_ajaxurl');
function pluginname_ajaxurl()
{
?>
    <script type="text/javascript">
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
    <?php
}

function get_categories_call()
{
    global $wpdb;
    $module_code = $_POST['module_code'];
    $data_prod_id = isset($_POST['data_prod_id']) && !empty($_POST['data_prod_id']) ? $_POST['data_prod_id'] : 0;
    $data_prod_comission = isset($_POST['data_prod_comission']) && !empty($_POST['data_prod_comission']) ? $_POST['data_prod_comission'] : 0;
    ob_start();

    if ($module_code == 'Supermarket') {
        $first_args = array(
            'show_option_none' => '',
            'parent' => 17641,
            'taxonomy' => 'product_cat',
            'hide_empty' => 0,
            'hierarchical' => 1,
        );
    } else if ($module_code == 'Auction') {
        $first_args = array(
            'show_option_none' => '',
            'parent' => 17573,
            'taxonomy' => 'product_cat',
            'hide_empty' => 0,
            'hierarchical' => 1,
        );
    } else if ($module_code == 'Grocery') {
        $first_args = array(
            'show_option_none' => '',
            'parent' => 17572,
            'taxonomy' => 'product_cat',
            'hide_empty' => 0,
            'hierarchical' => 1,
        );
    } else if ($module_code == 'Rental') {
        $first_args = array(
            'show_option_none' => '',
            'parent' => 17574,
            'taxonomy' => 'product_cat',
            'hide_empty' => 0,
            'hierarchical' => 1,
        );
    } else if ($module_code == 'Service'){
		$first_args = array(
            'show_option_none' => '',
            'parent' => 23598,
            'taxonomy' => 'product_cat',
            'hide_empty' => 0,
            'hierarchical' => 1,
        );
	}

    $first_subcats = get_categories($first_args);

    if (!empty($first_subcats)) {
        if ($module_code == 'Supermarket') {
           // echo '<option selected="selected" class="level-0" value="17641" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
           // echo 'Supermarket';
          //  echo '</option>';
        } else if ($module_code == 'Grocery') {
          //  echo '<option selected="selected" class="level-0" value="17572" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
          //  echo 'Grocery';
          //  echo '</option>';
        } else if ($module_code == 'Auction') {
          //  echo '<option selected="selected" class="level-0" value="17573" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
         //   echo 'Auction';
         //   echo '</option>';
        } else if ($module_code == 'Rental') {
          //  echo '<option selected="selected" class="level-0" value="17574" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
         //   echo 'Rental';
          //  echo '</option>';
        }
        foreach ($first_subcats as $key => $category) {
            echo '<option class="level-0" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
            echo $category->name;
            echo '</option>';
            // START second level
            //===================
            $second_args = array(
                'show_option_none' => '',
                'parent' => $category->term_id,
                'taxonomy' => 'product_cat',
                'hide_empty' => 0,
                'hierarchical' => 1,
            );

            $second_subcats = get_categories($second_args);

            if (!empty($second_subcats)) {
                foreach ($second_subcats as $key => $category) {
                    echo '<option class="level-1" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                    echo '&nbsp&nbsp' . $category->name;
                    echo '</option>';
                    // START third level
                    //===================
                    $third_args = array(
                        'show_option_none' => '',
                        'parent' => $category->term_id,
                        'taxonomy' => 'product_cat',
                        'hide_empty' => 0,
                        'hierarchical' => 1,
                    );

                    $third_subcats = get_categories($third_args);

                    if (!empty($third_subcats)) {
                        foreach ($third_subcats as $key => $category) {
                            echo '<option class="level-2" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                            echo '&nbsp&nbsp&nbsp&nbsp' . $category->name;
                            echo '</option>';
                            // START fourth level
                            //===================
                            $fourth_args = array(
                                'show_option_none' => '',
                                'parent' => $category->term_id,
                                'taxonomy' => 'product_cat',
                                'hide_empty' => 0,
                                'hierarchical' => 1,
                            );

                            $fourth_subcats = get_categories($fourth_args);

                            if (!empty($fourth_subcats)) {
                                foreach ($fourth_subcats as $key => $category) {
                                    echo '<option class="level-3" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                                    echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $category->name;
                                    echo '</option>';
                                    // START fifth level
                                    //===================
                                    $fifth_args = array(
                                        'show_option_none' => '',
                                        'parent' => $category->term_id,
                                        'taxonomy' => 'product_cat',
                                        'hide_empty' => 0,
                                        'hierarchical' => 1,
                                    );

                                    $fifth_subcats = get_categories($fifth_args);

                                    if (!empty($fifth_subcats)) {
                                        foreach ($fifth_subcats as $key => $category) {
                                            echo '<option class="level-4" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                                            echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $category->name;
                                            echo '</option>';
                                            // START sixth level
                                            //===================
                                            $sixth_args = array(
                                                'show_option_none' => '',
                                                'parent' => $category->term_id,
                                                'taxonomy' => 'product_cat',
                                                'hide_empty' => 0,
                                                'hierarchical' => 1,
                                            );

                                            $sixth_subcats = get_categories($sixth_args);

                                            if (!empty($sixth_subcats)) {
                                                foreach ($sixth_subcats as $key => $category) {
                                                    echo '<option class="level-5" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                                                    echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $category->name;
                                                    echo '</option>';
                                                    // START seventh level
                                                    //===================
                                                    $seventh_args = array(
                                                        'show_option_none' => '',
                                                        'parent' => $category->term_id,
                                                        'taxonomy' => 'product_cat',
                                                        'hide_empty' => 0,
                                                        'hierarchical' => 1,
                                                    );

                                                    $seventh_subcats = get_categories($seventh_args);

                                                    if (!empty($seventh_subcats)) {
                                                        foreach ($seventh_subcats as $key => $category) {
                                                            echo '<option class="level-6" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                                                            echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $category->name;
                                                            echo '</option>';
                                                            // START eighth level
                                                            //===================
                                                            $eighth_args = array(
                                                                'show_option_none' => '',
                                                                'parent' => $category->term_id,
                                                                'taxonomy' => 'product_cat',
                                                                'hide_empty' => 0,
                                                                'hierarchical' => 1,
                                                            );

                                                            $eighth_subcats = get_categories($eighth_args);

                                                            if (!empty($eighth_subcats)) {
                                                                foreach ($eighth_subcats as $key => $category) {
                                                                    echo '<option class="level-7" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                                                                    echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $category->name;
                                                                    echo '</option>';
                                                                    // START nineth level
                                                                    //===================
                                                                    $nineth_args = array(
                                                                        'show_option_none' => '',
                                                                        'parent' => $category->term_id,
                                                                        'taxonomy' => 'product_cat',
                                                                        'hide_empty' => 0,
                                                                        'hierarchical' => 1,
                                                                    );

                                                                    $nineth_subcats = get_categories($nineth_args);

                                                                    if (!empty($nineth_subcats)) {
                                                                        foreach ($nineth_subcats as $key => $category) {
                                                                            echo '<option class="level-8" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                                                                            echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $category->name;
                                                                            echo '</option>';
                                                                            // START tenth level
                                                                            //===================
                                                                            $tenth_args = array(
                                                                                'show_option_none' => '',
                                                                                'parent' => $category->term_id,
                                                                                'taxonomy' => 'product_cat',
                                                                                'hide_empty' => 0,
                                                                                'hierarchical' => 1,
                                                                            );

                                                                            $tenth_subcats = get_categories($tenth_args);

                                                                            if (!empty($tenth_subcats)) {
                                                                                echo '<option class="level-9" value="' . $category->term_id . '" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
                                                                                echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $category->name;
                                                                                echo '</option>';
                                                                            }
                                                                            //===================
                                                                            // END tenth level
                                                                        }
                                                                    }
                                                                    //===================
                                                                    // END nineth level
                                                                }
                                                            }
                                                            //===================
                                                            // END eighth level
                                                        }
                                                    }
                                                    //===================
                                                    // END seventh level
                                                }
                                            }
                                            //===================
                                            // END sixth level
                                        }
                                    }
                                    //===================
                                    // END fifth level
                                }
                            }
                            //===================
                            // END fourth level
                        }
                    }
                    //===================
                    // END third level
                }
            }
            //===================
            // END second level
        }
    }

    $results = ob_get_contents();

    ob_end_clean();

    echo $results;
    die();
}

add_action('wp_ajax_get_categories_call', 'get_categories_call');
add_action('wp_ajax_nopriv_get_categories_call', 'get_categories_call');

// END cqategories selection based on module

// ==========================================================
//======= Save select module field value from the vendor add new product page
function cstm_save_prod_module_value($product_id, $postdata)
{
    // update_post_meta($product_id, '_prod_module', str_replace(' ','',$postdata['prod_module']));
    update_post_meta($product_id, '_prod_module', str_replace(' ', '', $_POST['prod_module']));
	$module = $_POST['prod_module'];
	if($module == 'Supermarket'){
		wp_add_object_terms($product_id, array(17641), 'product_cat');
	}elseif($module == 'Grocery'){
		wp_add_object_terms($product_id, array(17572), 'product_cat');
	}elseif($module == 'Auction'){
		wp_add_object_terms($product_id, array(17573), 'product_cat');
	}elseif($module == 'Rental'){
		wp_add_object_terms($product_id, array(17574), 'product_cat');
	}elseif($module == 'Service'){
		wp_add_object_terms($product_id, array(23598), 'product_cat');
	}
	//echo $_POST['prod_module']; die();
    // update_post_meta($product_id, '_prod_module', str_replace(' ','',$_POST['prod_module']));
    // $a=array("red","green");
    // array_push($postdata['product_cat'],"17573");
    // print_r($postdata);
    // $postdata
    // echo '<pre>';
    // print_r($postdata);
    // echo '</pre>';
    // die;
     //wp_add_object_terms($product_id, 17573, 'product_cat');
     //
     if(isset($_POST['dropship_supplier'])){
		 wp_set_object_terms($product_id, (int) $_POST['dropship_supplier'] , 'dropship_supplier');
		 if(get_term($_POST['dropship_supplier'],'dropship_supplier')){
			$term = get_term($_POST['dropship_supplier'],'dropship_supplier');
			update_post_meta($product_id, 'supplier' , $term->name);
			update_post_meta($product_id, 'supplierid' , $term->term_id);
		 }else{
			update_post_meta($product_id, '' , $term->name);
			update_post_meta($product_id, '' , $term->term_id);
		 }
	 }
	if(isset($_POST['made_in'])){
		update_post_meta($product_id,'made_in',$_POST['made_in']);
	}
	 
     return false;
}
add_action('dokan_new_product_added', 'cstm_save_prod_module_value', 10, 2);
add_action('dokan_product_updated', 'cstm_save_prod_module_value', 10, 2);
// for auction product
add_action('dokan_new_auction_product_added', 'cstm_save_prod_module_value', 10, 2);
add_action('dokan_update_auction_product', 'cstm_save_prod_module_value_new', 10, 1);

function testing_vali($errors)
{
    if (empty($_POST['feat_image_id'])) {
        $errors[] = __('Please upload product image!', 'dokan-lite');
    }
    return $errors;
}
// add_filter('dokan_can_edit_product', 'testing_vali', 1, 1);
// add_filter('dokan_can_add_product', 'testing_vali', 1, 1);
// add_filter('dokan_can_edit_auction_product', 'testing_vali', 1, 1);
// add_filter('dokan_can_add_auction_product', 'testing_vali', 1, 1);

function cstm_save_prod_module_value_new($product_id)
{
    update_post_meta($product_id, '_prod_module', str_replace(' ', '', $_POST['prod_module']));
}

function testing_footerrr()
{

    // $first_args = array(
    //     'show_option_none' => '',
    //     'parent' => 17572, 
    //     'taxonomy' => 'product_cat',
    //     'hide_empty' => 0, 
    //     'hierarchical' => 1,
    // );

    // $first_subcats = get_categories($first_args);

    // if( !empty($first_subcats) ){
    //     foreach ($first_subcats as $key => $category) {
    //         echo '<option class="level-0" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //         echo $category->name;
    //         echo '</option>';
    //         // START second level
    //         //===================
    //         $second_args = array(
    //             'show_option_none' => '',
    //             'parent' => $category->term_id, 
    //             'taxonomy' => 'product_cat',
    //             'hide_empty' => 0, 
    //             'hierarchical' => 1,
    //         );

    //         $second_subcats = get_categories($second_args);

    //         if( !empty($second_subcats) ){
    //             foreach ($second_subcats as $key => $category) {
    //                 echo '<option class="level-1" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                 echo $category->name;
    //                 echo '</option>';
    //                 // START third level
    //                 //===================
    //                 $third_args = array(
    //                     'show_option_none' => '',
    //                     'parent' => $category->term_id, 
    //                     'taxonomy' => 'product_cat',
    //                     'hide_empty' => 0, 
    //                     'hierarchical' => 1,
    //                 );

    //                 $third_subcats = get_categories($third_args);

    //                 if( !empty($third_subcats) ){
    //                     foreach ($third_subcats as $key => $category) {
    //                         echo '<option class="level-2" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                         echo $category->name;
    //                         echo '</option>';
    //                         // START fourth level
    //                         //===================
    //                         $fourth_args = array(
    //                             'show_option_none' => '',
    //                             'parent' => $category->term_id, 
    //                             'taxonomy' => 'product_cat',
    //                             'hide_empty' => 0, 
    //                             'hierarchical' => 1,
    //                         );

    //                         $fourth_subcats = get_categories($fourth_args);

    //                         if( !empty($fourth_subcats) ){
    //                             foreach ($fourth_subcats as $key => $category) {
    //                                 echo '<option class="level-3" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                                 echo $category->name;
    //                                 echo '</option>';
    //                                 // START fifth level
    //                                 //===================
    //                                 $fifth_args = array(
    //                                     'show_option_none' => '',
    //                                     'parent' => $category->term_id, 
    //                                     'taxonomy' => 'product_cat',
    //                                     'hide_empty' => 0, 
    //                                     'hierarchical' => 1,
    //                                 );

    //                                 $fifth_subcats = get_categories($fifth_args);

    //                                 if( !empty($fifth_subcats) ){
    //                                     foreach ($fifth_subcats as $key => $category) {
    //                                         echo '<option class="level-4" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                                         echo $category->name;
    //                                         echo '</option>';
    //                                         // START sixth level
    //                                         //===================
    //                                         $sixth_args = array(
    //                                             'show_option_none' => '',
    //                                             'parent' => $category->term_id, 
    //                                             'taxonomy' => 'product_cat',
    //                                             'hide_empty' => 0, 
    //                                             'hierarchical' => 1,
    //                                         );

    //                                         $sixth_subcats = get_categories($sixth_args);

    //                                         if( !empty($sixth_subcats) ){
    //                                             foreach ($sixth_subcats as $key => $category) {
    //                                                 echo '<option class="level-5" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                                                 echo $category->name;
    //                                                 echo '</option>';
    //                                                 // START seventh level
    //                                                 //===================
    //                                                 $seventh_args = array(
    //                                                     'show_option_none' => '',
    //                                                     'parent' => $category->term_id, 
    //                                                     'taxonomy' => 'product_cat',
    //                                                     'hide_empty' => 0, 
    //                                                     'hierarchical' => 1,
    //                                                 );

    //                                                 $seventh_subcats = get_categories($seventh_args);

    //                                                 if( !empty($seventh_subcats) ){
    //                                                     foreach ($seventh_subcats as $key => $category) {
    //                                                         echo '<option class="level-6" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                                                         echo $category->name;
    //                                                         echo '</option>';
    //                                                         // START eighth level
    //                                                         //===================
    //                                                         $eighth_args = array(
    //                                                             'show_option_none' => '',
    //                                                             'parent' => $category->term_id, 
    //                                                             'taxonomy' => 'product_cat',
    //                                                             'hide_empty' => 0, 
    //                                                             'hierarchical' => 1,
    //                                                         );

    //                                                         $eighth_subcats = get_categories($eighth_args);

    //                                                         if( !empty($eighth_subcats) ){
    //                                                             foreach ($eighth_subcats as $key => $category) {
    //                                                                 echo '<option class="level-7" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                                                                 echo $category->name;
    //                                                                 echo '</option>';
    //                                                                 // START nineth level
    //                                                                 //===================
    //                                                                 $nineth_args = array(
    //                                                                     'show_option_none' => '',
    //                                                                     'parent' => $category->term_id, 
    //                                                                     'taxonomy' => 'product_cat',
    //                                                                     'hide_empty' => 0, 
    //                                                                     'hierarchical' => 1,
    //                                                                 );

    //                                                                 $nineth_subcats = get_categories($nineth_args);

    //                                                                 if( !empty($nineth_subcats) ){
    //                                                                     foreach ($nineth_subcats as $key => $category) {
    //                                                                         echo '<option class="level-8" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                                                                         echo $category->name;
    //                                                                         echo '</option>';
    //                                                                         // START tenth level
    //                                                                         //===================
    //                                                                         $tenth_args = array(
    //                                                                             'show_option_none' => '',
    //                                                                             'parent' => $category->term_id, 
    //                                                                             'taxonomy' => 'product_cat',
    //                                                                             'hide_empty' => 0, 
    //                                                                             'hierarchical' => 1,
    //                                                                         );

    //                                                                         $tenth_subcats = get_categories($tenth_args);

    //                                                                         if( !empty($tenth_subcats) ){
    //                                                                             echo '<option class="level-9" value="'.$category->term_id.'" data-commission="'.$data_prod_comission.'" data-product-id="'.$data_prod_id.'">';
    //                                                                             echo $category->name;
    //                                                                             echo '</option>';
    //                                                                         }
    //                                                                         //===================
    //                                                                         // END tenth level
    //                                                                     }
    //                                                                 }
    //                                                                 //===================
    //                                                                 // END nineth level
    //                                                             }
    //                                                         }
    //                                                         //===================
    //                                                         // END eighth level
    //                                                     }
    //                                                 }
    //                                                 //===================
    //                                                 // END seventh level
    //                                             }
    //                                         }
    //                                         //===================
    //                                         // END sixth level
    //                                     }
    //                                 }
    //                                 //===================
    //                                 // END fifth level
    //                             }
    //                         }
    //                         //===================
    //                         // END fourth level
    //                     }
    //                 }
    //                 //===================
    //                 // END third level
    //             }
    //         }
    //         //===================
    //         // END second level
    //     }
    // }

    // $args = array(
    //     'show_option_none' => '',
    //     'parent' => 17572, 
    //     'taxonomy' => 'product_cat',
    //     'hide_empty' => 0, 
    //     'hierarchical' => 1,
    // );

    // $subcats = get_categories($args);

    // echo '<ul class="wooc_sclist" style="display: none;">';
    // echo '<pre>';
    // print_r($subcats);
    // echo '</pre>';
    // $orderby = 'name';
    // $order = 'asc';
    // $hide_empty = false ;
    // $cat_args = array(
    //     'orderby'    => $orderby,
    //     'order'      => $order,
    //     'hide_empty' => $hide_empty,
    // );

    // $product_categories = get_terms( 'product_cat', $cat_args );

    // if( !empty($product_categories) ){
    //     echo '<ul>';
    //     foreach ($product_categories as $key => $category) {
    //         echo '<li>';
    //         echo '<a href="'.get_term_link($category).'" >';
    //         echo $category->name;
    //         echo '</a>';
    //         echo '</li>';
    //     }
    //     echo '</ul>';
    // }
    // foreach ($subcats as $sc) { 
    //     $link = get_term_link( $sc->slug, $sc->taxonomy ); 
    //      echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
    //      $sub_args = array(
    //         'show_option_none' => '',
    //         'parent' => 17572, 
    //         'taxonomy' => 'product_cat',
    //         'hide_empty' => 0, 
    //         'hierarchical' => 1,
    //     );

    //     $sub_subcats = get_categories($sub_args);

    // echo '<ul class="wooc_sclist" style="display: none;">';
    // if(!empty())
    // foreach ($sub_subcats as $sub_cat) {

    // }
    // } 
    // echo '</ul>';
}
// add_action('wp_footer','testing_footerrr');

// ==========================================================
//======= Hide empty categories from mega menu (Top main menu)
function nav_remove_empty_category_menu_item($items, $menu, $args)
{
    global $wpdb;
    $nopost = $wpdb->get_col("SELECT term_taxonomy_id FROM $wpdb->term_taxonomy WHERE count = 0");
    foreach ($items as $key => $item) {
        if (('taxonomy' == $item->type) && (in_array($item->object_id, $nopost))) {
            unset($items[$key]);
        }
    }
    return $items;
}
// add_filter( 'wp_get_nav_menu_items', 'nav_remove_empty_category_menu_item', 10, 3 );


/**
 * 	Modifying Dokan Dashboard Navigation
 */
add_filter('dokan_get_dashboard_nav', 'prefix_dokan_add_seller_nav', 99);
function prefix_dokan_add_seller_nav($urls)
{
    $urls['products']['title'] = 'Sell Products & Services';

	if(isset($urls['booking'])){
		$urls['booking']['pos'] = 31;
		$urls['booking']['title'] =  __('List Rentals & Booking', 'dokan');
	}


	if(isset($urls['auction'])){
		$urls['auction']['pos'] = 41;
		$urls['auction']['title'] =  __('Sell by Auction', 'dokan');
		$urls['auction']['icon'] = '<i class="fa fa-gavel"></i>';
	}

	$urls['buyer-dashboard']['pos'] = 999;
	$urls['buyer-dashboard']['title'] =  __('Go to buyer dashboard', 'dokan');
	$urls['buyer-dashboard']['icon'] = '<i class="fa fa-dashboard"></i>';
    $urls['buyer-dashboard']['url'] = '/my-account';
	//print_r($urls['auction']);
	return $urls;
}






add_action('set_comment_cookies', function ($comment, $user) {
    setcookie('ta_comment_wait_approval', '1', 0, '/');
}, 10, 2);

add_action('init', function () {
    if (isset($_COOKIE['ta_comment_wait_approval']) && $_COOKIE['ta_comment_wait_approval'] === '1') {
        setcookie('ta_comment_wait_approval', '0', 0, '/');
        add_action('comment_form_before', function () {
            echo '<div class="woocommerce-message" role="alert" style="margin-bottom: 20px !important;">Your details has been sent successfully</div>';
        });
    }
});

add_filter('comment_post_redirect', function ($location, $comment) {
    $location = get_permalink($comment->comment_post_ID) . '#wait_approval';
    return $location;
}, 10, 2);

function no_wordpress_errors()
{
    return 'Wrong username or password! ';
}
add_filter('login_errors', 'no_wordpress_errors');

header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security:maxage=31536000; includeSubdomains; preload');
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
add_filter('show_admin_bar', '__return_false');
function sww_add_seals_to_checkout()
{
    echo '<div class="aligncenter">
    <a><img style="width:100%; height: auto; max-width:180px;" alt="This Site is Secure" src="https://cutemesh.com/wp-content/uploads/2021/01/SSL.png"></a><div class="payment-badges-icon"><img src="https://cutemesh.com/wp-content/uploads/2021/01/paypal-1.png"></div>
    </div>';
}
add_action('woocommerce_review_order_after_payment', 'sww_add_seals_to_checkout');

add_action('admin_footer', 'validation_js');
add_action('wp_footer', 'validation_js');

function validation_js()
{
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>';
    echo "<script>
    jQuery(document).ready(function() {
		if(jQuery('.dokan-shipping-dimention-options').length > 0){
			jQuery('#publishing-action #publish').prop('disabled', true);
			jQuery('.dokan-shipping-dimention-options #_weight').val('0');
			setInterval(function(){
				 var weight_val = jQuery('#shipping_product_data .wc_input_decimal').val();
				 console.log(weight_val);
				 if(weight_val !== null && weight_val !== '') {
					jQuery('#publishing-action #publish').prop('disabled', false);
				 }
			}, 5000);
			jQuery('.dokan-shipping-dimention-options #_weight').change(function(){
				setTimeout(function(){
				   var front_weight = jQuery('.dokan-shipping-dimention-options #_weight').val();
				   if(front_weight==''){
					  jQuery('.dokan-shipping-dimention-options #_weight').val('0');
				   }
				}, 2000);
			});
		}
        
    });
    </script>";
}

// START change the dokan seller setup wizard text (https://cutemesh.com/?page=dokan-seller-setup)
class Dokan_Setup_Wizard_Override extends Dokan_Seller_Setup_Wizard
{

    /**
     * Introduction step.
     */
    public function dokan_setup_introduction()
    {
        $dashboard_url = dokan_get_navigation_url();
    ?>
        <h1><?php esc_attr_e('Welcome to the CuteMesh Marketplace', 'dokan-lite'); ?></h1>
        <p><?php echo wp_kses(__('Thank you for choosing The CuteMesh Marketplace to power your online store! This quick setup wizard will help you configure the basic settings. <strong>It’s completely optional and shouldn’t take longer than two minutes.</strong>', 'dokan-lite'), ['strong' => []]); ?></p>
        <p><?php esc_attr_e('No time right now? If you don’t want to go through the wizard, you can skip and return to the Store!', 'dokan-lite'); ?></p>
        <p class="wc-setup-actions step">
            <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button-primary button button-large button-next lets-go-btn dokan-btn-theme"><?php esc_attr_e('Let\'s Go!', 'dokan-lite'); ?></a>
            <a href="<?php echo esc_url($dashboard_url); ?>" class="button button-large not-right-now-btn dokan-btn-theme"><?php esc_attr_e('Not right now', 'dokan-lite'); ?></a>
        </p>
    <?php
        do_action('dokan_seller_wizard_introduction', $this);
    }
}
new Dokan_Setup_Wizard_Override;
function initheaderforchangemarketplacetext()
{
    if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] == 'dokan-seller-setup') {
    ?>
        <script src="http://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function() {
                jQuery('.dokan-vendor-setup-wizard a.wc-return-to-dashboard').text('Return to the CuteMesh Marketplace');
            });
        </script>
    <?php
    }
}
add_action('init', 'initheaderforchangemarketplacetext');
// END change the dokan seller setup wizard text (https://cutemesh.com/?page=dokan-seller-setup)

function woocom_validate_extra_register_fields($username, $email, $validation_errors)
{
    // print_r($_POST);die;
    if (isset($_POST['billing_phone']) && !empty($_POST['billing_phone']) ) {
        $hasPhoneNumber = get_users('meta_value=' . $_POST['billing_phone']);
        if (!empty($hasPhoneNumber)) {
            $validation_errors->add('billing_phone_error', __(' Your phone number has already been verified!.', 'woocommerce'));
        }
    }else{
        if(empty($_POST['billing_phone'])){
            $validation_errors->add('billing_phone_error', __('Phone number is required!', 'woocommerce'));
        }
    }
    return $validation_errors;
}

add_action('woocommerce_register_post', 'woocom_validate_extra_register_fields', 10, 3);

add_action('wp_footer', 'format_checkout_billing_phone');
function format_checkout_billing_phone()
{
    global $wp;
    $request = explode('/', $wp->request);

    // If NOT in My account dashboard page
    // if (is_account_page()) {
    ?>
        <script type="text/javascript">
		if(!jQuery("body").hasClass("page-id-1613")){	
		   var bill_phone = jQuery('#billing_phone').val();
            if (bill_phone != '' && bill_phone != undefined) {
                bill_phone = bill_phone.replace(/[^0-9]/g, '');
                bill_phone = bill_phone.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
                jQuery('#billing_phone').val(bill_phone);
            }
            jQuery(function($) {
                jQuery('#billing_phone').on('input focusout', function() {
                    var p = jQuery(this).val();

                    p = p.replace(/[^0-9]/g, '');
                    p = p.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
                    jQuery(this).val(p);
                });
            });
		}
        </script>
    <?php
    // }
    // if (is_checkout() && !is_wc_endpoint_url()) :
    ?>
        <!-- <script type="text/javascript">
            var bill_phone = jQuery('#billing_phone').val();
            if (bill_phone != '') {
                bill_phone = bill_phone.replace(/[^0-9]/g, '');
                bill_phone = bill_phone.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
                jQuery('#billing_phone').val(bill_phone);
            }
            jQuery(function($) {
                jQuery('#billing_phone').on('input focusout', function() {
                    var p = jQuery(this).val();

                    p = p.replace(/[^0-9]/g, '');
                    p = p.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
                    jQuery(this).val(p);
                });
            });
        </script> -->
    <?php
    // endif;
    if (!is_user_logged_in()) {
    ?>
        <style>
            .page-id-54 .woocommerce {
                display: block !important;
            }
        </style>
        <script>
            setTimeout(() => {
                jQuery('#loginform input').removeAttr('disabled');
            }, 1000);
        </script>
<?php
    }
}

// STRAT add new tab in my account page (Advertise)
// ------------------
// 1. Register new endpoint (URL) for My Account page
// Note: Re-save Permalinks or it will give 404 error  
function advertise_endpoint()
{
    add_rewrite_endpoint('advertise', EP_ROOT | EP_PAGES);
}
add_action('init', 'advertise_endpoint');

// ------------------
// 2. Add new query var  
function advertise_query_vars($vars)
{
    $vars[] = 'advertise';
    return $vars;
}
add_filter('query_vars', 'advertise_query_vars', 0);

// ------------------
// 3. Insert the new endpoint into the My Account menu  
function advertise_link_my_account($items)
{
    $items['advertise'] = 'Advertise';
    return $items;
}
add_filter('woocommerce_account_menu_items', 'advertise_link_my_account');

// ------------------
// 4. Add content to the new tab  
function advertise_content()
{   
    echo do_shortcode('[bsa_pro_form_and_stats]'); 
}
add_action('woocommerce_account_advertise_endpoint', 'advertise_content');
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format
// END add new tab in my account page (Advertise)

// ----------------------------------------------------
// STRAT add new tab in my account page (Advertise Statistics)
// ------------------
// 1. Register new endpoint (URL) for My Account page
// Note: Re-save Permalinks or it will give 404 error  
function advertise_statistics_endpoint()
{
    add_rewrite_endpoint('advertise-statistics', EP_ROOT | EP_PAGES);
}
add_action('init', 'advertise_statistics_endpoint');

// ------------------
// 2. Add new query var  
function advertise_statistics_query_vars($vars)
{
    $vars[] = 'advertise-statistics';
    return $vars;
}
add_filter('query_vars', 'advertise_statistics_query_vars', 0);

// ------------------
// 3. Insert the new endpoint into the My Account menu  
function advertise_statistics_link_my_account($items)
{
    $items['advertise-statistics'] = 'Advertise Statistics';
    return $items;
}
add_filter('woocommerce_account_menu_items', 'advertise_statistics_link_my_account');

// ------------------
// 4. Add content to the new tab  
function advertise_statistics_content()
{    
    echo do_shortcode('[bsa_pro_user_panel]');
}
add_action('woocommerce_account_advertise-statistics_endpoint', 'advertise_statistics_content');
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format
// END add new tab in my account page (Advertise)

/**
 * Modify the "must_log_in" string of the comment form.
 *
 * @see http://wordpress.stackexchange.com/a/170492/26350
 */
function wpdocs_set_comment_form_defaults($defaults)
{
    //Here you are able to change the $defaults[]
    //For example: 
    if ('careers' == get_post_type()) {
        $defaults['must_log_in'] = '<p class="must-log-in">You must be <a href="' . get_site_url() . '/my-account' . '">Logged</a> to submit resume.</p>';
    }

    return $defaults;
}
add_filter('comment_form_defaults', 'wpdocs_set_comment_form_defaults');

// Display the mobile phone field
// add_action( 'woocommerce_edit_account_form_start', 'add_billing_phone_to_edit_account_form' ); // At start
add_action( 'woocommerce_edit_account_form', 'add_billing_phone_to_edit_account_form' ); // After existing fields
function add_billing_phone_to_edit_account_form() {
    $user = wp_get_current_user();
    ?>
     <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="billing_phone"><?php _e( 'Phone number', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--phone input-text" name="billing_phone" id="billing_phone" value="<?php echo esc_attr( $user->billing_phone ); ?>" />
    </p>
    <?php
}

// Check and validate the mobile phone
add_action( 'woocommerce_save_account_details_errors','billing_phone_field_validation', 20, 1 );
function billing_phone_field_validation( $args ){
    if ( isset($_POST['billing_phone']) && empty($_POST['billing_phone']) )
        $args->add( 'error', __( 'Please fill in your phone number', 'woocommerce' ),'');
}

// Save the mobile phone value to user data
add_action( 'woocommerce_save_account_details', 'my_account_saving_billing_phone', 20, 1 );
function my_account_saving_billing_phone( $user_id ) {
    if( isset($_POST['billing_phone']) && ! empty($_POST['billing_phone']) )
        update_user_meta( $user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']) );
}



// add_action( 'woocommerce_product_query', function($query, $object){
//     if(!is_admin()){
//         $query->set('posts_per_page',2); echo 'fff'; die();
//     }

// },200,2);

// add_filter( 'woocommerce_shortcode_products_query', 'shortcode_products_query_on_location', 100, 3 );
// function shortcode_products_query_on_location( $query_args, $atts, $loop_name ){
   
// echo '<pre>'; print_r($query_args); echo '</pre>'; die();
//    $query_args['posts_per_page'] = 2; 
//     return $query_args;
// }

// add_action('pre_get_posts',function($query){
//     global $wp;
//     $request = explode('/', $wp->request);
 
//     if(!is_admin() && $request[0] == 'auction' && $query->get('post_type') == 'product'){
//         $tax_query = $query->get('tax_query');
//         $tax_query[]= array(
//             'taxonomy' => 'product_type',
//             'terms'    => array('auction'),
//             'field'    => 'slug',
//             'compare'  => 'IN'
//         );
      
//        $query->set('tax_query',$tax_query);
    
//     }
//     elseif(!is_admin() && $request[0] == 'rental' && $query->get('post_type') == 'product'){
//         $tax_query = $query->get('tax_query');
//         $tax_query[]= array(
//             'taxonomy' => 'product_type',
//             'terms'    => array('phive_booking'),
//             'field'    => 'slug',
//             'compare'  => 'IN'
//         );
//        $query->set('tax_query',$tax_query);
   
//     }
//     elseif(!is_admin() && $request[0] == 'supermarket' && $query->get('post_type') == 'product'){
//         $tax_query = $query->get('tax_query');
//         $tax_query[]= array(
//             'taxonomy' => 'product_type',
//             'terms'    => array('phive_booking','auction'),
//             'field'    => 'slug',
//             'compare'  => 'NOT IN'
//         );
      
//        $query->set('tax_query',$tax_query);
		
//         //echo '<pre>'; print_r( $tax_query); echo '</pre>'; 
//     }
// },100);


// add_action('init',function(){
// 	if(!is_admin()){
// 		$query = new WP_Query(array(
// 			'post_type' => 'product',
// 			'post_status' => 'publish',
// 			'fields' => 'ids',
// 			'posts_per_page' => -1,
// 			'tax_query' => array(
// 				'relation' => 'AND',
// 				array(
// 					'taxonomy' => 'product_cat',
// 					'terms' => array(17574),
// 					'field' => 'term_id',
// 					'include_children' => true,
// 					'compare' => 'IN',
					
// 				),
// 				array(
// 					'taxonomy' => 'product_type',
// 					'terms' => array(291),
// 					'field' => 'term_id',
// 					'compare' => 'NOT IN'
// 				)
// 			)
// 		));
// 		//print_r(get_terms(array('fields'=>'ids','taxonomy'=>'product_cat','parent'=>17574)));
// 		//echo 'fasdf';
// 		//print_r( get_term_by('slug','phive_booking','product_type'));
// $posts = array(9179,9178,9188,9187,9183,9222,9224,9216,9217,9219,9218,9206,9172,9208,9211,9212,9214,9203,9204,9202,9205,9207,9213,9173,9175,9221,9223);
// 		foreach($posts as $id){
// 			wp_remove_object_terms($id, array(17574),'product_cat');
// 		}
// 		echo '<pre>'; print_r($query->posts); echo '</pre>';
// 	}
// });





// add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
// function wpa83367_price_html( $price, $product ){
// 	echo '<pre>'; echo $product->get_type(); echo '</pre>';
//     return $price;
// }






/**
 *	Appearance Menu Showing ALL
 */
add_filter( 'nav_menu_meta_box_object', 'disable_pagination_in_menu_meta_box', 9999 );
function disable_pagination_in_menu_meta_box($obj)
{ global $wp_meta_boxes; // echo '<pre style="margin-left:200px;" >'; print_r($wp_meta_boxes); echo '</pre>';
    $obj->_default_query = array(
        'posts_per_page' => -1
    );
    return $obj;
} 


// add_filter('get_terms_args',function($args,$taxonomy){
	
// 	if($args['taxonomy'][0] == 'product_cat' && is_admin() && get_current_screen()->base == 'nav-menus'){
// 		$args['number'] = -1;
// 	}	
// 	return $args;
// },200,2);


	
// add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker',999999 );
// function mw_enqueue_color_picker( $hook_suffix ) {
//     // first check that $hook_suffix is appropriate for your admin page
  
//     wp_dequeue_script( 'iris-js' );
// }
// 
// 
// 



// add_action('woocommerce_before_single_product_summary',function(){
// 	global $product; 
// echo '<pre>'; print_r(get_post_meta($product->id)); echo '</pre>';
// // 	// 	echo '<pre>'; print_r(get_terms(array('taxonomy'=>'dropship_supplier','object_ids' => $product->id))); echo '</pre>';
// 	echo 'Product Meta : <pre>'; print_r(get_post_meta($product->id)); echo '</pre>';
// },100);




// Adding Suppliers Options to import
add_filter('woocommerce_csv_product_import_mapping_options',function( $options, $item){
	$options['supplier'] = 'Supplier';
	return $options;
},100,2);

//Exporting Suppliers
add_filter('woocommerce_product_export_product_default_columns',function($options){
	$options['supplier'] = 'Supplier';
	return $options;
},200,1);

add_filter('woocommerce_product_export_product_column_supplier',function($value,$product,$column_id){
	$term = wp_get_post_terms($product->id, 'dropship_supplier');
	if(!empty($term)){
		$value = $term[0]->name;
	}
	//echo '<pre>'; print_r($term); echo '</pre>'; echo 'product_id is ' . $product->id;
	return $value;
},100,3);

add_action( 'woocommerce_product_import_inserted_product_object', function($product, $data ){
	if(!empty($data['supplier'])){
		$supplier = get_term_by('name', $data["supplier"] ,'dropship_supplier');
		if(!empty($supplier)){
			wp_set_object_terms($product->id, (int) $supplier->term_id , 'dropship_supplier');
			update_post_meta($product->id, 'supplier' , $supplier->name);
			update_post_meta($product->id, 'supplierid' , $supplier->term_id);
		}
		
	}
},100,2);




// Removing Tab of refund policy
 add_filter( 'woocommerce_product_tabs', function($tabs){ // echo '<pre>'; print_r($tabs); echo '</pre>';
	 unset($tabs['refund_policy']);
	 return $tabs;
	 
 },99999,1 );


// add_action('init',function(){
// 	if(!is_admin()){
// 		//echo '<pre>'; print_r(count(get_terms(array('taxonomy'=> 'product_cat','hide_empty'=>false,'include'=> array(273,5682,15353,990,1693,4959,6681,7302,673,718,1139,988,1390,3104,3259,3818,13933,7088,3260,12422,4460,6005,15332,1394,3261,6682,11003,12791,15132,7089,5743,17528,17529,17557,15814,13035,11797,2299,14934,15815,8925,17444,4059,12005,2922,13932,6683,1141,10756,989,6276,10281,13033,3105,1140,13231,991,8744,6277,8923,8309,15578,1251,1252,17445,17447,17443,4058,1392,1391,))))); echo '</pre>';
// 		$var = get_terms(array('taxonomy'=> 'product_cat','hide_empty'=>false,'include'=> array(273,5682,15353,990,1693,4959,6681,7302,673,718,1139,988,1390,3104,3259,3818,13933,7088,3260,12422,4460,6005,15332,1394,3261,6682,11003,12791,15132,7089,5743,17528,17529,17557,15814,13035,11797,2299,14934,15815,8925,17444,4059,12005,2922,13932,6683,1141,10756,989,6276,10281,13033,3105,1140,13231,991,8744,6277,8923,8309,15578,1251,1252,17445,17447,17443,4058,1392,1391,)));
// 		foreach($var as $vars){
// 			wp_delete_term( $vars->term_id,'product_cat' );
// 		}
// 	}
// });



// Adjusting Mobile Menu
add_filter('wp_get_nav_menu_items', 'prefix_add_categories_to_menu', 10, 3);
function prefix_add_categories_to_menu($items, $menu, $args) { //echo '<pre>'; print_r($menu); echo '</pre>';
    // Make sure we only run the code on the applicable menu
    if($menu->slug !== 'new-mobile-menu' || is_admin()) return $items;
	$first = $items[0];
    // Get all the product categories
    $categories = get_categories(array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'show_count' => 0,
        'pad_counts' => 0,
        'hierarchical' => 1,
        'hide_empty' => 0,
        'depth' => $depth,
        'title_li' => '',
        'echo' => 0 
    ));

    $menu_items = array();
	$menu_items[] = $first;
    // Create menu items
    foreach($categories as $category) {
        $new_item = (object)array(
            'ID' => intval($category->term_id),
            'db_id' => intval($category->term_id),
            'menu_item_parent' => intval($category->category_parent),
            'post_type' => "nav_menu_item",
            'object_id' => intval($category->term_id),
            'object' => "product_cat",
            'type' => "taxonomy",
            'type_label' => __("Product Category", "textdomain"),
            'title' => $category->name,
            'url' => get_term_link($category),
            'classes' => array()
        );
        array_push($menu_items, $new_item);
    }
    $menu_order = 0;
    // Set the order property
    foreach ($menu_items as &$menu_item) {
        $menu_order++;
        $menu_item->menu_order = $menu_order;
    }
    unset($menu_item);
//echo '<pre>'; print_r(array_merge($first,$menu_items)); echo '</pre>';
    return $menu_items;
}



// add_filter('dokan_get_product_types',function($product_types){
// 	$product_types['phive_booking'] = 'Bookable';
// 	return $product_types;
// });


// add_action( 'dokan_load_custom_template', function($query_vars){
	
// 	if ( isset( $query_vars['phive_booking'] ) ) {
// 		if ( ! current_user_can( 'dokan_view_booking_menu' ) ) {
// 			dokan_get_template_part( 'global/dokan-error', '', array( 'deleted' => false, 'message' => __( 'You have no permission to view this rental page', 'dokan' ) ) );
// 		} else {
// 			dokan_get_template_part( 'auction/template-auction', '', array( 'is_auction' => true ) );
// 		} exit();
// 		return;
// 	}

// 	if ( isset( $query_vars['new-auction-product'] ) ) {
// 		if ( ! current_user_can( 'dokan_add_auction_product' ) ) {
// 			dokan_get_template_part( 'global/dokan-error', '', array( 'deleted' => false, 'message' => __( 'You have no permission to view this page', 'dokan' ) ) );
// 		} else {
// 			dokan_get_template_part( 'auction/new-auction-product', '', array( 'is_auction' => true ) );
// 		}
// 		return;
// 	}

	
    

// }, 10, 1 );
// 
// 




// add_filter( 'woocommerce_states', 'worda_woocommerce_states' );
 
//    function worda_woocommerce_states( $states ) {
//    echo'<pre>';  print_r($states); echo '</pre>';
//        $states['GH'] = array(
           
//                'MYCT1' => __('City Center', 'woocommerce') ,
//                'MYCT2' => __('Michael Ave', 'woocommerce') ,
//                'MYCT3' => __('Upper South Crec', 'woocommerce') ,
//                'MYCT4' => __('Hepiorgont Park', 'woocommerce') ,
//                'MYCT5' => __('Upper bosik', 'woocommerce') ,
//                'MYCT6' => __('Downtown Jaic', 'woocommerce') ,
//                'MYCT7' => __('Upper West Sopan', 'woocommerce') ,
//                'MYCT8' => __('Poggub Hill', 'woocommerce') ,
//                'MYCT9' => __('North Bob', 'woocommerce') ,
//                'MYCT10' => __('Bayside Ford', 'woocommerce') ,
//            //
//            // You can add more...
//            //
//        );
//        return $states;
// }
// 
// 


// Header Search Adjustment
/*** Product Search Form by Category ***/
if( !function_exists('boxshop_get_search_form_by_category_ttp') ){
	function boxshop_get_search_form_by_category_ttp(){
		global $boxshop_theme_options;
		$enable_category = !isset($boxshop_theme_options['ts_search_by_category']) || (isset($boxshop_theme_options['ts_search_by_category']) && $boxshop_theme_options['ts_search_by_category']);
		
		$search_for_product = class_exists('WooCommerce');
		if( $search_for_product ){
			$taxonomy = 'product_cat';
			$post_type = 'product';
			$placeholder_text = __('Search for products', 'boxshop');
		}
		else{
			$taxonomy = 'category';
			$post_type = 'post';
			$placeholder_text = __('Search', 'boxshop');
		}
		
		$rand = mt_rand(0, 1000);
		?>
		<div class="ts-search-by-category <?php echo esc_attr($enable_category?'':'no-category'); ?>">
			<form method="get" id="searchform<?php echo esc_attr($rand) ?>" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
				<?php if( $enable_category ): ?>
				<select class="select-category" name="term"><?php echo boxshop_search_by_category_get_option_html_ttp($taxonomy, 0, 0); ?></select>
				<?php endif; ?>
				<div class="search-content">
					<input type="text" value="<?php echo get_search_query() ?>" name="s" id="s<?php echo esc_attr($rand) ?>" placeholder="<?php echo esc_attr($placeholder_text) ?>" autocomplete="off" />
					<input type="submit" title="<?php esc_attr_e( 'Search', 'boxshop' ) ?>" id="searchsubmit<?php echo esc_attr($rand) ?>" value="<?php esc_attr_e( 'Search', 'boxshop' ) ?>" />
					<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type) ?>" />
					<?php if( $enable_category ): ?>
					<input type="hidden" name="taxonomy" value="<?php echo esc_attr($taxonomy) ?>" />
					<?php endif; ?>
				</div>
			</form>
		</div>
		<?php
	}
}
if( !function_exists('boxshop_search_by_category_get_option_html_ttp') ){
	function boxshop_search_by_category_get_option_html_ttp($taxonomy = 'product_cat', $parent = 0, $level = 0){
		$options = '<option value="">All categories</option><option value="auction">Auction</option><option value="grocery">Grocery</option><option value="rental">Rental</option><option value="supermarket">Marketplace</option><option value="freelance">Services</option>';
		
		return $options;
	}
}


// Adding Link to the banner word in dokan vendor progress bar notice
add_filter('gettext',function($text,$domain){
	if($text == 'Start with adding a Banner to gain profile progress'){
		$text = 'Start with adding a <a style="color: inherit;font-weight: bold;" href="/dashboard/settings/store">Banner</a> to gain profile progress';
	} 
	return $text;
},100,2);





add_filter( 'woocommerce_states',  function( $states ) {
$states['GH'] = array(
'ASH-1' => 'Agogo - Ashanti',
'ASH-2' => 'Bekwai - Ashanti',
'ASH-3' => 'Ejura - Ashanti',
'ASH-4' => 'Konongo - Ashanti',
'ASH-5' => 'Kumasi - Ashanti',
'ASH-6' => 'Mampong - Ashanti',
'ASH-7' => 'Obuasi - Ashanti',
'ASH-8' => 'Tafo - Ashanti',
'ASH-9' => 'Abasi - Ashanti',
'ASH-10' => 'Abesewa - Ashanti',
'ASH-11' => 'Abira - Ashanti',
'ASH-12' => 'Aboabo - Ashanti',
'ASH-13' => 'Aboabo Tetekasu - Ashanti',
'ASH-14' => 'Aboaso - Ashanti',
'ASH-15' => 'Aboasu - Ashanti',
'ASH-16' => 'Abodom - Ashanti',
'ASH-17' => 'Abofoo - Ashanti',
'ASH-18' => 'Abofour - Ashanti',
'ASH-19' => 'Aboma - Ashanti',
'ASH-20' => 'Abonsuaso - Ashanti',
'ASH-21' => 'Abore - Ashanti',
'ASH-22' => 'Abotanso - Ashanti',
'ASH-23' => 'Abuakwa - Ashanti',
'ASH-24' => 'Abuontem - Ashanti',
'ASH-25' => 'Aburaso - Ashanti',
'ASH-26' => 'Achiase - Ashanti',
'ASH-27' => 'Achina - Ashanti',
'ASH-28' => 'Achinakrom - Ashanti',
'ASH-29' => 'Adadekrom - Ashanti',
'ASH-30' => 'Adankwame - Ashanti',
'ASH-31' => 'Adansi Akrofuom - Ashanti',
'ASH-32' => 'Adansi Praso - Ashanti',
'ASH-33' => 'Adanwomase - Ashanti',
'ASH-34' => 'Adidwan	- Ashanti',
'ASH-35' => 'Adjamesu - Ashanti',
'ASH-36' => 'Adomfe - Ashanti',
'ASH-37' => 'Adonso - Ashanti',
'ASH-38' => 'Aduaben - Ashanti',
'ASH-39' => 'Adubea - Ashanti',
'ASH-40' => 'Adumasa	- Ashanti',
'ASH-41' => 'Adwumakase-Kese - Ashanti',
'ASH-42' => 'Afoako - Ashanti',
'ASH-43' => 'Aframanso - Ashanti',
'ASH-44' => 'Aframso - Ashanti',
'ASH-45' => 'Afrancho - Ashanti',
'ASH-46' => 'Afrantwo - Ashanti',
'ASH-47' => 'Agogo - Ashanti',
'ASH-48' => 'Agona - Ashanti',
'ASH-49' => 'Agoroyesum - Ashanti',
'ASH-50' => 'Ahenema Kokoben - Ashanti',
'ASH-51' => 'Ahenkro - Ashanti',
'ASH-52' => 'Ahinsan - Ashanti',
'ASH-53' => 'Ahwerewa - Ashanti',
'ASH-54' => 'Ahwerewam - Ashanti',
'ASH-55' => 'Ahwiren - Ashanti',
'ASH-56' => 'Akansiren and Wuruyiye - Ashanti',
'ASH-57' => 'Akantansu - Ashanti',
'ASH-58' => 'Akaporiso - Ashanti',
'ASH-59' => 'Akrofonso - Ashanti',
'ASH-60' => 'Akrofuom - Ashanti',
'ASH-61' => 'Akrokerri - Ashanti',
'ASH-62' => 'Akropong - Ashanti',
'ASH-63' => 'Akutuase - Ashanti',
'ASH-64' => 'Akwasiase - Ashanti',
'ASH-65' => 'Akyawkrom - Ashanti',
'ASH-66' => 'Amakom - Ashanti',
'ASH-67' => 'Amantena - Ashanti',
'ASH-68' => 'Amantia - Ashanti',
'ASH-69' => 'Amoako - Ashanti',
'ASH-70' => 'Amoamang - Ashanti',
'ASH-71' => 'Amoaw - Ashanti',
'ASH-72' => 'Ampunyase - Ashanti',
'ASH-73' => 'Ananekrom - Ashanti',
'ASH-74' => 'Ankaase - Ashanti',
'ASH-75' => 'Ankan - Ashanti',
'ASH-76' => 'Anto - Ashanti',
'ASH-77' => 'Antoakrom - Ashanti',
'ASH-78' => 'Anwankwanta - Ashanti',
'ASH-79' => 'Anweaso - Ashanti',
'ASH-80' => 'Anyanso	- Ashanti',
'ASH-81' => 'Anyinasu - Ashanti',
'ASH-82' => 'Anyinasuso - Ashanti',
'ASH-83' => 'Anyinofi - Ashanti',
'ASH-84' => 'Apaah - Ashanti',
'ASH-85' => 'Apagya - Ashanti',
'ASH-86' => 'Apitisu	- Ashanti',
'ASH-87' => 'Apromase - Ashanti',
'ASH-88' => 'Asafo - Ashanti',
'ASH-89' => 'Asam - Ashanti',
'ASH-90' => 'Asaman - Ashanti',
'ASH-91' => 'Asamang - Ashanti',
'ASH-92' => 'Asankare - Ashanti',
'ASH-93' => 'Asawasi - Ashanti',
'ASH-94' => 'Asenamaso - Ashanti',
'ASH-95' => 'Ashakoko - Ashanti',
'ASH-96' => 'Ashanti Newtown - Ashanti',
'ASH-97' => 'Asokore	- Ashanti',
'ASH-98' => 'Asokwa - Ashanti',
'ASH-99' => 'Asotwe - Ashanti',
'ASH-100' => 'Asuadei - Ashanti',
'ASH-101' => 'Asuahyia - Ashanti',
'ASH-102' => 'Asuboa - Ashanti',
'ASH-103' => 'Asumenya - Ashanti',
'ASH-104' => 'Asuofua - Ashanti',
'ASH-105' => 'Asuosu - Ashanti',
'ASH-106' => 'Atimatim - Ashanti',
'ASH-107' => 'Atobiase - Ashanti',
'ASH-108' => 'Atonsu - Ashanti',
'ASH-109' => 'Atonsu-Agogo - Ashanti',
'ASH-110' => 'Atonsuagya - Ashanti',
'ASH-111' => 'Atwere and Hiakosi - Ashanti',
'ASH-112' => 'Atwima - Ashanti',
'ASH-113' => 'Atwima Koforidua - Ashanti',
'ASH-114' => 'Atwima-Agogo - Ashanti',
'ASH-115' => 'Awabre - Ashanti',
'ASH-116' => 'Awurasa	- Ashanti',
'ASH-117' => 'Ayigya - Ashanti',
'ASH-118' => 'Ayinawafe - Ashanti',
'ASH-119' => 'Ayiribikrom	- Ashanti',
'ASH-120' => 'Babaso - Ashanti',
'ASH-121' => 'Bakoniaba - Ashanti',
'ASH-122' => 'Baniko - Ashanti',
'ASH-123' => 'Banka - Ashanti',
'ASH-124' => 'Banso - Ashanti',
'ASH-125' => 'Barekese - Ashanti',
'ASH-126' => 'Bayere-Nkwanta - Ashanti',
'ASH-127' => 'Bedomase - Ashanti',
'ASH-128' => 'Bekwai - Ashanti',
'ASH-129' => 'Benim - Ashanti',
'ASH-130' => 'Bepoase - Ashanti',
'ASH-131' => 'Beposo - Ashanti',
'ASH-132' => 'Besease - Ashanti',
'ASH-133' => 'Besoro - Ashanti',
'ASH-134' => 'Betiako - Ashanti',
'ASH-135' => 'Biemso I - Ashanti',
'ASH-136' => 'Biemso II - Ashanti',
'ASH-137' => 'Binsere - Ashanti',
'ASH-138' => 'Bipoe - Ashanti',
'ASH-139' => 'Birem - Ashanti',
'ASH-140' => 'Biribiwomang - Ashanti',
'ASH-141' => 'Birim Aboe - Ashanti',
'ASH-142' => 'Boamang - Ashanti',
'ASH-143' => 'Boanim - Ashanti',
'ASH-144' => 'Bobriase - Ashanti',
'ASH-145' => 'Bodomase - Ashanti',
'ASH-146' => 'Bodwesango - Ashanti',
'ASH-147' => 'Bofaso - Ashanti',
'ASH-148' => 'Bogyawe - Ashanti',
'ASH-149' => 'Bomen - Ashanti',
'ASH-150' => 'Bomfa - Ashanti',
'ASH-151' => 'Bomfa - Ashanti',
'ASH-152' => 'Bomireso - Ashanti',
'ASH-153' => 'Bompata - Ashanti',
'ASH-154' => 'Boni (Behenase) - Ashanti',
'ASH-155' => 'Bonkrom	- Ashanti',
'ASH-156' => 'Bonwire - Ashanti',
'ASH-157' => 'Bonyon - Ashanti',
'ASH-158' => 'Bosikese - Ashanti',
'ASH-159' => 'Brahabebome	- Ashanti',
'ASH-160' => 'Breku - Ashanti',
'ASH-161' => 'Breman - Ashanti',
'ASH-162' => 'Brofoyeduru - Ashanti',
'ASH-163' => 'Buokrom/Buokrom Estate - Ashanti',
'ASH-164' => 'Daaho - Ashanti',
'ASH-165' => 'Dadease - Ashanti',
'ASH-166' => 'Dampong - Ashanti',
'ASH-167' => 'Darso - Ashanti',
'ASH-168' => 'Datano - Ashanti',
'ASH-169' => 'Densubon - Ashanti',
'ASH-170' => 'Dichemso - Ashanti',
'ASH-171' => 'Dome - Ashanti',
'ASH-172' => 'Domeabra - Ashanti',
'ASH-173' => 'Domeabra - Ashanti',
'ASH-174' => 'Domiabra - Ashanti',
'ASH-175' => 'Domi-Keniago - Ashanti',
'ASH-176' => 'Dominase - Ashanti',
'ASH-177' => 'Dompoase - Ashanti',
'ASH-178' => 'Donyina - Ashanti',
'ASH-179' => 'Drobon - Ashanti',
'ASH-180' => 'Drobonso - Ashanti',
'ASH-181' => 'Dromankuma - Ashanti',
'ASH-182' => 'Dukusen - Ashanti',
'ASH-183' => 'Dunkwa Junction - Ashanti',
'ASH-184' => 'Dwaaho - Ashanti',
'ASH-185' => 'Dwease - Ashanti',
'ASH-186' => 'Dwendwenase - Ashanti',
'ASH-187' => 'Dwinyama - Ashanti',
'ASH-188' => 'Edubia - Ashanti',
'ASH-189' => 'Effiduase - Ashanti',
'ASH-190' => 'Ejian - Ashanti',
'ASH-191' => 'Ejisu - Ashanti',
'ASH-192' => 'Ejura - Ashanti',
'ASH-193' => 'Ejura Nkwanta - Ashanti',
'ASH-194' => 'Esaase - Ashanti',
'ASH-195' => 'Esereso - Ashanti',
'ASH-196' => 'Essienimpong - Ashanti',
'ASH-197' => 'Essuonwin	- Ashanti',
'ASH-198' => 'Esumeja	- Ashanti',
'ASH-199' => 'Fawamam	- Ashanti',
'ASH-200' => 'Fawoade	- Ashanti',
'ASH-201' => 'Fawomang - Ashanti',
'ASH-202' => 'Fena - Ashanti',
'ASH-203' => 'Fereso No. 2 - Ashanti',
'ASH-204' => 'Fiankoma - Ashanti',
'ASH-205' => 'Foase (Foasi)	- Ashanti',
'ASH-206' => 'Fomena - Ashanti',
'ASH-207' => 'Frante - Ashanti',
'ASH-208' => 'Fufuo - Ashanti',
'ASH-209' => 'Fumesua - Ashanti',
'ASH-210' => 'Fumso - Ashanti',
'ASH-211' => 'Helvetica	- Ashanti',
'ASH-212' => 'Hia - Ashanti',
'ASH-213' => 'Hiawoanwu	- Ashanti',
'ASH-214' => 'Huntodo	- Ashanti',
'ASH-215' => 'Huu - Ashanti',
'ASH-216' => 'Hwdiem - Ashanti',
'ASH-217' => 'Jakobu - Ashanti',
'ASH-218' => 'Jamasi - Ashanti',
'ASH-219' => 'Jeduako - Ashanti',
'ASH-220' => 'Jeinsusa - Ashanti',
'ASH-221' => 'Juaben - Ashanti',
'ASH-222' => 'Juaho - Ashanti',
'ASH-223' => 'Juansa - Ashanti',
'ASH-224' => 'Juaso - Ashanti',
'ASH-225' => 'Kanseri - Ashanti',
'ASH-226' => 'Kasaam - Ashanti',
'ASH-227' => 'Kasei - Ashanti',
'ASH-228' => 'Katape II Suponso	- Ashanti',
'ASH-229' => 'Kenyasi - Ashanti',
'ASH-230' => 'Kobreso - Ashanti',
'ASH-231' => 'Kobriti - Ashanti',
'ASH-232' => 'Kodee - Ashanti',
'ASH-233' => 'Kofiase - Ashanti',
'ASH-234' => 'Koforidua	- Ashanti',
'ASH-235' => 'Kokoben Yapessa - Ashanti',
'ASH-236' => 'Kokofu - Ashanti',
'ASH-237' => 'Kokote - Ashanti',
'ASH-238' => 'Kona - Ashanti',
'ASH-239' => 'Koniyaw - Ashanti',
'ASH-240' => 'Konongo - Ashanti',
'ASH-241' => 'Konya/Brenhoma - Ashanti',
'ASH-242' => 'Kotokuom - Ashanti',
'ASH-243' => 'Krofa - Ashanti',
'ASH-244' => 'Krofofrom	- Ashanti',
'ASH-245' => 'Krumuase - Ashanti',
'ASH-246' => 'Kumawu - Ashanti',
'ASH-247' => 'Kumeso - Ashanti',
'ASH-248' => 'Kunsu - Ashanti',
'ASH-249' => 'Kuntanase - Ashanti',
'ASH-250' => 'Kwabenadapaa - Ashanti',
'ASH-251' => 'Kwabenakwa - Ashanti',
'ASH-252' => 'Kwadaso Nsuom - Ashanti',
'ASH-253' => 'Kwamang - Ashanti',
'ASH-254' => 'Kwamo - Ashanti',
'ASH-255' => 'Kwapia - Ashanti',
'ASH-256' => 'Kwaso - Ashanti',
'ASH-257' => 'Kyease (Kyairase) - Ashanti',
'ASH-258' => 'Kyekyebiase - Ashanti',
'ASH-259' => 'Kyekyewere - Ashanti',
'ASH-260' => 'Maakro - Ashanti',
'ASH-261' => 'Maase - Ashanti',
'ASH-262' => 'Mabang - Ashanti',
'ASH-263' => 'Mampong - Ashanti',
'ASH-264' => 'Mamponteng - Ashanti',
'ASH-265' => 'Manfo - Ashanti',
'ASH-266' => 'Manhyia - Ashanti',
'ASH-267' => 'Mankranso - Ashanti',
'ASH-268' => 'Manso Abore - Ashanti',
'ASH-269' => 'Manso Mim - Ashanti',
'ASH-270' => 'Manso-Atwede - Ashanti',
'ASH-271' => 'Manso-Nkwanta - Ashanti',
'ASH-272' => 'Medoma - Ashanti',
'ASH-273' => 'Medoma and Asokwa - Ashanti',
'ASH-274' => 'Meduma - Ashanti',
'ASH-275' => 'Mensonso - Ashanti',
'ASH-276' => 'Morso - Ashanti',
'ASH-277' => 'Moseaso - Ashanti',
'ASH-278' => 'Mpasaso I Hwbaa - Ashanti',
'ASH-279' => 'Mpasatia - Ashanti',
'ASH-280' => 'Mpassaso II - Ashanti',
'ASH-281' => 'Mpatoam - Ashanti',
'ASH-282' => 'Mpehi - Ashanti',
'ASH-283' => 'Namong - Ashanti',
'ASH-284' => 'Nerebehi - Ashanti',
'ASH-285' => 'New Asonomaso - Ashanti',
'ASH-286' => 'New Brodekwano - Ashanti',
'ASH-287' => 'New Edubiase - Ashanti',
'ASH-288' => 'New Koforidua - Ashanti',
'ASH-289' => 'New Suame - Ashanti',
'ASH-290' => 'New Tafo - Ashanti',
'ASH-291' => 'Nintin - Ashanti',
'ASH-292' => 'Nkawie - Ashanti',
'ASH-293' => 'Nkawie-Kuma - Ashanti',
'ASH-294' => 'Nkenikaasu - Ashanti',
'ASH-295' => 'Nkenkasu - Ashanti',
'ASH-296' => 'Nkukua Bouho - Ashanti',
'ASH-297' => 'Nkwankwanua - Ashanti',
'ASH-298' => 'Nkwanta - Ashanti',
'ASH-299' => 'Nkwantakese - Ashanti',
'ASH-300' => 'Nobewam - Ashanti',
'ASH-301' => 'Nsuta - Ashanti',
'ASH-302' => 'Ntinankor - Ashanti',
'ASH-303' => 'Ntonso - Ashanti',
'ASH-304' => 'Ntunkumso - Ashanti',
'ASH-305' => 'Numereso - Ashanti',
'ASH-306' => 'Nwiniso (Winiso) No. 3 - Ashanti',
'ASH-307' => 'Nyaboe - Ashanti',
'ASH-308' => 'Nyameadom - Ashanti',
'ASH-309' => 'Nyamebekyere - Ashanti',
'ASH-310' => 'Nyameso - Ashanti',
'ASH-311' => 'Nyamiani - Ashanti',
'ASH-312' => 'Nyinahin - Ashanti',
'ASH-313' => 'Obenumase - Ashanti',
'ASH-314' => 'Obogu - Ashanti',
'ASH-315' => 'Obuasi - Ashanti',
'ASH-316' => 'Odahu/Odaho - Ashanti',
'ASH-317' => 'Odubi - Ashanti',
'ASH-318' => 'Odumasi - Ashanti',
'ASH-319' => 'Ofe - Ashanti',
'ASH-320' => 'Offinso - Ashanti',
'ASH-321' => 'Offinso Old Town - Ashanti',
'ASH-322' => 'Ofoase - Ashanti',
'ASH-323' => 'Ofoase-Kokoben - Ashanti',
'ASH-324' => 'Oforikrom - Ashanti',
'ASH-325' => 'Okaekurom - Ashanti',
'ASH-326' => 'Old Asonomaso - Ashanti',
'ASH-327' => 'Old Suame - Ashanti',
'ASH-328' => 'Old Tafo - Ashanti',
'ASH-329' => 'Onwi - Ashanti',
'ASH-330' => 'Oyoko - Ashanti',
'ASH-331' => 'Pakyi No.1 - Ashanti',
'ASH-332' => 'Pakyi No.2 - Ashanti',
'ASH-333' => 'Pankrono - Ashanti',
'ASH-334' => 'Pankrono - Ashanti',
'ASH-335' => 'Pataban - Ashanti',
'ASH-336' => 'Patakro - Ashanti',
'ASH-337' => 'Pechi - Ashanti',
'ASH-338' => 'Pekyerekye - Ashanti',
'ASH-339' => 'Pemanasi - Ashanti',
'ASH-340' => 'Pepease - Ashanti',
'ASH-341' => 'Petriensa - Ashanti',
'ASH-342' => 'Piase - Ashanti',
'ASH-343' => 'Poano - Ashanti',
'ASH-344' => 'Pokukrom - Ashanti',
'ASH-345' => 'Pomposo - Ashanti',
'ASH-346' => 'Potrikrom - Ashanti',
'ASH-347' => 'Pra River - Ashanti',
'ASH-348' => 'Pramso - Ashanti',
'ASH-349' => 'Praso - Ashanti',
'ASH-350' => 'Sabronum - Ashanti',
'ASH-351' => 'Sabusa - Ashanti',
'ASH-352' => 'Safo - Ashanti',
'ASH-353' => 'Sampraso - Ashanti',
'ASH-354' => 'Sampronso - Ashanti',
'ASH-355' => 'Sansu - Ashanti',
'ASH-356' => 'Sarakyi Akuraa - Ashanti',
'ASH-357' => 'Sawua - Ashanti',
'ASH-358' => 'Sekyere - Ashanti',
'ASH-359' => 'Sekyidumase - Ashanti',
'ASH-360' => 'Seneso - Ashanti',
'ASH-361' => 'Senfi - Ashanti',
'ASH-362' => 'Seniagya - Ashanti',
'ASH-363' => 'Senkye (Senchi) - Ashanti',
'ASH-364' => 'Sepase - Ashanti',
'ASH-365' => 'Sokora Wonoo - Ashanti',
'ASH-366' => 'Subriso - Ashanti',
'ASH-367' => 'Sumiso - Ashanti',
'ASH-368' => 'Surukrom - Ashanti',
'ASH-369' => 'Tano Odumase - Ashanti',
'ASH-370' => 'Tanodumase - Ashanti',
'ASH-371' => 'Tarkwa Maakro - Ashanti',
'ASH-372' => 'Teachekrom - Ashanti',
'ASH-373' => 'Tebeso No. 1 - Ashanti',
'ASH-374' => 'Tebeso No. 2 - Ashanti',
'ASH-375' => 'Tema - Ashanti',
'ASH-376' => 'Tetrem - Ashanti',
'ASH-377' => 'Tikrom - Ashanti',
'ASH-378' => 'Toase - Ashanti',
'ASH-379' => 'Tontokrom - Ashanti',
'ASH-380' => 'Traduom - Ashanti',
'ASH-381' => 'Trede - Ashanti',
'ASH-382' => 'Twabidi - Ashanti',
'ASH-383' => 'Tweapease - Ashanti',
'ASH-384' => 'Twedie - Ashanti',
'BRA-1' => 'Abease - Brong Ahafo',
'BRA-2' => 'Abesim - Brong Ahafo',
'BRA-3' => 'Abisaase - Brong Ahafo',
'BRA-4' => 'Aboabo No. 2 - Brong Ahafo',
'BRA-5' => 'Aboabo No. 4 - Brong Ahafo',
'BRA-6' => 'Abodom - Brong Ahafo',
'BRA-7' => 'Aboo - Brong Ahafo',
'BRA-8' => 'Abuo - Brong Ahafo',
'BRA-9' => 'Abuom - Brong Ahafo',
'BRA-10' => 'Acherensua - Brong Ahafo',
'BRA-11' => 'Adaa - Brong Ahafo',
'BRA-12' => 'Adamasu/Adams - Brong Ahafo',
'BRA-13' => 'Adantia - Brong Ahafo',
'BRA-14' => 'Adom - Brong Ahafo',
'BRA-15' => 'Adrobaa - Brong Ahafo',
'BRA-16' => 'Agyina (Ajina) - Brong Ahafo',
'BRA-17' => 'Ahansua and Mesidan - Brong Ahafo',
'BRA-18' => 'Ahoto - Brong Ahafo',
'BRA-19' => 'Ahyiaem - Brong Ahafo',
'BRA-20' => 'Ahyiayem and Asukwaa - Brong Ahafo',
'BRA-21' => 'Akokoa - Brong Ahafo',
'BRA-22' => 'Akontanim - Brong Ahafo',
'BRA-23' => 'Akrobi - Brong Ahafo',
'BRA-24' => 'Akrodie - Brong Ahafo',
'BRA-25' => 'Akroforo - Brong Ahafo',
'BRA-26' => 'Akrofrom - Brong Ahafo',
'BRA-27' => 'Akuma - Brong Ahafo',
'BRA-28' => 'Akumadan - Brong Ahafo',
'BRA-29' => 'Akumsa-Adumase - Brong Ahafo',
'BRA-30' => 'Akyeremade - Brong Ahafo',
'BRA-31' => 'Amanfrom - Brong Ahafo',
'BRA-32' => 'Amasu - Brong Ahafo',
'BRA-33' => 'Amoma - Brong Ahafo',
'BRA-34' => 'Ampeda - Brong Ahafo',
'BRA-35' => 'Ampoma - Brong Ahafo',
'BRA-36' => 'Ankaase - Brong Ahafo',
'BRA-37' => 'Antwirifo - Brong Ahafo',
'BRA-38' => 'Anwiam - Brong Ahafo',
'BRA-39' => 'Anyima - Brong Ahafo',
'BRA-40' => 'Apapasu - Brong Ahafo',
'BRA-41' => 'Apesika - Brong Ahafo',
'BRA-42' => 'Asaaman - Brong Ahafo',
'BRA-43' => 'Asempa Nlaye - Brong Ahafo',
'BRA-44' => 'Asikasu - Brong Ahafo',
'BRA-45' => 'Asuakwaa - Brong Ahafo',
'BRA-46' => 'Asuderi - Brong Ahafo',
'BRA-47' => 'Asueyi - Brong Ahafo',
'BRA-48' => 'Asukese No. 2 - Brong Ahafo',
'BRA-49' => 'Asummura - Brong Ahafo',
'BRA-50' => 'Asunu No.1 - Brong Ahafo',
'BRA-51' => 'Asuotiano - Brong Ahafo',
'BRA-52' => 'Atebubu - Brong Ahafo',
'BRA-53' => 'Atomfoso - Brong Ahafo',
'BRA-54' => 'Atronie - Brong Ahafo',
'BRA-55' => 'Atuna - Brong Ahafo',
'BRA-56' => 'Awisa - Brong Ahafo',
'BRA-57' => 'Awoase - Brong Ahafo',
'BRA-58' => 'Aworowa - Brong Ahafo',
'BRA-59' => 'Ayerede - Brong Ahafo',
'BRA-60' => 'Ayimom - Brong Ahafo',
'BRA-61' => 'Ayomfo - Brong Ahafo',
'BRA-62' => 'Baabiaraneha - Brong Ahafo',
'BRA-63' => 'Baantama - Brong Ahafo',
'BRA-64' => 'Babatokuma - Brong Ahafo',
'BRA-65' => 'Babianihaa - Brong Ahafo',
'BRA-66' => 'Badu - Brong Ahafo',
'BRA-67' => 'Banaso - Brong Ahafo',
'BRA-68' => 'Banda - Brong Ahafo',
'BRA-69' => 'Banda Ahenkro - Brong Ahafo',
'BRA-70' => 'Banda Boase - Brong Ahafo',
'BRA-71' => 'Banu - Brong Ahafo',
'BRA-72' => 'Bassa - Brong Ahafo',
'BRA-73' => 'Bechem - Brong Ahafo',
'BRA-74' => 'Bediako - Brong Ahafo',
'BRA-75' => 'Bediakokrom - Brong Ahafo',
'BRA-76' => 'Benkasem Kuture No. 2 - Brong Ahafo',
'BRA-77' => 'Berekum - Brong Ahafo',
'BRA-78' => 'Biadam - Brong Ahafo',
'BRA-79' => 'Biaso - Brong Ahafo',
'BRA-80' => 'Bobidi Nkwanta - Brong Ahafo',
'BRA-81' => 'Bodinka - Brong Ahafo',
'BRA-82' => 'Bolga-Nkwanta - Brong Ahafo',
'BRA-83' => 'Bomaa - Brong Ahafo',
'BRA-84' => 'Bomini and Pinihi - Brong Ahafo',
'BRA-85' => 'Bonga - Brong Ahafo',
'BRA-86' => 'Bonsu - Brong Ahafo',
'BRA-87' => 'Bonte - Brong Ahafo',
'BRA-88' => 'Botokrom - Brong Ahafo',
'BRA-89' => 'Brahoho - Brong Ahafo',
'BRA-90' => 'Branam - Brong Ahafo',
'BRA-91' => 'Breme - Brong Ahafo',
'BRA-92' => 'Bresoano No. 1 - Brong Ahafo',
'BRA-93' => 'Bresoano No. 2 - Brong Ahafo',
'BRA-94' => 'Brodi - Brong Ahafo',
'BRA-95' => 'Brohani - Brong Ahafo',
'BRA-96' => 'Bui - Brong Ahafo',
'BRA-97' => 'Buoyem - Brong Ahafo',
'BRA-98' => 'Busuama - Brong Ahafo',
'BRA-99' => 'Busunya - Brong Ahafo',
'BRA-100' => 'Camp No. 1 - Brong Ahafo',
'BRA-101' => 'Cherembo - Brong Ahafo',
'BRA-102' => 'Chiraa - Brong Ahafo',
'BRA-103' => 'Chirehin - Brong Ahafo',
'BRA-104' => 'Chiripo - Brong Ahafo',
'BRA-105' => 'Dadiesoaba - Brong Ahafo',
'BRA-106' => 'Dafo - Brong Ahafo',
'BRA-107' => 'Dama-Nkwanta - Brong Ahafo',
'BRA-108' => 'Dantano - Brong Ahafo',
'BRA-109' => 'Danyame - Brong Ahafo',
'BRA-110' => 'Dawadawa - Brong Ahafo',
'BRA-111' => 'Debiribi - Brong Ahafo',
'BRA-112' => 'Dena - Brong Ahafo',
'BRA-113' => 'Dentenso - Brong Ahafo',
'BRA-114' => 'Derma - Brong Ahafo',
'BRA-115' => 'Diabaa - Brong Ahafo',
'BRA-116' => 'Diabakrom - Brong Ahafo',
'BRA-117' => 'Dogokrom - Brong Ahafo',
'BRA-118' => 'Domeabra - Brong Ahafo',
'BRA-119' => 'Domfete - Brong Ahafo',
'BRA-120' => 'Dominase - Brong Ahafo',
'BRA-121' => 'Donkponkwanta - Brong Ahafo',
'BRA-122' => 'Donkro Nkwanta - Brong Ahafo',
'BRA-123' => 'Dormaa-Ahenkro - Brong Ahafo',
'BRA-124' => 'Dormaa-Akwamu (Awiam) - Brong Ahafo',
'BRA-125' => 'Dotobaa - Brong Ahafo',
'BRA-126' => 'Drobe - Brong Ahafo',
'BRA-127' => 'Dromankese - Brong Ahafo',
'BRA-128' => 'Duabone No. 1 - Brong Ahafo',
'BRA-129' => 'Duabone No. 2 - Brong Ahafo',
'BRA-130' => 'Duaburoni - Brong Ahafo',
'BRA-131' => 'Duadaso II - Brong Ahafo',
'BRA-132' => 'Duadaso No.1 - Brong Ahafo',
'BRA-133' => 'Duayaw-Nkwanta - Brong Ahafo',
'BRA-134' => 'Dumasua - Brong Ahafo',
'BRA-135' => 'Dumienu - Brong Ahafo',
'BRA-136' => 'Dwenem - Brong Ahafo',
'BRA-137' => 'Dwija - Brong Ahafo',
'BRA-138' => 'Dwomo - Brong Ahafo',
'BRA-139' => 'Fante New Town - Brong Ahafo',
'BRA-140' => 'Fawohoyeden - Brong Ahafo',
'BRA-141' => 'Fetentaa - Brong Ahafo',
'BRA-142' => 'Fiapre - Brong Ahafo',
'BRA-143' => 'fiaso - Brong Ahafo',
'BRA-144' => 'Forty-four - Brong Ahafo',
'BRA-145' => 'Gambia I - Brong Ahafo',
'BRA-146' => 'Gambia II - Brong Ahafo',
'BRA-147' => 'Garadima - Brong Ahafo',
'BRA-148' => 'Gbulumpe - Brong Ahafo',
'BRA-149' => 'Goaso - Brong Ahafo',
'BRA-150' => 'Goka - Brong Ahafo',
'BRA-151' => 'Gonnokrom - Brong Ahafo',
'BRA-152' => 'Gyedu - Brong Ahafo',
'BRA-153' => 'Gyenegyene - Brong Ahafo',
'BRA-154' => 'Hausakope - Brong Ahafo',
'BRA-155' => 'Hwidiem - Brong Ahafo',
'BRA-156' => 'Jamede - Brong Ahafo',
'BRA-157' => 'Jamera - Brong Ahafo',
'BRA-158' => 'Japekrom - Brong Ahafo',
'BRA-159' => 'Jato - Brong Ahafo',
'BRA-160' => 'Jema - Brong Ahafo',
'BRA-161' => 'Kabronu - Brong Ahafo',
'BRA-162' => 'Kadelso - Brong Ahafo',
'BRA-163' => 'Kajaji - Brong Ahafo',
'BRA-164' => 'Kakawere - Brong Ahafo',
'BRA-165' => 'Kakorasua - Brong Ahafo',
'BRA-166' => 'Kansere - Brong Ahafo',
'BRA-167' => 'Kapro - Brong Ahafo',
'BRA-168' => 'Kapua - Brong Ahafo',
'BRA-169' => 'Kasa - Brong Ahafo',
'BRA-170' => 'Kato - Brong Ahafo',
'BRA-171' => 'Kawampe - Brong Ahafo',
'BRA-172' => 'Kensere - Brong Ahafo',
'BRA-173' => 'Kenten - Brong Ahafo',
'BRA-174' => 'Kenyase No. I - Brong Ahafo',
'BRA-175' => 'Kenyasi No. 1 - Brong Ahafo',
'BRA-176' => 'Kintampo - Brong Ahafo',
'BRA-177' => 'Kirenkuase - Brong Ahafo',
'BRA-178' => 'Kobedi - Brong Ahafo',
'BRA-179' => 'Kofi Asua - Brong Ahafo',
'BRA-180' => 'Kofi Badu Krom - Brong Ahafo',
'BRA-181' => 'Kofi Djan - Brong Ahafo',
'BRA-182' => 'Kogyei - Brong Ahafo',
'BRA-183' => 'Kojokrom - Brong Ahafo',
'BRA-184' => 'Kokuma - Brong Ahafo',
'BRA-185' => 'Komampa - Brong Ahafo',
'BRA-186' => 'Komfourkrom - Brong Ahafo',
'BRA-187' => 'Koraso - Brong Ahafo',
'BRA-188' => 'Kotokrom - Brong Ahafo',
'BRA-189' => 'Kpagto - Brong Ahafo',
'BRA-190' => 'Krabonso - Brong Ahafo',
'BRA-191' => 'Krakrom - Brong Ahafo',
'BRA-192' => 'Kranka - Brong Ahafo',
'BRA-193' => 'Krobo - Brong Ahafo',
'BRA-194' => 'Kukuom - Brong Ahafo',
'BRA-195' => 'Kumfa - Brong Ahafo',
'BRA-196' => 'Kunsu - Brong Ahafo',
'BRA-197' => 'Kuntunso - Brong Ahafo',
'BRA-198' => 'Kutre No. 1 - Brong Ahafo',
'BRA-199' => 'Kwadwokurom - Brong Ahafo',
'BRA-200' => 'Kwadwonkromkurom - Brong Ahafo',
'BRA-201' => 'Kwaihunu - Brong Ahafo',
'BRA-202' => 'Kwakwanya - Brong Ahafo',
'BRA-203' => 'Kwame Danso - Brong Ahafo',
'BRA-204' => 'Kwameseikrom - Brong Ahafo',
'BRA-205' => 'Kwapong - Brong Ahafo',
'BRA-206' => 'Kwasu and Subriso - Brong Ahafo',
'BRA-207' => 'Kwatire - Brong Ahafo',
'BRA-208' => 'Kyeremasu - Brong Ahafo',
'BRA-209' => 'Kyiraa - Brong Ahafo',
'BRA-210' => 'Labo - Brong Ahafo',
'BRA-211' => 'Lailai - Brong Ahafo',
'BRA-212' => 'Langasi - Brong Ahafo',
'BRA-213' => 'Lassi - Brong Ahafo',
'BRA-214' => 'Laura - Brong Ahafo',
'BRA-215' => 'Lemu Intrubuso - Brong Ahafo',
'BRA-216' => 'Lobi - Brong Ahafo',
'BRA-217' => 'Longoro - Brong Ahafo',
'BRA-218' => 'Maaso - Brong Ahafo',
'BRA-219' => 'Mamasa - Brong Ahafo',
'BRA-220' => 'Mangoase - Brong Ahafo',
'BRA-221' => 'Mansing - Brong Ahafo',
'BRA-222' => 'Mantukwa - Brong Ahafo',
'BRA-223' => 'Masuo - Brong Ahafo',
'BRA-224' => 'Mawoekpor Kope - Brong Ahafo',
'BRA-225' => 'Mehame - Brong Ahafo',
'BRA-226' => 'Mem - Brong Ahafo',
'BRA-227' => 'Mempeasem Boniafo - Brong Ahafo',
'BRA-228' => 'Mengye (Menji) - Brong Ahafo',
'BRA-229' => 'Mframa - Brong Ahafo',
'BRA-230' => 'Mim - Brong Ahafo',
'BRA-231' => 'Moshimoshi - Brong Ahafo',
'BRA-232' => 'Mpatasie - Brong Ahafo',
'BRA-233' => 'Namasua - Brong Ahafo',
'BRA-234' => 'Nante - Brong Ahafo',
'BRA-235' => 'Nchiraa - Brong Ahafo',
'BRA-236' => 'New Brosankro - Brong Ahafo',
'BRA-237' => 'New Dormaa - Brong Ahafo',
'BRA-238' => 'New Drobo - Brong Ahafo',
'BRA-239' => 'New Kronkrompe - Brong Ahafo',
'BRA-240' => 'New Longoro (Mentukwa) - Brong Ahafo',
'BRA-241' => 'New Techiman - Brong Ahafo',
'BRA-242' => 'Nframa - Brong Ahafo',
'BRA-243' => 'Nkaseim - Brong Ahafo',
'BRA-244' => 'Nkasiem - Brong Ahafo',
'BRA-245' => 'Nkoranza - Brong Ahafo',
'BRA-246' => 'Nkrankrom - Brong Ahafo',
'BRA-247' => 'Nkrankwanta - Brong Ahafo',
'BRA-248' => 'Nkwaben - Brong Ahafo',
'BRA-249' => 'Nkwabeng - Brong Ahafo',
'BRA-250' => 'Nkwaeso - Brong Ahafo',
'BRA-251' => 'Nkyeraa - Brong Ahafo',
'BRA-252' => 'Nobekaw - Brong Ahafo',
'BRA-253' => 'Npuasu - Brong Ahafo',
'BRA-254' => 'Nsapor - Brong Ahafo',
'BRA-255' => 'Nsawkaw - Brong Ahafo',
'BRA-256' => 'Nsesereso - Brong Ahafo',
'BRA-257' => 'Nsuatre - Brong Ahafo',
'BRA-258' => 'Nsuhia - Brong Ahafo',
'BRA-259' => 'Nsuta - Brong Ahafo',
'BRA-260' => 'Ntankoro - Brong Ahafo',
'BRA-261' => 'Ntotroso - Brong Ahafo',
'BRA-262' => 'Ntronam - Brong Ahafo',
'BRA-263' => 'Nwawansua - Brong Ahafo',
'BRA-264' => 'Nwereme - Brong Ahafo',
'BRA-265' => 'Nyamease - Brong Ahafo',
'BRA-266' => 'Nyankontreh - Brong Ahafo',
'BRA-267' => 'Nyomoase - Brong Ahafo',
'BRA-268' => 'Nyomoasu - Brong Ahafo',
'BRA-269' => 'Obengkrom - Brong Ahafo',
'BRA-270' => 'Odumasi - Brong Ahafo',
'BRA-271' => 'Offuman - Brong Ahafo',
'BRA-272' => 'Oforikrom - Brong Ahafo',
'BRA-273' => 'Okomfookrom - Brong Ahafo',
'BRA-274' => 'Okyeamekrom - Brong Ahafo',
'BRA-275' => 'Old Brosankro - Brong Ahafo',
'BRA-276' => 'Old Drobo - Brong Ahafo',
'BRA-277' => 'Old Kronkrompe - Brong Ahafo',
'BRA-278' => 'Owusukrom - Brong Ahafo',
'BRA-279' => 'Pabire - Brong Ahafo',
'BRA-280' => 'Parembo-Sawaba - Brong Ahafo',
'BRA-281' => 'Peblastre - Brong Ahafo',
'BRA-282' => 'Pomaakrom - Brong Ahafo',
'BRA-283' => 'Portor - Brong Ahafo',
'BRA-284' => 'Pramposo - Brong Ahafo',
'BRA-285' => 'Prang - Brong Ahafo',
'BRA-286' => 'Premuase - Brong Ahafo',
'BRA-287' => 'Primase - Brong Ahafo',
'BRA-288' => 'Sabiye - Brong Ahafo',
'BRA-289' => 'Sampa - Brong Ahafo',
'BRA-290' => 'Sankore - Brong Ahafo',
'BRA-291' => 'Saranouse - Brong Ahafo',
'BRA-292' => 'Sawankyi/Afrefreso - Brong Ahafo',
'BRA-293' => 'Seikwa - Brong Ahafo',
'BRA-294' => 'Seketia - Brong Ahafo',
'BRA-295' => 'Sekyerekrom - Brong Ahafo',
'BRA-296' => 'Senase - Brong Ahafo',
'BRA-297' => 'Seneso - Brong Ahafo',
'BRA-298' => 'Senya - Brong Ahafo',
'BRA-299' => 'Sienkyem - Brong Ahafo',
'BRA-300' => 'Sikaa - Brong Ahafo',
'BRA-301' => 'Subinso No. 2 - Brong Ahafo',
'BRA-302' => 'Subompang - Brong Ahafo',
'BRA-303' => 'Suma-Ahenkro - Brong Ahafo',
'BRA-304' => 'Sunyani - Brong Ahafo',
'BRA-305' => 'Susuanso - Brong Ahafo',
'BRA-306' => 'Taenso - Brong Ahafo',
'BRA-307' => 'Tahima - Brong Ahafo',
'BRA-308' => 'Tainano - Brong Ahafo',
'BRA-309' => 'Takofiano - Brong Ahafo',
'BRA-310' => 'Tanoboase - Brong Ahafo',
'BRA-311' => 'Tanom - Brong Ahafo',
'BRA-312' => 'Tanoso - Brong Ahafo',
'BRA-313' => 'Tato Battor - Brong Ahafo',
'BRA-314' => 'Techiman - Brong Ahafo',
'BRA-315' => 'Techimantia - Brong Ahafo',
'BRA-316' => 'Teekyere - Brong Ahafo',
'BRA-317' => 'Tenfianu - Brong Ahafo',
'BRA-318' => 'Tepa - Brong Ahafo',
'BRA-319' => 'Terchire - Brong Ahafo',
'BRA-320' => 'Tintale - Brong Ahafo',
'BRA-321' => 'Trimukyea - Brong Ahafo',
'BRA-322' => 'Tromeso - Brong Ahafo',
'BRA-323' => 'Tuobodom - Brong Ahafo',
'BRA-324' => 'Banda Ahenkro - Brong Ahafo',
'BRA-325' => 'Bechem - Brong Ahafo',
'BRA-326' => 'Berekum - Brong Ahafo',
'BRA-327' => 'Drobo - Brong Ahafo',
'BRA-328' => 'Duayaw Nkwanta - Brong Ahafo',
'BRA-329' => 'Kintampo - Brong Ahafo',
'BRA-330' => 'Kintampo - Brong Ahafo',
'BRA-331' => 'Sunyani - Brong Ahafo',
'BRA-332' => 'Techiman - Brong Ahafo',
'BRA-333' => 'Wenchi - Brong Ahafo',
'CRL-1' => 'Agona Swedru - Central',
'CRL-2' => 'Anomabu - Central',
'CRL-3' => 'Apam - Central',
'CRL-4' => 'Cape Coast - Central',
'CRL-5' => 'Dunkwa-on-Offin - Central',
'CRL-6' => 'Elmina - Central',
'CRL-7' => 'Foso - Central',
'CRL-8' => 'Mumford - Central',
'CRL-9' => 'Nyakrom - Central',
'CRL-10' => 'Oduponkpehe - Central',
'CRL-11' => 'Saltpond - Central',
'CRL-12' => 'Winneba - Central',
'CRL-13' => 'Abaasa - Central',
'CRL-14' => 'Abakrampa - Central',
'CRL-15' => 'Abandze - Central',
'CRL-16' => 'Abaoba - Central',
'CRL-17' => 'Abeadze-Dominase - Central',
'CRL-18' => 'Abeyee - Central',
'CRL-19' => 'Abodom - Central',
'CRL-20' => 'Aboenu - Central',
'CRL-21' => 'Abora Oboasi - Central',
'CRL-22' => 'Aboransa - Central',
'CRL-23' => 'Aborodeano - Central',
'CRL-24' => 'Abrekum - Central',
'CRL-25' => 'Abrem Agona - Central',
'CRL-26' => 'Abrem Berase - Central',
'CRL-27' => 'Abreshia (Abrehya) - Central',
'CRL-28' => 'Abura-Dunkwa - Central',
'CRL-29' => 'Adawukwa - Central',
'CRL-30' => 'Afiaso - Central',
'CRL-31' => 'Afiefiso - Central',
'CRL-32' => 'Agona Nsaba - Central',
'CRL-33' => 'Ajumako - Central',
'CRL-34' => 'Ajumako Kwanyako - Central',
'CRL-35' => 'Ajumako-Mando - Central',
'CRL-36' => 'Akonoma - Central',
'CRL-37' => 'Akotokyere - Central',
'CRL-38' => 'Akra - Central',
'CRL-39' => 'Akropong - Central',
'CRL-40' => 'Akuffo Krodua (F. Kwesi K.) - Central',
'CRL-41' => 'Akwele Nkwanta - Central',
'CRL-42' => 'Amama - Central',
'CRL-43' => 'Amanful - Central',
'CRL-44' => 'Amia - Central',
'CRL-45' => 'Amisano - Central',
'CRL-46' => 'Amosima - Central',
'CRL-47' => 'Ampenkro - Central',
'CRL-48' => 'Ampenyi - Central',
'CRL-49' => 'Anim Akubrifa - Central',
'CRL-50' => 'Ankaako - Central',
'CRL-51' => 'Ankaful Village - Central',
'CRL-52' => 'Ankamu - Central',
'CRL-53' => 'Anomabo - Central',
'CRL-54' => 'Anto Essuekyir - Central',
'CRL-55' => 'Apam - Central',
'CRL-56' => 'Aperade - Central',
'CRL-57' => 'Asaafa - Central',
'CRL-58' => 'Asafo - Central',
'CRL-59' => 'Asasitre Enyinabrim - Central',
'CRL-60' => 'Asebu - Central',
'CRL-61' => 'Asebu Ekroful - Central',
'CRL-62' => 'Asikuma - Central',
'CRL-63' => 'Assasan - Central',
'CRL-64' => 'Assin Achiano - pop. 1577 - Central',
'CRL-65' => 'Assin Adiembra - Central',
'CRL-66' => 'Assin Akonfudi - pop. 3762 - Central',
'CRL-67' => 'Assin Akropong - Central',
'CRL-68' => 'Assin Akyiase - Central',
'CRL-69' => 'Assin Anyinabrim - Central',
'CRL-70' => 'Assin Asamankese - Central',
'CRL-71' => 'Assin Asempaneye - pop. 1588 - Central',
'CRL-72' => 'Assin Atonsu - pop. 1441 - Central',
'CRL-73' => 'Assin Awsem - pop. 2427 - Central',
'CRL-74' => 'Assin Becliadua - Central',
'CRL-75' => 'Assin Breku - pop. 5985 - Central',
'CRL-76' => 'Assin Brofoyedur - pop. 1339 - Central',
'CRL-77' => 'Assin Dansame - pop. 2561 - Central',
'CRL-78' => 'Assin Darmang/Nsuaem - Central',
'CRL-79' => 'Assin Dompem - pop. 2211 - Central',
'CRL-80' => 'Assin Endwa - pop. 1422 - Central',
'CRL-81' => 'Assin Fosu - pop. 22837 - Central',
'CRL-82' => 'Assin Jakai - Central',
'CRL-83' => 'Assin Juaso - pop. 1343 - Central',
'CRL-84' => 'Assin Kushea - pop. 2246 - Central',
'CRL-85' => 'Assin Manso - Central',
'CRL-86' => 'Assin Ngresi - Central',
'CRL-87' => 'Assin Nsuta - Central',
'CRL-88' => 'Assin Nyankomasi - pop. 3043 - Central',
'CRL-89' => 'Assin Ongwa (Aworoso) - Central',
'CRL-90' => 'Assin Praso - pop. 2860 - Central',
'CRL-91' => 'Assin Wurakese (Assin Worakese) - Central',
'CRL-92' => 'Asuansi - Central',
'CRL-93' => 'Awisam - Central',
'CRL-94' => 'Awutu Bereku - Central',
'CRL-95' => 'Awutu Senya Bawjiase - Central',
'CRL-96' => 'Ayafuri - Central',
'CRL-97' => 'Ayeldu - Central',
'CRL-98' => 'Ba - Central',
'CRL-99' => 'Balfikrom - Central',
'CRL-100' => 'Bantoma - Central',
'CRL-101' => 'Batanyaa - Central',
'CRL-102' => 'Beposo - Central',
'CRL-103' => 'Besease - Central',
'CRL-104' => 'Bethelehem - Central',
'CRL-105' => 'Bewuanum - Central',
'CRL-106' => 'Biriwa - Central',
'CRL-107' => 'Bobikuma - Central',
'CRL-108' => 'Bodwase Fantse - Central',
'CRL-109' => 'Bontrase - Central',
'CRL-110' => 'Brafoyaw - Central',
'CRL-111' => 'Brakwa - Central',
'CRL-112' => 'Braso - Central',
'CRL-113' => 'Breman Amanfopong - Central',
'CRL-114' => 'Breman Amoanda - Central',
'CRL-115' => 'Breman Anhwaim - Central',
'CRL-116' => 'Breman Ayipey - Central',
'CRL-117' => 'Breman Baako - Central',
'CRL-118' => 'Breman Bedum - Central',
'CRL-119' => 'Breman Benin - Central',
'CRL-120' => 'Breman Brakwa - Central',
'CRL-121' => 'Breman Fosuansa - Central',
'CRL-122' => 'Breman Jara - Central',
'CRL-123' => 'Breman Kokoso - Central',
'CRL-124' => 'Breman Kuntanase - Central',
'CRL-125' => 'Breman Nwomaso - Central',
'CRL-126' => 'Breman Nyamebekyere - Central',
'CRL-127' => 'Breman Odoben - Central',
'CRL-128' => 'Bronyibima - Central',
'CRL-129' => 'Buabin - Central',
'CRL-130' => 'Buabinso - Central',
'CRL-131' => 'Buduburam - Central',
'CRL-132' => 'Burukuso - Central',
'CRL-133' => 'Cape Coast (Cape Vars/Ola) - Central',
'CRL-134' => 'Cape Coast (Pedu/Abora) - Central',
'CRL-135' => 'Dasanyi - Central',
'CRL-136' => 'Dawurampong - Central',
'CRL-137' => 'Diaso - Central',
'CRL-138' => 'Dokutse - Central',
'CRL-139' => 'Domenase - Central',
'CRL-140' => 'Dominase - Central',
'CRL-141' => 'Duakor - Central',
'CRL-142' => 'Duakwa - Central',
'CRL-143' => 'Dunkwa-on-Offin - Central',
'CRL-144' => 'Dutch Komenda - Central',
'CRL-145' => 'Dwokwa - Central',
'CRL-146' => 'Edumifa - Central',
'CRL-147' => 'Effutu - Central',
'CRL-148' => 'Eguafo - Central',
'CRL-149' => 'Eguafo - Central',
'CRL-150' => 'Ekon - Central',
'CRL-151' => 'Ekrawfo - Central',
'CRL-152' => 'Ekumpoanu - Central',
'CRL-153' => 'Elmina - Central',
'CRL-154' => 'Elmina-Tetteh Kessim - Central',
'CRL-155' => 'Entumbil - Central',
'CRL-156' => 'Enyan Denkyira - Central',
'CRL-157' => 'Enyan-Maim - Central',
'CRL-158' => 'Enyanmanso - Central',
'CRL-159' => 'Eshiem - Central',
'CRL-160' => 'Essaman Junction - Central',
'CRL-161' => 'Essarkyir Abor - Central',
'CRL-162' => 'Essueshia - Central',
'CRL-163' => 'Etsi-Sonkwa - Central',
'CRL-164' => 'Eyisam - Central',
'CRL-165' => 'Fanti Nyankomasi (Fante Nyankomase) - Central',
'CRL-166' => 'Fianko - Central',
'CRL-167' => 'Fosu - Central',
'CRL-168' => 'Gomoa Feteh - Central',
'CRL-169' => 'Gomoa Otuam - Central',
'CRL-170' => 'Gomoa Tarkwa - Central',
'CRL-171' => 'Gyakai - Central',
'CRL-172' => 'Imbraim - Central',
'CRL-173' => 'Immuna - Central',
'CRL-174' => 'Jameso Nkwanta - Central',
'CRL-175' => 'Jamra - Central',
'CRL-176' => 'Jukwa - Central',
'CRL-177' => 'Kafodzidzi - Central',
'CRL-178' => 'Kakomdo - Central',
'CRL-179' => 'Katayiase - Central',
'CRL-180' => 'Kissi - Central',
'CRL-181' => 'Koforidua - Central',
'CRL-182' => 'Kokoado - Central',
'CRL-183' => 'Kokoben - Central',
'CRL-184' => 'Kokoso - Central',
'CRL-185' => 'Kokrobite - Central',
'CRL-186' => 'Komenda - Central',
'CRL-187' => 'Kormantse - Central',
'CRL-188' => 'Kotokori - Central',
'CRL-189' => 'Kpormetey - Central',
'CRL-190' => 'Krobo - Central',
'CRL-191' => 'Kromaim - Central',
'CRL-192' => 'Kuhyea - Central',
'CRL-193' => 'Kwaman - Central',
'CRL-194' => 'Kwansakrom - Central',
'CRL-195' => 'Kwanyako - Central',
'CRL-196' => 'Kyeakor - Central',
'CRL-197' => 'Kyekyewere - Central',
'CRL-198' => 'Kyiaboso (Chiaboso) - Central',
'CRL-199' => 'Lego - Central',
'CRL-200' => 'Mankesim - Central',
'CRL-201' => 'Mankoadze (Mankwadze) - Central',
'CRL-202' => 'Mankrong - Central',
'CRL-203' => 'Mankrong Nkwanta - Central',
'CRL-204' => 'Maudaso - Central',
'CRL-205' => 'Mfuom - Central',
'CRL-206' => 'Moree - Central',
'CRL-207' => 'Mpeasem - Central',
'CRL-208' => 'Mumford - Central',
'CRL-209' => 'Muna - Central',
'CRL-210' => 'Nankese - Central',
'CRL-211' => 'Narkwa - Central',
'CRL-212' => 'New Ebu - Central',
'CRL-213' => 'New Obuasi - Central',
'CRL-214' => 'New Odonase - Central',
'CRL-215' => 'Nkanfoa - Central',
'CRL-216' => 'Nkotumso - Central',
'CRL-217' => 'Nkronua - Central',
'CRL-218' => 'Nkum - Central',
'CRL-219' => 'Nkwaboso/Akwaboso - Central',
'CRL-220' => 'Nkwanta Nado - Central',
'CRL-221' => 'Nkwantanum-Esiam - Central',
'CRL-222' => 'Nsaba - Central',
'CRL-223' => 'Nsuta - Central',
'CRL-224' => 'Ntafrewaso - Central',
'CRL-225' => 'Ntom - Central',
'CRL-226' => 'Ntranoa - Central',
'CRL-227' => 'Nuamakrom Mampona - Central',
'CRL-228' => 'Nyakrom - Central',
'CRL-229' => 'Nyamedom - Central',
'CRL-230' => 'Nyanfeku-Ekrofur - Central',
'CRL-231' => 'Nyanyano - Central',
'CRL-232' => 'Nyenase - Central',
'CRL-233' => 'Nyinasin - Central',
'CRL-234' => 'Obohen - Central',
'CRL-235' => 'Obokor - Central',
'CRL-236' => 'Obrachire - Central',
'CRL-237' => 'Obuase - Central',
'CRL-238' => 'Ochiso - Central',
'CRL-239' => 'Oduponkpehe (Kasoa) - Central',
'CRL-240' => 'Ofaada - Central',
'CRL-241' => 'Ofaakor - Central',
'CRL-242' => 'Ofajator - Central',
'CRL-243' => 'Ojobi - Central',
'CRL-244' => 'Okitsew - Central',
'CRL-245' => 'Ongua - Central',
'CRL-246' => 'Onwane - Central',
'CRL-247' => 'Opeikuma - Central',
'CRL-248' => 'Osedzi - Central',
'CRL-249' => 'Otenkorang - Central',
'CRL-250' => 'Pomadze - Central',
'CRL-251' => 'Saltpond - Central',
'CRL-252' => 'Sankor - Central',
'CRL-253' => 'Senkyiem - Central',
'CRL-254' => 'Senya Bereku - Central',
'CRL-255' => 'Sowotuom - Central',
'CRL-256' => 'Supunso - Central',
'CRL-257' => 'Swedru - Central',
'CRL-258' => 'Tantum (Otuam) - Central',
'CRL-259' => 'Techiman - Central',
'CRL-260' => 'Towoboase - Central',
'CRL-261' => 'Tumfakura - Central',
'CRL-262' => 'Twifo Aduabeng - Central',
'CRL-263' => 'Twifo Agona Denkyira Odumase - Central',
'CRL-264' => 'Twifo Ayiase - Central',
'CRL-265' => 'Twifo Hemang - Central',
'CRL-266' => 'Twifo Praso - Central',
'CRL-267' => 'Twifo-Mampong - Central',
'ETN-1' => 'Akim Oda - Eastern',
'ETN-2' => 'Akim Swedru - Eastern',
'ETN-3' => 'Akropong - Eastern',
'ETN-4' => 'Akwatia - Eastern',
'ETN-5' => 'Asamankese - Eastern',
'ETN-6' => 'Begoro - Eastern',
'ETN-7' => 'Kade - Eastern',
'ETN-8' => 'Kibi - Eastern',
'ETN-9' => 'Koforidua - Eastern',
'ETN-10' => 'Mpraeso - Eastern',
'ETN-11' => 'Nkawkaw - Eastern',
'ETN-12' => 'Nsawam - Eastern',
'ETN-13' => 'Somanya - Eastern',
'ETN-14' => 'Suhum - Eastern',
'ETN-15' => 'Abam - Eastern',
'ETN-16' => 'Abamasarefan - Eastern',
'ETN-17' => 'Abenabu No. 2 - Eastern',
'ETN-18' => 'Abenase - Eastern',
'ETN-19' => 'Abene - Eastern',
'ETN-20' => 'Abetifi - Eastern',
'ETN-21' => 'Abiriw - Eastern',
'ETN-22' => 'Aboa Besease - Eastern',
'ETN-23' => 'Aboabo - Eastern',
'ETN-24' => 'Aboasa - Eastern',
'ETN-25' => 'Abodom - Eastern',
'ETN-26' => 'Abomanyaw Agbodokope - Eastern',
'ETN-27' => 'Abomase - Eastern',
'ETN-28' => 'Abomosarefo - Eastern',
'ETN-29' => 'Abomosu - Eastern',
'ETN-30' => 'Abompe - Eastern',
'ETN-31' => 'Aburi - Eastern',
'ETN-32' => 'Aburi - pop. 10071 - Eastern',
'ETN-33' => 'Achiase - Eastern',
'ETN-34' => 'Adai - Eastern',
'ETN-35' => 'Adamorobe - pop. 1356 - Eastern',
'ETN-36' => 'Adankrono - Eastern',
'ETN-37' => 'Adasawase - Eastern',
'ETN-38' => 'Adawso - Eastern',
'ETN-39' => 'Adiembra - Eastern',
'ETN-40' => 'Adjena - Eastern',
'ETN-41' => 'Adjikpo - Eastern',
'ETN-42' => 'Adjobue - Eastern',
'ETN-43' => 'Adoagyiri pop. - 13058 - Eastern',
'ETN-44' => 'Aduamoa - Eastern',
'ETN-45' => 'Adubia - Eastern',
'ETN-46' => 'Adubiase - Eastern',
'ETN-47' => 'Adukrom - Eastern',
'ETN-48' => 'Adumoa - Eastern',
'ETN-49' => 'Adwafo - Eastern',
'ETN-50' => 'Afosu - Eastern',
'ETN-51' => 'Agormanya - Eastern',
'ETN-52' => 'Agya Atta - Eastern',
'ETN-53' => 'Agyeikrom - Eastern',
'ETN-54' => 'Ahinkwa Yiti - Eastern',
'ETN-55' => 'Ahoniahoniaso - Eastern',
'ETN-56' => 'Ahwerase - pop. 1446 - Eastern',
'ETN-57' => 'Ahwerease - pop. 865 - Eastern',
'ETN-58' => 'Akateng - Eastern',
'ETN-59' => 'Akim Apapam - Eastern',
'ETN-60' => 'Akim Oda - Eastern',
'ETN-61' => 'Akim Osorase - Eastern',
'ETN-62' => 'Akim Sekyere - Eastern',
'ETN-63' => 'Akim-Aboabo - Eastern',
'ETN-64' => 'Akim-Achiase - Eastern',
'ETN-65' => 'Akim-Akenkauso - Eastern',
'ETN-66' => 'Akim-Akroso - Eastern',
'ETN-67' => 'Akim-Anamase - Eastern',
'ETN-68' => 'Akim-Anyinam - Eastern',
'ETN-69' => 'Akim-Aperade - Eastern',
'ETN-70' => 'Akim-Asuboa - Eastern',
'ETN-71' => 'Akim-Asuoso - Eastern',
'ETN-72' => 'Akim-Awisa - Eastern',
'ETN-73' => 'Akim-Eshiem - Eastern',
'ETN-74' => 'Akim-Manso - Eastern',
'ETN-75' => 'Akim-Swedru - Eastern',
'ETN-76' => 'Akim-Wenchi - Eastern',
'ETN-77' => 'Akoase - Eastern',
'ETN-78' => 'Akokoaseo - Eastern',
'ETN-79' => 'Akokoma Sisi - Eastern',
'ETN-80' => 'Akorabo - Eastern',
'ETN-81' => 'Akoroso - Eastern',
'ETN-82' => 'Akosombo - Eastern',
'ETN-83' => 'Akotoe Dorse/Kyerebuanya - Eastern',
'ETN-84' => 'Akpamu - Eastern',
'ETN-85' => 'Akrofufu - Eastern',
'ETN-86' => 'Akropong - Eastern',
'ETN-87' => 'Akuse - Eastern',
'ETN-88' => 'Akwabooso - Eastern',
'ETN-89' => 'Akwadum Dorse - Eastern',
'ETN-90' => 'Akwamufie - Eastern',
'ETN-91' => 'Akwaseho - Eastern',
'ETN-92' => 'Akwatia - Eastern',
'ETN-93' => 'Akyeansa - Eastern',
'ETN-94' => 'Akyem Hemang - Eastern',
'ETN-95' => 'Amanase - Eastern',
'ETN-96' => 'Amanfro - Eastern',
'ETN-97' => 'Amanfrom - pop. 957 - Eastern',
'ETN-98' => 'Amankwakrom - Eastern',
'ETN-99' => 'Amanokrom - Eastern',
'ETN-100' => 'Amedeka - Eastern',
'ETN-101' => 'Amuana Praso - Eastern',
'ETN-102' => 'Ankwa Dobro - pop. 1632 - Eastern',
'ETN-103' => 'Anoff - pop. 902 - Eastern',
'ETN-104' => 'Anum - Eastern',
'ETN-105' => 'Anum Apapam - Eastern',
'ETN-106' => 'Anweaso - Eastern',
'ETN-107' => 'Anyaboni - Eastern',
'ETN-108' => 'Anyansu - Eastern',
'ETN-109' => 'Anyinam - Eastern',
'ETN-110' => 'Anyinase - Eastern',
'ETN-111' => 'Apedwa - Eastern',
'ETN-112' => 'Apeguso - Eastern',
'ETN-113' => 'Apesika - Eastern',
'ETN-114' => 'Apinamang - Eastern',
'ETN-115' => 'Apinso - Eastern',
'ETN-116' => 'Apirede - Eastern',
'ETN-117' => 'Asafo - Eastern',
'ETN-118' => 'Asakraka - Eastern',
'ETN-119' => 'Asamama - Eastern',
'ETN-120' => 'Asamankese - Eastern',
'ETN-121' => 'Asanyansa - Eastern',
'ETN-122' => 'Asene - Eastern',
'ETN-123' => 'Asenema - Eastern',
'ETN-124' => 'Asesewa - Eastern',
'ETN-125' => 'Asiakwa - Eastern',
'ETN-126' => 'Asikuma - Eastern',
'ETN-127' => 'Asite Mannnwam - Eastern',
'ETN-128' => 'Asona - Eastern',
'ETN-129' => 'Asuboa - Eastern',
'ETN-130' => 'Asuboi - Eastern',
'ETN-131' => 'Asuboni No.3 - Eastern',
'ETN-132' => 'Asuboni Rail - Eastern',
'ETN-133' => 'Asunafo - Eastern',
'ETN-134' => 'Asuom - Eastern',
'ETN-135' => 'Atiankama-Nkwanta - Eastern',
'ETN-136' => 'Atibie - Eastern',
'ETN-137' => 'Atibie Amanfrom - Eastern',
'ETN-138' => 'Atimpoku - Eastern',
'ETN-139' => 'Atua - Eastern',
'ETN-140' => 'Awatia - Eastern',
'ETN-141' => 'Awemare - Eastern',
'ETN-142' => 'Awukugua - Eastern',
'ETN-143' => 'Ayiensu - Eastern',
'ETN-144' => 'Ayiribi - Eastern',
'ETN-145' => 'Banso - Eastern',
'ETN-146' => 'Battorkope/Kwabia Battor - Eastern',
'ETN-147' => 'Bawdua - Eastern',
'ETN-148' => 'Begoro - Eastern',
'ETN-149' => 'Bepoase - Eastern',
'ETN-150' => 'Bepong - Eastern',
'ETN-151' => 'Berekuso - pop. 1391 - Eastern',
'ETN-152' => 'Bisa - Eastern',
'ETN-153' => 'Bisibom - Eastern',
'ETN-154' => 'Bomaa - Eastern',
'ETN-155' => 'Bonkrom - Eastern',
'ETN-156' => 'Boso - Eastern',
'ETN-157' => 'Bososo - Eastern',
'ETN-158' => 'Brenase - Eastern',
'ETN-159' => 'Brepaw Sisi - Eastern',
'ETN-160' => 'Brong Densuso - Eastern',
'ETN-161' => 'Brumben - Eastern',
'ETN-162' => 'Bukanor - Eastern',
'ETN-163' => 'Bunso - Eastern',
'ETN-164' => 'Chemfe - Eastern',
'ETN-165' => 'Chia - Eastern',
'ETN-166' => 'Coaltar - Eastern',
'ETN-167' => 'Darmang - pop. 933 - Eastern',
'ETN-168' => 'Dawu - Eastern',
'ETN-169' => 'Dedeso - Eastern',
'ETN-170' => 'Dedeso Wireko - Eastern',
'ETN-171' => 'Dodi - Eastern',
'ETN-172' => 'Dokrokyewa - Eastern',
'ETN-173' => 'Dominase - Eastern',
'ETN-174' => 'Dwenase - Eastern',
'ETN-175' => 'Ehiamankyene-Odumase - Eastern',
'ETN-176' => 'Ekoso - Eastern',
'ETN-177' => 'Ekowso - Eastern',
'ETN-178' => 'Ekye Amanfrom - Eastern',
'ETN-179' => 'Ekyiamenfurom - Eastern',
'ETN-180' => 'Enyiresi - Eastern',
'ETN-181' => 'Farifari - Eastern',
'ETN-182' => 'Fintey - Eastern',
'ETN-183' => 'Fodoa - Eastern',
'ETN-184' => 'Forifori - Eastern',
'ETN-185' => 'Fotobi - pop. 2008 - Eastern',
'ETN-186' => 'Frankadua - Eastern',
'ETN-187' => 'Gyadem - Eastern',
'ETN-188' => 'Gyakiti (Gyekiti) - Eastern',
'ETN-189' => 'Huhunya - Eastern',
'ETN-190' => 'Jejeti - Eastern',
'ETN-191' => 'Juapong - Eastern',
'ETN-192' => 'Juaso - Eastern',
'ETN-193' => 'Kade - Eastern',
'ETN-194' => 'Kibi - Eastern',
'ETN-195' => 'Kitase - pop. 1804 - Eastern',
'ETN-196' => 'Klo Akwapim Yilo - Eastern',
'ETN-197' => 'Klo-Agogo - Eastern',
'ETN-198' => 'Kofi pare - Eastern',
'ETN-199' => 'Kokoben - Eastern',
'ETN-200' => 'Konkonuru - pop. 1167 - Eastern',
'ETN-201' => 'Kotokuom - Eastern',
'ETN-202' => 'Kotoso - Eastern',
'ETN-203' => 'Kpong - Eastern',
'ETN-204' => 'Kraboa Coaltar - Eastern',
'ETN-205' => 'Krabokese - Eastern',
'ETN-206' => 'Krobo Odumase (Odumase Krobo) - Eastern',
'ETN-207' => 'Kuano - Eastern',
'ETN-208' => 'Kukurantumi - Eastern',
'ETN-209' => 'Kusi - Eastern',
'ETN-210' => 'Kwabeng - Eastern',
'ETN-211' => 'Kwaboanta - Eastern',
'ETN-212' => 'Kwadjonya (Kojonya) - Eastern',
'ETN-213' => 'Kwae - Eastern',
'ETN-214' => 'Kwaekese - Eastern',
'ETN-215' => 'Kwahu Nsaba - Eastern',
'ETN-216' => 'Kwahu Praso II - Eastern',
'ETN-217' => 'Kwahu-Adawso - Eastern',
'ETN-218' => 'Kwahudaa - Eastern',
'ETN-219' => 'Kwahu-Nkwatia - Eastern',
'ETN-220' => 'Kwahu-Tafo - Eastern',
'ETN-221' => 'Kwame Dwamenakrom - Eastern',
'ETN-222' => 'Kwamoso - Eastern',
'ETN-223' => 'Kwasiadai - Eastern',
'ETN-224' => 'Labolabo - Eastern',
'ETN-225' => 'Larteh - Eastern',
'ETN-226' => 'Maame Krobo - Eastern',
'ETN-227' => 'Maase - Eastern',
'ETN-228' => 'Mamanso - Eastern',
'ETN-229' => 'Mamfe - Eastern',
'ETN-230' => 'Mampong - Eastern',
'ETN-231' => 'Mangoase - Eastern',
'ETN-232' => 'Manso - Eastern',
'ETN-233' => 'Manya Kpongunor - Eastern',
'ETN-234' => 'Mem Kyemfere - Eastern',
'ETN-235' => 'Moseaso - Eastern',
'ETN-236' => 'Mpakadan Quarters - Eastern',
'ETN-237' => 'Mpeam - Eastern',
'ETN-238' => 'Mpraeso - Eastern',
'ETN-239' => 'Mpreaso Amanfrom - Eastern',
'ETN-240' => 'Nankese - Eastern',
'ETN-241' => 'New Abirem - Eastern',
'ETN-242' => 'New Abirem - Eastern',
'ETN-243' => 'New Adjena - Eastern',
'ETN-244' => 'New Akrade - Eastern',
'ETN-245' => 'New Mangoase - Eastern',
'ETN-246' => 'New Senchi - Eastern',
'ETN-247' => 'New Worabong - Eastern',
'ETN-248' => 'Nkawkaw - Eastern',
'ETN-249' => 'Nketepa - Eastern',
'ETN-250' => 'Nkronso - Eastern',
'ETN-251' => 'Nkurakan - Eastern',
'ETN-252' => 'Nkwanda No. 1 - Eastern',
'ETN-253' => 'Nkwanda No.2 - Eastern',
'ETN-254' => 'Nkwantanag - Eastern',
'ETN-255' => 'Nkwateng - Eastern',
'ETN-256' => 'Nkwatia - Eastern',
'ETN-257' => 'Nsakye - Eastern',
'ETN-258' => 'Nsawam - Eastern',
'ETN-259' => 'Nsogyaso - Eastern',
'ETN-260' => 'Nsutam - Eastern',
'ETN-261' => 'Nteso No. 1 (Amokrom) - Eastern',
'ETN-262' => 'Ntoaso - pop. 936 - Eastern',
'ETN-263' => 'Ntonaboma - Eastern',
'ETN-264' => 'Ntronang - Eastern',
'ETN-265' => 'Nuaso - Eastern',
'ETN-266' => 'Nyuinyui Nos. 1& 2 - Eastern',
'ETN-267' => 'Obawale - Eastern',
'ETN-268' => 'Obo - Eastern',
'ETN-269' => 'Obomeng - Eastern',
'ETN-270' => 'Obomeng Odumase - Eastern',
'ETN-271' => 'Obooho - Eastern',
'ETN-272' => 'Obosomase - Eastern',
'ETN-273' => 'Obuoho - Eastern',
'ETN-274' => 'Odonkawkrom - Eastern',
'ETN-275' => 'Odotorm - Eastern',
'ETN-276' => 'Odumase - Eastern',
'ETN-277' => 'Odumasua - Eastern',
'ETN-278' => 'Ofoase - Eastern',
'ETN-279' => 'Ofoasekese - Eastern',
'ETN-280' => 'Oframase - Eastern',
'ETN-281' => 'Ogome - Eastern',
'ETN-282' => 'Okorase - Eastern',
'ETN-283' => 'Okra Kwadwo - Eastern',
'ETN-284' => 'Okumaning - Eastern',
'ETN-285' => 'Okwenya - Eastern',
'ETN-286' => 'Old Senchi - Eastern',
'ETN-287' => 'Old Tafo - Eastern',
'ETN-288' => 'Osenase - Eastern',
'ETN-289' => 'Osiem - Eastern',
'ETN-290' => 'Osino - Eastern',
'ETN-291' => 'Otchereso - Eastern',
'ETN-292' => 'Otekpolu - Eastern',
'ETN-293' => 'Otoase - Eastern',
'ETN-294' => 'Otrokope - Eastern',
'ETN-295' => 'Otumi - Eastern',
'ETN-296' => 'Owuraku - pop. 1010 - Eastern',
'ETN-297' => 'Pakpem - Eastern',
'ETN-298' => 'Pakro - pop. 2580 - Eastern',
'ETN-299' => 'Pankese - Eastern',
'ETN-300' => 'Pepease - Eastern',
'ETN-301' => 'Pleyo Okper - Eastern',
'ETN-302' => 'Pokrom - pop. 2181 - Eastern',
'ETN-303' => 'Ponponyya Puorkpe - Eastern',
'ETN-304' => 'Poponya - Eastern',
'ETN-305' => 'Pramkese - Eastern',
'ETN-306' => 'Pupuni - Eastern',
'ETN-307' => 'Saaman - Eastern',
'ETN-308' => 'Samanhyia - Eastern',
'ETN-309' => 'Sawer - Eastern',
'ETN-310' => 'Sekesua - Eastern',
'ETN-311' => 'Sekyikrom - pop. 1509 - Eastern',
'ETN-312' => 'Sempoah - Eastern',
'ETN-313' => 'Senchi - Eastern',
'ETN-314' => 'Seseamam - Eastern',
'ETN-315' => 'Somanya - Eastern',
'ETN-316' => 'South Senchi - Eastern',
'ETN-317' => 'Sowatey - Eastern',
'ETN-318' => 'Suhum - Eastern',
'ETN-319' => 'Suminakese - Eastern',
'ETN-320' => 'Sumsei - Eastern',
'ETN-321' => 'Tadieso - Eastern',
'ETN-322' => 'Takorowase - Eastern',
'ETN-323' => 'Takyimang - Eastern',
'ETN-324' => 'Teacher Mante - Eastern',
'ETN-325' => 'Tease - Eastern',
'ETN-326' => 'Tinkong - Eastern',
'ETN-327' => 'Topremang - Eastern',
'ETN-328' => 'Trawa - Eastern',
'ETN-329' => 'Trom - Eastern',
'ETN-330' => 'Tutu - Eastern',
'ETN-331' => 'Tweapease - Eastern',
'GTA-1' => 'Accra - Greater Accra',
'GTA-2' => 'Adenta East - Greater Accra',
'GTA-3' => 'Ashaiman - Greater Accra',
'GTA-4' => 'Dome - Greater Accra',
'GTA-5' => 'Gbawe - Greater Accra',
'GTA-6' => 'Lashibi - Greater Accra',
'GTA-7' => 'Madina - Greater Accra',
'GTA-8' => 'Nungua - Greater Accra',
'GTA-9' => 'Taifa - Greater Accra',
'GTA-10' => 'Tema - Greater Accra',
'GTA-11' => 'Tema New Town - Greater Accra',
'GTA-12' => 'Teshie - Greater Accra',
'GTA-13' => 'Abekope - Greater Accra',
'GTA-14' => 'Abelemkpe - Greater Accra',
'GTA-15' => 'Abia - Greater Accra',
'GTA-16' => 'Abonya - Greater Accra',
'GTA-17' => 'Aborfu - Greater Accra',
'GTA-18' => 'Abossey Okai - Greater Accra',
'GTA-19' => 'Abuviekpong - Greater Accra',
'GTA-20' => 'Accra new Town - Greater Accra',
'GTA-21' => 'Achimota - Greater Accra',
'GTA-22' => 'Ada-Foah - Greater Accra',
'GTA-23' => 'Adakope - Greater Accra',
'GTA-24' => 'Adenta East - Greater Accra',
'GTA-25' => 'Adenta West - Greater Accra',
'GTA-26' => 'Adjumadjan - Greater Accra',
'GTA-27' => 'Adumanya - Greater Accra',
'GTA-28' => 'Adzomanukope - Greater Accra',
'GTA-29' => 'Afienya - Greater Accra',
'GTA-30' => 'Agbekotsekpo - Greater Accra',
'GTA-31' => 'Agbogbloshie - Greater Accra',
'GTA-32' => 'Agortor - Greater Accra',
'GTA-33' => 'Ahwiam - Greater Accra',
'GTA-34' => 'Airport Residential Area - Greater Accra',
'GTA-35' => 'Akokorfoto - Greater Accra',
'GTA-36' => 'Akplabanya - Greater Accra',
'GTA-37' => 'Akweteman - Greater Accra',
'GTA-38' => 'Alajo - Greater Accra',
'GTA-39' => 'Alikope - Greater Accra',
'GTA-40' => 'Amanfrom - Greater Accra',
'GTA-41' => 'Ametafor - Greater Accra',
'GTA-42' => 'Anyaa - Greater Accra',
'GTA-43' => 'Anyamam - Greater Accra',
'GTA-44' => 'Apenkwa - Greater Accra',
'GTA-45' => 'Apese No.2 - Greater Accra',
'GTA-46' => 'Asebi - Greater Accra',
'GTA-47' => 'Asere - Greater Accra',
'GTA-48' => 'Ashaley Botwe - Greater Accra',
'GTA-49' => 'Ashongman - Greater Accra',
'GTA-50' => 'Asilevikope - Greater Accra',
'GTA-51' => 'Asutsuare - Greater Accra',
'GTA-52' => 'Asylum Down - Greater Accra',
'GTA-53' => 'Atabui - Greater Accra',
'GTA-54' => 'Atrobinya - Greater Accra',
'GTA-55' => 'Avakpo - Greater Accra',
'GTA-56' => 'Avenor - Greater Accra',
'GTA-57' => 'Awoshie - Greater Accra',
'GTA-58' => 'Ayernya - Greater Accra',
'GTA-59' => 'Ayetepa - Greater Accra',
'GTA-60' => 'Ayi Mensa - Greater Accra',
'GTA-61' => 'Ayikuma - Greater Accra',
'GTA-62' => 'Bansa - Greater Accra',
'GTA-63' => 'Bantang - Greater Accra',
'GTA-64' => 'Bedeku - Greater Accra',
'GTA-65' => 'Bethelehem - Greater Accra',
'GTA-66' => 'Bonikope Songor - Greater Accra',
'GTA-67' => 'Bortianor - Greater Accra',
'GTA-68' => 'Bubuashie - Greater Accra',
'GTA-69' => 'Buerko - Greater Accra',
'GTA-70' => 'Bukom - Greater Accra',
'GTA-71' => 'Burma Camp - Greater Accra',
'GTA-72' => 'Chantan - Greater Accra',
'GTA-73' => 'Chemuna - Greater Accra',
'GTA-74' => 'Chorkor - Greater Accra',
'GTA-75' => 'Christianborg - Greater Accra',
'GTA-76' => 'Dansoman - Greater Accra',
'GTA-77' => 'Darkuman - Greater Accra',
'GTA-78' => 'Dawa - Greater Accra',
'GTA-79' => 'Dawhenya - Greater Accra',
'GTA-80' => 'Dawhenya New Site - Greater Accra',
'GTA-81' => 'Dedenya - Greater Accra',
'GTA-82' => 'Dodowa - Greater Accra',
'GTA-83' => 'Domanya - Greater Accra',
'GTA-84' => 'Dome - Greater Accra',
'GTA-85' => 'Dorymu - Greater Accra',
'GTA-86' => 'Duffor - Greater Accra',
'GTA-87' => 'Dzogbedzi - Greater Accra',
'GTA-88' => 'Dzorwulu - Greater Accra',
'GTA-89' => 'East Cantonments - Greater Accra',
'GTA-90' => 'East Legon - Greater Accra',
'GTA-91' => 'East Legon (Okponglo) - Greater Accra',
'GTA-92' => 'East Ridge - Greater Accra',
'GTA-93' => 'Fiakonya - Greater Accra',
'GTA-94' => 'Forkpe - Greater Accra',
'GTA-95' => 'Gbegbeyise - Greater Accra',
'GTA-96' => 'Gbesemi - Greater Accra',
'GTA-97' => 'Gigedokum - Greater Accra',
'GTA-98' => 'Goi - Greater Accra',
'GTA-99' => 'Gozankope - Greater Accra',
'GTA-100' => 'Haatso - Greater Accra',
'GTA-101' => 'Henyum - Greater Accra',
'GTA-102' => 'Ho - Greater Accra',
'GTA-103' => 'Huapa - Greater Accra',
'GTA-104' => 'Independence Avenue - Greater Accra',
'GTA-105' => 'Kadjanya - Greater Accra',
'GTA-106' => 'Kakasunanka II - Greater Accra',
'GTA-107' => 'Kanda Estate - Greater Accra',
'GTA-108' => 'Kenekope - Greater Accra',
'GTA-109' => 'Kewum - Greater Accra',
'GTA-110' => 'Klebuse - Greater Accra',
'GTA-111' => 'Kodiabe - Greater Accra',
'GTA-112' => 'Kokomlemle - Greater Accra',
'GTA-113' => 'Kolikpo - Greater Accra',
'GTA-114' => 'Koluedor - Greater Accra',
'GTA-115' => 'Kongo - Greater Accra',
'GTA-116' => 'Koni Kablu - Greater Accra',
'GTA-117' => 'Konkontekope and Otenkope - Greater Accra',
'GTA-118' => 'Kopodor - Greater Accra',
'GTA-119' => 'Korle Gonno - Greater Accra',
'GTA-120' => 'Kortorkor - Greater Accra',
'GTA-121' => 'Kotobabi - Greater Accra',
'GTA-122' => 'Kpatsiremidor - Greater Accra',
'GTA-123' => 'Kpohe - Greater Accra',
'GTA-124' => 'Kpone - Greater Accra',
'GTA-125' => 'Kpongunor - Greater Accra',
'GTA-126' => 'Kuku Hill - Greater Accra',
'GTA-127' => 'Kwabenya - Greater Accra',
'GTA-128' => 'Kwashiebu - Greater Accra',
'GTA-129' => 'Kwashieman - Greater Accra',
'GTA-130' => 'Labadi-Aborm - Greater Accra',
'GTA-131' => 'Lakpleku - Greater Accra',
'GTA-132' => 'Lartebiokorshie - Greater Accra',
'GTA-133' => 'lashibi - Greater Accra',
'GTA-134' => 'Lekpongunor - Greater Accra',
'GTA-135' => 'Link Road - Greater Accra',
'GTA-136' => 'Lolonya - Greater Accra',
'GTA-137' => 'Lorlorvor - Greater Accra',
'GTA-138' => 'Lotsubuer - Greater Accra',
'GTA-139' => 'Luom - Greater Accra',
'GTA-140' => 'Machekope - Greater Accra',
'GTA-141' => 'Madina - Greater Accra',
'GTA-142' => 'Mallam - Greater Accra',
'GTA-143' => 'Mamobi - Greater Accra',
'GTA-144' => 'Mampong Shai - Greater Accra',
'GTA-145' => 'Mampose - Greater Accra',
'GTA-146' => 'Mandela - Greater Accra',
'GTA-147' => 'Mangochonya Agomeda - Greater Accra',
'GTA-148' => 'Mantseman - Greater Accra',
'GTA-149' => 'Mataheko - Greater Accra',
'GTA-150' => 'Minya - Greater Accra',
'GTA-151' => 'Mobole - Greater Accra',
'GTA-152' => 'Nakope - Greater Accra',
'GTA-153' => 'Natriku - Greater Accra',
'GTA-154' => 'New Abossey Okai - Greater Accra',
'GTA-155' => 'New Achimota - Greater Accra',
'GTA-156' => 'New Fadama - Greater Accra',
'GTA-157' => 'New Mamprobi - Greater Accra',
'GTA-158' => 'New Ningo - Greater Accra',
'GTA-159' => 'Ngmetsokope - Greater Accra',
'GTA-160' => 'Nigeria - Greater Accra',
'GTA-161' => 'Nii Boi Town - Greater Accra',
'GTA-162' => 'Nii Boye Town - Greater Accra',
'GTA-163' => 'Nima - Greater Accra',
'GTA-164' => 'North Dzorwulu - Greater Accra',
'GTA-165' => 'North Kaneshie - Greater Accra',
'GTA-166' => 'North Labone - Greater Accra',
'GTA-167' => 'Nungua - Greater Accra',
'GTA-168' => 'Nungua East - Greater Accra',
'GTA-169' => 'Nungua Old Town - Greater Accra',
'GTA-170' => 'Nungua-Zongo - Greater Accra',
'GTA-171' => 'Nyigbenya/Tsopoli - Greater Accra',
'GTA-172' => 'Ocanse Kope - Greater Accra',
'GTA-173' => 'Odawna - Greater Accra',
'GTA-174' => 'Odorkor - Greater Accra',
'GTA-175' => 'Odumase - Greater Accra',
'GTA-176' => 'Ofankor - Greater Accra',
'GTA-177' => 'Ogbojo - Greater Accra',
'GTA-178' => 'Okaishie - Greater Accra',
'GTA-179' => 'Old Dansoman - Greater Accra',
'GTA-180' => 'Old Ningo - Greater Accra',
'GTA-181' => 'Omankope - Greater Accra',
'GTA-182' => 'Oquedzor - Greater Accra',
'GTA-183' => 'Osu - Greater Accra',
'GTA-184' => 'Osu Ako-Adjei - Greater Accra',
'GTA-185' => 'Osu Alata/Ashante - Greater Accra',
'GTA-186' => 'Osuwem - Greater Accra',
'GTA-187' => 'Oyarifa - Greater Accra',
'GTA-188' => 'Oyikum - Greater Accra',
'GTA-189' => 'Pokuase - Greater Accra',
'GTA-190' => 'Police Headquarters Area - Greater Accra',
'GTA-191' => 'Pukper - Greater Accra',
'GTA-192' => 'Pute - Greater Accra',
'GTA-193' => 'Ridge - Greater Accra',
'GTA-194' => 'Ringway Estates - Greater Accra',
'GTA-195' => 'Roman Ridge - Greater Accra',
'GTA-196' => 'Sahara - Greater Accra',
'GTA-197' => 'Saihe - Greater Accra',
'GTA-198' => 'Sakaman - Greater Accra',
'GTA-199' => 'Santa Maria - Greater Accra',
'GTA-200' => 'Sege Junction - Greater Accra',
'GTA-201' => 'Sempe New Town - Greater Accra',
'GTA-202' => 'Shai Hills - Greater Accra',
'GTA-203' => 'Shiabu - Greater Accra',
'GTA-204' => 'Somey - Greater Accra',
'GTA-205' => 'Songutsokpa Big-Ada - Greater Accra',
'GTA-206' => 'Sota - Greater Accra',
'GTA-207' => 'South Amanhoma - Greater Accra',
'GTA-208' => 'South Labadi - Greater Accra',
'GTA-209' => 'South Odorkor - Greater Accra',
'GTA-210' => 'South Shiashie - Greater Accra',
'GTA-211' => 'Sowutuom - Greater Accra',
'GTA-212' => 'T/Junction - Greater Accra',
'GTA-213' => 'Tabora - Greater Accra',
'GTA-214' => 'Tachikope - Greater Accra',
'GTA-215' => 'Taifa - Greater Accra',
'GTA-216' => 'Tamatoku - Greater Accra',
'GTA-217' => 'Tantra Hill - Greater Accra',
'GTA-218' => 'Tema Community Eight - Greater Accra',
'GTA-219' => 'Tema Community Eleven - Greater Accra',
'GTA-220' => 'Tema Community Five - Greater Accra',
'GTA-221' => 'Tema Community Four - Greater Accra',
'GTA-222' => 'Tema community Nine - Greater Accra',
'GTA-223' => 'Tema Community one - Greater Accra',
'GTA-224' => 'Tema Community Seven - Greater Accra',
'GTA-225' => 'Tema Community Six - Greater Accra',
'GTA-226' => 'Tema community Three - Greater Accra',
'GTA-227' => 'Tema Community Two Sakumono - Greater Accra',
'GTA-228' => 'Tema Newtown - Greater Accra',
'GTA-229' => 'Tesano - Greater Accra',
'GTA-230' => 'Teshie new Town - Greater Accra',
'GTA-231' => 'Teshie-Nungua Estates - Greater Accra',
'GTA-232' => 'Tokpo No. 1 - Greater Accra',
'GTA-233' => 'Tokpo No. 2 - Greater Accra',
'GTA-234' => 'Totimekope - Greater Accra',
'GTA-235' => 'Totope - Greater Accra',
'GTA-236' => 'Tsumkpo - Greater Accra',
'GTA-237' => 'UssherTown - Greater Accra',
'NTN-1' => 'Kpandae - Northern',
'NTN-2' => 'Nyankpala - Northern',
'NTN-3' => 'Salaga - Northern',
'NTN-4' => 'Savelugu - Northern',
'NTN-5' => 'Tamale - Northern',
'NTN-6' => 'Yendi - Northern',
'NTN-7' => 'Ada - Northern',
'NTN-8' => 'Adibo - Northern',
'NTN-9' => 'Adubilliyili - Northern',
'NTN-10' => 'Arigu - Northern',
'NTN-11' => 'Bachalbado - Northern',
'NTN-12' => 'Baduli - Northern',
'NTN-13' => 'Bagape - Northern',
'NTN-14' => 'Bagbiapi - Northern',
'NTN-15' => 'Bagmare - Northern',
'NTN-16' => 'Bagurugu - Northern',
'NTN-17' => 'Bakpaba - Northern',
'NTN-18' => 'Bale - Northern',
'NTN-19' => 'Bamboi - Northern',
'NTN-20' => 'Banda Nkwanta - Northern',
'NTN-21' => 'Banda-Nkwanta - Northern',
'NTN-22' => 'Bandayili - Northern',
'NTN-23' => 'Bankamba - Northern',
'NTN-24' => 'Barwa Barracks - Northern',
'NTN-25' => 'Bawena - Northern',
'NTN-26' => 'Bende - Northern',
'NTN-27' => 'Bimbago - Northern',
'NTN-28' => 'Bimbilla - Northern',
'NTN-29' => 'Bincheratanga - Northern',
'NTN-30' => 'Bladjai - Northern',
'NTN-31' => 'Bofoyili - Northern',
'NTN-32' => 'Bogdoo - Northern',
'NTN-33' => 'Bole - Northern',
'NTN-34' => 'Bomburi - Northern',
'NTN-35' => 'Bonbonayili - Northern',
'NTN-36' => 'Brugbani - Northern',
'NTN-37' => 'Buachipe - Northern',
'NTN-38' => 'Bugrunu - Northern',
'NTN-39' => 'Buipe - Northern',
'NTN-40' => 'Buli - Northern',
'NTN-41' => 'Bulugu - Northern',
'NTN-42' => 'Bungeli - Northern',
'NTN-43' => 'Bunkpurugu - Northern',
'NTN-44' => 'Busunu - Northern',
'NTN-45' => 'Butie - Northern',
'NTN-46' => 'Buya - Northern',
'NTN-47' => 'Canteen - Northern',
'NTN-48' => 'Chache - Northern',
'NTN-49' => 'Chama - Northern',
'NTN-50' => 'Chamba - Northern',
'NTN-51' => 'Chanayili - Northern',
'NTN-52' => 'Chanchangu - Northern',
'NTN-53' => 'Changbuni - Northern',
'NTN-54' => 'Charkudo - Northern',
'NTN-55' => 'Chasia - Northern',
'NTN-56' => 'Chatali - Northern',
'NTN-57' => 'Chereponi - Northern',
'NTN-58' => 'Chibrungo - Northern',
'NTN-59' => 'Chichari - Northern',
'NTN-60' => 'Chirifoyili - Northern',
'NTN-61' => 'Dabogni - Northern',
'NTN-62' => 'Dabopi - Northern',
'NTN-63' => 'Dabori - Northern',
'NTN-64' => 'Daboya - Northern',
'NTN-65' => 'Dagbiriboari - Northern',
'NTN-66' => 'Dagonkadi - Northern',
'NTN-67' => 'Dakpam - Northern',
'NTN-68' => 'Dalun - Northern',
'NTN-69' => 'Damanko - Northern',
'NTN-70' => 'Damongo - Northern',
'NTN-71' => 'Degbila - Northern',
'NTN-72' => 'Degwiwu - Northern',
'NTN-73' => 'Demon - Northern',
'NTN-74' => 'Demon - Northern',
'NTN-75' => 'Diare - Northern',
'NTN-76' => 'Digma - Northern',
'NTN-77' => 'Disiga - Northern',
'NTN-78' => 'Dungu - Northern',
'NTN-79' => 'Duu - Northern',
'NTN-80' => 'Ekumdipe - Northern',
'NTN-81' => 'Ekumudi - Northern',
'NTN-82' => 'Esalikawu - Northern',
'NTN-83' => 'Fimbo - Northern',
'NTN-84' => 'Finimado - Northern',
'NTN-85' => 'Fuchmbluma - Northern',
'NTN-86' => 'Fulfoso - Northern',
'NTN-87' => 'Fulfusu - Northern',
'NTN-88' => 'Fuu - Northern',
'NTN-89' => 'Gaa - Northern',
'NTN-90' => 'Gambaga - Northern',
'NTN-91' => 'Garinkuka - Northern',
'NTN-92' => 'Gbalga - Northern',
'NTN-93' => 'Gbambaya - Northern',
'NTN-94' => 'Gbandaa - Northern',
'NTN-95' => 'Gbandi - Northern',
'NTN-96' => 'Gbasinkpa - Northern',
'NTN-97' => 'Gbateto - Northern',
'NTN-98' => 'Gbegu - Northern',
'NTN-99' => 'Gbeini - Northern',
'NTN-100' => 'Gbemfo - Northern',
'NTN-101' => 'Gbimsi - Northern',
'NTN-102' => 'Gbintiri - Northern',
'NTN-103' => 'Gbogu - Northern',
'NTN-104' => 'Gbrimani - Northern',
'NTN-105' => 'Gbulahagu - Northern',
'NTN-106' => 'Gbullung - Northern',
'NTN-107' => 'Gbung - Northern',
'NTN-108' => 'Gbungbalga - Northern',
'NTN-109' => 'Gbungbaliga - Northern',
'NTN-110' => 'Geluwei - Northern',
'NTN-111' => 'Gitase - Northern',
'NTN-112' => 'Gmanicheri - Northern',
'NTN-113' => 'Gnani - Northern',
'NTN-114' => 'Gorgu - Northern',
'NTN-115' => 'Gor-Kukani - Northern',
'NTN-116' => 'Grube - Northern',
'NTN-117' => 'Guabulga - Northern',
'NTN-118' => 'Gulubi - Northern',
'NTN-119' => 'Gulubi Quarters - Northern',
'NTN-120' => 'Gundaa - Northern',
'NTN-121' => 'Gunsi - Northern',
'NTN-122' => 'Gurugu - Northern',
'NTN-123' => 'Gushie - Northern',
'NTN-124' => 'Gushiegu - Northern',
'NTN-125' => 'Helvetica - Northern',
'NTN-126' => 'Jadima - Northern',
'NTN-127' => 'Jafor - Northern',
'NTN-128' => 'Jama - Northern',
'NTN-129' => 'Jandra - Northern',
'NTN-130' => 'Jang - Northern',
'NTN-131' => 'Janga - Northern',
'NTN-132' => 'Janga - Northern',
'NTN-133' => 'Jawani - Northern',
'NTN-134' => 'Jayondo - Northern',
'NTN-135' => 'Jegbuni - Northern',
'NTN-136' => 'Jemile - Northern',
'NTN-137' => 'Jerigu - Northern',
'NTN-138' => 'Jimbale - Northern',
'NTN-139' => 'Jindabuo - Northern',
'NTN-140' => 'Jinfranu - Northern',
'NTN-141' => 'Jisonayili - Northern',
'NTN-142' => 'Jogboi - Northern',
'NTN-143' => 'Jonokponto - Northern',
'NTN-144' => 'Juali - Northern',
'NTN-145' => 'Junle - Northern',
'NTN-146' => 'Juo - Northern',
'NTN-147' => 'Kabaka - Northern',
'NTN-148' => 'Kabampe - Northern',
'NTN-149' => 'Kablima - Northern',
'NTN-150' => 'Kabonwele - Northern',
'NTN-151' => 'Kadia - Northern',
'NTN-152' => 'Kafaba - Northern',
'NTN-153' => 'Kakpayili (Kapayili) - Northern',
'NTN-154' => 'Kalba - Northern',
'NTN-155' => 'Kamina Barracks - Northern',
'NTN-156' => 'Kananta - Northern',
'NTN-157' => 'Kananto - Northern',
'NTN-158' => 'Kandige - Northern',
'NTN-159' => 'Kandin - Northern',
'NTN-160' => 'Kanjo - Northern',
'NTN-161' => 'Kanvilli - Northern',
'NTN-162' => 'Kanyaga - Northern',
'NTN-163' => 'Karaga - Northern',
'NTN-164' => 'Karamenga - Northern',
'NTN-165' => 'Kasuliyili - Northern',
'NTN-166' => 'Kasuridabarshe - Northern',
'NTN-167' => 'Katali - Northern',
'NTN-168' => 'Katanga - Northern',
'NTN-169' => 'Katani - Northern',
'NTN-170' => 'Katariga - Northern',
'NTN-171' => 'Katiajeli - Northern',
'NTN-172' => 'Kiape - Northern',
'NTN-173' => 'Kijau Bator - Northern',
'NTN-174' => 'Kimabui - Northern',
'NTN-175' => 'Kitare - Northern',
'NTN-176' => 'Kogni - Northern',
'NTN-177' => 'Konfogsi - Northern',
'NTN-178' => 'Kong - Northern',
'NTN-179' => 'Konkori - Northern',
'NTN-180' => 'Kopota - Northern',
'NTN-181' => 'Kotito No. 1 - Northern',
'NTN-182' => 'Kotito No. 2 - Northern',
'NTN-183' => 'Kotito No. 3 - Northern',
'NTN-184' => 'Kpabi - Northern',
'NTN-185' => 'Kpabia - Northern',
'NTN-186' => 'Kpalba - Northern',
'NTN-187' => 'Kpalbe - Northern',
'NTN-188' => 'Kpalbusi - Northern',
'NTN-189' => 'Kpalbutabo (Kumbundo) - Northern',
'NTN-190' => 'Kpalgagbini - Northern',
'NTN-191' => 'Kpalguni - Northern',
'NTN-192' => 'Kpalibe - Northern',
'NTN-193' => 'Kpalisogu - Northern',
'NTN-194' => 'Kpalung - Northern',
'NTN-195' => 'Kpandai - Northern',
'NTN-196' => 'Kpani Fishing Village - Northern',
'NTN-197' => 'Kpanjamba - Northern',
'NTN-198' => 'Kparigu - Northern',
'NTN-199' => 'Kpasenkpe - Northern',
'NTN-200' => 'Kpasenkpe - Northern',
'NTN-201' => 'Kpatari-Bogu - Northern',
'NTN-202' => 'Kpatinga - Northern',
'NTN-203' => 'Kpeegu - Northern',
'NTN-204' => 'Kpembe - Northern',
'NTN-205' => 'Kpendua - Northern',
'NTN-206' => 'Kubari - Northern',
'NTN-207' => 'Kubori - Northern',
'NTN-208' => 'Kudani - Northern',
'NTN-209' => 'Kudani - Northern',
'NTN-210' => 'Kuga Kpatuya - Northern',
'NTN-211' => 'Kugnani - Northern',
'NTN-212' => 'Kukabila - Northern',
'NTN-213' => 'Kukpaligu - Northern',
'NTN-214' => 'Kukuo - Northern',
'NTN-215' => 'Kulkpanga - Northern',
'NTN-216' => 'Kulmasa - Northern',
'NTN-217' => 'Kulupene - Northern',
'NTN-218' => 'Kumbungu - Northern',
'NTN-219' => 'Kunkunzoli - Northern',
'NTN-220' => 'Kuntumbiyili - Northern',
'NTN-221' => 'Kusaweu - Northern',
'NTN-222' => 'Kusawgu - Northern',
'NTN-223' => 'Kusebi - Northern',
'NTN-224' => 'Kuyuli - Northern',
'NTN-225' => 'Kwame Kwasi - Northern',
'NTN-226' => 'Lampel - Northern',
'NTN-227' => 'Langa - Northern',
'NTN-228' => 'Langantre - Northern',
'NTN-229' => 'Langbensi - Northern',
'NTN-230' => 'Langbinsi - Northern',
'NTN-231' => 'Langogu - Northern',
'NTN-232' => 'Lanja - Northern',
'NTN-233' => 'Larabanga - Northern',
'NTN-234' => 'Larekago - Northern',
'NTN-235' => 'Laribanga - Northern',
'NTN-236' => 'Lepusi - Northern',
'NTN-237' => 'Limo - Northern',
'NTN-238' => 'Lingbinsi - Northern',
'NTN-239' => 'Loagri No. 1 - Northern',
'NTN-240' => 'Loloto - Northern',
'NTN-241' => 'Lonto - Northern',
'NTN-242' => 'Lovi - Northern',
'NTN-243' => 'Luari - Northern',
'NTN-244' => 'Lumpurgo - Northern',
'NTN-245' => 'Lungbunga - Northern',
'NTN-246' => 'Lungni - Northern',
'NTN-247' => 'Luntni - Northern',
'NTN-248' => 'Makongo - Northern',
'NTN-249' => 'Makpayili - Northern',
'NTN-250' => 'Maleshegu - Northern',
'NTN-251' => 'Malume - Northern',
'NTN-252' => 'Maluwe - Northern',
'NTN-253' => 'Mandari - Northern',
'NTN-254' => 'Mankarigu - Northern',
'NTN-255' => 'Mankpan - Northern',
'NTN-256' => 'Mankuma - Northern',
'NTN-257' => 'Masaka - Northern',
'NTN-258' => 'Meriche - Northern',
'NTN-259' => 'Mishuo - Northern',
'NTN-260' => 'Moba - Northern',
'NTN-261' => 'Moglaa - Northern',
'NTN-262' => 'Moglo - Northern',
'NTN-263' => 'Mognori - Northern',
'NTN-264' => 'Mojina - Northern',
'NTN-265' => 'Mole Achubunyor - Northern',
'NTN-266' => 'Mpana - Northern',
'NTN-267' => 'Mumgu - Northern',
'NTN-268' => 'Murugu - Northern',
'NTN-269' => 'Naamasim - Northern',
'NTN-270' => 'Nabari - Northern',
'NTN-271' => 'Nabori - Northern',
'NTN-272' => 'Nabuli - Northern',
'NTN-273' => 'Nadiyili - Northern',
'NTN-274' => 'Nagbo - Northern',
'NTN-275' => 'Nahuyili - Northern',
'NTN-276' => 'Najong I - Northern',
'NTN-277' => 'Najong II - Northern',
'NTN-278' => 'Nakpachei - Northern',
'NTN-279' => 'Nakpa-Gbeini - Northern',
'NTN-280' => 'Nakpali - Northern',
'NTN-281' => 'Nakpali (Kworli) - Northern',
'NTN-282' => 'Nakpanduri - Northern',
'NTN-283' => 'Nakpanzuo - Northern',
'NTN-284' => 'Nakpayili - Northern',
'NTN-285' => 'Nakpayili - Northern',
'NTN-286' => 'Nakudugu - Northern',
'NTN-287' => 'Nakwabi - Northern',
'NTN-288' => 'Nalerigu - Northern',
'NTN-289' => 'Namango - Northern',
'NTN-290' => 'Nambiri - Northern',
'NTN-291' => 'Naminboku Nagboo - Northern',
'NTN-292' => 'Nanton - Northern',
'NTN-293' => 'Nanton Kurugu - Northern',
'NTN-294' => 'Nasia - Northern',
'NTN-295' => 'Nasuan - Northern',
'NTN-296' => 'Natog - Northern',
'NTN-297' => 'Nawuhugu - Northern',
'NTN-298' => 'Nawuni - Northern',
'NTN-299' => 'Nayogu - Northern',
'NTN-300' => 'Nayoku - Northern',
'NTN-301' => 'Ngani - Northern',
'NTN-302' => 'Nkanchina No. 2 - Northern',
'NTN-303' => 'Ntereso - Northern',
'NTN-304' => 'Nyankpala - Northern',
'NTN-305' => 'Nyankpala - Northern',
'NTN-306' => 'Nyeko - Northern',
'NTN-307' => 'Nyensugi - Northern',
'NTN-308' => 'Nyoglo - Northern',
'NTN-309' => 'Nyoli No. 1 - Northern',
'NTN-310' => 'Nyolugu - Northern',
'NTN-311' => 'Nyong Guma - Northern',
'NTN-312' => 'Nyong Nayili - Northern',
'NTN-313' => 'Old Gor - Northern',
'NTN-314' => 'Old Makango - Northern',
'NTN-315' => 'Omarldo (Omarli) - Northern',
'NTN-316' => 'Opijua - Northern',
'NTN-317' => 'Otijua - Northern',
'NTN-318' => 'Palangasi - Northern',
'NTN-319' => 'Palari - Northern',
'NTN-320' => 'Pigu - Northern',
'NTN-321' => 'Piong - Northern',
'NTN-322' => 'Pishigu - Northern',
'NTN-323' => 'Pong (Kpung) - Northern',
'NTN-324' => 'Pong-Tamale - Northern',
'NTN-325' => 'Pudua - Northern',
'NTN-326' => 'Puduya - Northern',
'NTN-327' => 'Pulo - Northern',
'NTN-328' => 'Pumo - Northern',
'NTN-329' => 'Pusuga - Northern',
'NTN-330' => 'Saani - Northern',
'NTN-331' => 'Sabare No. 1 - Northern',
'NTN-332' => 'Saboba - Northern',
'NTN-333' => 'Sabon-Gida - Northern',
'NTN-334' => 'Sabonjida - Northern',
'NTN-335' => 'Sagadugu - Northern',
'NTN-336' => 'Sakogu - Northern',
'NTN-337' => 'Sakpa - Northern',
'NTN-338' => 'Sakpe - Northern',
'NTN-339' => 'Salaga - Northern',
'NTN-340' => 'Salkpang - Northern',
'NTN-341' => 'Salwa - Northern',
'NTN-342' => 'Samang Yapala - Northern',
'NTN-343' => 'Samanga - Northern',
'NTN-344' => 'Sambu - Northern',
'NTN-345' => 'Sambuli - Northern',
'NTN-346' => 'Samene - Northern',
'NTN-347' => 'Sampemo - Northern',
'NTN-348' => 'Samtemo - Northern',
'NTN-349' => 'Sandu - Northern',
'NTN-350' => 'Sang - Northern',
'NTN-351' => 'Sangbaa - Northern',
'NTN-352' => 'Sangbana - Northern',
'NTN-353' => 'Sanguyili (Sanguli) - Northern',
'NTN-354' => 'Sankpala - Northern',
'NTN-355' => 'Sapiegu - Northern',
'NTN-356' => 'Saru - Northern',
'NTN-357' => 'Savelugu - Northern',
'NTN-358' => 'Sawla - Northern',
'NTN-359' => 'Segbasi - Northern',
'NTN-360' => 'Sekpe - Northern',
'NTN-361' => 'Seripe - Northern',
'NTN-362' => 'Sheki - Northern',
'NTN-363' => 'Shieni - Northern',
'NTN-364' => 'Shintoli - Northern',
'NTN-365' => 'Shishegu - Northern',
'NTN-366' => 'Sibon Gida - Northern',
'NTN-367' => 'Simlibogu - Northern',
'NTN-368' => 'Singa - Northern',
'NTN-369' => 'Siriminchu - Northern',
'NTN-370' => 'Sobiba - Northern',
'NTN-371' => 'Soma - Northern',
'NTN-372' => 'Soo - Northern',
'NTN-373' => 'Sorri - Northern',
'NTN-374' => 'Sumpuoyiri/Berinya - Northern',
'NTN-375' => 'Sung - Northern',
'NTN-376' => 'Sunsan - Northern',
'NTN-377' => 'Taali - Northern',
'NTN-378' => 'Takorade - Northern',
'NTN-379' => 'Tali - Northern',
'NTN-380' => 'Tamale - Northern',
'NTN-381' => 'Tamaligu - Northern',
'NTN-382' => 'Tampion - Northern',
'NTN-383' => 'Tampulingu - Northern',
'NTN-384' => 'Tanamdo - Northern',
'NTN-385' => 'Tanaya - Northern',
'NTN-386' => 'Tantali - Northern',
'NTN-387' => 'Tarikpaa - Northern',
'NTN-388' => 'Tatale - Northern',
'NTN-389' => 'Techigu - Northern',
'NTN-390' => 'Teselima - Northern',
'NTN-391' => 'Teselima - Northern',
'NTN-392' => 'Tibung - Northern',
'NTN-393' => 'Tijo - Northern',
'NTN-394' => 'Tindan - Northern',
'NTN-395' => 'Tinga - Northern',
'NTN-396' => 'Tingoli - Northern',
'NTN-397' => 'Tinguri - Northern',
'NTN-398' => 'Tintang - Northern',
'NTN-399' => 'Tolon - Northern',
'NTN-400' => 'Tombo - Northern',
'NTN-401' => 'Tong - Northern',
'NTN-402' => 'Toyanyili - Northern',
'NTN-403' => 'Tugu - Northern',
'NTN-404' => 'Tuluwe - Northern',
'NTN-405' => 'Tuluwe - Northern',
'NTN-406' => 'Tuna - Northern',
'NTN-407' => 'Turumi - Northern',
'NTN-408' => 'Tuwuo - Northern',
'NTN-409' => 'Ugando - Northern',
'NTN-410' => 'Upper Nanson - Northern',
'UET-1' => 'Adaboya - Upper East',
'UET-2' => 'Aneigo - Upper East',
'UET-3' => 'Apodabogo - Upper East',
'UET-4' => 'Awchana-Yeri - Upper East',
'UET-5' => 'Azuwera - Upper East',
'UET-6' => 'Balungu-Gantorisi - Upper East',
'UET-7' => 'Bawku - Upper East',
'UET-8' => 'Bawku - Upper East',
'UET-9' => 'Binaba - Upper East',
'UET-10' => 'Binaba Central Kamega - Upper East',
'UET-11' => 'Binduri - Upper East',
'UET-12' => 'Biu - Upper East',
'UET-13' => 'Biung - Upper East',
'UET-14' => 'Bogorogo - Upper East',
'UET-15' => 'Bolgatanga - Upper East',
'UET-16' => 'Bolgatanga - Upper East',
'UET-17' => 'Bongo - Upper East',
'UET-18' => 'Bongo-Nyariga - Upper East',
'UET-19' => 'Bonia - Upper East',
'UET-20' => 'Bugri - Upper East',
'UET-21' => 'Chiana - Upper East',
'UET-22' => 'Chiok-Alonga Yeri - Upper East',
'UET-23' => 'Choo - Upper East',
'UET-24' => 'Chuchuliga Central - Upper East',
'UET-25' => 'Datako-Kurbor - Upper East',
'UET-26' => 'Doninga - Upper East',
'UET-27' => 'Dua - Upper East',
'UET-28' => 'Dua Apuwongo - Upper East',
'UET-29' => 'Duu - Upper East',
'UET-30' => 'Duusi - Upper East',
'UET-31' => 'Feo-Nabisi - Upper East',
'UET-32' => 'Fumbis-Baansa - Upper East',
'UET-33' => 'Fumbisi - Upper East',
'UET-34' => 'Fumbisi-Naadem - Upper East',
'UET-35' => 'fumbis-Kasisa - Upper East',
'UET-36' => 'Galaka - Upper East',
'UET-37' => 'Gambibigo-Azuabisi - Upper East',
'UET-38' => 'Gbedema-Jagsa-Garibiemsa - Upper East',
'UET-39' => 'Gbedema-Kunkwak - Upper East',
'UET-40' => 'Gongnia - Upper East',
'UET-41' => 'Googo - Upper East',
'UET-42' => 'Gore - Upper East',
'UET-43' => 'Gorogo - Upper East',
'UET-44' => 'Gororo Yikpemeri - Upper East',
'UET-45' => 'Gowrie Nayire Central Zoko-Gambrongo-Azaabisi - Upper East',
'UET-46' => 'Gowrie-Tingre - Upper East',
'UET-47' => 'Gumari - Upper East',
'UET-48' => 'Gumbo - Upper East',
'UET-49' => 'Guru Natinga - Upper East',
'UET-50' => 'Kadema - Upper East',
'UET-51' => 'Kalini - Upper East',
'UET-52' => 'Kamsoria - Upper East',
'UET-53' => 'Kanania - Upper East',
'UET-54' => 'Kandiga-Atibabisi - Upper East',
'UET-55' => 'Kaniga-Kurugu - Upper East',
'UET-56' => 'Kanjarga-Jiningsa - Upper East',
'UET-57' => 'Katiu - Upper East',
'UET-58' => 'Kayoro - Upper East',
'UET-59' => 'Kologo - Upper East',
'UET-60' => 'Kologo - Upper East',
'UET-61' => 'Kongo - Upper East',
'UET-62' => 'Korania - Upper East',
'UET-63' => 'Korri Alabyeri - Upper East',
'UET-64' => 'Kpalsako - Upper East',
'UET-65' => 'Kubouko - Upper East',
'UET-66' => 'Kugri Natinga - Upper East',
'UET-67' => 'Kulungugu - Upper East',
'UET-68' => 'Kumbosigo - Upper East',
'UET-69' => 'Kunkwa - Upper East',
'UET-70' => 'Kusinaba - Upper East',
'UET-71' => 'Lungu - Upper East',
'UET-72' => 'Mirigu-Nabaanga - Upper East',
'UET-73' => 'Mogonori - Upper East',
'UET-74' => 'Moteesa-Sinyangsa - Upper East',
'UET-75' => 'Nafkoliga - Upper East',
'UET-76' => 'Naga - Upper East',
'UET-77' => 'Nakolo - Upper East',
'UET-78' => 'Namoo - Upper East',
'UET-79' => 'Nangodi - Upper East',
'UET-80' => 'Nankong-Atinia - Upper East',
'UET-81' => 'Natinga - Upper East',
'UET-82' => 'Natugnia Akumbisi - Upper East',
'UET-83' => 'Navrongo - Upper East',
'UET-84' => 'Navrongo - Upper East',
'UET-85' => 'Nayagenia - Upper East',
'UET-86' => 'Paga - Upper East',
'UET-87' => 'Pelungo - Upper East',
'UET-88' => 'Pelungu - Upper East',
'UET-89' => 'Polmakom - Upper East',
'UET-90' => 'Punyoro - Upper East',
'UET-91' => 'Pusiga - Upper East',
'UET-92' => 'Pwalugu - Upper East',
'UET-93' => 'Sabzundi - Upper East',
'UET-94' => 'sakom - Upper East',
'UET-95' => 'Sambrun - Upper East',
'UET-96' => 'Sandema-Fiisa - Upper East',
'UET-97' => 'Sandema-Kandema-Kawansa - Upper East',
'UET-98' => 'Sandema-Nyansa - Upper East',
'UET-99' => 'Sapelliga Natinga - Upper East',
'UET-100' => 'Seo-Asabagabisi (Wabisi) - Upper East',
'UET-101' => 'Sheaga - Upper East',
'UET-102' => 'Sherigu Dorungu-Agobgabis - Upper East',
'UET-103' => 'Shiega - Upper East',
'UET-104' => 'Shiega Gbane - Upper East',
'UET-105' => 'Sinebaga - Upper East',
'UET-106' => 'Siniensi-Kaasa - Upper East',
'UET-107' => 'Sinyangsa-Badomsa I - Upper East',
'UET-108' => 'Sirigu-Guwonko - Upper East',
'UET-109' => 'Soe Soboko - Upper East',
'UET-110' => 'Tarongo - Upper East',
'UET-111' => 'Tili Natinga - Upper East',
'UET-112' => 'Tindonsobulugu - Upper East',
'UET-113' => 'Tonde - Upper East',
'UET-114' => 'Tongo - Upper East',
'UET-115' => 'Tongo Beo - Upper East',
'UET-116' => 'Tongo Wakii - Upper East',
'UET-117' => 'Tuo-Tan Gabisi - Upper East',
'UET-118' => 'Upper Gaane - Upper East',
'UWT-1' => 'Babile - Upper West',
'UWT-2' => 'Bangwam - Upper West',
'UWT-3' => 'Banko - Upper West',
'UWT-4' => 'Banu-Bassisan - Upper West',
'UWT-5' => 'Basie - Upper West',
'UWT-6' => 'Basirisan - Upper West',
'UWT-7' => 'Bawiesibai - Upper West',
'UWT-8' => 'Bielikpang - Upper West',
'UWT-9' => 'Bilaw - Upper West',
'UWT-10' => 'Billaw - Upper West',
'UWT-11' => 'Boli - Upper West',
'UWT-12' => 'Boo - Upper West',
'UWT-13' => 'Booti - Upper West',
'UWT-14' => 'Boro - Upper West',
'UWT-15' => 'Brutu - Upper West',
'UWT-16' => 'Bu - Upper West',
'UWT-17' => 'Bugbelle - Upper West',
'UWT-18' => 'Bugu - Upper West',
'UWT-19' => 'Bulenga - Upper West',
'UWT-20' => 'Busa - Upper West',
'UWT-21' => 'Bussie - Upper West',
'UWT-22' => 'Chaggu (Chako) - Upper West',
'UWT-23' => 'Chapuri - Upper West',
'UWT-24' => 'Charia - Upper West',
'UWT-25' => 'Chepuri - Upper West',
'UWT-26' => 'Chereponi - Upper West',
'UWT-27' => 'Daffiama - Upper West',
'UWT-28' => 'Danko - Upper West',
'UWT-29' => 'Dimajan - Upper West',
'UWT-30' => 'Doriman - Upper West',
'UWT-31' => 'Doweni - Upper West',
'UWT-32' => 'Ducie - Upper West',
'UWT-33' => 'Duong - Upper West',
'UWT-34' => 'Duu - Upper West',
'UWT-35' => 'Eremon Yagra Ku-Ongzigre - Upper West',
'UWT-36' => 'Eremon-Kuo-Ang (Naburanye) - Upper West',
'UWT-37' => 'Eremon-Zinpen - Upper West',
'UWT-38' => 'Fian - Upper West',
'UWT-39' => 'Fielmon - Upper West',
'UWT-40' => 'Fumsi - Upper West',
'UWT-41' => 'Ga - Upper West',
'UWT-42' => 'Gbal - Upper West',
'UWT-43' => 'Gbantala - Upper West',
'UWT-44' => 'Gbari - Upper West',
'UWT-45' => 'Goli - Upper West',
'UWT-46' => 'Goripie - Upper West',
'UWT-47' => 'Guri - Upper West',
'UWT-48' => 'Gwallu - Upper West',
'UWT-49' => 'Gwo - Upper West',
'UWT-50' => 'Gwosi - Upper West',
'UWT-51' => 'Hamile - Upper West',
'UWT-52' => 'Hamoro - Upper West',
'UWT-53' => 'Han - Upper West',
'UWT-54' => 'Hian - Upper West',
'UWT-55' => 'Issa - Upper West',
'UWT-56' => 'Jang - Upper West',
'UWT-57' => 'Jawia - Upper West',
'UWT-58' => 'Jeffisi - Upper West',
'UWT-59' => 'Jeyiri - Upper West',
'UWT-60' => 'Jinpasi - Upper West',
'UWT-61' => 'Jirapa - Upper West',
'UWT-62' => 'Jumo - Upper West',
'UWT-63' => 'Kaleo - Upper West',
'UWT-64' => 'Karni - Upper West',
'UWT-65' => 'Kentuo - Upper West',
'UWT-66' => 'Kogle - Upper West',
'UWT-67' => 'Kogri - Upper West',
'UWT-68' => 'Kojoperi - Upper West',
'UWT-69' => 'Kolipong (Namo) - Upper West',
'UWT-70' => 'Kolpong - Upper West',
'UWT-71' => 'Kong - Upper West',
'UWT-72' => 'Kotua - Upper West',
'UWT-73' => 'Kpari - Upper West',
'UWT-74' => 'Kperisi - Upper West',
'UWT-75' => 'Kpongu - Upper West',
'UWT-76' => 'Kujopere - Upper West',
'UWT-77' => 'Kulfuo Tarsaw - Upper West',
'UWT-78' => 'Kulun - Upper West',
'UWT-79' => 'Kunchoge - Upper West',
'UWT-80' => 'Kundungu - Upper West',
'UWT-81' => 'Kunkogu - Upper West',
'UWT-82' => 'Kunyukuo - Upper West',
'UWT-83' => 'Kunzokala - Upper West',
'UWT-84' => 'Kupulima - Upper West',
'UWT-85' => 'Kuunkyeni - Upper West',
'UWT-86' => 'Lambussie - Upper West',
'UWT-87' => 'Lawra - Upper West',
'UWT-88' => 'Lilikse - Upper West',
'UWT-89' => 'Lissa - Upper West',
'UWT-90' => 'Loggo - Upper West',
'UWT-91' => 'Lzir - Upper West',
'UWT-92' => 'Mengwe - Upper West',
'UWT-93' => 'Mengwe Goripie - Upper West',
'UWT-94' => 'Metiaw - Upper West',
'UWT-95' => 'Motigu - Upper West',
'UWT-96' => 'Munyopele - Upper West',
'UWT-97' => 'Naapaal - Upper West',
'UWT-98' => 'Nabolo - Upper West',
'UWT-99' => 'Nabugangn - Upper West',
'UWT-100' => 'Nadowli - Upper West',
'UWT-101' => 'Nagruma - Upper West',
'UWT-102' => 'Nandom - Upper West',
'UWT-103' => 'Nankpawie - Upper West',
'UWT-104' => 'Nanvilli - Upper West',
'UWT-105' => 'Naro Norung - Upper West',
'UWT-106' => 'Nator - Upper West',
'UWT-107' => 'Nechau (Wechia) - Upper West',
'UWT-108' => 'Nimbare - Upper West',
'UWT-109' => 'Nyimeti - Upper West',
'UWT-110' => 'Nyivil - Upper West',
'UWT-111' => 'Nyoli (Yipehiboa) - Upper West',
'UWT-112' => 'Owlo - Upper West',
'UWT-113' => 'Panyani - Upper West',
'UWT-114' => 'Perisi - Upper West',
'UWT-115' => 'Piina - Upper West',
'UWT-116' => 'Pisie - Upper West',
'UWT-117' => 'Puffien Baagangn - Upper West',
'UWT-118' => 'Sabuli - Upper West',
'UWT-119' => 'Sakala - Upper West',
'UWT-120' => 'Samambow - Upper West',
'UWT-121' => 'Sambo - Upper West',
'UWT-122' => 'Samoa - Upper West',
'UWT-123' => 'Sangbaka - Upper West',
'UWT-124' => 'Sankana - Upper West',
'UWT-125' => 'Santijan - Upper West',
'UWT-126' => 'Saripere - Upper West',
'UWT-127' => 'Saskai - Upper West',
'UWT-128' => 'Seri Kperee - Upper West',
'UWT-129' => 'Silibele - Upper West',
'UWT-130' => 'Siybele - Upper West',
'UWT-131' => 'Sombisi - Upper West',
'UWT-132' => 'Sombo - Upper West',
'UWT-133' => 'Sorbele - Upper West',
'UWT-134' => 'Suggo (Suke) - Upper West',
'UWT-135' => 'Tabeasi - Upper West',
'UWT-136' => 'Taffiasi - Upper West',
'UWT-137' => 'Tahgasia - Upper West',
'UWT-138' => 'Takpo - Upper West',
'UWT-139' => 'Tampala - Upper West',
'UWT-140' => 'Tanina - Upper West',
'UWT-141' => 'Tantuo - Upper West',
'UWT-142' => 'Tapomo - Upper West',
'UWT-143' => 'Tiiwi - Upper West',
'UWT-144' => 'Tizza - Upper West',
'UWT-145' => 'Tome Kokoduor - Upper West',
'UWT-146' => 'Torsa - Upper West',
'UWT-147' => 'Tugu - Upper West',
'UWT-148' => 'Tumu - Upper West',
'UWT-149' => 'Tutio - Upper West',
'UWT-150' => 'Ullo (Vlo) - Upper West',
'UWT-151' => 'Wa - Upper West',
'VTA-1' => 'Anloga - Volta',
'VTA-2' => 'Ho - Volta',
'VTA-3' => 'Hohoe - Volta',
'VTA-4' => 'Keta - Volta',
'VTA-5' => 'Kete-Krachi - Volta',
'VTA-6' => 'Kpandu - Volta',
'VTA-7' => 'Abdulaikrom - Volta',
'VTA-8' => 'Abehenease - Volta',
'VTA-9' => 'Ablornu - Volta',
'VTA-10' => 'Abor - Volta',
'VTA-11' => 'Abuadi - Volta',
'VTA-12' => 'Abunyanya - Volta',
'VTA-13' => 'Abutia-Kloe - Volta',
'VTA-14' => 'Abutia-Teti - Volta',
'VTA-15' => 'Adafienu - Volta',
'VTA-16' => 'Adaklu - Volta',
'VTA-17' => 'Adakulo Kpetoe - Volta',
'VTA-18' => 'Addo Nkwanta - Volta',
'VTA-19' => 'Adidakpavui - Volta',
'VTA-20' => 'Adidome - Volta',
'VTA-21' => 'Adina - Volta',
'VTA-22' => 'Adumadum - Volta',
'VTA-23' => 'Adutor - Volta',
'VTA-24' => 'Adzakoe - Volta',
'VTA-25' => 'Afegame - Volta',
'VTA-26' => 'Afife - Volta',
'VTA-27' => 'Aflao - Volta',
'VTA-28' => 'Agate - Volta',
'VTA-29' => 'Agavedz - Volta',
'VTA-30' => 'Agbagorme - Volta',
'VTA-31' => 'AgbagormeAgbogbla - Volta',
'VTA-32' => 'Agbakope - Volta',
'VTA-33' => 'Agbedrafor - Volta',
'VTA-34' => 'Agbeve - Volta',
'VTA-35' => 'Agblekpui - Volta',
'VTA-36' => 'Agbozume - Volta',
'VTA-37' => 'Agohoe - Volta',
'VTA-38' => 'Agome - Volta',
'VTA-39' => 'Agorkpo - Volta',
'VTA-40' => 'Agormor-Agado - Volta',
'VTA-41' => 'Agyana - Volta',
'VTA-42' => 'Ahamansu - Volta',
'VTA-43' => 'Ahamasu - Volta',
'VTA-44' => 'Ahenkro - Volta',
'VTA-45' => 'Ahunda - Volta',
'VTA-46' => 'Ahunta - Volta',
'VTA-47' => 'Akaniem - Volta',
'VTA-48' => 'Akanu - Volta',
'VTA-49' => 'Akatsi - Volta',
'VTA-50' => 'Akpafu Mempeasem - Volta',
'VTA-51' => 'Akpafu Odomi - Volta',
'VTA-52' => 'Akpafu Todzi - Volta',
'VTA-53' => 'Akplorlortorkor - Volta',
'VTA-54' => 'Akum - Volta',
'VTA-55' => 'Akyemfo - Volta',
'VTA-56' => 'Alavanyo Dzogbedze - Volta',
'VTA-57' => 'Alavanyo Wudidi - Volta',
'VTA-58' => 'Amedzofe - Volta',
'VTA-59' => 'Ampeyo - Volta',
'VTA-60' => 'Ampeyoo - Volta',
'VTA-61' => 'Anfoega - Volta',
'VTA-62' => 'Anfoega Adame - Volta',
'VTA-63' => 'Anfoega Akukome - Volta',
'VTA-64' => 'Anlo Afiadenyigba - Volta',
'VTA-65' => 'Anloga - Volta',
'VTA-66' => 'Anyako - Volta',
'VTA-67' => 'Anyanui - Volta',
'VTA-68' => 'Anyirawase - Volta',
'VTA-69' => 'Apesokubi - Volta',
'VTA-70' => 'Apesokubi - Volta',
'VTA-71' => 'Asanti-Kpoeta - Volta',
'VTA-72' => 'Asato - Volta',
'VTA-73' => 'Asato Wawaso - Volta',
'VTA-74' => 'Asiekpe - Volta',
'VTA-75' => 'Asukawkaw - Volta',
'VTA-76' => 'Asutuare - Volta',
'VTA-77' => 'Ata Kofi - Volta',
'VTA-78' => 'Atiavi - Volta',
'VTA-79' => 'Atidzive - Volta',
'VTA-80' => 'Atikpui - Volta',
'VTA-81' => 'Atiteti - Volta',
'VTA-82' => 'Atorkor - Volta',
'VTA-83' => 'Atsieve - Volta',
'VTA-84' => 'Avakpedome - Volta',
'VTA-85' => 'Ave Dakpa - Volta',
'VTA-86' => 'Ave-Afiadenyigba - Volta',
'VTA-87' => 'Ave-Dakpa - Volta',
'VTA-88' => 'Ave-Dzadzepe - Volta',
'VTA-89' => 'Ave-Havi - Volta',
'VTA-90' => 'Avenorpedo - Volta',
'VTA-91' => 'Avenorpeme - Volta',
'VTA-92' => 'Aveyime - Volta',
'VTA-93' => 'Aveyime - Volta',
'VTA-94' => 'Avoeme - Volta',
'VTA-95' => 'Ayitikope - Volta',
'VTA-96' => 'Aymamae - Volta',
'VTA-97' => 'Baaglo - Volta',
'VTA-98' => 'Baika - Volta',
'VTA-99' => 'Bajamse - Volta',
'VTA-100' => 'Banda - Volta',
'VTA-101' => 'Barae - Volta',
'VTA-102' => 'Battor - Volta',
'VTA-103' => 'Batume - Volta',
'VTA-104' => 'Blekusu - Volta',
'VTA-105' => 'Boafri - Volta',
'VTA-106' => 'Bodada - Volta',
'VTA-107' => 'Bonakye - Volta',
'VTA-108' => 'Bontibor - Volta',
'VTA-109' => 'Borae No. 2 - Volta',
'VTA-110' => 'Bowiri - Volta',
'VTA-111' => 'Bowiri Amanforo - Volta',
'VTA-112' => 'Brewaniase - Volta',
'VTA-113' => 'Brewaniase - Volta',
'VTA-114' => 'Burai - Volta',
'VTA-115' => 'Cape St. Paul - Volta',
'VTA-116' => 'Chaisa - Volta',
'VTA-117' => 'Chinderi - Volta',
'VTA-118' => 'Dabala - Volta',
'VTA-119' => 'Dabala Junction - Volta',
'VTA-120' => 'Dado - Volta',
'VTA-121' => 'Dafor - Volta',
'VTA-122' => 'Damaniko - Volta',
'VTA-123' => 'Dambai - Volta',
'VTA-124' => 'Dapa - Volta',
'VTA-125' => 'Dapaah Amanta - Volta',
'VTA-126' => 'Dededo - Volta',
'VTA-127' => 'Deme - Volta',
'VTA-128' => 'Denu - Volta',
'VTA-129' => 'Devego - Volta',
'VTA-130' => 'Dodi Mempeasem - Volta',
'VTA-131' => 'Dodi Papase - Volta',
'VTA-132' => 'Dodi-Papase - Volta',
'VTA-133' => 'Dodo Pepesu - Volta',
'VTA-134' => 'Dodo Tamale - Volta',
'VTA-135' => 'Dodo-Amanfrom - Volta',
'VTA-136' => 'Dodo-fie - Volta',
'VTA-137' => 'Dorfor Adidome - Volta',
'VTA-138' => 'Dormabin - Volta',
'VTA-139' => 'Dove - Volta',
'VTA-140' => 'Drakofe - Volta',
'VTA-141' => 'Duga-Kpalime - Volta',
'VTA-142' => 'Dzalele - Volta',
'VTA-143' => 'Dzana - Volta',
'VTA-144' => 'Dzelukope - Volta',
'VTA-145' => 'Dzindziso - Volta',
'VTA-146' => 'Dzita - Volta',
'VTA-147' => 'Dzita-Agbledomi - Volta',
'VTA-148' => 'Dzodze - Volta',
'VTA-149' => 'Dzogadze - Volta',
'VTA-150' => 'Dzogbedze - Volta',
'VTA-151' => 'Dzolo-Gbogame - Volta',
'VTA-152' => 'Ehiamankyene - Volta',
'VTA-153' => 'Ehie Tedzewu - Volta',
'VTA-154' => 'Fenyi Yokoe - Volta',
'VTA-155' => 'Fesi - Volta',
'VTA-156' => 'Fiave-Dugame - Volta',
'VTA-157' => 'Gbefi-Hoeme - Volta',
'VTA-158' => 'Gbefi-Tornu - Volta',
'VTA-159' => 'Gbi Wegbe - Volta',
'VTA-160' => 'Gokoron - Volta',
'VTA-161' => 'Golokuati - Volta',
'VTA-162' => 'Goviefe Todzi - Volta',
'VTA-163' => 'Grubi - Volta',
'VTA-164' => 'Harglakarpe - Volta',
'VTA-165' => 'Hatorgodo - Volta',
'VTA-166' => 'Have - Volta',
'VTA-167' => 'Have Etoe - Volta',
'VTA-168' => 'Hedzranawo - Volta',
'VTA-169' => 'Helekpe - Volta',
'VTA-170' => 'Helevi - Volta',
'VTA-171' => 'Helu - Volta',
'VTA-172' => 'Heluivi - Volta',
'VTA-173' => 'Hevi (Xevi) - Volta',
'VTA-174' => 'Hikpo - Volta',
'VTA-175' => 'Ho - Volta',
'VTA-176' => 'Hohoe - Volta',
'VTA-177' => 'Honuta - Volta',
'VTA-178' => 'Jasikan - Volta',
'VTA-179' => 'Jombo - Volta',
'VTA-180' => 'Kabre Akura - Volta',
'VTA-181' => 'Kadjebi - Volta',
'VTA-182' => 'Katanka - Volta',
'VTA-183' => 'Kecheibi - Volta',
'VTA-184' => 'Kedzi - Volta',
'VTA-185' => 'Keri - Volta',
'VTA-186' => 'Keta - Volta',
'VTA-187' => 'Kete Krachi - Volta',
'VTA-188' => 'Klave - Volta',
'VTA-189' => 'Klefe Achatime - Volta',
'VTA-190' => 'Klikor - Volta',
'VTA-191' => 'Kluma Dorfor - Volta',
'VTA-192' => 'Kodzopi Agotime Afegame - Volta',
'VTA-193' => 'Kordiabe - Volta',
'VTA-194' => 'Koue - Volta',
'VTA-195' => 'Kpadui - Volta',
'VTA-196' => 'Kpando - Volta',
'VTA-197' => 'Kpandu Torkor - Volta',
'VTA-198' => 'Kparekpare - Volta',
'VTA-199' => 'Kpasa - Volta',
'VTA-200' => 'Kpedze - Volta',
'VTA-201' => 'Kpedzeglo - Volta',
'VTA-202' => 'Kpeme - Volta',
'VTA-203' => 'Kpetoe - Volta',
'VTA-204' => 'Kpetoe - Volta',
'VTA-205' => 'Kpetsu - Volta',
'VTA-206' => 'Kpeve - Volta',
'VTA-207' => 'Kpeve Newtown - Volta',
'VTA-208' => 'Kpoglo - Volta',
'VTA-209' => 'Kpomkpo - Volta',
'VTA-210' => 'Kukurantumi - Volta',
'VTA-211' => 'Kute - Volta',
'VTA-212' => 'Kwamekrom - Volta',
'VTA-213' => 'Kyinderi - Volta',
'VTA-214' => 'Lave - Volta',
'VTA-215' => 'Likpe Agbozome - Volta',
'VTA-216' => 'Likpe bakwa - Volta',
'VTA-217' => 'Likpe Bala - Volta',
'VTA-218' => 'Likpe Kukurantumi - Volta',
'VTA-219' => 'Logba Alapati - Volta',
'VTA-220' => 'Lolobi Kumasi - Volta',
'VTA-221' => 'Mafi Kumase - Volta',
'VTA-222' => 'Matse - Volta',
'VTA-223' => 'Menuso - Volta',
'VTA-224' => 'Mepe - Volta',
'VTA-225' => 'Nabu - Volta',
'VTA-226' => 'New Agou - Volta',
'VTA-227' => 'New Ayoma - Volta',
'VTA-228' => 'New Fodzoku - Volta',
'VTA-229' => 'Nkonya Ahenkro - Volta',
'VTA-230' => 'Nkonya Ahunjo - Volta',
'VTA-231' => 'Nkonya Akloba - Volta',
'VTA-232' => 'Nkonya Asakyiri - Volta',
'VTA-233' => 'Nkonya Bunbula - Volta',
'VTA-234' => 'Nkonya Kejebi - Volta',
'VTA-235' => 'Nkonya Ntumda - Volta',
'VTA-236' => 'Nkonya Tayi - Volta',
'VTA-237' => 'Nkonya Tepo - Volta',
'VTA-238' => 'Nkonya Wurupong - Volta',
'VTA-239' => 'Nkwanta - Volta',
'VTA-240' => 'Nogokpo - Volta',
'VTA-241' => 'Nsuogya (Asodja) - Volta',
'VTA-242' => 'Nyambong - Volta',
'VTA-243' => 'Nyive - Volta',
'VTA-244' => 'Odami - Volta',
'VTA-245' => 'Odumase Adele - Volta',
'VTA-246' => 'Odumasi - Volta',
'VTA-247' => 'Ofosu - Volta',
'VTA-248' => 'Ohiamankyene - Volta',
'VTA-249' => 'Okadjakrom - Volta',
'VTA-250' => 'Old Biaka - Volta',
'VTA-251' => 'Osramani - Volta',
'VTA-252' => 'Pai Katanga - Volta',
'VTA-253' => 'Paikatanga - Volta',
'VTA-254' => 'Pampawie - Volta',
'VTA-255' => 'Papase - Volta',
'VTA-256' => 'Pawa - Volta',
'VTA-257' => 'Peki - Volta',
'VTA-258' => 'Peki Adzokoe - Volta',
'VTA-259' => 'Peki Avetile - Volta',
'VTA-260' => 'Peki Blengo Kpodzi - Volta',
'VTA-261' => 'Peki Dzake - Volta',
'VTA-262' => 'Peki Dzake Dzemeni - Volta',
'VTA-263' => 'Peki Sanga - Volta',
'VTA-264' => 'Peki Tsame - Volta',
'VTA-265' => 'Peki Wudome - Volta',
'VTA-266' => 'Penyi - Volta',
'VTA-267' => 'Poase - Volta',
'VTA-268' => 'Podoe - Volta',
'VTA-269' => 'Posmonu - Volta',
'VTA-270' => 'Pusupu - Volta',
'VTA-271' => 'Sakode-Etae - Volta',
'VTA-272' => 'Santrokofi Benua - Volta',
'VTA-273' => 'Sasekpe - Volta',
'VTA-274' => 'Sasieme - Volta',
'VTA-275' => 'Shia - Volta',
'VTA-276' => 'Sibi Central - Volta',
'VTA-277' => 'Sibi Hill Top - Volta',
'VTA-278' => 'Sogakope - Volta',
'VTA-279' => 'Sokode Gbogame - Volta',
'VTA-280' => 'Sokpoe - Volta',
'VTA-281' => 'Sovie - Volta',
'VTA-282' => 'Srogbae - Volta',
'VTA-283' => 'Srogbe - Volta',
'VTA-284' => 'Tadzevu - Volta',
'VTA-285' => 'Takla Gbogame - Volta',
'VTA-286' => 'Tapa Abotoase - Volta',
'VTA-287' => 'Tapa Amanfrom - Volta',
'VTA-288' => 'Tapa Amanya - Volta',
'VTA-289' => 'Tefle - Volta',
'VTA-290' => 'Tegbi - Volta',
'VTA-291' => 'Tetema - Volta',
'VTA-292' => 'Tinjase - Volta',
'VTA-293' => 'Todome - Volta',
'VTA-294' => 'Toh-Kpalime - Volta',
'VTA-295' => 'Toklokpo - Volta',
'VTA-296' => 'Tokuroano - Volta',
'VTA-297' => 'Torgorme - Volta',
'VTA-298' => 'Torve - Volta',
'VTA-299' => 'Tsiame - Volta',
'VTA-300' => 'Tsibu - Volta',
'VTA-301' => 'Tsito - Volta',
'VTA-302' => 'Tsrate - Volta',
'VTA-303' => 'Tsrefe - Volta',
'VTA-304' => 'Tunu and Fuveme - Volta',
'VTA-305' => 'Tutukpene - Volta',
'VTA-306' => 'Tzemeni - Volta',
'WTN-1' => 'Aboso - Western',
'WTN-2' => 'Axim - Western',
'WTN-3' => 'Bibiani - Western',
'WTN-4' => 'Effiakuma - Western',
'WTN-5' => 'Prestea - Western',
'WTN-6' => 'Sekondi-Takoradi - Western',
'WTN-7' => 'Shama - Western',
'WTN-8' => 'Tarkwa - Western',
'WTN-9' => 'Abena Abena - Western',
'WTN-10' => 'Abiesewagyaman - Western',
'WTN-11' => 'Aboadi - Western',
'WTN-12' => 'Aboadze - Western',
'WTN-13' => 'Abochia - Western',
'WTN-14' => 'Aboduam - Western',
'WTN-15' => 'Abontiakoon - Western',
'WTN-16' => 'Aboso - Western',
'WTN-17' => 'Abosso - Western',
'WTN-18' => 'Abosso-Bompieso - Western',
'WTN-19' => 'Abuesi - Western',
'WTN-20' => 'Abura - Western',
'WTN-21' => 'Achawa - Western',
'WTN-22' => 'Achichire - Western',
'WTN-23' => 'Achimfo - Western',
'WTN-24' => 'Adabokrom - Western',
'WTN-25' => 'Adamanso - Western',
'WTN-26' => 'Adiembra - Western',
'WTN-27' => 'Adientem - Western',
'WTN-28' => 'Adjakaa-Manso - Western',
'WTN-29' => 'Adjua - Western',
'WTN-30' => 'Adjuafua - Western',
'WTN-31' => 'Adonikrom - Western',
'WTN-32' => 'Adum Banso - Western',
'WTN-33' => 'Adum Dominase - Western',
'WTN-34' => 'Adupri - Western',
'WTN-35' => 'Adwamadiem - Western',
'WTN-36' => 'Adwufia - Western',
'WTN-37' => 'Adwum - Western',
'WTN-38' => 'Afere - Western',
'WTN-39' => 'Afransie - Western',
'WTN-40' => 'Agona Fie - Western',
'WTN-41' => 'Agona Menfi - Western',
'WTN-42' => 'Agona Nkwanta - Western',
'WTN-43' => 'Agyemra - Western',
'WTN-44' => 'Ahemakurom - Western',
'WTN-45' => 'Ahenkofikrom - Western',
'WTN-46' => 'Ahibenso - Western',
'WTN-47' => 'Ahobre No. 2 - Western',
'WTN-48' => 'Ahokwaa - Western',
'WTN-49' => 'Ahwiam - Western',
'WTN-50' => 'Aiyinase - Western',
'WTN-51' => 'Akaaso - Western',
'WTN-52' => 'Akatachi - Western',
'WTN-53' => 'Akatiso - Western',
'WTN-54' => 'Akonsia - Western',
'WTN-55' => 'Akontombra - Western',
'WTN-56' => 'Akpandue - Western',
'WTN-57' => 'Akuntuase - Western',
'WTN-58' => 'Akwidaa - Western',
'WTN-59' => 'Akwidaa Newtown - Western',
'WTN-60' => 'Akyemfo - Western',
'WTN-61' => 'Akyempim - Western',
'WTN-62' => 'Akyerekyere - Western',
'WTN-63' => 'Alenda - Western',
'WTN-64' => 'Allowule - Western',
'WTN-65' => 'Amafie - Western',
'WTN-66' => 'Amantin - Western',
'WTN-67' => 'Amonie - Western',
'WTN-68' => 'Amoya - Western',
'WTN-69' => 'Amuni - Western',
'WTN-70' => 'Anaji - Western',
'WTN-71' => 'Anaji Estate - Western',
'WTN-72' => 'Anakum - Western',
'WTN-73' => 'Angu - Western',
'WTN-74' => 'Anibil - Western',
'WTN-75' => 'Ankasie - Western',
'WTN-76' => 'Ankra-Muano - Western',
'WTN-77' => 'Ankwaso - Western',
'WTN-78' => 'Anoe - Western',
'WTN-79' => 'Antabia - Western',
'WTN-80' => 'Anto - Western',
'WTN-81' => 'Anwiam - Western',
'WTN-82' => 'Anwona Beach Kansaworado - Western',
'WTN-83' => 'Anyinabrim - Western',
'WTN-84' => 'Apataim - Western',
'WTN-85' => 'Apemenyim - Western',
'WTN-86' => 'Apowa - Western',
'WTN-87' => 'Apremdo - Western',
'WTN-88' => 'Asafo - Western',
'WTN-89' => 'Asankran-Bremang - Western',
'WTN-90' => 'Asankran-Saa - Western',
'WTN-91' => 'Asanta - Western',
'WTN-92' => 'Asantekrom - Western',
'WTN-93' => 'Asasetere - Western',
'WTN-94' => 'Asawinso Anhwaso - Western',
'WTN-95' => 'Asemasa - Western',
'WTN-96' => 'Asemkrom - Western',
'WTN-97' => 'Aserewadi - Western',
'WTN-98' => 'Asikuma - Western',
'WTN-99' => 'Assakae - Western',
'WTN-100' => 'Assorko Essaman - Western',
'WTN-101' => 'Asuentaa - Western',
'WTN-102' => 'Asundua - Western',
'WTN-103' => 'Ataase - Western',
'WTN-104' => 'Atesa - Western',
'WTN-105' => 'Atieku - Western',
'WTN-106' => 'Atronsu - Western',
'WTN-107' => 'Atuabo - Western',
'WTN-108' => 'Atuabo - Western',
'WTN-109' => 'Atwereboanda - Western',
'WTN-110' => 'Awaso - Western',
'WTN-111' => 'Awebo - Western',
'WTN-112' => 'Awonakrom - Western',
'WTN-113' => 'Axim - Western',
'WTN-114' => 'Ayanfure - Western',
'WTN-115' => 'Ayiem - Western',
'WTN-116' => 'Azuleloanu - Western',
'WTN-117' => 'Bakanta - Western',
'WTN-118' => 'Bamiankor - Western',
'WTN-119' => 'Bandae - Western',
'WTN-120' => 'Banso - Western',
'WTN-121' => 'Basake - Western',
'WTN-122' => 'Bau - Western',
'WTN-123' => 'Bawakrom - Western',
'WTN-124' => 'Bawdie - Western',
'WTN-125' => 'Beahu - Western',
'WTN-126' => 'Beku - Western',
'WTN-127' => 'Benchema - Western',
'WTN-128' => 'Benehema - Western',
'WTN-129' => 'Benso - Western',
'WTN-130' => 'Beposo - Western',
'WTN-131' => 'Beyin - Western',
'WTN-132' => 'Bibiani - Western',
'WTN-133' => 'Bodi - Western',
'WTN-134' => 'Bogoso - Western',
'WTN-135' => 'Boinso - Western',
'WTN-136' => 'Boizan - Western',
'WTN-137' => 'Bondai - Western',
'WTN-138' => 'Bonsu Nkwanta - Western',
'WTN-139' => 'Bonuama - Western',
'WTN-140' => 'Bonyere - Western',
'WTN-141' => 'Bopa - Western',
'WTN-142' => 'Bosomoiso - Western',
'WTN-143' => 'Botodwina - Western',
'WTN-144' => 'Bronyikrom - Western',
'WTN-145' => 'Buaka - Western',
'WTN-146' => 'Busua - Western',
'WTN-147' => 'Butumagyebu Effia Nkwanta - Western',
'WTN-148' => 'Cape Three Points - Western',
'WTN-149' => 'Chirano - Western',
'WTN-150' => 'Daboase - Western',
'WTN-151' => 'Daboase Nkwanta (old) - Western',
'WTN-152' => 'Dadieso - Western',
'WTN-153' => 'Dadwen - Western',
'WTN-154' => 'Damang - Western',
'WTN-155' => 'Datano - Western',
'WTN-156' => 'Dawurampong - Western',
'WTN-157' => 'Deabenekrom - Western',
'WTN-158' => 'Diasempa - Western',
'WTN-159' => 'Dixcove - Western',
'WTN-160' => 'Dominase - Western',
'WTN-161' => 'Dominibo - Western',
'WTN-162' => 'Dompim Bawdie - Western',
'WTN-163' => 'Dompim-Pepesa - Western',
'WTN-164' => 'East Tanokrom - Western',
'WTN-165' => 'Edu - Western',
'WTN-166' => 'Edumase - Western',
'WTN-167' => 'Effia - Western',
'WTN-168' => 'Effia-Kuma - Western',
'WTN-169' => 'Egyam - Western',
'WTN-170' => 'Egyambra - Western',
'WTN-171' => 'Eikwe - Western',
'WTN-172' => 'Eikwe - Western',
'WTN-173' => 'Ekpu - Western',
'WTN-174' => 'Ekuropong - Western',
'WTN-175' => 'Ellenda - Western',
'WTN-176' => 'Elloyin - Western',
'WTN-177' => 'Elluokrom - Western',
'WTN-178' => 'Elubo - Western',
'WTN-179' => 'Enchi - Western',
'WTN-180' => 'Eshiem - Western',
'WTN-181' => 'Esiama - Western',
'WTN-182' => 'Essaman - Western',
'WTN-183' => 'Essamang - Western',
'WTN-184' => 'Essem - Western',
'WTN-185' => 'Essikando - Western',
'WTN-186' => 'Essipon - Western',
'WTN-187' => 'Esuakrom - Western',
'WTN-188' => 'Ewusiejo - Western',
'WTN-189' => 'Ezinlibo - Western',
'WTN-190' => 'Fawomanye - Western',
'WTN-191' => 'Fijai - Western',
'WTN-192' => 'Funko - Western',
'WTN-193' => 'Gwira Banso - Western',
'WTN-194' => 'Gyapa - Western',
'WTN-195' => 'Gyedua - Western',
'WTN-196' => 'Gyema - Western',
'WTN-197' => 'Half Assini - Western',
'WTN-198' => 'Hiawa - Western',
'WTN-199' => 'Hotopo - Western',
'WTN-200' => 'Humjibre - Western',
'WTN-201' => 'Huni Valley - Western',
'WTN-202' => 'Hwenampori - Western',
'WTN-203' => 'Inchaban - Western',
'WTN-204' => 'Jaba - Western',
'WTN-205' => 'Jema - Western',
'WTN-206' => 'Jewi Wharf - Western',
'WTN-207' => 'Jomo - Western',
'WTN-208' => 'Juabeso - Western',
'WTN-209' => 'Juabo - Western',
'WTN-210' => 'Jukwa - Western',
'WTN-211' => 'Kaase - Western',
'WTN-212' => 'Kakum - Western',
'WTN-213' => 'Kamgbunli - Western',
'WTN-214' => 'Kanga - Western',
'WTN-215' => 'Karlo - Western',
'WTN-216' => 'Kawanopaado - Western',
'WTN-217' => 'Kejabill - Western',
'WTN-218' => 'Kemase - Western',
'WTN-219' => 'Kengen - Western',
'WTN-220' => 'Ketan - Western',
'WTN-221' => 'Kikam - Western',
'WTN-222' => 'Kikam - Western',
'WTN-223' => 'Kofi Ackaakrom - Western',
'WTN-224' => 'Kojokrom - Western',
'WTN-225' => 'Kojokrom-Bronyikrom - Western',
'WTN-226' => 'Kokokrom - Western',
'WTN-227' => 'Komfueko - Western',
'WTN-228' => 'Kookoase - Western',
'WTN-229' => 'Krokosue - Western',
'WTN-230' => 'Kunkunso - Western',
'WTN-231' => 'Kutukrom - Western',
'WTN-232' => 'Kwabedu - Western',
'WTN-233' => 'Kwabeng - Western',
'WTN-234' => 'Kwaman - Western',
'WTN-235' => 'Kwawu - Western',
'WTN-236' => 'Kweikuma - Western',
'WTN-237' => 'Kwesimintsi - Western',
'WTN-238' => 'Kwesimintsim - Western',
'WTN-239' => 'Lineso - Western',
'WTN-240' => 'Mafia - Western',
'WTN-241' => 'Manso - Western',
'WTN-242' => 'Manso Amenfi - Western',
'WTN-243' => 'Mawuabammu - Western',
'WTN-244' => 'Mempeasem - Western',
'WTN-245' => 'Menzenzor-Kakebenzele - Western',
'WTN-246' => 'Mollagye - Western',
'WTN-247' => 'Moseaso - Western',
'WTN-248' => 'Mpataba - Western',
'WTN-249' => 'Mpatado - Western',
'WTN-250' => 'Mpentemnserew - Western',
'WTN-251' => 'Mpintsin - Western',
'WTN-252' => 'Mpohor - Western',
'WTN-253' => 'Nananko - Western',
'WTN-254' => 'Nawuley - Western',
'WTN-255' => 'New Amanful - Western',
'WTN-256' => 'New Debiso - Western',
'WTN-257' => 'New Subri - Western',
'WTN-258' => 'New Takoradi - Western',
'WTN-259' => 'New Yakase - Western',
'WTN-260' => 'Ngyiresia - Western',
'WTN-261' => 'Nigeria No. 2 (KW. NARTEY) - Western',
'WTN-262' => 'Nkatieso - Western',
'WTN-263' => 'Nkotompo - Western',
'WTN-264' => 'Nkroful - Western',
'WTN-265' => 'Nkronua Atifi - Western',
'WTN-266' => 'Nkwanta - Western',
'WTN-267' => 'Nkwantakese Nkwanta - Western',
'WTN-268' => 'Nkwanta-Shama - Western',
'WTN-269' => 'Nsawora - Western',
'WTN-270' => 'Nsein - Western',
'WTN-271' => 'Nsinsin - Western',
'WTN-272' => 'Nsuaem - Western',
'WTN-273' => 'Nsuaem No. 2 - Western',
'WTN-274' => 'Nsuta - Western',
'WTN-275' => 'Ntankoful - Western',
'WTN-276' => 'Ntwaaban - Western',
'WTN-277' => 'Nuba - Western',
'WTN-278' => 'Nvellenu-Bawia - Western',
'WTN-279' => 'Nyame Bekyere - Western',
'WTN-280' => 'Nyankrom - Western',
'WTN-281' => 'Nyirisia - Western',
'WTN-282' => 'Odumasi - Western',
'WTN-283' => 'Ohyiayeanisa - Western',
'WTN-284' => 'Old Debiso - Western',
'WTN-285' => 'Old Edabo - Western',
'WTN-286' => 'Old Yakase - Western',
'WTN-287' => 'Omape - Western',
'WTN-288' => 'Opintobeng - Western',
'WTN-289' => 'Opon Valley - Western',
'WTN-290' => 'Osei Kojo Krom - Western',
'WTN-291' => 'Osofokrom - Western',
'WTN-292' => 'Prestea - Western',
'WTN-293' => 'Prestea-Nkwanta - Western',
'WTN-294' => 'Princess Town - Western',
'WTN-295' => 'Pumpuni - Western',
'WTN-296' => 'Punikrom - Western',
'WTN-297' => 'Saamang - Western',
'WTN-298' => 'Samenye - Western',
'WTN-299' => 'SamreBoi - Western',
'WTN-300' => 'Sanzule - Western',
'WTN-301' => 'Sayerano - Western',
'WTN-302' => 'Sefwi Anhwiaso - Western',
'WTN-303' => 'Sefwi Bekwai - Western',
'WTN-304' => 'Sefwi Buako - Western',
'WTN-305' => 'Sefwi Dwinase - Western',
'WTN-306' => 'Sefwi-Wiawso - Western',
'WTN-307' => 'Sekondi - Western',
'WTN-308' => 'Sekyere Krobo - Western',
'WTN-309' => 'Sekyere-Heman - Western',
'WTN-310' => 'Sese - Western',
'WTN-311' => 'Sewum - Western',
'WTN-312' => 'Shama - Western',
'WTN-313' => 'Simpa-Pepesa - Western',
'WTN-314' => 'Subri - Western',
'WTN-315' => 'Subri Nkwanta/kojina - Western',
'WTN-316' => 'Sui - Western',
'WTN-317' => 'Supomu Dunkwa - Western',
'WTN-318' => 'Surano - Western',
'WTN-319' => 'Takinta - Western',
'WTN-320' => 'Takoradi - Western',
'WTN-321' => 'Tamso - Western',
'WTN-322' => 'Tandan - Western',
'WTN-323' => 'Tanokrom - Western',
'WTN-324' => 'Tanoso - Western',
'WTN-325' => 'Tarkwa Atoabo - Western',
'WTN-326' => 'Teleku Bokazo - Western',
'WTN-327' => 'Tikobo No. 1 - Western',
'WTN-328' => 'Tikobo No. 2 - Western',
'WTN-329' => 'Twenene - Western'

);
//echo '<pre>'; print_r($states['GH']); echo '</pre>';

return $states;
},100);


add_shortcode('vendor_categories',function(){
	$categories = array(17641,17574,17573,17572); 
	
	$url = dokan_get_store_url(get_query_var( 'author' ));
	$html = '<h3 class="widget-title">Categories</h3>';
	$html .= '<ul style="margin-bottom:0px;">';
	foreach($categories as $category){
		$html .= '<li><a href="'.$url.''.$category.'">'.get_term($category,"product_cat")->name.'</a></li>';
	}
	$html .= '</ul>';
	
	return $html;

});







function tm_additional_profile_fields( $user ) { 
	$value = get_user_meta($user->id,'dropshipping',true); 
?>
   
	<h3>Additional Settings</h3>

    <table class="form-table">
   	 <tr>
   		 <th><label for="birth-date-day">DropShipping?</label></th>
   		 <td>
			 <select name="dropshipping">
				 <option <?php echo $value == 'disable' ? 'selected' : '';?> value="disable">Disable</option>
				 <option <?php echo $value == 'enable' ? 'selected' : '';?> value="enable">Enable</option>
			 </select>
		 </td>
   	 </tr>
    </table>
    <?php
}

add_action( 'show_user_profile', 'tm_additional_profile_fields' );
add_action( 'edit_user_profile', 'tm_additional_profile_fields' );


/**
 * Save additional profile fields.
 *
 * @param  int $user_id Current user ID.
 */
function tm_save_profile_fields( $user_id ) {

    if ( ! current_user_can( 'edit_user', $user_id ) ) {
   	 return false;
    }

    if ( empty( $_POST['dropshipping'] ) ) {
   	 return false;
    }

    update_usermeta( $user_id, 'dropshipping', $_POST['dropshipping'] );
}

add_action( 'personal_options_update', 'tm_save_profile_fields' );
add_action( 'edit_user_profile_update', 'tm_save_profile_fields' );




// add_action('init',function(){
// 	if(!is_admin()){
// 		$query = new WP_Query(array('post_type'=>'product','meta_key'=>'_gift_card','meta_value'=>'yes','meta_compare'=>'=','posts_per_page'=> -1));
// 		//echo '<pre>'; print_r($query->posts); echo '</pre>';
// while($query->have_posts()):$query->the_post(); echo '<pre>'; print_r(get_the_permalink()); echo '</pre>'; endwhile;
// 	}

// });


// Adjusting Products Tabs
add_filter( 'woocommerce_product_tabs', function( $tabs ) {
    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['shipping'] ); 			// Remove the reviews tab
    return $tabs;
},100);

add_action('woocommerce_after_single_product_summary',function(){
	global $product;
	echo'<div class="after-summary">';
	if(!empty(get_the_content($product->id))){
		echo '<h3>Description</h3>';
		woocommerce_product_description_tab();
	}
	ob_start();
	$new = new WeDevs\DokanPro\Shipping\Hooks();
	$new->shipping_tab();
	$shipping_content = ob_get_clean();
	
	if(!empty($shipping_content)){
		echo '<h3>Shipping</h3>';
		echo $shipping_content;
	}
	echo '</div>';
},9);

// add_action('plugin_loaded',function(){
// 	vc_disable_frontend(false);
	
// },1000);


add_action('init',function(){
	if(!is_admin()){
		//echo '<pre>'; print_r(get_user_meta(get_current_user_id())); echo '</pre>';
	}

});


add_action('dps_subscription_product_fields',function(){
	$modules = new WeDevs\DokanPro\Module();
	if($modules->is_active('booking')){
		woocommerce_wp_text_input(
			array(
				'id'                => '_no_of_booking_product',
				'label'             => __( 'Bookable Products', 'dokan' ),
				'placeholder'       => __( 'Put -1 for unlimited products', 'dokan' ),
				'description'       => __( 'Enter the no of product you want to give this package.', 'dokan' ),
				'type'              => 'number',
				'custom_attributes' => array(
					'step' => 'any',
					'min'  => '-1',
				),
			)
		);
	}

	if($modules->is_active('auction')){
		woocommerce_wp_text_input(
			array(
				'id'                => '_no_of_auction_product',
				'label'             => __( 'Auction Products', 'dokan' ),
				'placeholder'       => __( 'Put -1 for unlimited products', 'dokan' ),
				'description'       => __( 'Enter the no of auction product you want to give this package.', 'dokan' ),
				'type'              => 'number',
				'custom_attributes' => array(
					'step' => 'any',
					'min'  => '-1',
				),
			)
		);
	}	
    woocommerce_wp_text_input(
        array(
            'id'                => '_no_of_grocery_product',
            'label'             => __( 'Grocery Products', 'dokan' ),
            'placeholder'       => __( 'Put -1 for unlimited products', 'dokan' ),
            'description'       => __( 'Enter the no of grocery product you want to give this package.', 'dokan' ),
            'type'              => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min'  => '-1',
            ),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'                => '_no_of_service_product',
            'label'             => __( 'Service Products', 'dokan' ),
            'placeholder'       => __( 'Put -1 for unlimited products', 'dokan' ),
            'description'       => __( 'Enter the no of service product you want to give this package.', 'dokan' ),
            'type'              => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min'  => '-1',
            ),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id'                => '_no_of_supermarket_product',
            'label'             => __( 'Supermarket Products', 'dokan' ),
            'placeholder'       => __( 'Put -1 for unlimited products', 'dokan' ),
            'description'       => __( 'Enter the no of supermarket product you want to give this package.', 'dokan' ),
            'type'              => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min'  => '-1',
            ),
        )
    );
});


add_action('dps_process_subcription_product_meta',function($product_id){
	$woocommerce_no_of_auction_product_field = $_POST['_no_of_auction_product'];
	if ( ! empty( $woocommerce_no_of_auction_product_field ) ) {
		update_post_meta( $product_id, '_no_of_auction_product', $woocommerce_no_of_auction_product_field );
	}
	
	$woocommerce_no_of_booking_product_field = $_POST['_no_of_booking_product'];
	if ( ! empty( $woocommerce_no_of_booking_product_field ) ) {
		update_post_meta( $product_id, '_no_of_booking_product', $woocommerce_no_of_booking_product_field );
	}

	$woocommerce_no_of_grocery_product_field = $_POST['_no_of_grocery_product'];
	if ( ! empty( $woocommerce_no_of_grocery_product_field ) ) {
		update_post_meta( $product_id, '_no_of_grocery_product', $woocommerce_no_of_grocery_product_field );
	}

	$woocommerce_no_of_service_product_field = $_POST['_no_of_service_product'];
	if ( ! empty( $woocommerce_no_of_service_product_field ) ) {
		update_post_meta( $product_id, '_no_of_service_product', $woocommerce_no_of_service_product_field );
	}

	$woocommerce_no_of_supermarket_product_field = $_POST['_no_of_supermarket_product'];
	if ( ! empty( $woocommerce_no_of_supermarket_product_field ) ) {
		update_post_meta( $product_id, '_no_of_supermarket_product', $woocommerce_no_of_supermarket_product_field );
	}
});


add_action('dokan_vendor_purchased_subscription',function($user_id){
// update_user_meta( $user_id, 'auction_product_no_with_pack', get_post_meta( $product_pack->get_id(), '_no_of_auction_product', true ) );
// update_user_meta( $user_id, 'booking_product_no_with_pack', get_post_meta( $product_pack->get_id(), '_no_of_booking_product', true ) );
});

// add_action('dokan_process_seller_meta_fields',function($user_id){
// 	$pack_id = intval( $_POST['_dokan_user_assigned_sub_pack'] );
// 	update_user_meta( $user_id, 'auction_product_no_with_pack', get_post_meta( $pack_id, '_no_of_auction_product', true ) ); //number of products
// 	update_user_meta( $user_id, 'booking_product_no_with_pack', get_post_meta( $pack_id, '_no_of_booking_product', true ) ); //number of products
// });

add_filter('dokan_can_add_product',function($errors){
	//$errors = array();
	//echo '<pre>'; print_r($_POST); echo '</pre>'; die();
	if(isset($_POST['add_product']) || isset($_POST['update_product']) || isset($_POST['add_auction_product']) || isset($_POST['update_auction_product']) || isset($_POST['add_booking_product']) || isset($_POST['update_booking_product'])){
		$current_product = $_POST['prod_module'];
		
		if(!current_user_can_create_product($current_product,get_current_user_id())){
			$errors = array('limit_reach' => "You can't add more ".$current_product." products. Please upgrade your plan.");
		}
		
	}
	//echo'<pre>'; print_r($_POST); echo '</pre>';
	return $errors;
});

//add_action('dokan_before_listing_product',function(){
	//global $wp_filter;
	//global $wp_action;
	//echo '<pre>'; print_r($wp_filter); echo '</pre>';
	//echo '<pre>'; print_r($wp_action); echo '</pre>';
	//$new = new WeDevs\DokanPro\Modules\ProductSubscription\Module();
	//remove_action('dokan_before_listing_product',array(new Dokan_Pro()->container['product_subscription'],'show_custom_subscription_info'),10);

//},9);

// add_action('dokan_pro_get_class_container',function($container){
// 	//echo '<pre>'; print_r($container); echo '</pre>';

// 	return $container;
// });


add_filter('gettext',function($t,$d){ 
	global $wp;
	if(strpos($t,'You can add') !== false && strpos($t,'more product(s)') !== false){
// echo '<pre>'; print_r($wp->request); echo '</pre>';
		$user_id = get_current_user_id();
		$products_by_type = get_user_products_by_type($user_id);
		$pack = get_user_meta($user_id,'product_package_id',true);
		$auction_products = get_post_meta($pack,'_no_of_auction_product',true);
		$booking_products = get_post_meta($pack,'_no_of_booking_product',true);
		$service_products = get_post_meta($pack,'_no_of_service_product',true);
		$grocery_products = get_post_meta($pack,'_no_of_grocery_product',true);
		$supermarket_products = get_post_meta($pack,'_no_of_supermarket_product',true);
        $t = ''; 
		if(!empty($auction_products) && $auction_products != -1 && $wp->request == 'dashboard/auction'){
			if($products_by_type['auction'] < $auction_products){
				$t .= sprintf('You can add %s more %s products<br>',$auction_products - $products_by_type['auction'],'auction');
			}else{
				$t .= "You can't add more auction products. Update your subscription<br>";
			}
			
		}
		if(!empty($booking_products) && $booking_products != -1 && $wp->request == 'dashboard/booking'){
			if($products_by_type['booking'] < $booking_products){
				$t .= sprintf('You can add %s more %s products<br>',$booking_products - $products_by_type['booking'],'booking');
			}
			else{
				$t .= "You can't add more booking products. Update your subscription<br>";
			}
		}
		if(!empty($service_products) && $service_products != -1 && $wp->request == 'dashboard/products'){
			if($products_by_type['service'] < $service_products){
				$t .= sprintf('You can add %s more %s products<br>',$service_products - $products_by_type['service'],'freelance');
			}else{
				$t .= "You can't add more service products. Update your subscription<br>";
			}
		}
		if(!empty($grocery_products) && $grocery_products != -1 && $wp->request == 'dashboard/products'){
			if($products_by_type['grocery'] < $grocery_products){
				$t .= sprintf('You can add %s more %s products<br>',$grocery_products - $products_by_type['grocery'],'grocery');
			}else{
				$t .= "You can't add more grocery products. Update your subscription<br>";
			}
		}
		if(!empty($supermarket_products) && $supermarket_products != -1 && $wp->request == 'dashboard/products'){
			if($products_by_type['supermarket'] < $supermarket_products){
				$t .= sprintf('You can add %s more %s products<br>',$supermarket_products - $products_by_type['supermarket'],'supermarket');
			}else{
				$t .= "You can't add more supermarket products. Update your subscription<br>";
			}
		}
	}
	return $t;
},100,2);

function get_user_products_limits($user_id){
	$pack = get_user_meta($user_id,'product_package_id',true);
    $array = array();
    if($pack){
        $array = array(
            'auction'       =>   get_post_meta($pack,'_no_of_auction_product',true),
            'booking'       =>   get_post_meta($pack,'_no_of_booking_product',true),
            'service'       =>   get_post_meta($pack,'_no_of_service_product',true),
            'grocery'       =>   get_post_meta($pack,'_no_of_grocery_product',true),
            'supermarket'   =>   get_post_meta($pack,'_no_of_supermarket_product',true)
        );
    }
	//echo '<pre>'; print_r($array); echo '</pre>';
	return $array;
}
function get_user_products_by_type($user_id){
	$array = array(
		'auction' =>	count(get_posts(array('post_type'=>'product','author' => $user_id ,'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => 'auction',
						))))),
		'booking' =>	count(get_posts(array('post_type'=>'product','author' => $user_id ,'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => 'rental',
						))))),
		'service' =>	count(get_posts(array('post_type'=>'product','author' => $user_id ,'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => 'service',
						))))),
		'grocery' =>	count(get_posts(array('post_type'=>'product','author' => $user_id ,'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => 'grocery',
						))))),
		'supermarket' =>	count(get_posts(array('post_type'=>'product','author' => $user_id ,'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => 'supermarket',
						))))),
	);
	return $array;	
}

function current_user_can_create_product($type, $user_id){
	$type = strtolower($type);
	if($type == 'rental'){
		$type = 'booking';	
	}
	if($type == 'freelance'){
		$type == 'service';
	}
	
	$limits = get_user_products_limits($user_id);
	$current = get_user_products_by_type($user_id);
	if($current[$type] < $limits[$type] || $limits[$type] == -1 ){
		return true;
	}else{
		return false;
	}
	//echo $type; die();
	return false;
}


// My Account page Navigation Dropdown on Mobile.
add_action('woocommerce_before_account_navigation',function(){
	echo '<div class="my-account-navigation-wrapper"><div class="my-account-menu-toggle"><i class="fa fa-bars"></i></div>';
});
add_action('woocommerce_after_account_navigation',function(){
	echo '</div>';
});


// Supermarket = 17641
// Grocery = 17572
// Auction = 17573
// Rental = 17574
// Service = 23598
// Dokan Categories in Listing Filters
add_filter('dokan_product_cat_dropdown_args',function($args){
	global $wp;
	if($wp->request == 'dashboard/booking'){
		$args['exclude_tree'] = array(23598,17573,17572,17641,23574);
	}elseif($wp->request == 'dashboard/auction'){
		$args['exclude_tree'] = array(23598,17574,17572,17641,23574);
	}elseif($wp->request == 'dashboard/products'){
		$args['exclude_tree'] = array(17573,17574,23574);
	}

	return $args;
});


function auto_login_new_user( $user_id ) {
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
   // wp_redirect( home_url() ); // You can change home_url() to the specific URL,such as "wp_redirect( 'http://www.wpcoke.com' )";
   // exit();
}
add_action( 'user_register', 'auto_login_new_user' );

add_filter( 'woocommerce_login_redirect', function($redirect, $user){
	if(isset($_GET['redirect-url'])){
		return $_GET['redirect-url'];
	}
	return $redirect;
},1000,2);

add_action('woocommerce_login_form_start',function(){
	if(isset($_GET['redirect-url'])){
		echo '<input type="hidden" name="redirect-url" value="'.$_GET['redirect-url'].'">';
	}
});

	
add_filter( 'use_widgets_block_editor', '__return_false' );
	
add_filter( 'show_admin_bar', function($return){
	if(current_user_can('administrator')){
		return true;
	}
	return $return;

},10 );


add_action('ttp_custom_crons','ttp_database_clean_query_cron');
function ttp_database_clean_query_cron(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'options'; 
    $query = $wpdb->query($wpdb->prepare('Delete from '.$table_name.' where option_name in ("epkb_version","epkb_show_upgrade_message","epkb_config_1","asea_version","asea_show_upgrade_message")'));
}
add_action('init',function(){
 	global $wpdb;
    $table_name = $wpdb->prefix . 'options'; 
    $query = $wpdb->query($wpdb->prepare('Delete from '.$table_name.' where option_name in ("epkb_version","epkb_show_upgrade_message","epkb_config_1","asea_version","asea_show_upgrade_message")'));
});





add_action( 'woocommerce_register_form_start', 'ttp_extra_register_fields' );
add_action( 'woocommerce_register_post',  'ttp_validate_extra_register_fields', 10, 3 );
add_action( 'woocommerce_created_customer', 'ttp_save_extra_register_fields', 10 , 1  );
add_action('woocommerce_registration_redirect', 'ttp_verify_registration_redirect', 2);
add_shortcode('kas_otp_verify', 'ttp_shortcode_verification_otp');


function ttp_extra_register_fields() {?>
    <p class="form-row form-row-wide">
    <label for="billing_phone"><?php _e( 'Phone' ); ?><span class="required">*</span></label>
    <input type="text" class="input-text"  id="billing_phone_ttp" value="<?php esc_attr_e( $_POST['billing_phone'] ); ?>" />
    <input type="text" name="billing_phone" style="display:none;">
    </p>
    <div class="clear"></div>
    <?php
}	


/**
* Add new register field validation.
*
* @since    1.2.0
*/	

function ttp_validate_extra_register_fields( $username, $email, $validation_errors ) {

if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {

      $validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone is required!' ) );

}else{

    $hasPhoneNumber = new WP_User_Query(array('meta_key' => 'billing_phone','meta_value' => $_POST['billing_phone'],'meta_compare' => '=')); 
    $hasPhoneNumber = $hasPhoneNumber->get_results();
    if (!empty($hasPhoneNumber)) {
        $validation_errors->add('billing_phone_error', __(' Your phone number has already been registered!', 'woocommerce'));
    }else{
        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;
        $_SESSION['billing_phone'] = $_POST['billing_phone'];
        $message = 'Your Verification Code Is: ' . $code;
        $parse_phone = WPNotif_Handler::parseMobile($_SESSION['billing_phone']); 
        $countrycode = $parse_phone['countrycode']; 
        $phone = $parse_phone['mobile'];
        $gateway = WPNotif_Handler::gatewaytoUse($countrycode);
        

        WPNotif_SMS_handler::send_sms(array(), $gateway, $countrycode, $phone, $message, false , false);
    }
   
   // $gateway = get_option('kas-notifications-gateway');
//    $notify = new Kas_WC_Notifications_Api($this->kas_notifications, $this->version);
//    $notify->kas_send_notifications('', $gateway, $message, array($_SESSION['billing_phone']));
}
return $validation_errors;
}	


/**
* update user phone in db.
*
* @since    1.2.0
*/	
function ttp_save_extra_register_fields( $customer_id ) {
 if ( isset( $_POST['billing_phone'] ) ) {
       $_SESSION['user_id'] = $customer_id;
     // Phone input filed which is used in WooCommerce 
    
     update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
 }
}


function ttp_verify_registration_redirect(){
    return home_url( '/phone-verification' );
}


/**
	 * Add ShortCode Functions for OTP form.
	 *
	 * @since    1.0.0
	 */
function ttp_shortcode_verification_otp() { 
		
		
		if (isset($_POST['register'])) {
			if ($_POST['verification_code'] > 0 && $_POST['verification_code'] == $_SESSION['code']) {
				update_user_meta( $_SESSION['user_id'], 'verification_code', sanitize_text_field( $_POST['verification_code'] ) );
				 _e('Your phone number is verified now.<br>');
				
			}else {
				 _e('<div class="error">Code didn\'t Match try again...</div>');
			}

			
		} 
		// resend code.. 
		if (isset($_POST['resend'])) {
			
      		$code = rand(100000, 999999);
      		$_SESSION['code'] = $code;
	      	$message = 'Your Verification Code Is: ' . $_SESSION['code'];
	      	$parse_phone = WPNotif_Handler::parseMobile($_SESSION['billing_phone']); 
            $countrycode = $parse_phone['countrycode']; 
            $phone = $parse_phone['mobile'];
            $gateway = WPNotif_Handler::gatewaytoUse($countrycode);
            // echo 'resend code';
            // echo '<pre>'; print_r($_SESSION); echo  '<br>';
            // echo $phone;
            // echo '<br>' . $countrycode;
            WPNotif_SMS_handler::send_sms(array(), $gateway, $countrycode, $phone, $message, false , true);

	      	// $notify = new Kas_WC_Notifications_Api($this->kas_notifications, $this->version);
	      	// $notify->kas_send_notifications('', $gateway, $message, array($_SESSION['billing_phone']));			

		}
		$user_code = get_user_meta( get_current_user_id(), 'verification_code', true );
		
		if ($user_code != $_SESSION['code']) {
		
		
	?>
	    <form method="post" class="register" novalidate="novalidate">
	       <p class="form-row form-row-wide">
	       <label for="verification_code"><?php _e( 'Verification Code' ); ?><span class="required">*</span></label>
	       <input type="text" class="input-text" name="verification_code" id="verification_code" value="<?php esc_attr_e( $_POST['verification_code'] ); ?>" />
	       </p>
	       <input class="woocommerce-Button button" name="register" value="Register" type="submit">
	       <input class="woocommerce-Button button" name="resend" value="Resend" type="submit">
	       <div class="clear"></div>
	    </form>	
	<?php 	
		}else {
			if ( is_user_logged_in() && !isset($_POST["register"]) ) {
				_e('Your phone number is already verified!');
			} else {
				_e('Please register or login to check phone verification status!');
			}	
		}
	}


    add_action('wp_head',function(){
        ?>
        <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <style>
    .iti__country-list li{list-style: none;}.iti {
    position: relative;
    display: inline-block;
    width: 100%;
    padding-left: 55px;
}
   </style>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js">
        <?Php
    });

    add_action('wp_footer',function(){
        ?>
        
   <script> 
   if(jQuery("#billing_phone_ttp").length > 0){
    const phoneInputField = document.querySelector(".woocommerce-form-register #billing_phone_ttp");
    const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "gh",
        utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
    jQuery(".woocommerce-form-register #billing_phone_ttp").change(function(){ 
        jQuery('[name="billing_phone"]').val(phoneInput.getNumber());
    });
   }
    //Dokan New Product Page
	jQuery(".module-selector .card-selector").click(function(e){
		var value = jQuery(this).data().value;
	
		setTimeout(function(){ 
			if(value=="Service"){ 
				jQuery('.made_in').next('.select2').hide();
				jQuery('.made_in').parents('.dokan-form-group').hide();
			}
			
		},1000);
	}); 	
   </script>
        <?Php
    });

    
    // $parse_phone = WPNotif_Handler::parseMobile('+923135864937'); echo '<pre>'; print_r($parse_phone); echo '</pre>'; //die();
            // $countrycode = $parse_phone['countrycode']; 
            // $phone = $parse_phone['mobile'];
    //  $notify_handler = new WPNotif_Handler::instance();
    //echo WPNotif_Handler::gatewaytoUse('gh'); die();
    // $gateway = WPNotif_Handler::gatewaytoUse($parse_phone['countrycode']); echo $gateway;

    add_action('init',function(){
        $_COOKIE['wmc_current_currency'] = 'GHS';
    });


    function redirect_to_home() {
        if(!is_admin() && !is_front_page()  && !is_page(54) && !is_user_logged_in()) {
          wp_redirect(home_url());
          exit();
        }
      }
     // add_action('template_redirect', 'redirect_to_home');


add_shortcode('today-exchange-rate',function($attr){
    $currency_rate          = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate', array( 1 ) );
	$currency_rate_fee      = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate_fee', array( 0.0000 ) );
    $rate =  $currency_rate[1] + $currency_rate_fee[1];
    ob_start();
    echo '<div class="currency-exchange-rate-today"> <span>Today exchange rate</span> 1 GHS = ' . $rate . ' USD</div>'; 
    return ob_get_clean();
});





add_action( 'dokan_new_product_added', 'exchange_rate_save_dokan',100,2);
add_action( 'dokan_product_updated', 'exchange_rate_save_dokan',9,2);
add_action('dokan_new_auction_product_added', 'exchange_rate_save_dokan', 10, 2);
add_action('dokan_update_auction_product', 'exchange_rate_save_dokan_new', 10, 1);
function exchange_rate_save_dokan_new($product_id){ 
    $currency_rate          = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate', array( 1 ) );
	$currency_rate_fee      = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate_fee', array( 0.0000 ) );
    $current_custom_postmeta = get_post_meta($product_id, 'exchange_rate', true);
    if($current_custom_postmeta)
    {
        delete_post_meta($product_id, 'exchange_rate');
    }
    add_post_meta($product_id,'exchange_rate',$currency_rate[1],true);
}
function exchange_rate_save_dokan($product_id, $post_data){ 
    $currency_rate          = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate', array( 1 ) );
	$currency_rate_fee      = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate_fee', array( 0.0000 ) );
    $current_custom_postmeta = get_post_meta($product_id, 'exchange_rate', true);
    if($current_custom_postmeta)
    {
        delete_post_meta($product_id, 'exchange_rate');
    }
    add_post_meta($product_id,'exchange_rate',$currency_rate[1],true);
}

add_action( 'woocommerce_new_product', 'mp_sync_on_product_save', 10, 1 );
add_action( 'woocommerce_update_product', 'mp_sync_on_product_save', 10, 1 );
function mp_sync_on_product_save( $product_id ) {
    $currency_rate          = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate', array( 1 ) );
	$currency_rate_fee      = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate_fee', array( 0.0000 ) );
    $current_custom_postmeta = get_post_meta($product_id, 'exchange_rate', true);
    if($current_custom_postmeta)
    {
        delete_post_meta($product_id, 'exchange_rate');
    }
    add_post_meta($product_id,'exchange_rate',$currency_rate[1],true);
     
}



add_filter( 'woocommerce_get_price_html', 'bbloomer_alter_price_display', 9999, 2 );
 
function bbloomer_alter_price_display( $price_html, $product ) {
   
    if ( is_admin() ) return $price_html;
    if ( '' === $product->get_price() ) return $price_html;
   
        $orig_price = wc_get_price_to_display( $product );
        if($product->get_type() == 'variation'){
            $product = wc_get_product($product->get_parent_id()); 
           
        }      
        if(get_post_meta($product->get_id(),'exchange_rate',true) != ''){
            $currency_rate          = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate', array( 1 ) );
            $currency_rate_fee      = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate_fee', array( 0.0000 ) );
            $rate =  $currency_rate[1] + $currency_rate_fee[1];
            $orig_price_in_USD = $orig_price / get_post_meta($product->get_id(),'exchange_rate',true);
            $price_html = wc_price($orig_price_in_USD * $rate);   
        }
    return $price_html;
}


add_action( 'woocommerce_before_calculate_totals', function ( $cart ) {
 
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) return;
    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
        $price = $product->get_price();

        $currency_rate          = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate', array( 1 ) );
        $currency_rate_fee      = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate_fee', array( 0.0000 ) );
        $rate =  $currency_rate[1] + $currency_rate_fee[1];
        $orig_price_in_USD = $price / get_post_meta($product->get_id(),'exchange_rate',true);
        if(get_post_meta($product->get_id(),'exchange_rate',true)){
            $cart_item['data']->set_price( $orig_price_in_USD * $rate );
        }
        
    }
});


add_filter( 'woocommerce_bookings_calculated_booking_cost', function($booking_cost, $product, $data){
   
    $currency_rate          = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate', array( 1 ) );
    $currency_rate_fee      = WOOMULTI_CURRENCY_Admin_Settings::get_field( 'currency_rate_fee', array( 0.0000 ) );
    $rate =  $currency_rate[1] + $currency_rate_fee[1];
    $orig_price_in_USD = $booking_cost / get_post_meta($product->get_id(),'exchange_rate',true);
    if(get_post_meta($product->get_id(),'exchange_rate',true)){
        $booking_cost = $orig_price_in_USD * $rate;
    }
    return $booking_cost;
},100,3);


// Your additional action button

function add_my_account_my_orders_custom_action( $order ) {
	if(is_admin() || $order->status != 'processing'){
		return $actions;
	}
    
    $seller = dokan_get_seller_id_by_order( $order->id ); 
    $order_id = $order->id;
    if($seller == 0){
        return;
    }
    $store_info  = dokan_get_store_info($seller);

    if ( isset( $store_info['show_support_btn'] ) && 'no' === $store_info['show_support_btn'] ) {
        return;
    } 
    if(get_post_meta($order_id,'order_cancel_requested',true) == true){
        echo '<button class="dokan-btn dokan-btn-theme" disabled>Requested Refund</button>';
        return;
    }
    if(get_post_meta($order_id,'order_cancel_requested',true) == 'refunded'){
        echo '<button class="dokan-btn dokan-btn-theme" disabled>Refunded</button>';
        return;
    }
    //echo'<pre>'; print_r( get_post_meta($order_id)); echo '</pre>';
    if(get_post_meta($order->id, 'swoove_delivery_status', true) != 'not-created' && !empty(get_post_meta($order->id,'swoove_request_sent',true)) ){
        return;
    }
   //die();
    ?> 
        <button data-store_id="<?php echo esc_attr( $store_id ); ?>" class="dokan-cancel-request-btn dokan-btn dokan-btn-theme dokan-btn-sm user_logged"><?php echo esc_html( "Cancel/Refund" ); ?></button>
        <div class="cancel-form-wrapper" style="display:none;">
            <div class="cancel-form">
                <a class="close"><i class="fa fa-times"></i></a>
                <form action="">
                    <p style="text-align:center;">Cancel Order #<?php echo $order->id; ?></p>
                    <input style="pointer-events:none; opacity:.6;" type="text" name="title" value="Cancel Order #<?php echo $order->id; ?>" id="">
                    <input type="hidden" name="order_no" value="<?php echo $order->id; ?>">
                    <label> Reason for Cancelation?</label>
                    <textarea name="reason" id="" cols="30" rows="10"></textarea>
                    <input type="submit" value="submit-cancel-order">
                </form>
            </div>
        </div>
    <?php
}

// Jquery script
add_action( 'woocommerce_after_account_orders', 'action_after_account_orders_js');
function action_after_account_orders_js() {
    $action_slug = 'refund_cancel_order';
    ?>
    <script>
   
    jQuery(function($){
        $('a.<?php echo $action_slug; ?>').each( function(){
            $(this).attr('target','_blank');
        })
    });
    </script>
    <?php
}
add_action('wp_footer',function(){
    ?><script>
        jQuery(document).ready(function(){
            jQuery('.dokan-cancel-request-btn').click(function(){
                jQuery(this).next().addClass('active');
            });
            jQuery('.cancel-form-wrapper .close').click(function(){
                jQuery('.cancel-form-wrapper').removeClass('active');
            });
            jQuery('.cancel-form-wrapper form').submit(function(e){
                jQuery.blockUI();
                e.preventDefault();
                jQuery.ajax({
                    method: 'post',
                    url: ajaxurl,
                    data : { action: 'cancel_refund_request', data: jQuery(this).serialize()},
                    success: function(res){
                        jQuery.unblockUI();
                        alert(JSON.stringify(res));
                    }
                })
            });
            
        });
    </script><?php

},1000);


add_action( 'wp_ajax_cancel_refund_request', 'cancel_refund_request' );
add_action( 'wp_ajax_nopriv_cancel_refund_request', 'cancel_refund_request' );
function cancel_refund_request(){
    $postdata = $_POST['data'];
  
    if ( !empty( $postdata ) ) {
        parse_str( wp_unslash( $_POST['data'] ), $postdata );
    }
  

	$my_post = [
        'post_title'     => $postdata['title'],
        'post_content'   => $postdata['reason'],
        'post_status'    => 'open',
        'post_author'    => dokan_get_current_user_id(),
        'post_type'      => 'dokan_store_support',
        'comment_status' => 'open',
        'meta_input'   => array(
            'order_cancel' => 'requested',
        ),
    ];

    $post_id = wp_insert_post( apply_filters( 'dss_new_ticket_insert_args', $my_post ) );
    $order = wc_get_order($postdata['order_no']);
    $seller = dokan_get_seller_id_by_order( $order->id );  // echo '<pre>'; print_r($seller); echo '</pre>'; die();
    $store_info  = dokan_get_store_info($seller); 
    $order_id  = $order->id;
    if ( $post_id ) {
        $store_id = ( ! empty( $seller ) ) ? absint($seller ) : null;
        $order_id = ( ! empty( $postdata['order_no'] ) ) ? absint( $postdata['order_no'] ) : null;

        update_post_meta( $post_id, 'store_id', $store_id );
        update_post_meta( $post_id, 'order_id', $order_id );

        $mailer = WC()->mailer();

        do_action( 'dokan_new_ticket_created_notify', $seller, $post_id );

        $success_msg = __( 'Thank you. Your ticket has been submitted!', 'dokan' );

        do_action( 'dss_new_ticket_created', $post_id, $seller ); echo get_post_meta($order_id, 'swoove_id', true);
        // if(!empty(get_post_meta($order_id, 'swoove_id', true))){
        //     $Swoove_Shipping_Method = new SwooveShippingMethod(); echo 'fasdfa'; die();
        //     $Swoove_Shipping_Method->cancel_the_order($order_id);
        // }
        
    } else { 
        $error_msg = __( 'Sorry, something went wrong! Couldn\'t create the ticket.', 'dokan' );
        wp_send_json(
            [
                'success' => false,
                'msg'     => apply_filters( 'dss_ticket_submission_error_msg', $error_msg ),
            ]
        );
    }

}


add_action( 'init', 'register_custom_post_status', 20 );
function register_custom_post_status() {
    register_post_status( 'wc-awaiting-delivery', array(
        'label'                     => _x( 'Preparing', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Preparing <span class="count">(%s)</span>', 'Preparing <span class="count">(%s)</span>', 'woocommerce' )
    ) );
}

// Adding custom status 'awaiting-delivery' to order edit pages dropdown
// add_filter( 'wc_order_statuses', 'custom_wc_order_statuses' );
// function custom_wc_order_statuses( $order_statuses ) {
//     $order_statuses['preparing'] = _x( 'Preparing', 'Order status', 'woocommerce' );
//     return $order_statuses;
// }


add_action('woocommerce_order_status_changed', 'so_status_refunded', 10, 3);

function so_status_completed($order_id, $old_status, $new_status)
{

    $order = wc_get_order($order_id);
    if($order->status == 'refunded'){
       updated_post_meta($order_id,'order_cancel_requested','refunded');
    }
    
}
//remove_action('dokan_customer_account_migration_list',[ 'Dokan_Wholesale_Customer', 'render_migration_html' ],10);
add_action('dokan_customer_account_migration_list',function(){
	$user = wp_get_current_user();
	if ( !in_array( 'seller', (array) $user->roles ) ) {
		echo '<style>li.dokan-wholesale-migration-wrapper{display:none !important;}</style>';
		echo '<script>jQuery("li.dokan-wholesale-migration-wrapper").remove();</script>';
	}
},10);

  


// Category Menu
function hierarchical_term_tree($category = 0){
    $html = '';
    $args = array(
        'parent' => $category,
		'orderby' => 'name',
		'order'  => 'ASC',
		'hide_empty' => false,
		'exclude' => array(23544 )
    );
    $next = get_terms('product_cat', $args);// echo'<pre>'; print_r($next); echo '</pre>';
	$classes = $category == 0 ? 'parent-list' : 'sub-list';
	
    if ($next) {
        $html .= '<ul class="'.$classes.'">';
		if($category != 0){
			$html .= '<li class="view-all"><a href="'.get_term_link(get_term( $category )->slug, get_term( $category )->taxonomy) .'">View All '. get_term( $category )->name .'</a></li>';
		}
        foreach ($next as $cat) {
			if(!is_wp_error(get_term_link($cat->slug, $cat->taxonomy))):
           $html .= '<li ><a href="'.get_term_link($cat->slug, $cat->taxonomy).'" title="'.sprintf(__("View all products in %s"), $cat->name).'"'.'>'.$cat->name.'</a>';
           $html .= $cat->term_id !== 0 ? hierarchical_term_tree($cat->term_id) : null;
			endif;
        }
        $html .= '</li>';
		if($category == 0){
// 			$html .= '<li><a href="/brands/">Brands</a></li>';
// 			$html .= '<li><a href="/blog/">Blog</a></li>';		
// 			$html .= '<li class="sale-part"><a href="/on-sale/">Sale</a></li>';
		}
        $html .= '</ul>';
    }
   return $html;
}

add_action('wp_footer',function(){ ?>
<style>
/* Duplicating Menu Styling */
.hierarchical_term_menu span {
	    cursor:pointer;
	    font-weight:700;
		width: 100%;
		box-shadow: inset 0px -5px 0px -3px #00000045;
		overflow:hidden;
		font-family: monospace;
		background: white;
		text-align: right;
	    font-size: 20px;
	   	background:white;
		display: block;
		
		padding: 7px 10px;
	}
	.hierarchical_term_menu{
		display:none;
		position:fixed;
		top:0;
		left:0;
		width:300px;
		background:white;
		height:100vh;
		box-shadow: 2px 0px 19px 0px #00000090;
		z-index:999999;
	}
	ul.sub-list.opened {
		display: block !important;
		left: 0;
		border-top: 1px solid #00000090;
	}
	li.view-all a {
		font-style: italic;
		color: gray;
	}
	.parent-list a:before {
		content: '\f105';
		font-style:normal !important;
		vertical-align: middle;
		font-size: 18px;
		font-weight: 700;
		font-family: 'FontAwesome';
		float: right;
		display: inline-block;
		line-height: 16px;
	}
	.parent-list a {
		color: black;
		padding: 10px 12px;
		display: block;
		text-decoration: none;
	}
	ul.parent-list{
		position:relative;
	}
	ul.parent-list ul {
		padding-left: 0;
		margin-top:50px;
		position:fixed;
		height:calc(100vh - 50px);
		background: white;
		width: 300px;
		overflow-x: hidden;
		top: 0;
		z-index:9999;
	}
	ul.parent-list li {
		list-style: none;
	}
	ul.parent-list > li .sub-list {
		display: none;
	}
	.category-menu::-webkit-scrollbar{
		display:none;
	}
	.category-menu {
		overflow:scroll;
		height: calc(100% - 50px);
		position:relative;
		box-shadow: inset 0px 1px 1px 0px #00000073;
	}
	.category-menu:before {
		content: '';
		z-index:-1;
		width: 300px;
		height: 100vh;
		position: fixed;
		left: 0;
		top: 0;
		background: white;
	}
	.menu-header{
		display:flex;
		align-items:center;
		justify-content:space-between;
	}
	.menu-header img {
		max-height: 30px;
	}
	.menu-header .current,.menu-header .back{
		display:none;
		
	}
	.menu-header span.logo {
		height: 50px;
		text-align:left;
	}
	.menu-header .back{
		text-align:left;
	}
	.menu-header span{
		height:50px;
		line-height: 35px;
		box-shadow:none !important;
	}
	span.current {
		font-family: inherit;
		font-weight: 500;
		font-size: 15px;
		text-align: center;
		flex: 0 0 70%;
		height: 50px;
	}
	.menu-header span:before {
		z-index: -1;
		content: '';
		top:0;
		width: 100%;
		height: 100vh;
		background: #000000ab;
		position: fixed;
		left: 0;
	}
	#page.menu-mobile-active:before {
    display: none !important;
}

.mobile-menu-wrapper {
    display: none !important;
}
ul.sub-list.opened {
    margin: 0px;
    margin-top: 50px;
}
	.admin-bar {
    padding-top: 50px;
}
ul.parent-list li {
    padding: 0px;
}
	
</style>	
<script>
//jQuery(document).ready(function(){


	

	jQuery('<a style="display:none;"class="desktop-category-menu-toggle"><i class="fa fa-bars"></i></a>').prependTo('.search.head_search');
	jQuery("ul.parent-list a").click(function(e){  
        if(jQuery(this).siblings('.sub-list').length > 0){
            e.preventDefault();
          	jQuery('ul.parent-list a').removeClass('active');
            jQuery(this).addClass('active');
          	jQuery(".hierarchical_term_menu .current").text(jQuery(this).text());
          	jQuery(".hierarchical_term_menu .logo").hide();
          	jQuery(".hierarchical_term_menu .current,.hierarchical_term_menu .back").show();
            jQuery(this).siblings('.sub-list').addClass('opened');
        }
    });
  	jQuery(".hierarchical_term_menu .back").click(function(){
      var active = jQuery('ul.parent-list a.active');
      jQuery('ul.parent-list a.active').siblings('.sub-list').removeClass('opened');
	  jQuery(active).removeClass('active');
      if(jQuery(active).parent().parent().hasClass('opened')){
        jQuery(active).parent().parent().siblings('a').addClass('active');
        jQuery(".hierarchical_term_menu .current").text(jQuery("ul.parent-list a.active").text());
      }else{
        jQuery(".hierarchical_term_menu .logo").show();
        jQuery(".hierarchical_term_menu .current,.hierarchical_term_menu .back").hide();
      }
    });
    jQuery(".hierarchical_term_menu > .menu-header > span.close").click(function(){
        jQuery(".hierarchical_term_menu").hide();
    });
    jQuery('body').on("click",".ic-mobile-menu-button, .desktop-category-menu-toggle,button.mega-toggle-animated,.mega-menu-toggle",function(){
        jQuery(".hierarchical_term_menu").show();
    });
	
	jQuery('.hierarchical_term_menu').removeClass('remove');
	
</script>

	
<?php });
add_action('woocommerce_account_advertise_endpoint', function() {
	echo "<div style='color:black;'><p>Grow your business and reach your clients by advertising with us. WIth Cutemesh, you not only reach your customers, you find new ones!! The sky's the limit and you are not limited in your options,  our main objective is to promote the message of the advertisers.  Show up where it counts, follow the steps below and create an ad !!!
</p><p>
Complete the advertisement placement form below and submit for review and publication. We will reach out to you if there is the need for that.
</p></div>";
},1);


add_action('woocommerce_account_dropshipper-registration_endpoint', function() {
    echo '<div class="dropshipper-module"> <h2> Dropshipper Registration</h2>';
	echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');
    echo '</div>';
});
add_action('woocommerce_account_post-an-event_endpoint', function() {
    echo '<div class="dropshipper-module"> <h2> Post an Event</h2>';
	echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]');
    echo '</div>';
});
add_action('woocommerce_account_add-vacancy_endpoint', function() {
    echo '<div class="dropshipper-module"> <h2> Post a Job Vacancy</h2>';
	echo do_shortcode('[gravityform id="4" title="false" description="false" ajax="true"]');
    echo '</div>';
});
add_action('init', function() {
	add_rewrite_endpoint('dropshipper-registration', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('post-an-event', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('add-vacancy', EP_ROOT | EP_PAGES);
});

add_action('dokan_customer_account_migration_list',function(){ 
    global $current_user;
    if ( !in_array( 'dropshipper', (array) $current_user->roles ) && in_array( 'seller', (array) $current_user->roles ) ) : ?>
        <li>
            <div class="dokan-w8 left-content">
                <p><strong><?php esc_html_e( 'Become a Dropshipper', 'dokan' ); ?></strong></p>
                <p><?php esc_html_e( 'Dropshippers can provide a csv of their products and vendors will also be able to add you as a dropshipper on their products.', 'dokan' ); ?></p>
            </div>
            <div class="dokan-w4 right-content">
                <a href="<?php echo esc_url( dokan_get_page_url( 'myaccount', 'woocommerce', 'dropshipper-registration' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Become a Dropshipper', 'dokan' ); ?></a>
            </div>
            <div class="dokan-clearfix"></div>
        </li>

<?php endif; });


function dokan_set_go_to_dropshipper_dashboard_btn() {
    global $current_user; 
    if ( !in_array( 'dropshipper', (array)$current_user->roles ) ){
        return;
    }

    printf(
        '<p><a href="%s" class="dokan-btn dokan-btn-theme vendor-dashboard" >%s</a></p>',
        esc_url(  dokan_get_page_url( 'myaccount', 'woocommerce', 'dropshipper-registration' ) ),
        esc_html( __('Go to Dropshipper Dashboard', 'dokan-lite') )
    );
}

add_action( 'woocommerce_account_dashboard', 'dokan_set_go_to_dropshipper_dashboard_btn' );





// Add the meta box
function add_careers_meta_box() {
    add_meta_box(
        'careers_expiry_date',
        'Additional Fields',
        'careers_expiry_date_callback',
        'careers',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_careers_meta_box' );

// Output the meta box
function careers_expiry_date_callback( $post ) {
    wp_nonce_field( 'careers_expiry_date_nonce', 'careers_expiry_date_nonce' );
    $expiry_date = get_post_meta( $post->ID, '_careers_expiry_date', true );
    $posted_by_email = get_post_meta( $post->ID, '_posted_by_email', true );
    ?>
    <p>
        <label for="careers_expiry_date"><?php esc_html_e( 'Expiry Date', 'text-domain' ); ?></label><br>
        <input type="date" id="careers_expiry_date" name="careers_expiry_date" value="<?php echo esc_attr( $expiry_date ); ?>">
    </p>
    <p>
        <label for="posted_by_email"><?php esc_html_e( 'Posted By Email', 'text-domain' ); ?></label><br>
        <input type="email" id="posted_by_email" name="posted_by_email" value="<?php echo esc_attr( $posted_by_email ); ?>">
    </p>
    <?php
}

// Save the meta box
function save_careers_expiry_date( $post_id ) {
    if ( ! isset( $_POST['careers_expiry_date_nonce'] ) || ! wp_verify_nonce( $_POST['careers_expiry_date_nonce'], 'careers_expiry_date_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['careers_expiry_date'] ) ) {
        delete_post_meta( $post_id, '_careers_expiry_date' );
    }
    if ( ! isset( $_POST['posted_by_email'] ) ) {
        delete_post_meta( $post_id, '_posted_by_email' );
    }
    if ( ! isset( $_POST['careers_expiry_date'] ) && ! isset( $_POST['posted_by_email'] ) ){
        return;
    }
    $expiry_date = sanitize_text_field( $_POST['careers_expiry_date'] );
    $posted_by_email = sanitize_text_field( $_POST['posted_by_email'] );
    update_post_meta( $post_id, '_careers_expiry_date', $expiry_date );
    update_post_meta( $post_id, '_posted_by_email', $posted_by_email );
}
add_action( 'save_post_careers', 'save_careers_expiry_date' );




function additional_features_buttons_myaccount() {
    global $current_user; 

    printf(
        '<p><a href="%s" class="dokan-btn dokan-btn-theme vendor-dashboard" >%s</a></p>',
        esc_url(  dokan_get_page_url( 'myaccount', 'woocommerce', 'post-an-event' ) ),
        esc_html( __('Post an Event', 'dokan-lite') )
    );
    printf(
        '<p><a href="%s" class="dokan-btn dokan-btn-theme vendor-dashboard" >%s</a></p>',
        esc_url(  dokan_get_page_url( 'myaccount', 'woocommerce', 'add-vacancy' ) ),
        esc_html( __('Post an Job Vacancy', 'dokan-lite') )
    );
}

//add_action( 'woocommerce_account_dashboard', 'additional_features_buttons_myaccount' );


function create_career_taxonomy() {
  $labels = array(
    'name' => __( 'Career Categories', 'textdomain' ),
    'singular_name' => __( 'Career Category', 'textdomain' ),
    'search_items' => __( 'Search Career Categories', 'textdomain' ),
    'all_items' => __( 'All Career Categories', 'textdomain' ),
    'parent_item' => __( 'Parent Career Category', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Career Category:', 'textdomain' ),
    'edit_item' => __( 'Edit Career Category', 'textdomain' ),
    'update_item' => __( 'Update Career Category', 'textdomain' ),
    'add_new_item' => __( 'Add New Career Category', 'textdomain' ),
    'new_item_name' => __( 'New Career Category Name', 'textdomain' ),
    'menu_name' => __( 'Career Categories', 'textdomain' ),
  );
  
  $args = array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'career-category' ),
  );
  
  register_taxonomy( 'career-category', array( 'careers' ), $args );
}
add_action( 'init', 'create_career_taxonomy' );

add_filter( 'gform_pre_render', 'populate_career_category_dropdown' );
add_filter( 'gform_pre_validation', 'populate_career_category_dropdown' );
add_filter( 'gform_pre_submission_filter', 'populate_career_category_dropdown' );
add_filter( 'gform_admin_pre_render', 'populate_career_category_dropdown' );
function populate_career_category_dropdown( $form ) {
    foreach ( $form['fields'] as $field ) { 
        if ( $field->type == 'select' && $field->label == 'Select Category' ) {
            $terms = get_terms( array(
                'taxonomy' => 'career-category',
                'hide_empty' => false,
            ) );
            $choices = array();
            foreach ( $terms as $term ) {
                $choices[] = array(
                    'text' => $term->name,
                    'value' => $term->slug,
                );
            }
            $field->choices = $choices;
        }
		
		if ( $field->type == 'select' && $field->label == 'Event Category' ) {
            $terms = get_terms( array(
                'taxonomy' => 'tribe_events_cat',
                'hide_empty' => false,
            ) );
            $choices = array();
            foreach ( $terms as $term ) {
                $choices[] = array(
                    'text' => $term->name,
                    'value' => $term->slug,
                );
            }
            $field->choices = $choices;
        }
    }
    return $form;
}
// Saving Dynamic Post by Email Field
add_filter( 'gform_field_value_posted_by_email', 'populate_hidden_field', 10, 3 );
function populate_hidden_field( $value, $field, $name ) {
    global $post;
    // Replace 123 with the ID of your Gravity Form
    //  echo '<pre>'; print_r($field); echo '</pre>';
    // echo $name; die();
    if ( $field['formId'] == 2  ) {
        // Replace your_meta_key with the key of your post meta field
        $meta_value = get_post_meta( $post->ID, '_posted_by_email', true );
        return $meta_value;
    }
	
    return $value;
}

add_filter( 'gform_field_value_first_name',  function($value, $field, $name){
	 if ( $field['formId'] == 3  ) {
       	$current_user = wp_get_current_user();
	  	$first_name = $current_user->user_firstname;
        return $first_name;
    }
	return $value;
}, 10, 3 );

add_filter( 'gform_field_value_last_name',  function($value, $field, $name){
	 if ( $field['formId'] == 3  ) {
       	$current_user = wp_get_current_user();
	  	$last_name = $current_user->user_lastname;
        return $last_name;
    }
	return $value;
}, 10, 3 );

add_filter( 'gform_field_value_email',  function($value, $field, $name){
	 if ( $field['formId'] == 3  ) {
       	$current_user = wp_get_current_user(); //echo '<pre>'; print_r($current_user); echo '</pre>';
	  	$email = $current_user->user_email;
        return $email;
    }
	return $value;
}, 10, 3 );

add_filter( 'gform_field_value_phone',  function($value, $field, $name){
	 if ( $field['formId'] == 3  ) {
       	$current_user = wp_get_current_user();
		$phone_number = get_user_meta( $current_user->ID, 'billing_phone', true );
        return $phone_number;
    }
	return $value;
}, 10, 3 );




add_action('wp_footer',function(){
    ?>
    <script>
    jQuery('<div style="display:none;" class="image-dimention-error">Image dimention must be 400 x 300</div>').appendTo('.bsaProInput.bsa_img_inputs_load label');
    jQuery('select#bsa_pro_space_id').change(function(){
        if(jQuery(this).val() == 25 ){
            jQuery('.image-dimention-error').show();
        }else{
            jQuery('.image-dimention-error').hide();
        }
    });
    var _URL = window.URL || window.webkitURL;
    jQuery("input#bsa_pro_img").change(function (e) {
        var file, img;
        if(jQuery('select#bsa_pro_space_id').val() == 25){
            if ((file = this.files[0])) {
                img = new Image();
                var objectUrl = _URL.createObjectURL(file);
                img.onload = function () {
                   if(this.width != 400 || this.height != 300){
                    jQuery('.image-dimention-error').addClass('alert');
                   }else{
                    jQuery('.image-dimention-error').removeClass('alert');
                   }
                    _URL.revokeObjectURL(objectUrl);
                };
                img.src = objectUrl;
            }
        }
        
    });
    </script>
    <style>
    .image-dimention-error {
        font-style: italic;
        font-weight: normal;
    }
    .image-dimention-error.alert {
        color: red;
        padding: 0;
        margin-bottom: 0;
    }
    </style>
    <?php
    });


    

add_action( 'edit_term', function( $term_id, $tt_id, $taxonomy ) { //echo '<pre>'; print_r($_POST); echo '</pre>'; die();
    if ( isset( $_POST['product_cat_thumbnail_id'] )  ) { 
        $product_cat_thumbnail_id = absint( $_POST['product_cat_thumbnail_id'] ); //echo $product_cat_thumbnail_id; die();
        update_term_meta( $term_id, 'thumbnail_id', $product_cat_thumbnail_id ); 
        set_term_thumbnail( $term_id, $product_cat_thumbnail_id );
        echo '<pre>'; print_r(get_term_meta($term_id)); echo '</pre>';
        //echo $term_id; die();
    }
}, 10, 3 );

function set_term_thumbnail( $term_id, $thumbnail_id ) {
    $thumbnail_id = absint( $thumbnail_id );
    if ( $thumbnail_id ) {
        // Get the attachment metadata
        $attachment = get_post( $thumbnail_id );
        $attachment_data = array(
            'alt' => get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ),
        );
        
        // Set the category thumbnail
        update_term_meta( $term_id, '_thumbnail_id', $thumbnail_id );
        update_term_meta( $term_id, '_wp_attachment_image_alt', $attachment_data['alt'] );
    } else {
        // Remove the category thumbnail if no attachment is selected
        delete_term_meta( $term_id, '_thumbnail_id' );
        delete_term_meta( $term_id, '_wp_attachment_image_alt' );
    }
}


// Event page banner
add_action('boxshop_before_main_content',function(){
	global $wp;
	if($wp->request == 'events'){
		echo do_shortcode('[elementor-template id="23469"]');
	}
	if($wp->request == 'careers-list'){
		echo do_shortcode('[elementor-template id="23474"]');
	}
	

});


function custom_shop_query($query) {
    if (is_admin() || !is_main_query() || !is_shop()) {
        return;
    }

    $show_on_sale = isset($_GET['on-sale']) && $_GET['on-sale'] === 'yes';

    if ($show_on_sale) {
        $query->set('meta_query', array(
            array(
                'key' => '_sale_price',
                'value' => 0,
                'compare' => '>',
                'type' => 'NUMERIC',
            ),
        ));
    }
}
add_action('pre_get_posts', 'custom_shop_query');


add_action('wp_footer',function(){
	?>
	<script>
		jQuery(document).ready(function(){
			jQuery('ul.product-categories li.cat-parent > a').click(function(e){
				e.preventDefault();
				jQuery(this).toggleClass('active');
			});
		});
		jQuery('.top-selling-carousel .products,.carousel .products ').slick({
		  dots: false,
		  infinite: true,
		  speed: 300,
		  autoplay:true,
		  arrows: true,
		  prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-angle-left"></i></button>',
	      nextArrow: '<button type="button" class="slick-next"><i class="fas fa-angle-right"></i></button>',
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		  ]
		});
	</script>
	<?php
});







// Start a session on WooCommerce init
add_action('woocommerce_init', 'start_session');
function start_session() {
    if (!session_id()) {
        session_start();
    }
}

// Add checkboxes for each vendor after the order review table
add_action('woocommerce_review_order_after_order_total', 'add_vendor_insurance_checkboxes');

function add_vendor_insurance_checkboxes() {
    // Get an array of vendors from products in the cart
    $vendors = array();
    if(get_field('percentage_of_insurance','option') !== 0):
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $product_id = $cart_item['product_id'];
            $product = wc_get_product($product_id);
            $vendor_id = get_post_field( 'post_author', $product_id );
            if (!in_array($vendor_id, $vendors)) {
                $vendors[] = $vendor_id;
                $store_info  = dokan_get_store_info( $vendor_id );
                $checked = isset($_SESSION['add_insurance'][$vendor_id]) && $_SESSION['add_insurance'][$vendor_id] ? 'checked' : '';
                echo '<tr class="woocommerce-insurance-checkbox"><td colspan="2"><label><input data-vendor="'.$vendor_id.'" class="insurance-vendor" type="checkbox" name="add_insurance[' . $vendor_id . ']" value="1" ' . $checked . '> Insurane for Vendor ' . $store_info["store_name"] . ' order '.get_field("percentage_of_insurance","option").'%</label></td></tr>';
            }
        }
    endif;
}

// Calculate and apply insurance amount
add_action('woocommerce_cart_calculate_fees', 'apply_vendor_insurance_fee');
function apply_vendor_insurance_fee() {
    session_start();

    //echo '<pre>'; print_r(WC()->cart->get_cart()); echo '</pre>';
    $vendors_total = array();
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $product_id = $cart_item['product_id'];
        $vendor_id = get_post_field( 'post_author', $product_id );
        $postedData = array();
        if(!isset($vendor_total[$vendor_id])){
            $vendor_total[$vendor_id] = 0;
        }
        $vendors_total[$vendor_id] += $cart_item['line_total'];
    }
    foreach($vendors_total as $vendor_id => $total){ 
        if(isset($_SESSION['add_insurance'][$vendor_id])):
            $store_info  = dokan_get_store_info( $vendor_id );
            if(get_field('percentage_of_insurance','option') !== 0){
                $insurance_amount = $total * (get_field('percentage_of_insurance','option')/100); 
                // Apply the insurance fee for this vendor
                WC()->cart->add_fee('Vendor ' .  $store_info["store_name"] . ' Insurance', $insurance_amount);
            }
            
        endif;
    }
    //echo '<pre>'; print_r($vendors_total); echo '</pre>';
}

// // Load the checkbox states from session when WooCommerce initializes the cart
// add_action('woocommerce_cart_loaded_from_session', 'load_checkbox_states');
// function load_checkbox_states() {
//     if (isset($_SESSION['add_insurance'])) {
//         foreach ($_SESSION['add_insurance'] as $vendor_id => $checked) {
//             WC()->session->set($_SESSION['add_insurance'][$vendor_id], $checked);
//         }
//     }
// }

// Save insurance status and amount as order metadata for each vendor
add_action('woocommerce_checkout_create_order', 'save_vendor_insurance_metadata');
function save_vendor_insurance_metadata($order) {
    foreach ($_SESSION['add_insurance'] as $vendor_id => $checkbox_state) {
        if ($checkbox_state) {
            update_post_meta($order->get_id(), 'additional_insurance_vendor_' . $vendor_id, 'yes');
            // Save insurance amount as well if needed
        }
    }
}

// Display insurance details in order details for each vendor
add_action('woocommerce_order_details_after_order_table', 'display_vendor_insurance_details');
function display_vendor_insurance_details($order) {
    foreach ($_SESSION['add_insurance'] as $vendor_id => $checkbox_state) {
        $insurance_status = get_post_meta($order->get_id(), 'additional_insurance_vendor_' . $vendor_id, true);
        if ($insurance_status == 'yes') {
            echo '<p><strong>Additional Insurance for Vendor ' . $vendor_id . ':</strong> Added</p>';
        }
    }
}


add_action('wp_footer',function(){
    ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('body').on('change','.insurance-vendor', function() {
                jQuery('.woocommerce-checkout-review-order-table,#payment').block({message : ''});
                jQuery.ajax({
                    method: 'post',
                    url: ajaxurl,
                    data : { action: 'add_vendor_insurance', vendor: jQuery(this).data().vendor , checked : jQuery(this).is(':checked')},
                    success: function(res){
                        jQuery('body').trigger('update_checkout');
                    }
                })
                //jQuery('body').trigger('update_checkout');
            });
        });
    </script>
    <?php
});
add_action( 'wp_ajax_add_vendor_insurance', 'add_vendor_insurance' );
add_action( 'wp_ajax_nopriv_add_vendor_insurance', 'add_vendor_insurance' );
function add_vendor_insurance(){
    session_start();
    $postdata = $_POST;
  print_r($postdata); 
    $vendor = $postdata['vendor'];
    if($postdata['checked'] == 'true'): 
        $_SESSION['add_insurance'][$vendor] = true; echo 'checked'; die();
    else:
       unset($_SESSION['add_insurance'][$vendor]); echo '<pre>'; print_r($_SESSION); echo '</pre>'; die();
    endif;
    wp_send_json_success(array('message'=>'Insurance Updated'));
	
}


add_filter('woocommerce_checkout_fields', 'customize_checkout_field_validation',99999);

function customize_checkout_field_validation($fields) {
    // Remove validation rules for specific fields
    if (isset($fields['billing']['billing_state'])) {
        unset($fields['billing']['billing_state']['validate']);
    }
    // Add more fields as needed

    return $fields;
}




if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'Insurance Setting',
        'menu_title' => 'Insurance Setting',
        'menu_slug' => 'insurance-settings',
        'capability' => 'manage_options',
        'redirect' => false
    ));
}
