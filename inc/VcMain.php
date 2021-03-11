<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class VcMain {
    public function __construct(){
      
        add_filter( 'woocommerce_shipping_calculator_enable_postcode',  '__return_false' );
        add_filter( 'woocommerce_shipping_calculator_enable_city', '__return_true' );
        add_filter( 'woocommerce_shipping_calculator_enable_country', '__return_false' );
        add_filter( 'woocommerce_checkout_fields', array($this, 'custom_checkout_fields'), 999999, 1 );
        add_filter( 'woocommerce_checkout_fields' , array($this,'custom_override_checkout_fields') );
        add_filter( 'woocommerce_package_rates', array( $this, 'custom_shipping_rate_cost_calculation' ), 9999999, 2 );
        add_action( 'woocommerce_checkout_process', array($this,'vc_minimum_order_amount' ));
        // add_action( 'woocommerce_before_checkout_shipping_form', array($this,'vc_minimum_order_amount' ));
        // add_action( 'woocommerce_before_cart' , array($this, 'vc_minimum_order_amount' ));
        add_action( 'woocommerce_before_cart', array($this,'add_notification_on_cart_page'), 10 );
        // remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20);
    }

    public function change_default_checkout_country_state() {
        return 'AE';
    }

    public function set_country_befor_cart_page(){
        WC()->customer->set_country('AE');
        WC()->customer->set_shipping_country('AE');
    }


    /* WooCommerce: The Code Below Removes Checkout Fields */
    
        function custom_override_checkout_fields( $fields ) {
            global $wpdb;
            $cityID = WC()->customer->get_billing_city();
            $table_areas = $wpdb->prefix ."vc_city_areas";
            $table_cities = $wpdb->prefix ."vc_cities_group";
            $cities = $wpdb->get_results("SELECT * FROM $table_cities WHERE `id` = {$cityID} ORDER BY `id`",OBJECT);
            $areas = $wpdb->get_results("SELECT * FROM $table_areas WHERE `ciry_id` = {$cityID} ORDER BY `id`",OBJECT);
            
            unset($fields['shipping']['shipping_company']);
            unset($fields['shipping']['shipping_address_1']);
            unset($fields['shipping']['shipping_address_2']);
            unset($fields['shipping']['shipping_city']);
            unset($fields['shipping']['shipping_postcode']);
            unset($fields['shipping']['shipping_country']);
            unset($fields['shipping']['shipping_state']);

            return $fields;
            
        }

        
    function add_notification_on_cart_page(){
        echo "<div id='cartPageNote'></div>";
    }    
    
   

    function custom_checkout_fields( $fields ) {
        global $wpdb;
        $table_name = $wpdb->prefix ."vc_cities_group";
        $table_areas = $wpdb->prefix ."vc_city_areas";
        $table_timeslots = $wpdb->prefix ."vc_time_slots";

        $cities = $wpdb->get_results("SELECT * FROM $table_name ORDER BY `id`",OBJECT);
        $areas = $wpdb->get_results("SELECT * FROM $table_areas WHERE `city_id` = {$cities[0]->id}  ORDER BY `id`",OBJECT);
        $timeslots = $wpdb->get_results("SELECT * FROM $table_timeslots WHERE `city_id` = {$cities[0]->id} ORDER BY `id`",OBJECT);

        $cities_group = array();
        $allcities = array();
        $allids = array();
        $area_group = array();
        $allareas = array();
        $timeslots_groups = array();
        $alltimeslots = array();

        foreach($cities as $city){
           array_push($cities_group, $city->city);
           array_push($allcities, $city->city);
           array_push($allids, $city->id);
        }
        
        
        $fields['billing']['billing_city']['type']        = 'select';
        $fields['billing']['billing_city']['class']       = array('form-row-first');
        $fields['billing']['billing_city']['input_class'] = array('city_select');
        $fields['billing']['billing_city']['options']     = array_combine($allcities,$cities_group);


       
        $fields['shipping']['shipping_city']['type'] = 'select';
        $fields['shipping']['shipping_city']['label'] = 'City';
        $fields['shipping']['shipping_city']['required'] = 'required';
        $fields['shipping']['shipping_city']['class']       = array('form-row-first');
        $fields['shipping']['shipping_city']['input_class'] = array('city_select shipping_city_select');
        $fields['shipping']['shipping_city']['options'] =  array_combine($allcities,$cities_group);
        
        foreach($areas as $area){
            array_push($area_group, $area->area_name);
            array_push($allareas, $area->area_name);
        }

        $fields['billing']['billing_area']['type']        = 'select';
        $fields['billing']['billing_area']['class']       = array('form-row-first');
        $fields['billing']['billing_area']['input_class'] = array('area_select');
        $fields['billing']['billing_area']['options']     = array_combine($area_group,$allareas);


        $fields['shipping']['shipping_area']['type']        = 'select';
        $fields['shipping']['shipping_area']['label']       = 'Area';
        $fields['shipping']['shipping_area']['required']    = 'required';
        $fields['shipping']['shipping_area']['class']       = array('form-row-first');
        $fields['shipping']['shipping_area']['input_class'] = array('area_select shipping_area_select');
        $fields['shipping']['shipping_area']['options']     = array_combine($area_group,$allareas);
        
        foreach($timeslots as $timeslot){
            array_push($timeslots_groups, $timeslot->time_slot);
            array_push($alltimeslots, $timeslot->time_slot);
         }

         $fields['billing']['billing_timeslot']['type']        = 'select';
         $fields['billing']['billing_timeslot']['class']       = array('form-row-first');
         $fields['billing']['billing_timeslot']['input_class'] = array('timeslot_select');
         $fields['billing']['billing_timeslot']['options']     =  array_combine($timeslots_groups,$alltimeslots);

         $fields['shipping']['shipping_timeslot']['type']        = 'select';
         $fields['shipping']['shipping_timeslot']['label']       = 'Available Timeslots';
         $fields['shipping']['shipping_timeslot']['required']    = 'required';
         $fields['shipping']['shipping_timeslot']['class']       = array('form-row-first');
         $fields['shipping']['shipping_timeslot']['input_class'] = array('timeslot_select shipping_timeslot_select');
         $fields['shipping']['shipping_timeslot']['options']     =  array_combine($timeslots_groups,$alltimeslots);
         
         $fields['shipping']['shipping_address_1']['type']        = 'text';
         $fields['shipping']['shipping_address_1']['label']       = 'Street Address (Building , Flat)';
         $fields['shipping']['shipping_address_1']['required']    = 'required';

        return $fields;
    
    }

    function vc_minimum_order_amount() {
        global $wpdb;
        $table_cities = $wpdb->prefix ."vc_cities_group";
        $cityID = WC()->customer->get_billing_city();
        $current = WC()->cart->subtotal;
        $cities = $wpdb->get_results("SELECT * FROM $table_cities WHERE `city` = '$cityID' ORDER BY `id`",OBJECT);
        $minimum = $cities[0]->minimum_order;

        if ( WC()->cart->total < $minimum ) {

            if( is_cart() ) {

                wc_print_notice( 
                    sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order ' , 
                        wc_price( WC()->cart->total ), 
                        wc_price( $minimum )
                    ), 'error' 
                );

            } else {

                wc_add_notice( 
                    sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order' , 
                        wc_price( WC()->cart->total ), 
                        wc_price( $minimum )
                    ), 'error' 
                );

            }
        }
    }


     function calculate_custom_shipping_for_city(){
        global $wpdb;
       
        $cityID = WC()->customer->get_shipping_city();
       
        $table_cities = $wpdb->prefix ."vc_cities_group";
        $table_areas = $wpdb->prefix ."vc_city_areas";
        $table_timeslots = $wpdb->prefix ."vc_time_slots";
        $table_categories = $wpdb->prefix ."vc_city_categories";
        
        $cities = $wpdb->get_results("SELECT * FROM $table_cities WHERE `city` = '{$cityID}'", OBJECT);
        $minimumOrder = $cities[0]->minimum_order;
        $deliveryFee = $cities[0]->delivery_fee;
        if(WC()->cart->subtotal >=$minimumOrder){
            return $deliveryFee;
        }else{
            return 0;
        }

        // return WC()->cart->subtotal;
     }       


    public function custom_shipping_rate_cost_calculation( $rates, $package ) {
        $new_flat_rate = array();
        $new_free_shipping = array();
        $new_cost = $this->calculate_custom_shipping_for_city();
        foreach( $rates as $rate_key => $rate ) {
            if ( 'flat_rate' === $rate->method_id ){
                // Set rate cost
                if( !empty( $new_cost ) ){
                    $rates[$rate_key]->cost = $new_cost;
                    
                    //Set taxes rate cost (if enabled)
                    $taxes = array();
                    foreach ($rates[$rate_key]->taxes as $key => $tax){
                        if( $rates[$rate_key]->taxes[$key] > 0 )
                            $taxes[$key] = $new_cost * $rates[$rate_key]->taxes[$key];
                    }
                    $rates[$rate_key]->taxes = $taxes;
                    $rates[$rate_key]->label = __( 'Delivery Fees For '. WC()->customer->get_shipping_city() , 'woocommerce' );
                    $new_flat_rate[ $rate_key ] = $rates[$rate_key];
                }
            }
            if ( 'free_shipping' === $rate->method_id ) {
                $new_free_shipping[ $rate_key ] = $rates[$rate_key];
            }
        }

        if( !empty( $new_cost ) ){
            return $new_flat_rate;
        }else{
            return $new_free_shipping;
        }

    }

  
}


