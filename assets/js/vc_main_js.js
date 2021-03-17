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
    jQuery('#visibleDiv').css('display','none');
    jQuery('#hiddenDiv').css('display','block');
    jQuery('#hvc_city').val(jQuery('#city_'+id).text());
    var strCate = jQuery('#strCate_'+id).text();
    if(strCate == ''){
        jQuery('#hiddeStrCateOption').text("Assign Strong Category... ");
        jQuery('#hiddeStrCateOption').attr('disabled','disabled');
    }else{
        jQuery('#hiddeStrCateOption').text(strCate);
        jQuery('#hiddeStrCateOption').attr('val',strCate);
    }
    
    jQuery('#vc_id').val(id);
  
}

//fill Time slot data

function fill_timeslot_for_edit(id){
    jQuery('#visibleTimeSlot').css('display','none');
    jQuery('#hiddenTimeSlot').css('display','block');
    jQuery('#slot_id').val(id);
    var cityName = jQuery('#slotcity_'+id).text();
    var cityID = jQuery('#slotcity_'+id).attr('alt');
    var timeslot = jQuery('#timeslot_'+id).text();
    jQuery('#timeUpFill').val(timeslot);
    jQuery('#timeUpFill').text(timeslot);
}  

//fill city area form
function fill_cityarea_for_edit(id){
    jQuery('#visibleRow').css('display','none');
    jQuery('#hiddenRow').css('display','block');
    var city_name = jQuery('#cityid_'+id).text();
    var city_id = jQuery('#cityid_'+id).attr('alt');
    jQuery('#hcityOption').text(city_name);
    jQuery('#hcityOption').attr('val',city_id);
    var times = jQuery('#times_'+id).text();
    jQuery('#htimesOptions').text(times);
    jQuery('#htimesOptions').attr('val',times);
    var areaName = jQuery('#areaname_'+id).text();
    var delivery = jQuery('#delivery_'+id).text();
    var minOrder = jQuery('#minorder_'+id).text();
    jQuery('#hcity_area').val(areaName);
    jQuery('#hdelivery_fee').val(delivery);
    jQuery('#hminimum_order').val(minOrder);
    jQuery('#city_area_id').val(id);
}
//Fill city category form
function fill_assign_city_for_edit(id){
    jQuery('#visible_row').css('display','none');
    jQuery('#hidden_row').css('display','block');
    var cate_name = jQuery('#cate_'+id).text();
    var cate_id = jQuery('#category_'+id).text();
    jQuery('#set_hidden_city_update').text(cate_name);
    jQuery('#set_hidden_city_update').attr('val',cate_id);
    jQuery('#city_hidden_id').val(id);
}

function fill_time_for_edit(id){
    jQuery('#addTimeRow').css('display','none');
    jQuery('#updateTimeRow').css('display','block');
    var timeTitle = jQuery('#timetitle_'+id).text();
    var timeFrom = jQuery('#timefrom_'+id).text();
    var timeTo = jQuery('#timeto_'+id).text();
    jQuery('#updateTimeID').val(id)
    jQuery('#updatedOtionTitle').val(timeTitle);
    jQuery('#updatedOtionTitle').text(timeTitle);
    jQuery('#updatedOtionFromTime').val(timeFrom);
    jQuery('#updatedOtionFromTime').text(timeFrom);
    jQuery('#updatedOtionToTime').val(timeTo);
    jQuery('#updatedOtionToTime').text(timeTo);

}