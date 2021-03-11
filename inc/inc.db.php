<?php

register_activation_hook(__FILE__, 'create_initial_tables');
function create_initial_tables(){
    global $wpdb;
    $table_city = $wpdb->prefix . 'vc_cities_group';
    $charset_collate = $wpdb->get_charset_collate();
    $table_timeslots  = $wpdb->prefix . 'vc_time_slots';
    $table_areas = $wpdb->prefix . 'vc_city_areas';
    $queries = array();
    array_push($queries,"CREATE TABLE IF NOT EXISTS $table_city (
            `id` int(11) NOT NULL AUTO_INCREMENT,                
            `city` text  NOT NULL,
            `delivery_fee` int(11) NOT NULL,
            `minimum_order` int(11) NOT NULL,
            PRIMARY KEY (`id`)
           ) $charset_collate");
    array_push($queries,"CREATE TABLE IF NOT EXISTS $table_timeslots(
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `city_id` int(11) NOT NULL,
                `time_slot` text NOT NULL,
     PRIMARY KEY (`id`)
    ) $charset_collate");
    array_push($queries,"CREATE TABLE IF NOT EXISTS $table_areas(
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `city_id` int(11) NOT NULL,
            `area_name` text NOT NULL,
     PRIMARY KEY (`id`)
    ) $charset_collate");

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    foreach ($queries as $key => $sql) {
        dbDelta( $sql );
    }
}