add_action('wp_footer', 'custom_checkout_js_script');
function custom_checkout_js_script() {
    if( is_checkout() && ! is_wc_endpoint_url() ) :
    $localize = array('ajax_url' => admin_url( 'admin-ajax.php' )  );
        wp_enqueue_script('vc_main_js',VC_PLUGIN_PATH.'assets/js/vc_main_js.js',array(),'1.0.0', true);
        wp_enqueue_script('vc-ajax-js', VC_PLUGIN_PATH. 'assets/js/vc_ajax.js','jQuery','1.0.0', true);
        wp_localize_script('vc-ajax-js','vc_ajax_url', $localize);
    endif;
 ?>
<script>
       jQuery(document).ready(function(){
        var city = jQuery('#calc_shipping_city').val();
        var area = jQuery('#calc_shipping_area').val();
        jQuery.ajax({
                        url: vc_ajax_url.ajax_url,
                        type: 'post',
                        data: {
                            action: 'show_notification_on_cart_page',  
                            city: city,
                            area:area,
                        },
                        success: function (data) {
                            jQuery('#cartPageNote').html(data);
                        }
        });
           
           jQuery('#calc_shipping_city').change(function(){
                var cityid = jQuery(this).val();
                jQuery.ajax({
                        url: vc_ajax_url.ajax_url,
                        type: 'post',
                        data: {
                            action: 'vc_get_area_on_checkout_page_load',  
                            cityid: cityid,
                        },
                        beforeSend: function(){
                            jQuery("#loader").css('display','block');
                        },
                        success: function (data) {
                            jQuery('#calc_shipping_area').html(data);
                        },
                        complete: function(){
                            jQuery("#loader").css('display','none');
                        },
                      });
            });

            jQuery('#calculate').click(function(){
                    var city = jQuery('#calc_shipping_city').val();
                    var area = jQuery('#calc_shipping_area').val();
                    jQuery.ajax({
                        url: vc_ajax_url.ajax_url,
                        type: 'post',
                        data: {
                            action: 'calculate_shipping_on_cart_page',  
                            city: city,
                            area:area,
                        },
                        beforeSend: function(){
                            jQuery("#loader").css('display','block');
                        },
                        success: function (data) {
                          jQuery('#shippingOutput').html(data);
                        },
                        complete: function(){
                            jQuery("#loader").css('display','none');
                        },
                      });
            });
        });
</script>
    <?php
}
