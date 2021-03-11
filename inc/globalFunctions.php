<?php

function getCityName($cityId){
    global $wpdb;
    $cities = $wpdb->prefix.'vc_cities_group';
    $city = $wpdb->get_results("SELECT `city` FROM $cities WHERE `id` = $cityId",OBJECT);
    return $city[0]->city;
}

function getCateName($cateId){
        $term = get_term_by( 'id', $cateId, 'product_cat');
        return $term->name;
}

function getCityID($city){
    global $wpdb;
    $cities = $wpdb->prefix.'vc_cities_group';
    $city = $wpdb->get_results("SELECT `id` FROM $cities WHERE `city` = '$city'",OBJECT);
    return $city[0]->id;
}