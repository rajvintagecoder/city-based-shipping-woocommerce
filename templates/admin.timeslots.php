<div class="container mt-4 p-2">
    <h3 class="text-center">City Based Delivery System</h3>
    <hr>
    <h4 class="text-center">Time Slots</h4>
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
            <input type="text" id="city_name" class="vc_input_area" readonly style="display:none">
            <input type="hidden" id="hidden_city_id" name="hidden_city_id">
            <input type="hidden" id="slot_id" name="slot_id">
        </div>
        <div class="col-md-3">
            <select name="timeslots" id="timeslots" class="vc_input_area">
            <option value="" disabled selected >Select timaslot ....</option>
                <option value="8 AM ">8 AM </option>
                <option value="9 AM ">9 AM </option>
                <option value="10 AM ">10 AM </option>
                <option value="11 AM ">11 AM </option>
                <option value="12 PM ">12 PM </option>
                <option value="1 PM ">1 PM </option>
                <option value="2 PM ">2 PM </option>
                <option value="3 PM ">3 PM </option>
                <option value="4 PM ">4 PM </option>
                <option value="5 PM ">5 PM </option>
                <option value="6 PM ">6 PM </option>
                <option value="7 PM ">7 PM </option>
                <option value="8 PM ">8 PM </option>
               
            </select>                                                                                                                                                                                                                                                                                                                                                                                                                                </select>
        </div>
        <div class="col-md-3">
            <button type="button" class="button-primary vc_button" onclick="vc_add_timeslot_ajax()" id="vc_add_timeslot">Save Timeslot</button>
            <button type="button" class="button-primary vc_button" onclick="vc_update_timeslot_ajax()" id="vc_update_timeslot" style="display:none">Update Tiemslot</button>
        </div>
    </div>
</div>
<div class="container mt-2 p-2">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>City</th>
                        <th>Timeslot</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="timeslotTbody">
                    <?php
                      global $wpdb;
                      $table_name = $wpdb->prefix . "vc_time_slots";
                      $timeSlots = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
                      foreach ($timeSlots as $timeslot):?>
                          <tr>
                          <td><span id="slotcity_<?=$timeslot->id?>" alt="<?=$timeslot->city_id?>"><?=getCityName($timeslot->city_id)?></span></td>
                          <td><span id="timeslot_<?=$timeslot->id?>" ><?=$timeslot->time_slot?></span></td>
                          <td><button alt="<?=$timeslot->id?>" type="button" class="btn btn-sm btn-primary mr-4" onclick="fill_timeslot_for_edit(<?=$timeslot->id?>)"><i class="fa fa-pencil" aria-hidden="true"></i>
                            </button><button alt="<?=$timeslot->id?>" type="button" class="btn btn-sm btn-danger" onclick="vc_delete_timeslot_ajax(<?=$timeslot->id?>)"><i class="fa fa-remove" aria-hidden="true"></i>
                            </button></td>
                          </tr>
                      <?php endforeach; ?>
                    
                </tbody>
            </table>
</div>