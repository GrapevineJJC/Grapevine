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
                    	<option value="1">Restaurants</option>
                    	<option value="2">Sports</option>
                    	<option value="3">Fitness</option>
                    	<option value="4">Bars</option>
                    	<option value="5">Music</option>
                    	<option value="6">Theatre</option>
                    	<option value="7">Museums</option>
                    	<option value="8">Gaming</option>
                    	<option value="9">Outdoors</option>
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
	

	
	if (insertEvent($eventname, $eventaddress, $eventdesc, $eventcategory)) {
		echo "<br/> <br/> Thanks, $username!  You have successfully created an event. <br/>";
		$eventID = selectEventID($eventname);
		insertEventTag($eventID, $eventcategory);
		insertUserTag($eventcategory);
		discoverSecondaryTags($eventID);
	}
	
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
				array( '%d', '%s', '%s', '%f', '%f', '%s', '%d' ) );	
	}
	
	else {
		$wpdb->insert( 'wp_grape_events',
				array(	'CreatedByUser' => $currUser->ID,
						'EventName' => $eventname,
						'Description' => $eventdesc, 
						'Category' => $eventcategory),
				array( '%d', '%s', '%s', '%d' ) );	
	}
	//echo "Current user is $currUser->ID<br/>EventName is $eventname<br/>Description is $eventdesc<br/>Category is $eventcategory<br/>";
	//echo "Event address is $eventaddress<br/>Geographic coordinates of the location of this event are ($latitude, $longitude)<br/>";

	return true;
}

function selectEventID($eventname) {
	global $wpdb;
	$eventID = null;
	$query = "SELECT * FROM wp_grape_events WHERE EventName='".$eventname."'";
	$result = $wpdb->get_results($query);
	foreach ($result as $row) {
		$eventID = $row->EventID;
	}
	return $eventID;
}

function insertEventTag($eventID, $tagID) {
	global $wpdb;
	$wpdb->insert( 'wp_grape_event_tags',
		array(	'event_id' => $eventID,
				'tag_id' => $tagID),
		array( '%d', '%d' ) );
}

function insertUserTag($tagID) {
  	global $currUser;	
	global $wpdb;
	$currUser = wp_get_current_user(); 
	$userID = $currUser->ID;
	
	//only insert this primary tag if a user doesn't already have it
	$tags = array();
	$query1 = "SELECT * FROM wp_grape_user_tags WHERE tagID < 10 AND userID = ".$userID;
	$result1 = $wpdb->get_results($query1);
	foreach($result1 as $row) {
		array_push($tags, $row->tagID);
	}
	
	if (count($tags) == 0 ) {
		//user has no primary tags yet
		$wpdb->insert( 'wp_grape_user_tags',
				array(	'userID' => $currUser->ID,
						'tagID' => $tagID),
				array( '%d', '%d' ) );	
	} else {
		for ($i=0; $i<count($tags); $i++) {
			if ($tags[$i] == $tagID) {
				continue;
			}
			if ( ($tags[$i] != $tagID) && ( $i == count($tags)-1) ) {
				//user doesn't have this primary tag, so insert it
				$wpdb->insert( 'wp_grape_user_tags',
					array(	'userID' => $currUser->ID,
							'tagID' => $tagID),
					array( '%d', '%d' ) );	
			}
		}
	}
}

function discoverSecondaryTags($eventID) {
	global $wpdb;
	$eventDesc = "";
	$eventName = "";
	$eventWords = array();
	$secondaryTags = array();
	
	$query1 = "SELECT * FROM wp_grape_tags_secondary";
	$result1 = $wpdb->get_results($query1);
	foreach ($result1 as $row) {
		array_push($secondaryTags, $row->tagName);
	}
	
	$query2 = "SELECT * FROM wp_grape_events WHERE EventID=".$eventID;
	$result2 = $wpdb->get_results($query2);
	foreach ($result2 as $row) {
		$eventDesc = $row->Description;
		$eventName = $row->EventName;
	}
	
	$descWords = preg_split("/[\s,!\?\.]+/", $eventDesc);
	$nameWords = preg_split("/[\s,!\?\.]+/", $eventName);
	
	foreach($descWords as $word) {
		array_push($eventWords, $word);
	}
	foreach($nameWords as $word) {
		array_push($eventWords, $word);
	}

	//search thru $eventDesc and $eventName for secondary tags
	$newSecondaryTags = array();		// secondary tags to be associated with event and user
	foreach ($secondaryTags as $sTag) {
		foreach ($eventWords as $word) {
			if( strtolower($sTag) == strtolower($word) ) {
				//they are the same
				array_push($newSecondaryTags, strtolower($sTag));
			}
		}
	}
	//get those secondary tags' IDs as associate with events and users
	insertSecondaryTags($eventID, $newSecondaryTags);
	
}

function insertSecondaryTags($eventID, $newSecondaryTags) {
	global $currUser;	
	global $wpdb;
	$currUser = wp_get_current_user();
	$userID = $currUser->ID;
	
	//get all new secondary tags' IDs
	$query1 = "SELECT * FROM wp_grape_tags_secondary";
	$result1 = $wpdb->get_results($query1);
	$tagIDs = array();
	foreach($newSecondaryTags as $tagname) {
		$query1 = "SELECT * FROM wp_grape_tags_secondary WHERE lower(tagName) LIKE '%".$tagname."%'";
		$result1 = $wpdb->get_results($query1);
		foreach($result1 as $row){
			array_push($tagIDs, $row->tagID);	
		}
	}
	
	//only insert secondary tags if the user does not already have them
	$usersTags = array();
	$query2 = "SELECT * FROM wp_grape_user_tags WHERE tagID > 9 AND userID = ".$userID;
	$result2 = $wpdb->get_results($query2);
	foreach($result2 as $row) {
		array_push($usersTags, $row->tagID);
	}
 	
 	//If the user has no secondary tags, insert
 	if (count($usersTags) == 0) {
 		foreach($tagIDs as $tagID) {
 			$wpdb->insert( 'wp_grape_user_tags',
				array(	'userID' => $currUser->ID,
						'tagID' => $tagID),
				array( '%d', '%d' ) );	
		}
 	} else {
		for($i=0; $i<count($tagIDs); $i++) {
				for($j=0; $j<count($usersTags); $j++) {
					if ( $tagIDs[$i] == $usersTags[$j] )
						break;	//because user already has that tag; increment $tagIDs				
					if (( $tagIDs[$i] != $usersTags[$j] ) && ( $j==count($usersTags)-1 ) ) {
						echo "we should insert this id: $tagIDs[$i]";
					    $wpdb->insert( 'wp_grape_user_tags',
		 					array(	'userID' => $currUser->ID,
		 							'tagID' => $tagIDs[$i]),
		 					array( '%d', '%d' ) );	
					}
				}
		}
 	}
 	//insert the secondary tags for the event into the event_tags table
 	foreach ($tagIDs as $tagID) {
		$wpdb->insert( 'wp_grape_event_tags',
				array(	'event_id' => $eventID,
						'tag_id' => $tagID),
				array( '%d', '%d' ) );
 	}
}

function getLocation($page, $pattern) {
	$content = file_get_contents($page);
	preg_match_all($pattern, $content, $res);
	$explodedRes = explode(", ",$res[0][0]);
	$location = array("latitude" => $explodedRes[0], "longitude" => $explodedRes[1]);
	return $location;
}

?>