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
?>
<script>
var d = new Date();
var n = d.getTimezoneOffset();
var name = "timezone";
document.cookie = name + "=" + n/60;
</script>

<?php

	function display_sunrise_and_set() {

		$ip = $_SERVER['REMOTE_ADDR']; 
		$cookie_name = 'timezone';


		$offset = $_COOKIE[$cookie_name];
		$offset = floatval(substr($offset, 1,2)); 
		
		$object = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
		$lat = $object['geoplugin_latitude'];
		$long = $object['geoplugin_longitude'];

		$sunset = date_sunset(time(), SUNFUNCS_RET_STRING, $lat, $long, 90, $offset);
		$sunrise =  date_sunrise(time(), SUNFUNCS_RET_STRING, $lat, $long, 90, $offset);
		$out = 'Today Sun rose at '.$sunrise.' and it will set at '.$sunset;
		return $out;
	}
	add_shortcode( 'sunrise-and-set', 'display_sunrise_and_set' );
