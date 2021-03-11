<div class="container mt-4 p-2">
    <h3 class="text-center">City Based Delivery System</h3>
    <hr>
    <h4 class="text-center">City Areas</h4>
    <div class="row mt-4">
        <div class="col-md-3">
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
            <input type="hidden" id="city_area_id"value="">
            <select name="city_id_update" id="city_id_update" class="vc_input_area" style="display:none">
            <option  id="set_cityid_update"></option>
            <?php foreach ($cities as $city) {
                echo "<option value='{$city->id}'>{$city->city}</option>";
            }?>
            </select>
           
        </div>
        <div class="col-md-3">
            <input type="text" class="vc_input_area" id="city_area" name="city_area" placeholder="City Area">                                                                                                                                                                                                                                                                                                                                                                                                                          </select>
        </div>
        <div class="col-md-3">
            <button type="button" class="button-primary vc_button" onclick="vc_add_cityarea_ajax()" id="vc_add_cityarea">Save City Area</button>
            <button type="button" class="button-primary vc_button" onclick="vc_update_cityarea_ajax()" id="vc_update_cityarea" style="display:none">Update City Area</button>
        </div>
    </div>
</div>
<div class="container mt-2 p-2">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>City</th>
                        <th>Area</th>
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
                          <td><button alt="<?=$cityarea->id?>" type="button" class="btn btn-sm btn-primary mr-4" onclick="fill_cityarea_for_edit(<?=$cityarea->id?>)"><i class="fa fa-pencil" aria-hidden="true"></i>
                            </button><button alt="<?=$cityarea->id?>" type="button" class="btn btn-sm btn-danger" onclick="vc_delete_cityarea_ajax(<?=$cityarea->id?>)"><i class="fa fa-remove" aria-hidden="true"></i>
                            </button></td>
                          </tr>
                      <?php endforeach; ?>
                    
                </tbody>
            </table>
</div>