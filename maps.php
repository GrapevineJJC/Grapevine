<?php function maps() {
include('maps.js'); ?>

	<div id="mapspage">
	<form id="ajaxRequestForm" method="get">
	<?php global $wpdb;
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
	var_dump($LatLngArray);
	echo "Number of events in DB is ".$numLocations;
	
	$addressArray = array($LatLngArray);
	echo json_encode($addressArray);?>
	
	</form>
	<div id="arraySpitBack"></div>
	<div id="googleMap" style="width:900px;height:550px;"></div>
	</div>
<?php
}

