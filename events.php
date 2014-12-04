<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>
<link rel="stylesheet" type="text/css" href="wp-content/plugins/grapevine/css/grapevine.css"/>
</head>

<?php

function testEvents(){
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	
	echo "<h1>Welcome, $username</h1>";

?>

<script type="text/javascript">

$(document).ready(function(){
	
		$("#blItemButton").click(function(){
			$("#blitemModal").modal('show');
		});
  			
});

</script>

<!-- This is the html for the Bucketlist Item Modals. -->
<!-- Users click button to launch modal, enter the input fields, and insert into db -->
<div class="bucketlistitemModal">
    <!-- Button HTML (to Trigger Modal) -->
    <center><a href="#" id="blItemButton" class="btn btn-lg btn-success">Create Event!</a></center>
    
    <!-- Modal HTML -->
    <div id="blitemModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h1 class="modal-title">Create a new Desired Place to Go, Event, or Activity</h1>
                </div>
                <form method="post">
                <div class="modal-body">                  
                    <center><p>Give it a name, description, and category!</p></center><br/><br/>
                   
                   <label>Name of Desired Place to Go, Event, or Activity:</label><br/>
                    <input type="text" id="eventname" name="eventname" placeholder="E.g. Fin's Sushi+Grill or Kayaking on the Charles" size="60" /><br/><br/><br/>
                    
                    <label>Description:</label><br/>
                    <textarea id="eventdesc" name="eventdesc" placeholder="E.g. New sushi restaurant to try, or exciting adventures in Boston!" row="40" cols="65" maxlength="150"></textarea><br/><br/><br/>
                    
                    <label>Category:</label><br/>
                    <select id="eventcategory" name="eventcategory">
                    	<option value="food">Food & Dining</option>
                   	 	<option value="nightlife">Nightlife</option>
                    	<option value="entertainment">Entertainment</option>
                    	<option value="sports">Sporting Events</option>
                    	<option value="academic">Academic</option>
                    	<option value="travel">Travel</option>
                    	<option value="outdoors">Outdoors</option>
                    </select>
		 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="EventCancel" name="EventCancel" style="color: black; font-size: 16px;">Cancel</button>
                    <input type="submit" class="btn btn-default" id="createEvent" name="createEvent" value="Create" style="color: black; font-size: 16px;"/>
                
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if(isset($_POST['createEvent'])){
	$eventname = $_POST['eventname'];
	$eventdesc = $_POST['eventdesc'];
	$eventcategory = $_POST['eventcategory'];
	insertEvent($eventname, $eventdesc, $eventcategory);
}
}

function insertEvent($eventname, $eventdesc, $eventcategory){

  	global $currUser;	
	global $wpdb;
	
	$currUser = wp_get_current_user(); 
	
	$wpdb->insert( 'wp_grape_events',
				array(	'CreatedByUser' => $currUser->ID,
						'EventName' => $eventname,
						'Description' => $eventdesc, 
						'Category' => $eventcategory),
				array( '%d', '%s', '%s', '%s' ) );	
	
	echo "Current user is $currUser->ID<br/>EventName is $eventname<br/>Description is $eventdesc<br/>Category is $eventcategory<br/>";
}