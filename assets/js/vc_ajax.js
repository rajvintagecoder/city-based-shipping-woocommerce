

//Add new City Ajax Call
    function vc_add_city_ajax() {
        jQuery('#errorDelete').css('display','none');
        var vc_city = jQuery('#vc_city').val();
        var vc_delivery_fee = jQuery('#vc_delivery_fee').val();
        var vc_minimum_order = jQuery('#vc_minimum_order').val();
        var isValid = true;
        if(vc_city.length == 0 || vc_delivery_fee.length == 0 || vc_minimum_order.length == 0){
            isValid = false;
            jQuery('.alert').show();
     }
        if(isValid){
            jQuery('.alert').hide();
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            // dataType: 'JSON',
            data: {
                action: 'vc_add_city_ajax_action',
                city: vc_city,
                delivery_fee: vc_delivery_fee,
                minimum_order: vc_minimum_order,

            },
            success: function (data) {
                jQuery('#vc_city').val('');
               jQuery('#vc_delivery_fee').val('');
               jQuery('#vc_minimum_order').val('');
               jQuery('#vc_tableBody').html(data);
               jQuery('.alert').hide();
            }
        });
         }
    }
//update city ajax call
    function vc_update_city_ajax() {
        var vc_city = jQuery('#vc_city').val();
        var vc_delivery_fee = jQuery('#vc_delivery_fee').val();
        var vc_minimum_order = jQuery('#vc_minimum_order').val();
        var vc_id = jQuery('#vc_id').val();
        var isValid = true;
        if(vc_city.length == 0 || vc_delivery_fee.length == 0 || vc_minimum_order.length == 0){
            isValid = false;
            jQuery('.alert').show();
        }
        if(isValid){
            jQuery('.alert').hide();
                jQuery.ajax({
                    url: vc_ajax_url.ajax_url,
                    type: 'post',
                    // dataType: 'JSON',
                    data: {
                        action: 'vc_update_city_ajax',
                        city: vc_city,
                        delivery_fee: vc_delivery_fee,
                        minimum_order: vc_minimum_order,
                        id: vc_id,
                    },
                    success: function (data) {
                    jQuery('#vc_tableBody').html(data);
                    jQuery('#vc_add_button').css('display','block');
                    jQuery('#vc_update_button').css('display','none');
                    jQuery('#vc_city').val('');
                    jQuery('#vc_delivery_fee').val('');
                    jQuery('#vc_minimum_order').val('');
                    jQuery('#vc_id').val('id');
                    }
                });
        }
    }

    //Delete city ajax call
    function vc_delete_city_ajax(id) {
        var vc_id = id;
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_delete_city_ajax',  
                id: vc_id,
            },
            success: function (data) {
               jQuery('#vc_tableBody').html(data);
               jQuery('#errorDelete').css('display','block');
               jQuery('.alert').hide();
            }
        });
    }

//Add time
function vc_add_times_ajax(){
    var timeTitle = jQuery('#timetitle').val();
    var fromTime = jQuery('#fromtime').val();
    var toTime = jQuery('#totimes').val();

    var isValid = true;
    if(timeTitle == null || fromTime == null || toTime == null){
        isValid = false;
    }
    if(isValid){
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_add_times_action',
                timeTitle: timeTitle,
                fromTime: fromTime,
                toTime: toTime
            },
            success: function(data){
                jQuery('#timeTbody').html(data);
                jQuery('#timetitle').prop('selectedIndex',0);
                jQuery('#fromtime').prop('selectedIndex',0);
                jQuery('#totimes').prop('selectedIndex',0);
            }
        });
    }
}

