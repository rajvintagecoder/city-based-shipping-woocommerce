<?php

  $args = array(
         'taxonomy'     => 'product_cat',
         'orderby'      => 'name',
         'show_count'   => 0,
         'pad_counts'   => 0,
         'hierarchical' => 1,
         'title_li'     => '',
         'hide_empty'   => 0
  );
  $all_categories = get_categories( $args );
?>

<div class="container mt-4 ">
    <h3 class="text-center">City Based Delivery System</h3>
    <hr>
    <h4 class="text-center">List Of Strong Categories</h4>
    <div id="visible_row">
        <div class="row mt-4" >
                <div class="col-md-3"></div>

                <div class="col-md-3">
                        <select name="category_id" id="category_id" class="vc_input_area">
                        <option value="" selected disabled>Select a category...</option>
                        <?php foreach ($all_categories as $cat) {
                            if($cat->category_parent == 0) { ?>
                                <option value="<?=$cat->term_id?>"><?=$cat->name?></option>
                        <?php  } } ?>
                        </select>                                                                                                                                                                                                                                                                                                                                                                                                                     </select>
                </div>

                <div class="col-md-3">
                    <button type="button" class="button-primary vc_button" onclick="vc_assign_city_ajax()" id="vc_assign_city">Assign Category</button>
                </div>
        </div>
   </div>
</div>

<div class="container" id="hidden_row" style="display:none">
    <div class="row mt-4" >
        <div class="col-md-3">
            <input type="hidden" id="city_hidden_id" value="">
        </div>
        <div class="col-md-3">
                <select name="category_hidden_id" id="category_hidden_id" class="vc_input_area">
                    <option  id="set_hidden_city_update"></option>
                    <?php foreach ($all_categories as $cat) {
                        if($cat->category_parent == 0) { ?>
                            <option value="<?=$cat->term_id?>"><?=$cat->name?></option>
                    <?php  } } ?>
                </select>   
        </div>
        <div class="col-md-3">
        <button type="button" class="button-secondary vc_button" onclick="vc_update_assigned_city_ajax()" id="vc_update_assign_city">Update Assigned Category</button>
        </div>
    </div>
</div>


<div class="container mt-4">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Category ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="cityCategoryTbody">
                    <?php
                      global $wpdb;
                      $table_name = $wpdb->prefix . "vc_city_categories";
                      $categories = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`", OBJECT); 
                      foreach ($categories as $cate):?>
                          <tr>
                          <td><span id="cate_<?=$cate->id?>" alt="<?=$cate->category?>"><?=$cate->category?></span></td>
                          <td><span id="category_<?=$cate->id?>" alt="<?=$cate->category_id?>"><?=$cate->category_id?></span></td>
                          <td><button alt="<?=$cate->id?>" type="button" class="btn btn-sm btn-primary mr-4" onclick="fill_assign_city_for_edit(<?=$cate->id?>)"><i class="fa fa-pencil" aria-hidden="true"></i>
                            </button><button alt="<?=$cate->id?>" type="button" class="btn btn-sm btn-danger" onclick="vc_delete_assign_city_ajax(<?=$cate->id?>)"><i class="fa fa-remove" aria-hidden="true"></i>
                            </button></td>
                          </tr>
                      <?php endforeach; ?>
                    
                </tbody>
            </table>
</div>