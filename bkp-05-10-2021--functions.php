<?php
// ==========================================
//======= register style sheet
function boxshop_child_register_scripts()
{
    $parent_style = 'boxshop-style';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css', array('boxshop-reset'), boxshop_get_theme_version());
    wp_enqueue_style(
        'boxshop-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style)
    );
    wp_enqueue_script('jquery-validate-js', get_stylesheet_directory_uri() . '/assets/js/jquery.validate.min.js', array('jquery'));
    wp_enqueue_script('cstm_frontend_script', get_stylesheet_directory_uri() . '/assets/js/custom_script.js', array(), '1.0.0', true);
    wp_enqueue_script('cstm_paginathing_script', get_stylesheet_directory_uri() . '/assets/js/paginathing.min.js', array(), '1.0.0', true);
    wp_enqueue_script('i_have_cookie', get_stylesheet_directory_uri() . '/assets/js/jquery.ihavecookies.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'boxshop_child_register_scripts');

// ==========================================
//======= register style sheet
function cstm_admin_style()
{
    wp_enqueue_style('cstm-admin-styles', get_stylesheet_directory_uri() . '/admin.css');
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
        <input type="text" class="input-text" required pattern="S+" title="White space not allow" name="billing_last_name" id="reg_billing_last_name" value="<?php if (!empty($_POST['billing_last_name'])) esc_attr_e($_POST['billing_last_name']); ?>" />
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
            'label' => __('Digital Address'),
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
    $digital_address = $user ? get_user_meta($user->ID, 'billing__digital_address', true) : '';
    $is_additional_address = $user ? get_user_meta($user->ID, 'billing__is_additional_address', true) : '';
    $fields['digital_address'] = array(
        'label' => __('<span class="dgtl-span">Digital Address</span> <span class="details-span">If in Ghana, this is your GhanaPost GPS Digital Address. For all other countries, this is your GPS location. Add it if necessary, for package delivery.</span>'),
        'placeholder'   => _x('Digital Address', 'placeholder', 'woocommerce'),
        'class'     => array('form-row-wide'),
        'clear'     => true,
        'priority'     => 200,
    );
    $fields['is_additional_address'] = array(
        'type'      => 'radio',
        'label' => __('Above digital address for : '),
        'class'     => array('form-row-wide'),
        'clear'     => true,
        'priority'     => 200,
        'options' => array('Additional billing address' => __('Additional billing address'), 'Delivery address' => __('Delivery address')),
    );
    $fields['digital_address']['default'] = $digital_address;
    $fields['is_additional_address']['default'] = $is_additional_address;
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
                    <th><?php _e('Digital address:'); ?></th>
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
            woocommerce_wp_radio(array(
                'id'            => '_is_additional_address',
                'wrapper_class' => 'show_if_simple',
                'label'         => __('Digital address for : ', 'my_theme_domain'),
                'options'       => array(
                    'Additional billing address'    => 'Additional billing address',
                    'Delivery address'    => 'Delivery address',
                ),
                'value'         => get_post_meta($order->id, 'billing__is_additional_address', true),
                'name' => 'billing_is_additional_address',
            ));
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
        if (WeDevsDokanProShippingMethodsProductShipping::is_product_disable_shipping($item['product_id'])) {
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

        CURLOPT_POSTFIELDS => "{"from":{"longitude":21.192572,"latitude":72.799736},"to":{"longitude":21.16708,"latitude":72.86569}}",

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
    }

    $first_subcats = get_categories($first_args);

    if (!empty($first_subcats)) {
        if ($module_code == 'Supermarket') {
//             echo '<option selected="selected" class="level-0" value="17641" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
//             echo 'Supermarket';
//             echo '</option>';
        } elseif ($module_code == 'Grocery') {
        //    echo '<option selected="selected" class="level-0" value="17572" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
        //    echo 'Grocery';
        //    echo '</option>';
        } elseif ($module_code == 'Auction') {
         //   echo '<option selected="selected" class="level-0" value="17573" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
         //   echo 'Auction';
        //    echo '</option>';
        } elseif ($module_code == 'Rental') {
          //  echo '<option selected="selected" class="level-0" value="17574" data-commission="' . $data_prod_comission . '" data-product-id="' . $data_prod_id . '">';
          //  echo 'Rental';
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
    // update_post_meta($product_id, '_prod_module', str_replace(' ','',$_POST['prod_module']));
    // $a=array("red","green");
    // array_push($postdata['product_cat'],"17573");
    // print_r($postdata);
    // $postdata
    // echo '<pre>';
    // print_r($postdata);
    // echo '</pre>';
    // die;
    // wp_set_object_terms($product_id, 17573, 'product_cat');
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

function prefix_dokan_add_seller_nav($urls)
{
    $urls['products']['title'] = 'Sell Grocery & Products';

    $urls['bookings'] = array(
        'title' => __('List Rentals & Booking', 'dokan'),
        'icon'  => '<i class="fa fa-calendar"></i>',
        'url'   => dokan_get_navigation_url('phive_booking'),
        'pos'   => 31
    );

    $urls['auctions'] = array(
        'title' => __('Sell by Auction', 'dokan'),
        'icon'  => '<i class="fa fa-gavel"></i>',
        'url'   => dokan_get_navigation_url('auction'),
        'pos'   => 41
    );

    return $urls;
}
add_filter('dokan_get_dashboard_nav', 'prefix_dokan_add_seller_nav', 10);

function disable_pagination_in_menu_meta_box($obj)
{
    $obj->_default_query = array(
        'posts_per_page' => -1
    );
    return $obj;
}
// add_filter( 'nav_menu_meta_box_object', 'disable_pagination_in_menu_meta_box', 9 );

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
            <a href="<?php echo esc_url($this->get_next_step_link()); ?>" class="button-primary button button-large button-next lets-go-btn dokan-btn-theme"><?php esc_attr_e('Let's Go!', 'dokan-lite'); ?></a>
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
    if (isset($_POST['billing_phone'])) {
        $hasPhoneNumber = get_users('meta_value=' . $_POST['billing_phone']);
        if (!empty($hasPhoneNumber)) {
            $validation_errors->add('billing_phone_error', __(' Your phone number has already been verified!.', 'woocommerce'));
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
            var bill_phone = jQuery('#billing_phone').val();
            if (bill_phone != '') {
                bill_phone = bill_phone.replace(/[^0-9]/g, '');
                bill_phone = bill_phone.replace(/(d{3})(d{3})(d{4})/, "$1-$2-$3");
                jQuery('#billing_phone').val(bill_phone);
            }
            jQuery(function($) {
                jQuery('#billing_phone').on('input focusout', function() {
                    var p = jQuery(this).val();

                    p = p.replace(/[^0-9]/g, '');
                    p = p.replace(/(d{3})(d{3})(d{4})/, "$1-$2-$3");
                    jQuery(this).val(p);
                });
            });
        </script>
    <?php
    // }
    // if (is_checkout() && !is_wc_endpoint_url()) :
    ?>
        <!-- <script type="text/javascript">
            var bill_phone = jQuery('#billing_phone').val();
            if (bill_phone != '') {
                bill_phone = bill_phone.replace(/[^0-9]/g, '');
                bill_phone = bill_phone.replace(/(d{3})(d{3})(d{4})/, "$1-$2-$3");
                jQuery('#billing_phone').val(bill_phone);
            }
            jQuery(function($) {
                jQuery('#billing_phone').on('input focusout', function() {
                    var p = jQuery(this).val();

                    p = p.replace(/[^0-9]/g, '');
                    p = p.replace(/(d{3})(d{3})(d{4})/, "$1-$2-$3");
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