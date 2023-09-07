jQuery(document).ready(function(){ 
	jQuery('body').on('woocommerce-product-type-change',function(n, e){
		jQuery('p.form-field._no_of_auction_product_field,p.form-field._no_of_booking_product_field,p.form-field._no_of_service_product_field,p.form-field._no_of_grocery_product_field,p.form-field._no_of_supermarket_product_field').insertAfter('p.form-field._no_of_product_field');
		jQuery('input#publish').removeAttr('disabled');
		jQuery('._no_of_auction_product_field').hide();
		jQuery('._no_of_booking_product_field').hide();
		jQuery('._no_of_service_product_field').hide();
		jQuery('._no_of_grocery_product_field').hide();
		jQuery('._no_of_supermarket_product_field').hide();
		if(e == 'product_pack'){
			jQuery('._no_of_auction_product_field').show();
			jQuery('._no_of_booking_product_field').show();
			jQuery('._no_of_supermarket_product_field').show();
			jQuery('._no_of_grocery_product_field').show();
			jQuery('._no_of_service_product_field').show();
		}
	});
});