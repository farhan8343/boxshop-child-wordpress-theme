<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$menu_items = wc_get_account_menu_items();
$updated = array();
$transaction = array(
	'orders' => $menu_items['orders'],
	'downloads' => $menu_items['downloads'],
	'bookings' => $menu_items['bookings']
);
$account_settings = array(
	'edit-account' => $menu_items['edit-account'],
	'edit-address' => $menu_items['edit-address'],
	'auctions-endpoint' => $menu_items['auctions-endpoint']
);
$payment = array(
	'payment-methods' => $menu_items['payment-methods'],
	'woo-wallet' =>  $menu_items['woo-wallet'],
	'giftcards' => $menu_items['giftcards']
);
$wishlist =  array(
	'manage-wishlist' => 'Manage Wishlist'
);
$correspondence = array(
	'customer-inbox' => $menu_items['customer-inbox'],
	'rma-requests' => $menu_items['rma-requests'],
	'support-tickets' => $menu_items['support-tickets']
);
$advertisement = array(
	'advertise' => $menu_items['advertise'],
	'advertise-statistics' => $menu_items['advertise-statistics']
);
$post = array(
	'add-vacancy' => 'Job vacancy',
	'post-an-event' => 'Event'
);
$updated['dashboard'] = $menu_items['dashboard'];
$updated['transaction']['heading'] = 'Orders';
$updated['transaction']['icon'] = '<i class="fa-solid fa-cart-shopping"></i>';
$updated['transaction']['content'] = $transaction;
$updated['account_settings']['heading'] = 'Account Settings';
$updated['account_settings']['icon'] = '<i class="fa-solid fa-user-gear"></i>';
$updated['account_settings']['content'] = $account_settings; 
$updated['payment']['heading'] = 'Payments';
$updated['payment']['icon'] = '<i class="fa-solid fa-credit-card"></i>';
$updated['payment']['content'] = $payment;
$updated['wishlist']['heading'] = 'Wishlist';
$updated['wishlist']['icon'] = '<i class="fa-solid fa-heart"></i>';
$updated['wishlist']['content'] = $wishlist;
$updated['correspondence']['heading'] = 'Correspondence';
$updated['correspondence']['icon'] = '<i class="fa-sharp fa-solid fa-message"></i>';
$updated['correspondence']['content'] = $correspondence; 
$updated['advertisement']['heading'] = 'Advertisement';
$updated['advertisement']['icon'] = '<i class="fa-solid fa-rectangle-ad"></i>';
$updated['advertisement']['content'] = $advertisement;
$updated['post']['heading'] = 'Request A Post';
$updated['post']['icon'] = '<i class="fa-solid fa-signs-post"></i>';
$updated['post']['content'] = $post;

unset($menu_items['dashboard']);
unset($menu_items['orders']);
unset($menu_items['downloads']);
unset($menu_items['bookings']);
unset($menu_items['edit-account']);
unset($menu_items['edit-address']);
unset($menu_items['auctions-endpoint']);
unset($menu_items['payment-methods']);
unset($menu_items['woo-wallet']);
unset($menu_items['giftcards']);
unset($menu_items['customer-inbox']);
unset($menu_items['rma-requests']);
unset($menu_items['support-tickets']);
unset($menu_items['advertise']);
unset($menu_items['advertise-statistics']);

$menu_items = array_merge($updated,$menu_items);
//echo '<pre>'; print_r($menu_items); echo '</pre>'; die();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
	nav.woocommerce-MyAccount-navigation > ul {
    padding: 10px;
}
nav.woocommerce-MyAccount-navigation {
    padding: 10px !important;
    border: 1px solid #e5e5e5;
}
nav.woocommerce-MyAccount-navigation li {
    text-align: left !important;
	margin-bottom:0px !important;
	color:black; font-size: 16px;
}
	nav.woocommerce-MyAccount-navigation li.label{
		padding: 8px !important;
		padding-left: 0px !important;
		font-weight:bold !important;
	}
	
	nav.woocommerce-MyAccount-navigation li.sub-item a{
		padding-left:15px !Important;
	}
	nav.woocommerce-MyAccount-navigation li span{
		padding-right:5px;
	}
	nav.woocommerce-MyAccount-navigation li a,nav.woocommerce-MyAccount-navigation li.sub-item.is-active a {

		border: unset !important;

		text-align: left;
		padding: 2px !important;
		padding-left: 15px !important;
	}
	
	nav.woocommerce-MyAccount-navigation > ul > li, .wrap-sub {
		padding-bottom: 15px !important;
	}
	nav.woocommerce-MyAccount-navigation > ul > li > a{
		padding-left: 0px !important;
	}
	nav.woocommerce-MyAccount-navigation > ul > li.is-active > a{
		padding-left: 5px !important;
	}
	
</style>

<?php
do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach ( $menu_items as $endpoint => $label ) : ?>
			<?php if(is_array($label)): echo '<div class="wrap-sub">'; ?>
				<li class="label"><?php echo $label['icon'].' '. $label['heading']; ?></li>
				<?php foreach($label['content'] as $endpoint=>$lable): ?>
					<li class="sub-item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
						<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo '<span>-</span>'. esc_html( $lable ); ?></a>
					</li>
				<?php endforeach; echo '</div>'; ?>
			<?php else: ?>
				<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
					
					
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
						<?php 
							switch($endpoint){
								case 'following':
									echo '<i class="fa-solid fa-users"></i>';
									break;
								case 'customer-logout':
									echo '<i class="fa-solid fa-right-from-bracket"></i>';
									break;
							}
						?>
						<?php echo '<span>'. esc_html( $label ).'</span>'; ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
