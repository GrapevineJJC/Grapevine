<?php
function feed() {

include('plugins/popoverPlugin.js');
include('plugins/addingBLs.js');

	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
		
	echo "<h1>Welcome, $username</h1>";
		
	global $wpdb;
	
	//GET USERS BUCKETLIST IDs AND NAMES
	$query = 'SELECT * FROM wp_grape_bucketlists WHERE CreatedByUser  =  '.$current_user->ID;
	$result = $wpdb->get_results($query);

	$blnames = array();
	$blids = array();
	$numEvents = array();
	
	foreach ($result as $row) {
		$BLname = $row->BucketListName;
		array_push($blnames, $BLname);
		
		$BLID = $row->BucketListID;
		array_push($blids, $BLID);
		}
	
	
	if ($current_user->returning_user == 0 ) {
		//echo '$user->returning_user is'.$current_user->returning_user.' in the if statement!';
		// redirect them to the default place
		$wpdb->update( 'wp_grape_users',
			array(	'returning_user' => 1),
			array(	'ID' => $current_user->ID),		// WHERE clause
			array( '%d' ),							// data format
			array( '%d' )	);						// WHERE format
			launchModal();							// TODO
		//return home_url("/?page_id=44");	//First time logging in, make bucketlist.
	} else {
	
		showFeed();
	}
}