function vc_update_times_ajax(){
    var timeTitle = jQuery('#timetitleup').val();
    var fromTime = jQuery('#fromtimeup').val();
    var toTime = jQuery('#totimesup').val();
    var id = jQuery('#updateTimeID').val();
    var isValid = true;
    if(timeTitle == null || fromTime == null || toTime == null){
        isValid = false;
    }
    if(isValid){
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_update_times_action',
                timeTitle: timeTitle,
                fromTime: fromTime,
                toTime: toTime,
                id:id
            },
            success: function(data){
                jQuery('#timeTbody').html(data);
                jQuery('#addTimeRow').css('display','block');
                jQuery('#updateTimeRow').css('display','none');
                jQuery('#timetitle').prop('selectedIndex',0);
                jQuery('#fromtime').prop('selectedIndex',0);
                jQuery('#totimes').prop('selectedIndex',0);
            }
        });
    }
}

//Delete time ajax call
function vc_delete_time_ajax(id) {
    var vc_id = id;
    jQuery.ajax({
        url: vc_ajax_url.ajax_url,
        type: 'post',
        data: {
            action: 'vc_delete_time_ajax',  
            id: vc_id,
        },
        success: function (data) {
            jQuery('#timeTbody').html(data);
            jQuery('#timetitle').prop('selectedIndex',0);
            jQuery('#fromtime').prop('selectedIndex',0);
            jQuery('#totimes').prop('selectedIndex',0);
        }
    });
}








    //add time slots

    function vc_add_timeslot_ajax(){
        var cityId = jQuery('#city_id').val();
        var timeslot = jQuery('#timeslots').val();
        var isValid = true;
        if(cityId.length == 0 || timeslot.length == 0){
            isValid = false;
            alert("All fields are required");
        }
        if(isValid){
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_add_timeslot_ajax_action',
                cityId: cityId,
                timeslot: timeslot,
            },
            success: function(data){
                jQuery('#timeslotTbody').html(data);  
                jQuery('#city_id').prop('selectedIndex',0);        
                jQuery('#timeslots').prop('selectedIndex',0);   
                     
            }
        });
        }
    }

    //Update timeslot

    function vc_update_timeslot_ajax(){
        var cityId = jQuery('#city_idup').val();
        var timeslot = jQuery('#timeslotsup').val();
        var id = jQuery('#slot_id').val();
        var isValid = true;
        if(cityId.length == 0 || timeslot.length == 0){
            isValid = false;
            alert("All fields are required");
        }
        if(isValid){
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_update_timeslot_ajax_action',
                cityId: cityId,
                timeslot: timeslot,
                id:id,
            },
            success: function(data){
                jQuery('#timeslotTbody').html(data);  
                jQuery('#visibleTimeSlot').css('display','block');
                jQuery('#hiddenTimeSlot').css('display','none');  
                jQuery('#city_id').prop('selectedIndex',0);        
                jQuery('#timeslots').prop('selectedIndex',0); 
        
            }
        });
        }

    }

    //Delete time ajax call
    function vc_delete_timeslot_ajax(id) {
        var vc_id = id;
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_delete_timeslot_ajax',  
                id: vc_id,
            },
            success: function (data) {
                jQuery('#timeslotTbody').html(data);
            }
        });
    }

    //Add City area ajax call

    function vc_add_cityarea_ajax(){
        var cityId = jQuery('#city_id').val();
        var areaName = jQuery('#city_area').val();
        var isValid = true;
        if(cityId.length == 0 || areaName.length == 0){
            isValid = false;
            alert("All fields are required");
        }
        if(isValid){
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_add_cityarea_ajax_action',
                cityId: cityId,
                areaName: areaName,
            },
            success: function(data){
                jQuery('#cityAreaTbody').html(data);  
                jQuery('#city_id').prop('selectedIndex',0);        
                jQuery('#city_area').val('');  
                     
            }
        });
        }
    }

//Update city area ajax call

