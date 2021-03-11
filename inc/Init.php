<?php
class Init{

    function instantiate(){
         register_activation_hook(__FILE__, $this->create_initial_tables());
         add_action('admin_enqueue_scripts',array($this,'enqueue'));
         add_action('wp_enqueue_scripts',array($this,'enqueue'));
         add_action('admin_menu',array($this, 'create_admin_pages'));
         add_filter("plugin_action_links_city-based-delivery/city-based-delivery.php",array($this,'setting_link'));
     }
    function create_initial_tables(){
        global $wpdb;
        $table_city = $wpdb->prefix . 'vc_cities_group';
        $charset_collate = $wpdb->get_charset_collate();
        $table_timeslots = $wpdb->prefix . 'vc_time_slots';
        $table_areas = $wpdb->prefix . 'vc_city_areas';
        $table_categories = $wpdb->prefix . 'vc_city_categories';
        $table_times = $wpdb->prefix . 'vc_times';
        $queries = array();
        array_push($queries, "CREATE TABLE IF NOT EXISTS $table_city (
            `id` int(11) NOT NULL AUTO_INCREMENT,                
            `city` text  NOT NULL,
            `delivery_fee` int(11) NOT NULL,
            `minimum_order` int(11) NOT NULL,
            PRIMARY KEY (`id`)
           ) $charset_collate");
        array_push($queries, "CREATE TABLE IF NOT EXISTS $table_timeslots(
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `city_id` int(11) NOT NULL,
                `time_slot` text NOT NULL,
                `city` text,
            PRIMARY KEY (`id`)
            ) $charset_collate");
        array_push($queries, "CREATE TABLE IF NOT EXISTS $table_areas(
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `city_id` int(11) NOT NULL,
            `area_name` text NOT NULL,
            `city` text,
            PRIMARY KEY (`id`)
            ) $charset_collate");

            array_push($queries, "CREATE TABLE IF NOT EXISTS $table_categories(
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `city_id` int(11) NOT NULL,
                `category_id` int(11) NOT NULL,
                `city` text,
                PRIMARY KEY (`id`)
                ) $charset_collate");

            array_push($queries, "CREATE TABLE IF NOT EXISTS $table_times(
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `time_title` text NOT NULL,
                `from_time` text NOT NULL,
                `to_time` text NOT NULL,
                PRIMARY KEY (`id`)
                ) $charset_collate");

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        foreach ($queries as $key => $sql) {
            dbDelta($sql);
        }

    }

    function setting_link($links){
        $settings_link = '<a href="admin.php?page=city-based-delivery">Settings</a>';
        array_push($links,$settings_link);
        return $links;
    }

    function create_admin_pages(){
        add_menu_page('City Based Delivery','City Based Delivery','manage_options','city-based-delivery',array($this,'admin_index'),'dashicons-admin-multisite',10);
        add_submenu_page( 'city-based-delivery','City Based Delivery' , 'Add Cities', 'manage_options', 'city-based-delivery', array($this,'admin_index'));
        add_submenu_page( 'city-based-delivery','City Based Delivery' , 'Times', 'manage_options', 'add-times', array($this,'admin_add_times'));
        add_submenu_page( 'city-based-delivery','City Based Delivery' , 'Assign Categories', 'manage_options', 'assign-categories', array($this,'admin_assign_ategories'));
        add_submenu_page( 'city-based-delivery','Add Time Slots' , 'Add Time Slots', 'manage_options', 'add-time-slots', array($this,'admin_time_slots'));
        add_submenu_page( 'city-based-delivery','Add City Areas' , 'Add City Areas', 'manage_options', 'add-city-areas', array($this,'admin_city_areas'));
     }
    
    function admin_index(){
        require_once plugin_dir_path(__DIR__).'templates/admin.index.php';
    }
    function admin_assign_ategories(){
        require_once plugin_dir_path( __DIR__ ).'templates/admin.assign.categories.php';
    }
    function admin_city_areas(){
        require_once plugin_dir_path(__DIR__).'templates/admin.cityareas.php';
    }
    
    function admin_time_slots(){
        require_once plugin_dir_path(__DIR__).'templates/admin.timeslots.php';
    }
    function admin_add_times(){
        require_once plugin_dir_path(__DIR__).'templates/admin.times.php';
    }

    function enqueue(){
        $localize = array('ajax_url' => admin_url( 'admin-ajax.php' )  );
        wp_enqueue_style('vc_bootstrap',VC_PLUGIN_PATH.'assets/css/bootstrap.min.css',array(),'4.0.0','all');
        wp_enqueue_style('vc_font-awesome-css','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',array(),'4.0.0','all');
        wp_enqueue_style('vc_main_css',VC_PLUGIN_PATH.'assets/css/vc_main.css',array(),'1.0.0','all');
        wp_enqueue_script('vc_main_js',VC_PLUGIN_PATH.'assets/js/vc_main_js.js',array(),'1.0.0', true);
        wp_enqueue_script('vc-ajax-js', VC_PLUGIN_PATH. 'assets/js/vc_ajax.js','jQuery','1.0.0', true);
        wp_localize_script('vc-ajax-js','vc_ajax_url', $localize);

    }

}