function launchModal() {

	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
?>

<script type="text/javascript">

$(document).ready(function(){
	$("#editProfileModal").modal('show');			
});

</script>

<!-- This is the html for the Edit Profile Modal. -->
<!-- Users click button to launch modal, enter the input fields, and insert into db -->
<div class="profileModal">
    <!-- Button HTML (to Trigger Modal) -->
    
    <!-- Modal HTML -->
    <div id="editProfileModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h1 class="modal-title">Edit Your Profile</h1>
                </div>
                <form method="post">
                <div class="modal-body">                  
                    <center><p>Tell us about yourself!</p></center><br/><br/>
                   
                   <label>Your Name:</label><br/>
                    <input type="text" id="name" name="name" placeholder="Name" /><br/><br/><br/>
                    
                    <label>Your email:</label><br/>
                    <input type="text" id="email" name="email" placeholder="Email Address" /><br/><br/><br/>

                    <label>Your Phone Number:</label><br/>
					<input type="text" id="phone" name="phone" placeholder="Phone Number" /><br/><br/><br/>

					<label>Your Bio:</label><br/>
					<textarea id="bio" name="bio" rows="10" cols="50" placeholder="Enter Your Bio"></textarea><br/><br/>

	
	
					<!-- (EDIT THIS AFTER TALKING TO ALVAREZ)
						Here we should query the database for all existing tags.
						Hardcoded a few tags for now.  2/14/2015                 -->
					<label><b>Check all tags that interest you:</b></label><br/>
					<center>
					<div style="float: left; text-align:left; width: 33%;">						
						<input type="checkbox" name="usertags[]" value="sports"/> Sports<br/>
						<input type="checkbox" name="usertags[]" value="nightlife"/> Nightlife<br/>
						<input type="checkbox" name="usertags[]" value="food"/> Food<br/>
						<input type="checkbox" name="usertags[]" value="beauty"/> Beauty<br/>
						<input type="checkbox" name="usertags[]" value="recreation"/> Recreation<br/>
					</div>	
					<div style="float: left; text-align:left; width: 33%;">
						<input type="checkbox" name="usertags[]" value="music"/> Music<br/> 
						<input type="checkbox" name="usertags[]" value="volunteering"/> Volunteering<br/>
						<input type="checkbox" name="usertags[]" value="beer"/> Beer<br/>
						<input type="checkbox" name="usertags[]" value="college"/> College<br/>
						<input type="checkbox" name="usertags[]" value="shopping"/> Shopping<br/>
					</div>
					<div style="float: right; text-align:left; width: 33%;">
						<input type="checkbox" name="usertags[]" value="books"/> Books<br/> 
						<input type="checkbox" name="usertags[]" value="tech"/> Tech<br/>
						<input type="checkbox" name="usertags[]" value="art"/> Art<br/>
						<input type="checkbox" name="usertags[]" value="gaming"/> Gaming<br/>
						<input type="checkbox" name="usertags[]" value="movies"/> Movies<br/>
					</div>
					</center>
					<br/><br/><br/><br/>
					<br/>

					
					
					<!-- Additional preference updates to refine recommendations upon
						 very first log-in. 	2/16/2015		--> 
						 
					<label><b>If you are interested in sports, check your favorite(s):</b></label><br/>
					<center>
					<div style="float: left; text-align:left; width: 33%;">
						<input type="checkbox" name="sportstags[]" value="football"/> Football <br/>
						<input type="checkbox" name="sportstags[]" value="hockey"/> Hockey <br/>
						<input type="checkbox" name="sportstags[]" value="basketball"/> Basketball <br/>
					</div>
					<div style="float: left; text-align:left; width: 33%;">
						<input type="checkbox" name="sportstags[]" value="baseball"/> Baseball		<br/>
						<input type="checkbox" name="sportstags[]" value="soccer"/> Soccer	<br/>
						<input type="checkbox" name="sportstags[]" value="volleyball"/> Volleyball <br/>
					</div>	
					<div style="float: right; text-align:left; width: 33%;">
						<input type="checkbox" name="sportstags[]" value="tennis"/> Tennis <br/>
						<input type="checkbox" name="sportstags[]" value="swimming"/> Swimming <br/>
						<input type="checkbox" name="sportstags[]" value="running"/> Running <br/>
					</div>
					</center>
					<br/><br/><br/><br/>
					<br/>

					
					<label><b>If applicable, let us know what kinds of restaurants you like:</b></label><br/>
					<center>
					<div style="float: left; text-align:left; width: 33%;">
						<input type="checkbox" name="foodtags[]" value="american"/> American<br/>
						<input type="checkbox" name="foodtags[]" value="italian"/> Italian<br/>
						<input type="checkbox" name="foodtags[]" value="chinese"/> Chinese<br/>
						<input type="checkbox" name="foodtags[]" value="japanese"/> Japanese/Sushi<br/>
						<input type="checkbox" name="foodtags[]" value="thai"/> Thai<br/>
						<input type="checkbox" name="foodtags[]" value="mexican"/> Mexican<br/>
						<input type="checkbox" name="foodtags[]" value="spanish"/> Spanish<br/>
						<input type="checkbox" name="foodtags[]" value="indian"/> Indian<br/>
						<input type="checkbox" name="foodtags[]" value="french"/> French<br/>
						<input type="checkbox" name="foodtags[]" value="cuban"/> Cuban<br/>
					</div>	
					<div style="float: left; text-align:left; width: 33%;">
						<input type="checkbox" name="foodtags[]" value="korean"/> Korean<br/>		
						<input type="checkbox" name="foodtags[]" value="greek"/> Greek<br/>
						<input type="checkbox" name="foodtags[]" value="german"/> German</br>
						<input type="checkbox" name="foodtags[]" value="latinamerican"/> Latin American<br/>
						<input type="checkbox" name="foodtags[]" value="mideastern"/> Middle Eastern<br/>
						<input type="checkbox" name="foodtags[]" value="southern"/> Southern<br/>
						<input type="checkbox" name="foodtags[]" value="vietnamese"/> Vietnamese<br/>
						<input type="checkbox" name="foodtags[]" value="tapas"/> Tapas<br/>
						<input type="checkbox" name="foodtags[]" value="pizzeria"/> Pizzeria<br/>
						<input type="checkbox" name="foodtags[]" value="pubgrills"/> Pubs/Grills<br/>	
					</div>	
					<div style="float: right; text-align:left; width: 33%;">
						<input type="checkbox" name="foodtags[]" value="barbecue"/> Barbecue<br/>	
						<input type="checkbox" name="foodtags[]" value="dimsum"/> Dim Sum<br/>
						<input type="checkbox" name="foodtags[]" value="vegan"/> Vegan<br/>
						<input type="checkbox" name="foodtags[]" value="deli"/> Deli<br/>
						<input type="checkbox" name="foodtags[]" value="vegan"/> Vegan<br/>
						<input type="checkbox" name="foodtags[]" value="fastfood"/> Fast Food<br/>
						<input type="checkbox" name="foodtags[]" value="seafood"/> Seafood<br/>
						<input type="checkbox" name="foodtags[]" value="brunch"/> Brunch<br/>
						<input type="checkbox" name="foodtags[]" value="diner"/> Diner<br/>
						<input type="checkbox" name="foodtags[]" value="dessert"/> Dessert<br/>
					<br/><br/><br/>
					</div>
					</center>
					<br/><br/><br/>

					<table>
					<tr>
					<td>
		 			<label>Your Profile Picture:<label><br/>
		 			</td>
		 			<td>
		 			<form action="wp-content/plugins/grapevine/upload.php" method="post" enctype="multipart/form-data">
    					Select image to upload <br/>
    					<input type="file" name="fileToUpload" id="fileToUpload"><br/>
    					<input type="submit" value="Upload Image" name="submit">
					</form><br/><br/>
					</td>
					</tr>
					</table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="ProfileCancel" name="EventCancel" style="color: black; font-size: 16px;">Cancel</button>
                	<!--<button class="btn btn-lg btn-success">Update Profile</button>-->
                    <input type="submit" class="btn btn-default" id="updateProfile" name="updateProfile" value="Update Profile" style="color: black; font-size: 16px;"/>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


	<?php

	// Show the feed now
	showFeed();
	?>

	<?php
	
	if(isset($_POST['updateProfile'])) {
		echo "I clicked update profile Button";
		if(isset($_POST['name'])) 
			$userName = $_POST['name'];
		else 
			$userName = NULL;
		if(isset($_POST['email'])) 
			$userEmail = $_POST['email'];
		else
			$userEmail = NULL;
		if(isset($_POST['phone']))
			$userPhone = $_POST['phone'];
		else
			$userPhone = NULL;
		if(isset($_POST['bio']))
			$userBio = $_POST['bio'];
		else
			$userBio = NULL;
		if(isset($_POST['fileToUpload']))
			$userPhoto = $_POST['fileToUpload'];
		else
			$userPhoto = NULL;
	
		updateProfile($userName, $userEmail, $userPhone, $userBio, $userPhoto);
	}
}


