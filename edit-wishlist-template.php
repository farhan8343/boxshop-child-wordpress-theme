<?php
// Template Name: Wishlist Edit
global $wpdb;

acf_form_head();
get_header();
//echo '<pre>'; print_r(yith_wcwl_get_wishlist( $_GET['id'] )); echo '</pre>';
$wishlist = yith_wcwl_get_wishlist( $_GET['id'] );
$query = new WP_Query(array('post_type' => 'wishlist_template','fields'=>'ids','meta_key' => 'wishlist_id','meta_value'=>$_GET['id'])); 
if($query->have_posts()){ 
	$post_id = $query->posts[0];
}else{
		$post_title = 'Wishlist Template ' . $_GET["id"]; // You can customize the post title here

        $post_data = array(
            'post_title'    => $post_title,
            'post_type'     => 'wishlist_template',
            'post_status'   => 'publish',
        );

        // Insert the post
        $post_id = wp_insert_post($post_data);

        // Add meta data (wishlist_id) to the post
        if ($post_id && $_GET["id"]) {
            update_post_meta($post_id, 'wishlist_id', $_GET["id"]);
        }

}



echo '<div class="wishlist-edit-wrapper">';
	echo '<div class="wishlist-form">';
	acf_form(array(
		'post_id'       => $post_id,
		'post_title'    => false,
		'post_content'  => false,
		'updated_message' => "Template Updated",
		'field_groups'  => array(23549),
		'submit_value'  => __('Save Template')
	)); 
	echo '</div>';
	echo '<div class="display-edit-wishlist">';
	echo '<iframe src="'.$wishlist->get_url().'/?edit-mode=yes"></iframe>';
	echo '</div>';
echo '</div>';
get_footer();