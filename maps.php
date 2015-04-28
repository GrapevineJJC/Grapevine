<?php function maps() { 
include('maps.js');

 	global $wpdb;
 	$result = $wpdb->get_results( 'SELECT EventName, LocationAddress, Latitude, Longitude from wp_grape_events' );
	
	$LatLngArray = array();
	$numLocations = 0;
	foreach ($result as $row) {
		$latitude = $row->Latitude;
		$longitude = $row->Longitude;
		$eventname = $row->EventName;
		$address = $row->LocationAddress;
		//echo "<b>$eventname</b>: $address<br>";
		$LatLngPair = $latitude.", ".$longitude;
		array_push($LatLngArray, $LatLngPair);
		$numLocations = $numLocations + 1;
	}
	//echo "Number of events in DB is ".$numLocations."<br><br>";
		
	//$addressArray = array($LatLngArray);
	//$addressArray = json_encode($LatLngArray);
	
	//makeMaps($addressArray);?>
	
 	<div id="googleMap" style="width:900px;height:550px;"></div>

<?php }?>