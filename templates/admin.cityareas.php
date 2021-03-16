<div class="container mt-4 p-2">
    <h3 class="text-center">City Based Delivery System</h3>
    <hr>
    <h4 class="text-center">City Areas</h4>
    <div id="visibleRow">
            <div class="row mt-4">
                <div class="col-md-2">
                <?php 
                
                    global $wpdb;
                    $table_name = $wpdb->prefix ."vc_cities_group";
                    $cities = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT);?>
                    <select name="city_id" id="city_id" class="vc_input_area">
                    <option  selected disabled>Select city ....</option>
                    <?php foreach ($cities as $city) {
                        echo "<option value='{$city->id}'>{$city->city}</option>";
                    }?>
                    </select>
                
                </div>
                <div class="col-md-2">
                    <input type="text" class="vc_input_area" id="city_area" name="city_area" placeholder="City Area">                                                                                                                                                                                                                                                                                                                                                                                                                          </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="vc_input_area" id="delivery_fee" id="delivery_fee" placeholder="Delivery Fee" onkeypress="return onlyNumberKey(event)">
                </div>
                <div class="col-md-2">
                    <input type="text" class="vc_input_area" id="minimum_order" id="minimum_order" placeholder="Minimum order" onkeypress="return onlyNumberKey(event)">
                </div>

                <div class="col-md-2">
                <?php 
                    $table_times = $wpdb->prefix ."vc_times";
                    $times = $wpdb->get_results("SELECT * FROM $table_times ORDER BY `id`", OBJECT);?>
                    <select name="times" id="times" class="vc_input_area">
                    <option  selected disabled>Select timeslot ....</option>
                    <?php foreach ($times as $time) {
                        echo "<option value='{$time->time_title}'>{$time->time_title}</option>";
                    }?>
                    </select>
                
                </div>
                
                <div class="col-md-2">
                    <button type="button" class="button-primary vc_button" onclick="vc_add_cityarea_ajax()" id="vc_add_cityarea">Save City Area</button>
                 </div>
            </div>
    </div>
    <div id="hiddenRow" style="display:none">
            <div class="row mt-4">
                <div class="col-md-2">
                <input type="hidden" id="city_area_id">
                <?php 
                
                    global $wpdb;
                    $table_name = $wpdb->prefix ."vc_cities_group";
                    $cities = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT);?>
                    <select name="hcity_id" id="hcity_id" class="vc_input_area">
                    <option  id="hcityOption"></option>
                    <?php foreach ($cities as $city) {
                        echo "<option value='{$city->id}'>{$city->city}</option>";
                    }?>
                    </select>
                
                </div>
                <div class="col-md-2">
                    <input type="text" class="vc_input_area" id="hcity_area" name="city_area" placeholder="City Area">                                                                                                                                                                                                                                                                                                                                                                                                                          </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="vc_input_area" id="hdelivery_fee" id="delivery_fee" placeholder="Delivery Fee" onkeypress="return onlyNumberKey(event)">
                </div>
                <div class="col-md-2">
                    <input type="text" class="vc_input_area" id="hminimum_order" id="minimum_order" placeholder="Minimum order" onkeypress="return onlyNumberKey(event)">
                </div>

                <div class="col-md-2">
                <?php 
                    $table_times = $wpdb->prefix ."vc_times";
                    $times = $wpdb->get_results("SELECT * FROM $table_times ORDER BY `id`", OBJECT);?>
                    <select name="times" id="htimes" class="vc_input_area">
                    <option  id="htimesOptions"></option>
                    <?php foreach ($times as $time) {
                        echo "<option value='{$time->time_title}'>{$time->time_title}</option>";
                    }?>
                    </select>
                
                </div>
                
                <div class="col-md-2">
                    <button type="button" class="button-secondary vc_button" onclick="vc_update_cityarea_ajax()" id="vc_update_cityarea">Update City Area</button>
                </div>
            </div>
    </div>
</div>
<div class="container mt-2 p-2">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>City</th>
                        <th>Area</th>
                        <th>Delivery Fee</th>
                        <th>Min Order</th>
                        <th>Timeslot</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="cityAreaTbody">
                    <?php
                      global $wpdb;
                      $table_name = $wpdb->prefix . "vc_city_areas";
                      $cityAreas = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
                      foreach ($cityAreas as $cityarea):?>
                          <tr>
                          <td><span id="cityid_<?=$cityarea->id?>" alt="<?=$cityarea->city_id?>"><?=getCityName($cityarea->city_id)?></span></td>
                          <td><span id="areaname_<?=$cityarea->id?>" ><?=$cityarea->area_name?></span></td>
                          <td><span id="delivery_<?=$cityarea->id?>" ><?=$cityarea->delivery_fee?></span></td>
                          <td><span id="minorder_<?=$cityarea->id?>" ><?=$cityarea->minimum_order?></span></td>
                          <td><span id="times_<?=$cityarea->id?>" ><?=$cityarea->timeslot?></span></td>
                          <td><button alt="<?=$cityarea->id?>" type="button" class="btn btn-sm btn-primary mr-4" onclick="fill_cityarea_for_edit(<?=$cityarea->id?>)"><i class="fa fa-pencil" aria-hidden="true"></i>
                            </button><button alt="<?=$cityarea->id?>" type="button" class="btn btn-sm btn-danger" onclick="vc_delete_cityarea_ajax(<?=$cityarea->id?>)"><i class="fa fa-remove" aria-hidden="true"></i>
                            </button></td>
                          </tr>
                      <?php endforeach; ?>
                    
                </tbody>
            </table>
</div>