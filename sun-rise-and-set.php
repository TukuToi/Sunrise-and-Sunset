<?php
/**
 * Plugin Name: Sun Rise and Sun Set
 * Description: Plotting Sun Rise and Sun Set according to User Location
 * Plugin URI: http://www.tukutoi.com
 * Author: Author
 * Author URI: http://www.tukutoi.com
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: tkt-srss
 */

	//error_log(print_r(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])), true));
	//error_log(print_r(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=118.68.122.75')), true));
	

	function display_sunrise_and_set() {

		$object = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
		$lat = $object['geoplugin_latitude'];
		$long = $object['geoplugin_longitude'];
		$sunset = date_sunset(time(), SUNFUNCS_RET_STRING, $lat, $long, 90, 0);
		$sunrise =  date_sunrise(time(), SUNFUNCS_RET_STRING, $lat, $long, 90, 0);
		$out = 'Today Sun rose at '.$sunrise.' and it will set at '.$sunset;
		return $out;
	}
	add_shortcode( 'sunrise-and-set', 'display_sunrise_and_set' );
