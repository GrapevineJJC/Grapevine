<?php
function testEvents(){
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	
	echo "<h1>Welcome, $username</h1>";

?>

<script type="text/javascript">
$(document).ready(function(){

    $(".btn").click(function(){
        $("#myModal").modal('show');
    });
    
    $("#createEvent").click(function(){
        	alert("TESTING");
    });
    
});
</script>


<!-- Button HTML (to Trigger Modal) -->
<a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Create An Event!</a>
 
<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create An Event</h4>
            </div>
            

            <div class="modal-body">  
            <form method="post">
                   <label>Name of Desired Place to Go, Event, or Activity:</label><br/>
                    <input type="text" id="eventname" name="eventname" placeholder="E.g. Fin's Sushi+Grill or Kayaking on the Charles" size="70" /><br/><br/>
                    
                    <label>Address:</label><br/>
                    <input type="text" id="eventaddress" name="eventaddress" placeholder="E.g. 123 Main Street, Chestnut Hill, MA 02467" size="70"/><br/><br/>
                    
                    <label>Description:</label><br/>
                    <textarea id="eventdesc" name="eventdesc" placeholder="E.g. New sushi restaurant to try, or exciting adventures in Boston!" row="40" cols="65" maxlength="500"></textarea><br/><br/>
                    
                    <label>Category:</label><br/>
                    <select id="eventcategory" name="eventcategory">
                    	<option value="restaurants">Restaurants</option>
                    	<option value="sports">Sports</option>
                    	<option value="fitness">Fitness</option>
                    	<option value="bars">Bars</option>
                    	<option value="music">Music</option>
                    	<option value="theatre">Theatre</option>
                    	<option value="museums">Museums</option>
                    	<option value="gaming">Gaming</option>
                    	<option value="outdoors">Outdoors</option>
                    </select><br/><br/>
           
            </div>
            
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="EventCancel" name="EventCancel" style="color: black; font-size: 16px;">Cancel</button>
                    <input type="submit" class="btn btn-default" id="createEvent" name="createEvent" value="Create" style="color: black; font-size: 16px;"/>
            </div>
            </form>
            
        </div>
    </div>
</div>
<?php

if(isset($_POST['createEvent'])){
	$eventaddress = null;
	
	$eventname = $_POST['eventname'];
	
	if(isset($_POST['eventaddress'])) {
		$eventaddress = $_POST['eventaddress'];
	}
	
	$eventdesc = $_POST['eventdesc'];
	$eventcategory = $_POST['eventcategory'];
	
	insertEvent($eventname, $eventaddress, $eventdesc, $eventcategory);
}

}

function insertEvent($eventname, $eventaddress, $eventdesc, $eventcategory){

  	global $currUser;	
	global $wpdb;
	
	$currUser = wp_get_current_user(); 
	
	if ($eventaddress != null) {
		$page = "http://geocoder.us/demo.cgi?address=".urlencode($eventaddress);
		$pattern = "/-?\d{2}\.\d+, -?\d{2}\.\d+/";
		$location = getLocation($page, $pattern);
		$latitude = $location['latitude'];
		$longitude = $location['longitude'];
	
	
		$wpdb->insert( 'wp_grape_events',
				array(	'CreatedByUser' => $currUser->ID,
						'EventName' => $eventname,
						'LocationAddress' => $eventaddress,
						'Latitude' => $latitude,
						'Longitude' => $longitude,
						'Description' => $eventdesc, 
						'Category' => $eventcategory),
				array( '%d', '%s', '%s', '%f', '%f', '%s', '%s' ) );	
	}
	
	else {
		$wpdb->insert( 'wp_grape_events',
				array(	'CreatedByUser' => $currUser->ID,
						'EventName' => $eventname,
						'Description' => $eventdesc, 
						'Category' => $eventcategory),
				array( '%d', '%s', '%s', '%s' ) );	
	}
	echo "Current user is $currUser->ID<br/>EventName is $eventname<br/>Description is $eventdesc<br/>Category is $eventcategory<br/>";
	echo "Event address is $eventaddress<br/>Geographic coordinates of the location of this event are ($latitude, $longitude)<br/>";


	//1. Get the tagID from tags table
	
	
	$query2 = 'SELECT * FROM wp_grape_tags WHERE tagName="'.$eventcategory.'"';
	//echo "$query2";

	$result = $wpdb->get_results($query2);
	
	//var_dump($result);
	foreach ($result as $row) {
		$tagID = $row->tagID;
	}
	
	echo "Tag ID is $tagID";
	/*
	//2. Insert into user_tags table
	$wpdb->insert( 'wp_grape_user_tags',
				array(	'userID' => $currUser->ID,
						'tagID' => $tagID,
				array( '%d', '%d' ) );
				
	echo "Inserted User ID: $currUser->ID and Tag ID: $tagID";
	
	
	//3. Query event table for eventID
	$query = "SELECT EventID FROM wp_grape_events WHERE tagName  =  '.$eventCategory";
	*/
	//query event table for event ID
	//insert into event_tags table event ID and tag ID

}


function getLocation($page, $pattern) {
	$content = file_get_contents($page);
	preg_match_all($pattern, $content, $res);
	$explodedRes = explode(", ",$res[0][0]);
	$location = array("latitude" => $explodedRes[0], "longitude" => $explodedRes[1]);
	return $location;
}

?>