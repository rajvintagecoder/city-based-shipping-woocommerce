jQuery('.alert').hide();
jQuery('.close').click(function(){
    jQuery('.alert').hide();
});

//Allow only number
function onlyNumberKey(evt) { 
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
        return false; 
    return true; 
} 

function fill_form_for_edit(id){
    jQuery('#vc_city').val(jQuery('#city_'+id).text());
    jQuery('#vc_delivery_fee').val(jQuery('#fee_'+id).text());
    jQuery('#vc_minimum_order').val(jQuery('#minorder_'+id).text());
    jQuery('#vc_id').val(id);
    jQuery('#vc_add_button').css('display','none');
    jQuery('#vc_update_button').css('display','block');
}

//fill Time slot data

function fill_timeslot_for_edit(id){
    jQuery('#city_id').css('display','none');
    jQuery('#vc_add_timeslot').css('display','none');
    jQuery('#vc_update_timeslot').css('display','block');
    jQuery('#city_name').css('display','block');
    jQuery('#city_name').val(jQuery('#slotcity_'+id).text());
    jQuery('#hidden_city_id').val(jQuery('#slotcity_'+id).attr('alt'));
    jQuery('#slot_id').val(id);
}

//fill city area form
function fill_cityarea_for_edit(id){
    jQuery('#vc_add_cityarea').css('display','none');
    jQuery('#vc_update_cityarea').css('display','block');
    jQuery('#city_area').val(jQuery('#areaname_'+id).text());
    jQuery('#city_id').css('display','none');
    jQuery('#city_id_update').css('display','block');
    jQuery('#city_area_id').val(id);
    var city_name = jQuery('#cityid_'+id).text();
    var city_id = jQuery('#cityid_'+id).attr('alt');
    jQuery('#set_cityid_update').text(city_name);
    jQuery('#set_cityid_update').attr('val',city_id);

}
//Fill city category form
function fill_assign_city_for_edit(id){
    jQuery('#visible_row').css('display','none');
    jQuery('#hidden_row').css('display','block');
    var city_name = jQuery('#cityid_'+id).text();
    var city_id = jQuery('#cityid_'+id).attr('alt');
    jQuery('#set_cityid_update').text(city_name);
    jQuery('#set_cityid_update').attr('val',city_id);
    var cate_name = jQuery('#category_'+id).text();
    var cate_id = jQuery('#category_'+id).attr('alt');
    jQuery('#set_hidden_city_update').text(cate_name);
    jQuery('#set_hidden_city_update').attr('val',cate_id);
    jQuery('#city_hidden_id').val(id);
}

// jQuery('.city_select').change(function(){
//     var city = jQuery(this).val();
//             jQuery.ajax({
//                 type : "post",
//                 url: vc_ajax_url.ajax_url,
//                 data : {
//                     action: "vc_get_area_on_checkout_page_load",
//                     city : city
//                 },
//                 success: function(response) {
//                     console.log('Hello World')
//                 }
//             });
// });