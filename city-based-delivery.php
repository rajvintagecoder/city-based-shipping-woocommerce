<?php
/**
 * Plugin Name: City Based Delivery
 * Plugin URI: https://vintagecoders.com/
 * Description: This Plugin is created by vintage coders for city based custom order delivery.
 * Version: 1.0.0
 * Author: Vintage Coders
 * Author URI: https://vintagecoders.com/
 *

City Based Delivery is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

City Based Delivery is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with City Based Delivery. If not, see {URI to Plugin License}.
*/


if(!defined('ABSPATH')){
    exit;
}
if(!defined('VC_PLUGIN_PATH')){
    define('VC_PLUGIN_PATH', plugin_dir_url( __FILE__ ));
}
if(!defined('VC_PLUGIN_DIR')){
define('VC_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

require_once  VC_PLUGIN_DIR.'inc/globalFunctions.php';
require_once  VC_PLUGIN_DIR.'inc/Init.php';
require_once  VC_PLUGIN_DIR.'inc/VcMain.php';
include_once WP_PLUGIN_DIR .'/woocommerce/woocommerce.php';
$initilize = new Init();
$initilize->instantiate();
$main = new VcMain();

require_once  VC_PLUGIN_DIR.'inc/inc.ajax.php';
