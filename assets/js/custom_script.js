jQuery(document).ready(function(){
    jQuery('#bbpress-forums li.bbp-body').paginathing({
        perPage: 5,
        prevNext: true,
        firstLast: true,
        prevText: '&laquo;',
        nextText: '&raquo;',
        firstText: 'First',
        lastText: 'Last',
        containerClass: 'pagination-container',
        ulClass: 'pagination',
        liClass: 'page',
        activeClass: 'active',
        disabledClass: 'disabled',
    });
});
// START module based categories selction for add new product
(function(jQuery) {
 
    var module = jQuery(".cstm-prod-add select[name*='prod_module']");
     
    if (module.length) {
        module.change(function() {
            jQuery('.cstm-loading').show();
            var jQuerythis = jQuery(this);
            
            get_categories(jQuery(this).val(), function(response) {
            
            var obj = JSON.parse(response);
            var len = obj.length;
            var jQueryModuleValues = '';
            
            // jQuery("select[name*='product_cat[]']").empty();
            // for (i = 0; i < len; i++) {
                // var myCategories = obj[i];
                // jQueryModuleValues += '<option value="'+myCategories.module_code+'">'+myCategories.module_code+'</option>';
            // }
            // jQuery("select[name*='product_cat[]']").append(response);
            jQuery("#product_cat").empty().append(response);
            
            });
            /* JSON populate Region/State Listbox */
        });
    }     
    function get_categories(moduleCODE, callback) {
     
        var data = {
            action: 'get_categories_call',
            module_code: moduleCODE
        };
        jQuery.post( ajaxurl, data, function(response) {
            // callback(response);
            jQuery("#product_cat").empty().append(response);
            jQuery('.cstm-loading').hide();
        });
    }
     
})(jQuery);
// END module based categories selction for add new product

// START module based categories selction for edit new product
(function(jQuery) {
 
    var module = jQuery(".cstm-prod-edit select[name*='prod_module']");
     
    if (module.length) {
        module.change(function() {
            jQuery('.cstm-loading').show();
            var jQuerythis = jQuery(this);
            var data_prod_id = jQuery(this).attr("data-prod-id");
            var data_prod_comission = jQuery(this).attr("data-prod-comission");
            
            get_categories(jQuery(this).val(), data_prod_id, data_prod_comission, function(response) {
            
            var obj = JSON.parse(response);
            var len = obj.length;
            var jQueryModuleValues = '';
            
            // jQuery("select[name*='product_cat[]']").empty();
            // for (i = 0; i < len; i++) {
                // var myCategories = obj[i];
                // jQueryModuleValues += '<option value="'+myCategories.module_code+'">'+myCategories.module_code+'</option>';
            // }
            // jQuery("select[name*='product_cat[]']").append(response);
            jQuery("#product_cat").empty().append(response);
            
            });
            /* JSON populate Region/State Listbox */
        });
    }     
    function get_categories(moduleCODE, data_prod_id, data_prod_comission, callback) {
     
        var data = {
            action: 'get_categories_call',
            module_code: moduleCODE,
            data_prod_id: data_prod_id,
            data_prod_comission: data_prod_comission
        };
        jQuery.post( ajaxurl, data, function(response) {
            // callback(response);
            jQuery("#product_cat").empty().append(response);
            jQuery('.cstm-loading').hide();
        });
    }
     
})(jQuery);
// add active class to active menu at dokan vendor dashboard
jQuery(function(){
    var current = location.pathname;
    var cstmsiteurl = jQuery('.cstm-site-url').text();
    jQuery('#dokan-navigation .dokan-dashboard-menu li a').each(function(){
        var $this = jQuery(this);
        // if the current path is like this link, make it active
        if(current == '/dashboard/phive_booking/'){
            jQuery('#dokan-navigation li.bookings').addClass('active');
        }
        else if(current == '/dashboard/phive_booking/edit/'){
            jQuery('#dokan-navigation li.bookings').addClass('active');
        }
        else if(current == '/dashboard/phive_booking/new-product/'){
            jQuery('#dokan-navigation li.bookings').addClass('active');
        }
        else if(current == '/dashboard/new-auction-product/'){
            jQuery('#dokan-navigation li.auctions').addClass('active');
        }
        else if(current == '/dashboard/auction/'){
            jQuery('#dokan-navigation li.auctions').addClass('active');
        }
    })
})
// END module based categories selction for edit new product

