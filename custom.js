jQuery(document).ready(function(){
	jQuery('.store-cat-stack-dokan li.has-children > a').click(function(e){
		e.preventDefault();
		jQuery(this).toggleClass('active');
	});
	
	
	jQuery(".dps-pack-wrappper .dps-pack-"+jQuery('#dokan-subscription-pack').val()).addClass('active');
	jQuery(".dps-pack-wrappper .dps-pack").click(function(){
		jQuery(".dps-pack-wrappper .dps-pack").removeClass('active');
		jQuery(this).addClass('active');
		var id = jQuery(this).attr('class').split('dps-pack-')[1];
		jQuery("#dokan-subscription-pack").val(parseInt(id));
	});
	
	//Dokan New Product Page
	jQuery(".module-selector .card-selector").click(function(e){
		var value = jQuery(this).data().value;
		
		jQuery("select#prod_module").val(value);
		jQuery("select#prod_module").trigger('change');
		setTimeout(function(){
			jQuery(".module-selector").hide();
			jQuery(".dokan-form-container").removeClass('dokan-hide');
			
		},1000);
	}); 	
	
	//Account Migration Page 
	jQuery(".dps-pack-"+jQuery('select#dokan-subscription-pack').val()).addClass('selected');
	jQuery('.form-row.form-group.form-row-wide.dps-pack-wrappper .dps-pack').click(function(){
		jQuery('.form-row.form-group.form-row-wide.dps-pack-wrappper .dps-pack').removeClass('selected');
		jQuery(this).addClass('selected');
		var selected = jQuery(this).attr('class').split('dps-pack-')[1].split(' ')[0];
		jQuery('select#dokan-subscription-pack').val(selected);
	});
	
	// My account page menu
	jQuery('.my-account-menu-toggle').click(function(){
		jQuery(this).next().toggleClass('active');
	});
	
});
