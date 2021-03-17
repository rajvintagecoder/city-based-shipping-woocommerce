<?php   global $wpdb; ?>
<div class="container mt-4 p-2">
    <h3 class="text-center">City Based Delivery System</h3>
    <hr>
    <h4 class="text-center">Add City And Assign Strong Categroy</h4>
    <div id="visibleDiv">
    <div class="row mt-4">
  
        <div class="col-md-3">
         
           <input placeholder="City" type="text" id="vc_city" name="vc_city" class="vc_input_area">
        </div>
        <div class="col-md-4">
        <?php 
           $strong_cates = $wpdb->prefix ."vc_city_categories";
           $categories = $wpdb->get_results("SELECT * FROM $strong_cates ORDER BY `id`",OBJECT);
        ?>
           <select name="strong_cate" id="strong_cate" class="vc_input_area">
                        <option value="" selected disabled>Assign Strong Category...</option>
                        <?php foreach ($categories as $cate) { ?>
                            <option value="<?=$cate->category?>"><?=$cate->category?></option>
                        <?php  }  ?>
                        </select> 
        
        </div>
        <div class="col-md-3">
            <button type="button" class="button-primary vc_button" onclick="vc_add_city_ajax()" id="vc_add_button">Save City</button>
        </div>
    </div>
    </div>
    <div id="hiddenDiv" style="display:none">
            <div class="row mt-4">
                <div class="col-md-3">
                    <input type="hidden" id="vc_id" name="vc_id" class="vc_input_area">
                    <input placeholder="City" type="text" id="hvc_city" name="hvc_city" class="vc_input_area">
                </div>
                <div class="col-md-4">
                <?php 
                $strong_cates = $wpdb->prefix ."vc_city_categories";
                $categories = $wpdb->get_results("SELECT * FROM $strong_cates ORDER BY `id`",OBJECT);
                ?>
                <select name="strong_cate" id="hstrong_cate" class="vc_input_area">
                                <option  id="hiddeStrCateOption"></option>
                                <option value="">Select Blank</option>
                                <?php foreach ($categories as $cate) { ?>
                                    <option value="<?=$cate->category?>"><?=$cate->category?></option>
                                <?php  }  ?>
                                </select> 
                
                </div>
                <div class="col-md-3">
                    <button type="button" class="button-secondary vc_button" onclick="vc_update_city_ajax()" id="vc_update_button">Update City</button>
                </div>
            </div>

    </div>
</div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error" style="display:none;width:90%;margin:0px auto">
    <strong>All fields are required!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>


<div class="container mt-2 p-2">
    <table class="table table-dark table-striped table-hover">
        <thead>
        <tr>

            <th id="cm_city" class="manage-column column-city" scope="col">City</th>
            <th>Strong Category</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody id="vc_tableBody">
        <?php
            $table_name = $wpdb->prefix ."vc_cities_group";
            $totalCity = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`",OBJECT);
            foreach($totalCity as $city):
        ?>
            <tr>
                <td><span id="city_<?=$city->id?>"><?=$city->city;?></span></td>
                <td><span id="strCate_<?=$city->id?>"><?=$city->strong_category;?></span></td>

                <td><button alt="<?=$city->id?>" type="button" class="btn btn-sm btn-primary mr-4 my-btn-edit" onclick="fill_form_for_edit(<?=$city->id?>)"><i class="fa fa-pencil" aria-hidden="true"></i>
                </button>   <button alt="<?=$city->id?>" type="button" class="btn btn-sm btn-danger my-btn-delete" onclick="vc_delete_city_ajax(<?=$city->id?>)"><i class="fa fa-remove" aria-hidden="true"></i>
                </button></td>     
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>


    </table>

</div>