jQuery.validator.addMethod("email2", 
    function(value, element) {
        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
    }, 
    "Please enter a valid email address"
);

// jQuery.validator.addMethod("pwcheck", function(value) {
//     return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
//         && /[a-z]/.test(value) // has a lowercase letter
//         && /\d/.test(value) // has a digit
//  });

jQuery("#ts-login-form").validate({
    rules: {
        'log': {
            required: {
                depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                }
            }
        },
        'pwd': {
            required: {
                depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                }
            }
        },
    },
    messages: {
        'log': {
            required: 'Please enter username',
        },
        'pwd': {
            required: 'Please enter password',
        },
    }
});
jQuery(".woocommerce-form-login").validate({
    rules: {
        'username': {
            required: {
                depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                }
            }
        },
        'password': {
            required: {
                depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                }
            }
        },
    },
    messages: {
        'username': {
            required: 'Please enter username or email address',
        },
        'password': {
            required: 'Please enter password',
        },
    }
});

jQuery("#dokan-product-enquiry").validate({
    rules: {
        'author': {
            required: {
                depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                }
            }  
        },
        'email': {
            required: true,
        },
        'enq_message': {
            required: {
                depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                }
            }  
        }
        
    },
    messages: {
        'author': {
            required: 'Please enter your name',
        },
        'email': {
            required: 'Please enter your email',
        },
        'enq_message': {
            required: 'Please enter details about your enquiry',
        }
    },
    // success: function (label, element) {
        
    // },
    // invalidHandler: function(event, validator) {
    //     var errors = validator.numberOfInvalids();
    //     if (!errors) {
    //         jQuery('#dokan-product-enquiry #name').val(''); 
    //     }    
    // }
});
jQuery(".lost_reset_password").validate({
    rules: {
        'user_login': {
            required: true
        },
    },
    messages: {
        'user_login': {
            required: 'Please enter username or email address',
        },
    },
    success: function (label, element) {
        jQuery('.lost_reset_password .woocommerce-Button').prop('disabled', false); 
    },
    invalidHandler: function(event, validator) {
        jQuery('.lost_reset_password .woocommerce-Button').prop('disabled', false); 
    }
});

setTimeout(function() {
    jQuery('.dokan-message').fadeOut();
    jQuery('.woocommerce-message').fadeOut();    
}, 10000 );

function fadeoutFunction(){
    jQuery('.alert-success').fadeOut();
}

jQuery(document).ready(function(){
    setInterval("fadeoutFunction()", 6000);
});

jQuery('#user_login22').on('blur', function() {
    if (jQuery("#myform").valid()) {
        jQuery('.lost_reset_password .woocommerce-Button').prop('disabled', false);  
    } else {
        jQuery('.lost_reset_password .woocommerce-Button').prop('disabled', false);
    }
});

jQuery(".woocommerce-form-register").validate({
    rules: {
        'billing_first_name': {
            required: {
                depends: function() {
                    jQuery(this).val(jQuery(this).val().trimStart());
                    return true;
                }
            }
        },
        'billing_last_name': {
            // required: {
            //     depends: function() {
            //         jQuery(this).val(jQuery(this).val().trimStart());
            //         return true;
            //     }
            // }
            required: true
        },
        'email': {
            required: true,
            // email2: true
        },
        'password': {
            required: true
        },
    },
    messages: {
        'billing_first_name': {
            required: 'Please enter first name',
        },
        'billing_last_name': {
            required: 'Please enter last name',
        },
        'email': {
            required: 'Please enter email address',
        },
        'password': {
            required: 'Please enter password',
        },
    },
});

jQuery(function(){
    // jQuery(".woocommerce-form-register").validate();    
    // jQuery("#cstmRegiForm").on('submit', function(e) {
        
        // var isvalid = jQuery("#cstmRegiForm").valid();
        // if (isvalid  == false) {
            // e.preventDefault();
            // alert('not valid');
            // alert(getvalues("myform"));
        // }else{
            // alert('valid');
            // jQuery("#cstmRegiForm").submit();
        // }
    // });
});