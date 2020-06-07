<?php
function tkt_srss_get_ip() {

	$ip = $_SERVER['REMOTE_ADDR']; 

	if ($ip != '') {
		return $ip;
	}
	else {
		return;
	}

}

function tkt_srss_get_geodata_by_ip($data){
	
	$ip = $_SERVER['REMOTE_ADDR']; 
		
	$object = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
	$lat = $object['geoplugin_latitude'];
	$long = $object['geoplugin_longitude'];
	if ($data == 'long') {
		return $long;
	}
	else {
		return $lat;
	}

}

function tkt_srss_get_geoloc_by_ip($data){

    $day = time();
	$lat = tkt_srss_get_geodata_by_ip('lat');
	$long = tkt_srss_get_geodata_by_ip('long');
	$url = 'https://maps.googleapis.com/maps/api/timezone/json?location='.$lat.','.$long.'&timestamp='.$day.'&key='.TKT_SRSS_GOOGLE_API_KEY.''; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
 
	if ($data == 'offset') {
		return $response_a->rawOffset/3600;
	}
	if ($data == 'loc') {
		return $response_a->timeZoneId;
	}

}

function tkt_srss_get_sunrise_and_set($data){

	$day = time();
	$sunset = date_sunset($day, SUNFUNCS_RET_STRING, tkt_srss_get_geodata_by_ip('lat'), tkt_srss_get_geodata_by_ip('long'), 90, tkt_srss_get_geoloc_by_ip('offset'));
	$sunrise = date_sunrise($day, SUNFUNCS_RET_STRING, tkt_srss_get_geodata_by_ip('lat'), tkt_srss_get_geodata_by_ip('long'), 90, tkt_srss_get_geoloc_by_ip('offset'));
	if ($data == 'rise') {
		return $sunrise;
	}
	else {
		return $sunset;
	}

}