function addItem(){
	echo "IN ADD ITEM!";
	
	$idButton = isset($_POST['iddetector'])?$_POST['iddetector']:NULL;
    echo "The id of the button clicked is ".$idButton;
}


?>
<?php
function updateProfile($userName, $userEmail, $userPhone, $userBio, $userPhoto){

  	global $currUser;	
	global $wpdb;
	
	$currUser = wp_get_current_user(); 
	
	$update_query_start = "UPDATE wp_grape_users SET";
	$update_query_middle = "";
	$update_query_end = " WHERE ID = " . $currUser->ID;
	
	if($userName != NULL) {
		if($update_query_middle.strlen() == 0 )
			$update_query_middle .= " user_name = " . $userName;
		else
			$update_query_middle .= ", user_name = " . $userName;
	}
	if($userEmail != NULL) {
		if($update_query_middle.strlen() == 0 )
			$update_query_middle .= " user_email = " . $userEmail;
		else
			$update_query_middle .= ", user_email = " . $userEmail;
	}
	if($userPhone != NULL) {
		if($update_query_middle.strlen() == 0 )
			$update_query_middle .= " user_phone = " . $userPhone;
		else
			$update_query_middle .= ", user_phone = " . $userPhone;
	}
	if($userBio != NULL) {
		if($update_query_middle.strlen() == 0 )
			$update_query_middle .= " user_bio = " . $userBio;
		else
			$update_query_middle .= ", user_bio = " . $userBio;
	}	
	if($userPhoto != NULL) {
		if($update_query_middle.strlen() == 0 )
			$update_query_middle .= " user_image = " . $userPhoto;
		else
			$update_query_middle .= ", user_image = " . $userPhoto;
	}

	$full_query = $update_query_start . $update_query_middle . $update_query_end;
	
	$wpdb->query($full_query);
				
	
// Later, if the user is simply editting info (not inputting for first time), we need to only update if they updated their info, not set database to NULL
// 	$wpdb->update( 'wp_grape_users',
// 			array(	'user_name' => $userName),
// 			array(	'user_email' => $userEmail),
// 			array(	'user_phone' => $userPhone),
// 			array(	'user_bio' => $userBio),
// 			array(	'user_image' => $userPhoto),
// 			array(	'ID' => $currUser->ID),		// WHERE clause
// 			array( '%s, %s, %s, %s, %s' ),		// data format
// 			array( '%d' )	);					// WHERE format
// 	
// 	echo "Am I here???";
}
	
	



function showFeed() {
	
	global $wpdb;
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	$userid = $current_user->ID;
	recommendEvents($userid);
	
/*
	echo "<center>Welcome to your Feed! <br/></center><br/>";
	//echo "<center>Check out all these cool events</center>";
	
	$result = $wpdb->get_results( 'SELECT * from wp_grape_events' );
	
	foreach ($result as $row) {
		echo "<div class=\"well\"><h2> ".$row->EventName."</h2>";
		
		if ($row->LocationAddress != null) 
			echo "<label>Location: </label> ".$row->LocationAddress."<br/>";
			
		echo "<label>Category: </label> ".$row->Category."<br/>";
		echo "<label>Description: </label> ".$row->Description."<br/><br/>";
		
		echo "<button type=\"button\" class=\"btn btn-default\" id=\"AddToBL\" name=\"AddToBL\" style=\"color:black; font-size: 14px;\">Add to my bucket list!</button>";
		echo "</div><br/><br/>";
*/
	}
	
