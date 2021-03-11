<div class="container mt-4 p-2">
    <h3 class="text-center">City Based Delivery System</h3>
    <hr>
    <h4 class="text-center">Time Slots</h4>
    <div class="row mt-4">
        <div class="col-md-3">
        <select name="timetitle" id="timetitle" class="vc_input_area">
            <option value="" disabled selected >Title ....</option>
                <option value="T1">T1 </option>
                <option value="T2">T2 </option>
                <option value="T3">T3 </option>
                <option value="T4">T4 </option>
                <option value="T5">T5 </option>
                <option value="T6">T6 </option>
                <option value="T7">T7 </option>
                <option value="T8">T8 </option>
                <option value="T9">T9 </option>
                <option value="T10">T10 </option>
                <option value="T11 ">T11 </option>
                <option value="T12 ">T12 </option>
                
            </select>    
        </div>
        <div class="col-md-3">
            <select name="fromtime" id="fromtime" class="vc_input_area">
            <option value="" disabled selected >From ....</option>
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
                <option value="9 PM ">9 PM </option>
               
            </select>                                                                                                                                                                                                                                                                                                                                                                                                                                </select>
        </div>

        <div class="col-md-3">
            <select name="totime" id="totimes" class="vc_input_area">
            <option value="" disabled selected >To ....</option>
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
                <option value="9 PM ">9 PM </option>
               
            </select>                                                                                                                                                                                                                                                                                                                                                                                                                                </select>
        </div>
        <div class="col-md-3">
            <button type="button" class="button-primary vc_button" onclick="vc_add_times_ajax()" id="vc_add_times">Save Times</button>
            <button type="button" class="button-primary vc_button" onclick="vc_update_times_ajax()" id="vc_update_times" style="display:none">Update Tiems</button>
        </div>
    </div>
</div>
<div class="container mt-2 p-2">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody id="timeTbody">
                    <?php
                      global $wpdb;
                      $table_times = $wpdb->prefix . 'vc_times';
                      $times = $wpdb->get_results("SELECT * FROM $table_times ORDER BY `id`", OBJECT); 
                      foreach ($times as $time):?>
                          <tr>
                          <td><span id="timetitle_<?=$time->id?>" alt="<?=$time->id?>"><?=$time->time_title?></span></td>
                          <td><span id="timefrom_<?=$time->id?>" ><?=$time->from_time?></span></td>
                          <td><span id="timeto_<?=$time->id?>" ><?=$time->to_time?></span></td>
                          <td><button alt="<?=$time->id?>" type="button" class="btn btn-sm btn-primary mr-4" onclick="fill_time_for_edit(<?=$time->id?>)"><i class="fa fa-pencil" aria-hidden="true"></i>
                            </button><button alt="<?=$timeslot->id?>" type="button" class="btn btn-sm btn-danger" onclick="vc_delete_time_ajax(<?=$time->id?>)"><i class="fa fa-remove" aria-hidden="true"></i>
                            </button></td>
                          </tr>
                      <?php endforeach; ?>
                    
                </tbody>
            </table>
</div>