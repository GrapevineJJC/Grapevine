<<<<<<< HEAD
<?php function maps() { 
include('maps.js');

	global $wpdb;
=======
<?php function maps() {
include('maps.js'); ?>

	<div id="mapspage">
	<form id="ajaxRequestForm" method="get">
	<?php global $wpdb;
>>>>>>> origin/master
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
<<<<<<< HEAD
	
		?>
	<form id="ajaxRequestForm" method="get">
		<input type="button" id="getAddressArray" value="Find events nearby!"/><br>
		<br>
	</form>
	<div id="googleMap" style="width:900px;height:550px;"></div>
	<?php
	
	
	//var_dump($LatLngArray);
	echo "Number of events in DB is ".$numLocations."<br><br>";
		
	//$addressArray = array($LatLngArray);
	$addressArray = array('stuff' => $LatLngArray);
	echo json_encode($addressArray);
	
	echo "<br>Below json_encode!<br>";
=======
	var_dump($LatLngArray);
	echo "Number of events in DB is ".$numLocations;
	
	$addressArray = array($LatLngArray);
	echo json_encode($addressArray);?>
	
	</form>
	<div id="arraySpitBack"></div>
	<div id="googleMap" style="width:900px;height:550px;"></div>
	</div>
<?php
>>>>>>> origin/master
}