/**
 * RECOMMENDER
 *
 */	
function recommendEvents($userid) {
			$bl_names= $_POST['blnames'];
			$event_id = $_POST['eventid'];
			//var_dump($blnames);
			//var_dump($event_id);
			
	global $wpdb;
	
	/**** GET USERS BUCKETLIST IDs AND BUCKETLIST NAMES ****/
	$query = 'SELECT * FROM wp_grape_bucketlists WHERE CreatedByUser  =  '.$userid;

	$result = $wpdb->get_results($query);

	$blnames = array();
	
	foreach ($result as $row) {
		$BLname = $row->BucketListName;
		$BLID = $row->BucketListID;

		$blnames[$BLname] = $BLID;
	}
	echo "<br>";
	foreach ($blnames as $key => $value) {
    //echo "Key: $key; Value: $value<br />\n";
	}
	
	
	/****** TAGS *******/
	//table of tagIDs associated with user
/****TAKEN OUT AND REPLACED WITH BIG LARGE QUERY --- all lines that start with '//* ' *****/
		//* $result = $wpdb->get_results('SELECT tagID FROM wp_grape_user_tags WHERE userID='.$userid);
	
	//array of eventIDs
	//* $eventIDs = array();
	
	//get all eventIDs associated with all tagIDs
	//* foreach($result as $row) {
	//* 	$eventResult = $wpdb->get_results('SELECT event_id FROM wp_grape_event_tags WHERE tag_id='.$row->tagID);
	//* 	foreach($eventResult as $eventRow) {
	//* 		array_push($eventIDs, $eventRow->event_id);
	//* 	}
	//* }
		echo "<b>Here are some events we think you'll enjoy!</b>\n\n";
			
	//go thru all the eventIDs we've accumulated (all are primary)
	// go thru all events with those ID's and recommend them
	//* foreach($eventIDs as $id) {
	//* echo "id is $id";
	/*
		//Check if ID is primary or secondary
		if ($id>9) {		//secondary ID
			//get primary key associated with the secondary key
			$primaryIDs = $wpdb->get_results("SELECT parentID FROM wp_grape_tags_secondary WHERE tagID=".$id);
			foreach($primaryIDs as $key) { //only one
				//search for this ID in $eventIDs and take it out
				if (in_array($key, $eventIDs)
					unset($
			}
		}
	*/
	
	//* $events = $wpdb->get_results('SELECT * FROM wp_grape_events WHERE EventID='.$id);
	$events = $wpdb->get_results('
			SELECT e.EventName, e.LocationAddress, e.Description, e.EventID, e.CreatedByUser
				FROM wp_grape_users AS u
				JOIN wp_grape_user_tags AS ut ON u.ID = ut.userID
				JOIN wp_grape_event_tags AS et ON ut.tagID = et.tag_id
				JOIN wp_grape_events AS e ON e.EventID = et.event_id
				WHERE u.ID ='.$userid);
				
		foreach($events as $event) {
			$eventID = $event->EventID;
			echo "event id is $eventID";
			
			//print info for event
			echo "<div class=\"well\">
				<h2> ".$event->EventName."</h2>";
				
			echo "<label>Created by User: </label> ".$event->CreatedByUser."<br/>";
				$jpg = 'wp-content/plugins/grapevine/profilepictures/'.$event->CreatedByUser.'_thumb.jpg';
				if (file_exists($jpg)){
					echo "<img src=\"$jpg\" alt=\"Profile Picture\" /><br/>";
				}
		
				if ($event->LocationAddress != null) 
					echo "<label>Location: </label> ".$event->LocationAddress."<br/>";
				
				//* echo "<label>Category: </label> ".$event->Category."<br/>";
				echo "<label>Description: </label> ".$event->Description."<br/><br/>";

				echo "<button id=\"$eventID\" name=\"AddToBL\" type=\"button\" class=\"btn btn-warning popover-toggle\" data-container=\"body\" data-toggle=\"popover\" data-placement=\"right\" rel=\"popover\" title=\"My Bucketlists\">Add to Bucketlist!</button>";

				//echo "<button id=\"$eventID\" class=\"AddToBL\" type=\"button\" title=\"My Bucketlists\" >Add to Bucketlist!</button>";
				
				//echo "<input type=\"submit\" name=\"showBLs$eventID\" id=\"$eventID\" value=\"Add to Bucketlist!\">";
				
				
				?>
				<!-- your popup hidden content -->

				<?php echo "<div class=\"popover_content_wrapper\" id=\"$eventID\">"; ?>
					<form method="post">
						<?php
							echo "<input type='hidden' name='event_id' value='$eventID' />";
							
							foreach ($blnames as $key => $value) {
								echo "<input type=\"checkbox\" name=\"blnames[]\" value=\"$value\"> $key <br>";
							}
						?>
						<input type="submit" name="submitBLs" value="Submit">
					</form>
				</div>
			</div>
	
	<?php
	} //end foreach loop
	
	
		if(isset($_POST['submitBLs'])){		
		echo "I CLICKED THE SUBMIT BUTTON!";
			
		$bl_names= $_POST['blnames'];
		$event_id = $_POST['event_id'];
			
		echo "BL NAMES:\n";
		var_dump($bl_names);
			
		echo "<br/> EVENT ID:\n";
			var_dump($event_id);
		echo "<br/><br/><br/>";
		
		
		
		//Iterate through bucketlists checked and insert Event into BL
			foreach($bl_names as $bl){
			$wpdb->insert( 'wp_grape_blJoinEvents',
					array(	'BucketListID' => $bl,
							'EventID' => $event_id),
					array( '%d', '%d' ) );
			
			
			$query = 'SELECT NumberOfEvents FROM wp_grape_bucketlists WHERE BucketListID  =  '.$bl;
			$result = $wpdb->get_results($query);
	
			foreach ($result as $row) {
				$num = $row->NumberOfEvents;
				echo "Number of events in bl id $bl is $num\n";
				$newnum = $num + 1;
				echo "New Number of events in bl id $bl is $newnum\n";
			}
			
			
			$update_query = "UPDATE wp_grape_bucketlists SET NumberOfEvents = ".$newnum." WHERE BucketListID = ".$bl;
			echo "$update_query";
			$wpdb->query($update_query);
			
			}
			//QUERY FOR EVENT'S TAGS, STORE IN USER TAGS TABLE
	}
	
	/*
		foreach ($events as $event){
		$eventID = $event->EventID;
		echo "HEYY EVENT ID IS $eventID";
				if(isset($_POST['showBLs$eventID'])) {
					displayPopover($blnames, $eventID);
					if (isset($_POST['submitBLs$eventID'])) {
						$bucketlists = $_POST['blnames'];
						bucketlistsSelected($eventID, $bucketlists);
					}
				}
		}
	*/
	//* }
		
}

function useInfo(){
//Check if submit button hit
	if(isset($_POST['submitBLs'])){		
			echo "I CLICKED THE SUBMIT BUTTON!";
			
			$bl_names= $_POST['blnames'];
			$event_id = $_POST['event_id'];
			
			echo "BL NAMES:\n";
			//var_dump($bucketlists);
			
			echo "<br/> EVENT ID:\n";
			//var_dump($eventID);
	}
}

function displayPopover($blnames, $eventID) {
?>
	<div>
		<form method="post">
			<?php
				echo "<input type='hidden' name='event_id' value='$eventID' />";
				 
				foreach ($blnames as $key => $value) {
					echo "<input type=\"checkbox\" name=\"blnames[]\" value=\"$value\"> $key <br>";
				}
			echo "<input type=\"submit\" name=\"submitBLs$eventID\" value=\"Submit\">";
			?>
		</form>   
	</div>
<?php
}

function bucketlistsSelected($eventID, $bucketlists) {
//Check if submit button hit
		//if(isset($_POST['submitBLs'])){		
		//	echo "I CLICKED THE SUBMIT BUTTON!";
			
		//	$bl_names= $_POST['blnames'];
		//	$event_id = $_POST['event_id'];
			
			echo "BL NAMES:\n";
			var_dump($bucketlists);
			
			echo "<br/> EVENT ID:\n";
			var_dump($eventID);
			
			//Iterate through bucketlists checked and insert Event into BL
			foreach($bl_names as $bl){
			$wpdb->insert( 'wp_grape_blJoinEvents',
					array(	'BucketListID' => $bl,
							'EventID' => $event_id),
					array( '%d', '%d' ) );
			
			}
			//QUERY FOR EVENT'S TAGS, STORE IN USER TAGS TABLE
		//}


}