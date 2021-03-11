<?php
//Ajax Request for Adding new city
function vc_add_city_ajax_action()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_cities_group";
    $city = $_POST['city'];
    $delivery_fee = $_POST['delivery_fee'];
    $minimum_order = $_POST['minimum_order'];
    $wpdb->insert($table_name,
        array('city' =>$city,'delivery_fee' => $delivery_fee, 'minimum_order' => $minimum_order)
    );
    $totalCity = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`",OBJECT);
    $htmlContent = '';
    foreach($totalCity as $city){
        $htmlContent .="<tr><td><span id='city_{$city->id}'>{$city->city}</span></td><td><span id='fee_{$city->id}'>{$city->delivery_fee}</span></td><td><span id='minorder_{$city->id}'>{$city->minimum_order}</span></td><td><button alt='{$city->id}' type='button' class='btn btn-sm btn-primary my-btn-edit mr-4' onclick='fill_form_for_edit({$city->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
        </button><button alt='{$city->id}' type='button' class='btn btn-sm btn-danger my-btn-delete' onclick='vc_delete_city_ajax({$city->id})'><i class='fa fa-remove' aria-hidden='true'></i>
        </button></td></tr>";
    }
    echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_add_city_ajax_action', 'vc_add_city_ajax_action');
add_action('wp_ajax_nopriv_vc_add_city_ajax_action', 'vc_add_city_ajax_action');

//Ajax Request for Adding new city
function vc_update_city_ajax()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_cities_group";
    $city = $_POST['city'];
    $delivery_fee = $_POST['delivery_fee'];
    $minimum_order = $_POST['minimum_order'];
    $id = $_POST['id'];

    $wpdb->update($table_name, array(
        'city' =>$city,
        'delivery_fee' => $delivery_fee,
        'minimum_order' => $minimum_order,
    ), array('id' => $id));
    $totalCity = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`",OBJECT);
    $htmlContent = '';
    foreach($totalCity as $city){
        $htmlContent .="<tr><td><span id='city_{$city->id}'>{$city->city}</span></td><td><span id='fee_{$city->id}'>{$city->delivery_fee}</span></td><td><span id='minorder_{$city->id}'>{$city->minimum_order}</span></td><td><button alt='{$city->id}' type='button' class='btn btn-sm btn-primary my-btn-edit mr-4' onclick='fill_form_for_edit({$city->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
        </button><button alt='{$city->id}' type='button' class='btn btn-sm btn-danger my-btn-delete' onclick='vc_delete_city_ajax({$city->id})'><i class='fa fa-remove' aria-hidden='true'></i>
        </button></td></tr>";
    }
    echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_update_city_ajax', 'vc_update_city_ajax');
add_action('wp_ajax_nopriv_vc_update_city_ajax', 'vc_update_city_ajax');


