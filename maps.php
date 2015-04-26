<?php function maps() {
<<<<<<< HEAD
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
		echo "<b>$eventname</b>: $address<br>";
		$LatLngPair = $latitude.", ".$longitude;
		array_push($LatLngArray, $LatLngPair);
		$numLocations = $numLocations + 1;
	}
	var_dump($LatLngArray);
	echo "numLocations is ".$numLocations;
	
	$addressArray = array('addresses' => $LatLngArray);
	echo json_encode($addressArray);?>
	
	</form>
	<div id="googleMap" style="width:900px;height:550px;"></div>
	</div>
<?php
}

=======
include('maps.js'); 


	global $wpdb;
	$geocodeURL = "https://maps.googleapis.com/maps/api/geocode/xml?";

	$result = $wpdb->get_results( 'SELECT LocationAddress from wp_grape_events' );
	
	$addressArray = array();
	$numLocations = 0;
	foreach ($result as $row) {
		array_push($addressArray, $row);
		$numLocations = $numLocations + 1;
	}
	var_dump($addressArray);
	echo "numLocations is ".$numLocations;
	
	foreach ($addressArray as $address) {
		$address = "address=" . urlencode($address);
   		$key = "key=AIzaSyBarEOhA0ygMeKahIvEnlYgTlqlgARI3k8";
  		$geocoderequest = "$geocodeURL$address" . "&" . $key;

		$xml= new SimpleXMLElement( file_get_contents( $geocoderequest ) );
   		
   		if($xml->status != 'OK') {
   			$status = $xml->error_message;
   			die("bad result status $status");
   		}

		$placeRequestURL = "https://maps.googleapis.com/maps/api/place/details/xml?";

		$placeID = "placeid=" . $xml->place_id;
   		$placedetailsrequest = "$placeRequestURL$placeID" . "&" . $key;
   		
   		echo $placedetailsrequest;
   		
   		$xml2 = new SimpleXMLElement( file_get_contents( $geocoderequest ) );
   		$loc = getLoc($xml);
   		echo "<pre>"; print_r( $loc);  	echo "</pre>";
	}?>
	
	<div id="googleMap" style="width:900px;height:550px;"></div>
<?php
}
function getLoc($xml)
    {
        //echo "<pre>"; print_r( $xml);  	echo "</pre>";
        $latitude  = $xml->result->geometry->location->lat;
        $longitude = $xml->result->geometry->location->lng;
        
        $location = array("latitude" => $latitude, "longitude" => $longitude);
        
        return ($location);
    }
>>>>>>> origin/master
