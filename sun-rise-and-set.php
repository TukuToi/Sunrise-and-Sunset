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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$tkt_srss_plugin_path = plugin_dir_path(__FILE__);

define('TKT_SRSS_GOOGLE_API_KEY', 'u2498ujcv98jw');//change API key to your API google key

require_once($tkt_srss_plugin_path.'/functions.php');


/**
 * Returns the parsed shortcode.
 *
 * @param array   {
 *     Attributes of the shortcode.
 *
 *     @type string $id ID of...
 * }
 * @param string  Shortcode content.
 *
 * @return string HTML content to display the shortcode.
 */
function shortcode_callback_func(  ) {
	
	$out = 'The sun rises at: '.tkt_srss_get_sunrise_and_set('rise').' and sets at '.tkt_srss_get_sunrise_and_set('set').' in '.tkt_srss_get_geoloc_by_ip('loc').'';
	return $out;

}
add_shortcode( 'sunrise-and-set', 'shortcode_callback_func' );