//Ajax Request for Adding new city
function vc_delete_city_ajax()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_cities_group";
    $timeslot_table = $wpdb->prefix . "vc_time_slots";
    $cityarea_table = $wpdb->prefix ."vc_city_areas";
    $category_table = $wpdb->prefix ."vc_city_categories";
    $id = $_POST['id'];

    $wpdb->delete($table_name, array('id' => $id));
    $wpdb->delete($timeslot_table, array('city_id' => $id));
    $wpdb->delete($cityarea_table, array('city_id' => $id));
    $wpdb->delete($category_table, array('city_id' => $id));
    $totalCity = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`",OBJECT);
    $htmlContent = '';
    foreach($totalCity as $city){
        $htmlContent .="<tr><td><span id='city_{$city->id}'>{$city->city}</span></td><td><span id='fee_{$city->id}'>{$city->delivery_fee}</span></td><td><span id='minorder_{$city->id}'>{$city->minimum_order}</span></td><td><button alt='{$city->id}' type='button' class='btn btn-sm btn-primary my-btn-edit mr-4' onclick='fill_form_for_edit({$city->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
        </button><button alt='{$city->id}' type='button' class='btn btn-sm btn-danger my-btn-delete' onclick='vc_delete_city_ajax({$city->id})'><i class='fa fa-remove' aria-hidden='true'></i>
        </button></td></tr>";
    }
    echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_delete_city_ajax', 'vc_delete_city_ajax');
add_action('wp_ajax_nopriv_vc_delete_city_ajax', 'vc_delete_city_ajax');

// Add Times T1-T12
function vc_add_times_action()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_times";
    $timeTitle = $_POST['timeTitle'];
    $fromTime = $_POST['fromTime'];
    $toTime = $_POST['toTime'];
    $wpdb->insert($table_name,
        array('time_title' => $timeTitle,'from_time' => $fromTime, 'to_time' => $toTime)
    );
    $times = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
    $htmlContent = '';
    foreach ($times as $time){
     $htmlContent .="<tr>
             <td><span id='timetitle_{$time->id}' alt='{$time->id}'>{$time->time_title}</span></td>
        <td><span id='timefrom_{$time->id}' >{$time->from_time}</span></td>
        <td><span id='timeto_{$time->id}' >{$time->to_time}</span></td>
        <td><button alt='$time->id' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_time_for_edit({$time->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$time->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_time_ajax({$time->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button>
          </td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();
}

add_action('wp_ajax_vc_add_times_action', 'vc_add_times_action');
add_action('wp_ajax_nopriv_vc_add_times_action', 'vc_add_times_action');


// Update Times T1-T12
function vc_update_times_action()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_times";
    $timeTitle = $_POST['timeTitle'];
    $fromTime = $_POST['fromTime'];
    $toTime = $_POST['toTime'];
    $id = $_POST['id'];

    $wpdb->update($table_name, array(
        'time_title' =>$timeTitle,
        'from_time' => $fromTime,
        'to_time' => $toTime,
    ), array('id' => $id));
    $times = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
    $htmlContent = '';
    foreach ($times as $time){
     $htmlContent .="<tr>
        <td><span id='timetitle_{$time->id}' alt='{$time->id}'>{$time->time_title}</span></td>
        <td><span id='timefrom_{$time->id}' >{$time->from_time}</span></td>
        <td><span id='timeto_{$time->id}' >{$time->to_time}</span></td>
        <td><button alt='$time->id' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_time_for_edit({$time->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$time->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_time_ajax({$time->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button>
          </td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();
}

add_action('wp_ajax_vc_update_times_action', 'vc_update_times_action');
add_action('wp_ajax_nopriv_vc_update_times_action', 'vc_update_times_action');

function vc_delete_time_ajax()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_times";
    $id = $_POST['id'];
    $wpdb->delete($table_name, array('id' => $id));
    $totalCity = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`",OBJECT);
    $times = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
    $htmlContent = '';
    foreach ($times as $time){
     $htmlContent .="<tr>
        <td><span id='timetitle_{$time->id}' alt='{$time->id}'>{$time->time_title}</span></td>
        <td><span id='timefrom_{$time->id}' >{$time->from_time}</span></td>
        <td><span id='timeto_{$time->id}' >{$time->to_time}</span></td>
        <td><button alt='$time->id' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_time_for_edit({$time->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$time->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_time_ajax({$time->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button>
          </td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_delete_time_ajax', 'vc_delete_time_ajax');
add_action('wp_ajax_nopriv_vc_delete_time_ajax', 'vc_delete_time_ajax');

//add timeslot ajax

function vc_add_timeslot_ajax_action(){
    global $wpdb;
    $table_name = $wpdb->prefix . "vc_time_slots";
    $cityId = $_POST['cityId'];
    $timeSlot = $_POST['timeslot'];
    $wpdb->insert($table_name, array('city_id' => $cityId,'time_slot' => $timeSlot, 'city' =>getCityName($cityId)));
    $timeSlots = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT);
    $htmlContent = '';
    foreach ($timeSlots as $timeslot){
        $cityname = getCityName($timeslot->city_id);
        $htmlContent .= "<tr><td><span id='slotcity_{$timeslot->id}'  alt='{$timeslot->city_id}'>{$cityname}</span></td>
        <td><span id='timeslot_{$timeslot->id}'>{$timeslot->time_slot}</span></td>
        <td><button alt='{$timeslot->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_timeslot_for_edit({$timeslot->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$timeslot->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_timeslot_ajax({$timeslot->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
     }
     echo $htmlContent;
    wp_die();
}
add_action('wp_ajax_vc_add_timeslot_ajax_action', 'vc_add_timeslot_ajax_action');
add_action('wp_ajax_nopriv_vc_add_timeslot_ajax_action', 'vc_add_timeslot_ajax_action');

//update time slot

//Ajax Request for Adding new city
function vc_update_timeslot_ajax_action()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "vc_time_slots";
    $cityId = $_POST['cityId'];
    $timeslot = $_POST['timeslot'];
    $id = $_POST['id'];
    $wpdb->update($table_name, array(
        'city_id' =>$cityId,
        'time_slot' => $timeslot,
        'city' => getCityName($cityId)
    ), array('id' => $id));

    $timeSlots = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT);
    $htmlContent = '';
    foreach ($timeSlots as $timeslot){
        $cityname = getCityName($timeslot->city_id);
        $htmlContent .= "<tr><td><span id='slotcity_{$timeslot->id}'  alt='{$timeslot->city_id}'>{$cityname}</span></td>
        <td><span id='timeslot_{$timeslot->id}'>{$timeslot->time_slot}</span></td>
        <td><button alt='{$timeslot->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_timeslot_for_edit({$timeslot->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$timeslot->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_timeslot_ajax({$timeslot->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
     }
     echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_update_timeslot_ajax_action', 'vc_update_timeslot_ajax_action');
add_action('wp_ajax_nopriv_vc_update_timeslot_ajax_action', 'vc_update_timeslot_ajax_action');

//Delete timeslot ajax call

function vc_delete_timeslot_ajax()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "vc_time_slots";
    
    $id = $_POST['id'];

    $wpdb->delete($table_name, array('id' => $id));
    $timeSlots = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT);
    $htmlContent = '';
    foreach ($timeSlots as $timeslot){
        $cityname = getCityName($timeslot->city_id);
        $htmlContent .= "<tr><td><span id='slotcity_{$timeslot->id}' alt='{$timeslot->city_id}'>{$cityname}</span></td>
        <td><span id='timeslot_{$timeslot->id}' >{$timeslot->time_slot}</span></td>
        <td><button alt='{$timeslot->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_timeslot_for_edit({$timeslot->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$timeslot->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_timeslot_ajax({$timeslot->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
     }
     echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_delete_timeslot_ajax', 'vc_delete_timeslot_ajax');
add_action('wp_ajax_nopriv_vc_delete_timeslot_ajax', 'vc_delete_timeslot_ajax');

//Add City Areas Ajax Call
function vc_add_cityarea_ajax_action()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_city_areas";
    $cityId = $_POST['cityId'];
    $areaName = $_POST['areaName'];
    $wpdb->insert($table_name,
        array('city_id' =>$cityId,'area_name' => $areaName,'city' =>getCityName($cityId))
    );
    $cityAreas = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
   
    $htmlContent = '';
    foreach ($cityAreas as $cityarea){
        $cityname = getCityName($cityarea->city_id);
        $htmlContent .="<tr>
        <td><span id='cityid_{$cityarea->id}' alt='{$cityarea->city_id}'>{$cityname}</span></td>
        <td><span id='areaname_{$cityarea->id}' >{$cityarea->area_name}</span></td>
        <td><button alt={$cityarea->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_cityarea_for_edit({$cityarea->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$cityarea->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_cityarea_ajax({$cityarea->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_add_cityarea_ajax_action', 'vc_add_cityarea_ajax_action');
add_action('wp_ajax_nopriv_vc_add_cityarea_ajax_action', 'vc_add_cityarea_ajax_action');


//Update City Areas Ajax Call
function vc_update_cityarea_ajax_action()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_city_areas";
    $cityId = $_POST['cityId'];
    $areaName = $_POST['areaName'];
    $id = $_POST['id'];
    $wpdb->update($table_name, array('city_id' =>$cityId,'area_name' => $areaName,'city' =>getCityName($cityId)), array('id' => $id));
    $cityAreas = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
   
    $htmlContent = '';
    foreach ($cityAreas as $cityarea){
        $cityname = getCityName($cityarea->city_id);
        $htmlContent .="<tr>
        <td><span id='cityid_{$cityarea->id}' alt='{$cityarea->city_id}'>{$cityname}</span></td>
        <td><span id='areaname_{$cityarea->id}' >{$cityarea->area_name}</span></td>
        <td><button alt={$cityarea->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_cityarea_for_edit({$cityarea->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$cityarea->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_cityarea_ajax({$cityarea->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_update_cityarea_ajax_action', 'vc_update_cityarea_ajax_action');
add_action('wp_ajax_nopriv_vc_update_cityarea_ajax_action', 'vc_update_cityarea_ajax_action');

//Delete city area ajax call

function vc_delete_cityarea_ajax()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_city_areas";
    
    $id = $_POST['id'];

    $wpdb->delete($table_name, array('id' => $id));
    $cityAreas = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
   
    $htmlContent = '';
    foreach ($cityAreas as $cityarea){
        $cityname = getCityName($cityarea->city_id);
        $htmlContent .="<tr>
        <td><span id='cityid_{$cityarea->id}' alt='{$cityarea->city_id}'>{$cityname}</span></td>
        <td><span id='areaname_{$cityarea->id}' >{$cityarea->area_name}</span></td>
        <td><button alt={$cityarea->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_cityarea_for_edit({$cityarea->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$cityarea->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_cityarea_ajax({$cityarea->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_delete_cityarea_ajax', 'vc_delete_cityarea_ajax');
add_action('wp_ajax_nopriv_vc_delete_cityarea_ajax', 'vc_delete_cityarea_ajax');

//Assign Category Ajax Call
function vc_add_assign_category_ajax_action()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_city_categories";
    $cityId = $_POST['cityId'];
    $categoryId = $_POST['categoryId'];
    $wpdb->insert($table_name,
        array('city_id' =>$cityId,'category_id' => $categoryId, 'city' =>getCityName($cityId))
    );
    $categories = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
   
    $htmlContent = '';
    foreach ($categories as $cate){
        $cityname = getCityName($cate->city_id);
        $catename = getCateName($cate->category_id);
        $htmlContent .="<tr>
        <td><span id='cityid_{$cate->id}' alt='{$cate->city_id}'>{$cityname}</span></td>
        <td><span id='category_{$cate->id}' alt='{$cate->category_id}'>{$catename}</span></td>
        <td><button alt={$cate->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_assign_city_for_edit({$cate->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$cate->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_assign_city_ajax({$cate->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();

}
add_action('wp_ajax_vc_add_assign_category_ajax_action', 'vc_add_assign_category_ajax_action');
add_action('wp_ajax_nopriv_vc_add_assign_category_ajax_action', 'vc_add_assign_category_ajax_action');

//Assign Category Ajax Call
function vc_update_assign_category_ajax_action()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_city_categories";
    $cityId = $_POST['cityId'];
    $categoryId = $_POST['categoryId'];
    $id = $_POST['id'];
    $wpdb->update($table_name, array('city_id' =>$cityId,'category_id' => $categoryId,'city' =>getCityName($cityId)), array('id' => $id));
    $categories = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
   
    $htmlContent = '';
    foreach ($categories as $cate){
        $cityname = getCityName($cate->city_id);
        $catename = getCateName($cate->category_id);
        $htmlContent .="<tr>
        <td><span id='cityid_{$cate->id}' alt='{$cate->city_id}'>{$cityname}</span></td>
        <td><span id='category_{$cate->id}' alt='{$cate->category_id}'>{$catename}</span></td>
        <td><button alt={$cate->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_assign_city_for_edit({$cate->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$cate->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_assign_city_ajax({$cate->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();

}
add_action('wp_ajax_vc_update_assign_category_ajax_action', 'vc_update_assign_category_ajax_action');
add_action('wp_ajax_nopriv_vc_update_assign_category_ajax_action', 'vc_update_assign_category_ajax_action');

//Delete assigned category
function vc_delete_assigned_category_ajax()
{
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_city_categories";
    
    $id = $_POST['id'];

    $wpdb->delete($table_name, array('id' => $id));
    $categories = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
   
    $htmlContent = '';
    foreach ($categories as $cate){
        $cityname = getCityName($cate->city_id);
        $catename = getCateName($cate->category_id);
        $htmlContent .="<tr>
        <td><span id='cityid_{$cate->id}' alt='{$cate->city_id}'>{$cityname}</span></td>
        <td><span id='category_{$cate->id}' alt='{$cate->category_id}'>{$catename}</span></td>
        <td><button alt={$cate->id}' type='button' class='btn btn-sm btn-primary mr-4' onclick='fill_assign_city_for_edit({$cate->id})'><i class='fa fa-pencil' aria-hidden='true'></i>
          </button><button alt='{$cate->id}' type='button' class='btn btn-sm btn-danger' onclick='vc_delete_assign_city_ajax({$cate->id})'><i class='fa fa-remove' aria-hidden='true'></i>
          </button></td>
        </tr>";
    }
    echo $htmlContent;
    wp_die();

}

add_action('wp_ajax_vc_delete_assigned_category_ajax', 'vc_delete_assigned_category_ajax');
add_action('wp_ajax_nopriv_vc_delete_assigned_category_ajax', 'vc_delete_assigned_category_ajax');

//City area based on city on checkout page

function vc_get_area_on_checkout_page_load(){
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_city_areas";
    $table_cities = $wpdb->prefix ."vc_cities_group";
    $cityid = $_POST['cityid'];
    $htmlContent = '';
    $htmlContentCities = '';
    $allCities = $wpdb->get_results("SELECT * FROM $table_cities", OBJECT);

    // foreach($allCities as $ac){
    //     if($ac->id){
    //         $htmlContentCities .= "<option value='{$ac->city}' selected>{$ac->city}</option>";
    //     }else{
    //         $htmlContentCities .= "<option value='{$ac->city}'>{$ac->city}</option>";
    //     }
    // }

    $cityAreas = $wpdb->get_results("SELECT * FROM $table_name WHERE `city` = '{$cityid}' ", OBJECT); 
     foreach($cityAreas as $ca){
            $htmlContent .= "<option value='{$ca->area_name}'>{$ca->area_name}</option>";
        }
    echo $htmlContent;
    wp_die();
}

add_action('wp_ajax_vc_get_area_on_checkout_page_load', 'vc_get_area_on_checkout_page_load');
add_action('wp_ajax_nopriv_vc_get_area_on_checkout_page_load', 'vc_get_area_on_checkout_page_load');


function vc_get_timeslots_on_checkout_page(){
    global $wpdb;
    $timeslots = $wpdb->prefix . "vc_time_slots";
  
    $cityid = $_POST['cityid'];
    $sysTime  = $_POST['sysTime'];
    $htmlContent = '';
    
    $timeslotsAreas = $wpdb->get_results("SELECT * FROM $timeslots WHERE `city` = '{$cityid}' ", OBJECT);
    foreach($timeslotsAreas as $ta){
        if(strtotime($ta->time_slot) >= strtotime($sysTime)){
        $htmlContent .= "<option value='{$ta->id}'>{$ta->time_slot}</option>";
        }
    }
    if(!empty($htmlContent)){
        echo $htmlContent;
    }else{
        echo $htmlContent = "<option value='You will recieve your order towmorrow after {$timeslotsAreas[0]->time_slot}'>You will recieve your order towmorrow on {$timeslotsAreas[0]->time_slot}</option>";
       
    }
   
    die();
} 


add_action('wp_ajax_vc_get_timeslots_on_checkout_page', 'vc_get_timeslots_on_checkout_page');
add_action('wp_ajax_nopriv_vc_get_timeslots_on_checkout_page', 'vc_get_timeslots_on_checkout_page');

function vc_get_cities_on_checkout_page_load(){
    global $wpdb;
    $table_name = $wpdb->prefix ."vc_cities_group";
    $htmlContent = '';
    $cities = $wpdb->get_results("SELECT * FROM $table_name ", OBJECT); 
           foreach($cities as $ca){
            $htmlContent .= "<option value='{$ca->city}' alt='{$ca->id}'>{$ca->city}</option>";
        }
        echo $htmlContent;
    wp_die();
} 


add_action('wp_ajax_vc_get_cities_on_checkout_page_load', 'vc_get_cities_on_checkout_page_load');
add_action('wp_ajax_nopriv_vc_get_cities_on_checkout_page_load', 'vc_get_cities_on_checkout_page_load');

function calculate_shipping_on_cart_page(){
    global $wpdb;
    global  $woocommerce;
    $table_name = $wpdb->prefix ."vc_cities_group";
    $city = $_POST['city'];
    $area = $_POST['area'];
    $fee = $wpdb->get_results("SELECT * FROM $table_name WHERE `city` = '$city'", OBJECT);
    $shippingFee = $fee[0]->delivery_fee + WC()->cart->subtotal;
    $minOrder = $fee[0]->minimum_order;
    if(WC()->cart->subtotal <=$minOrder){
        echo "<p style='background: linear-gradient(135deg, #fa1009 0%,#f98828 100%);padding:5px;color:#fff'>Minimum order for ". $city .", " . $area . " is " .  woocommerce_price( $minOrder) ."</p>";
    }else{
        echo "<p style='background: linear-gradient(135deg, #fa1009 0%,#f98828 100%);padding:5px;color:#fff'>Shipping for ". $city . ", " . $area ." is " .  woocommerce_price( $fee[0]->delivery_fee) ." and Cart total would be ". woocommerce_price($shippingFee)."</p>";
    }   
   wp_die();
}
add_action('wp_ajax_calculate_shipping_on_cart_page', 'calculate_shipping_on_cart_page');
add_action('wp_ajax_nopriv_calculate_shipping_on_cart_page', 'calculate_shipping_on_cart_page');

function show_notification_on_cart_page(){
    global $wpdb;
    global  $woocommerce;
    $table_name = $wpdb->prefix ."vc_cities_group";
    $city = $_POST['city'];
    $area = $_POST['area'];
    $fee = $wpdb->get_results("SELECT * FROM $table_name WHERE `city` = '$city'", OBJECT);
    $shippingFee = $fee[0]->delivery_fee + WC()->cart->subtotal;
    $minOrder = $fee[0]->minimum_order;
    if(WC()->cart->subtotal <=$minOrder){
        echo "<p style='background: linear-gradient(135deg, #fa1009 0%,#f98828 100%);color:#fff;padding:15px;font-size:18px;border-radius:3px;'>Your current order total is ".WC()->cart->subtotal." — you must have an order with a minimum of ".woocommerce_price( $minOrder)." to place your order </p>";
    }else{
        echo "";
    }   
   wp_die();
}
add_action('wp_ajax_show_notification_on_cart_page', 'show_notification_on_cart_page');
add_action('wp_ajax_nopriv_show_notification_on_cart_page', 'show_notification_on_cart_page');