function vc_update_cityarea_ajax(){
        var cityId = jQuery('#city_id_update').val();
        var areaName = jQuery('#city_area').val();
        var id = jQuery('#city_area_id').val()    
        var isValid = true;
        if(cityId.length == 0 || areaName.length == 0){
            isValid = false;
            alert("All fields are required");
        }
        if(isValid){
            jQuery.ajax({
                url: vc_ajax_url.ajax_url,
                type: 'post',
                data: {
                    action: 'vc_update_cityarea_ajax_action',
                    cityId: cityId,
                    areaName: areaName,
                    id:id,
                },
                success: function(data){
                    jQuery('#cityAreaTbody').html(data);  
                    jQuery('#city_id').css('display','block');
                    jQuery('#city_id_update').css('display','none');
                    jQuery('#vc_add_cityarea').css('display','block');
                    jQuery('#vc_update_cityarea').css('display','none');
                    jQuery('#city_id').prop('selectedIndex',0);        
                    jQuery('#city_area').val('');  
                         
                }
            });
            }
}

    //Delete city area ajax call
    function vc_delete_cityarea_ajax(id) {
        var vc_id = id;
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_delete_cityarea_ajax',  
                id: vc_id,
            },
            success: function (data) {
                jQuery('#cityAreaTbody').html(data);
            }
        });
    }
   
    
    //Assign city category ajax call

    function vc_assign_city_ajax( ){
        var cityId = jQuery('#city_id').val();
        var categoryId = jQuery('#category_id').val();
        var isValid = true;
        if(cityId.length == 0 || categoryId.length == 0){
            isValid = false;
            alert("All fields are required");
        }
       
;        if(isValid){
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_add_assign_category_ajax_action',
                cityId: cityId,
                categoryId: categoryId,
            },
            success: function(data){
                jQuery('#cityCategoryTbody').html(data);  
                jQuery('#city_id').prop('selectedIndex',0);        
                jQuery('#category_id').prop('selectedIndex',0);   
                     
            }
         });
        }
    }

    //Update Assign city category ajax call

    function vc_update_assigned_city_ajax( ){
        var cityId = jQuery('#city_hidden_update').val();
        var categoryId = jQuery('#category_hidden_id').val();
        var id = jQuery('#city_hidden_id').val();
        var isValid = true;
        if(cityId == null || categoryId == null){
            isValid = false;
            alert("All fields are required");
        }
      
;        if(isValid){
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_update_assign_category_ajax_action',
                cityId: cityId,
                categoryId: categoryId,
                id:id,
            },
            success: function(data){
                jQuery('#cityCategoryTbody').html(data);  
                jQuery('#city_id').prop('selectedIndex',0);        
                jQuery('#category_id').prop('selectedIndex',0);   
                jQuery('#visible_row').css('display','block');
                jQuery('#hidden_row').css('display','none');
            }
         });
        }
    }

    //delete assigned category

    //Delete time ajax call
    function vc_delete_assign_city_ajax(id) {
        var vc_id = id;
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_delete_assigned_category_ajax',  
                id: vc_id,
            },
            success: function (data) {
                jQuery('#cityCategoryTbody').html(data);  
                jQuery('#city_id').prop('selectedIndex',0);        
                jQuery('#category_id').prop('selectedIndex',0);   
            }
        });
    }


    jQuery(document).on('change','.city_select', function(){
    // jQuery('.city_select').change(function(){
        var cityid = jQuery(this).val();
        console.log(cityid);
        jQuery.ajax({
            url: vc_ajax_url.ajax_url,
            type: 'post',
            // dataType: 'json',
            data: {
                action: 'vc_get_area_on_checkout_page_load',  
                cityid: cityid,
            },
            beforeSend: function(){
                jQuery("#loader").css('display','block');
            },
            success: function (data) {
                jQuery('.area_select').html(data);
                // jQuery('.shipping_city_select').html(data.cities);
                cityid = '';
            },
            complete: function(){
                jQuery("#loader").css('display','none');
            }
        });
        var time = new Date();
      
        var sysTime =   time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })
      
        jQuery.ajax({

            url: vc_ajax_url.ajax_url,
            type: 'post',
            data: {
                action: 'vc_get_timeslots_on_checkout_page',  
                cityid: cityid,
                sysTime: sysTime,
            },
            success: function (data) {
                jQuery('.timeslot_select').html(data);
            }
        });
    });

    jQuery('#shippingCalculator').change(function(){
        var city = jQuery(this).val();
        jQuery('#calc_shipping_city').val(city);
    });


