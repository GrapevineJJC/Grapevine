<?php
function feed() {

	include('plugins/popoverPlugin.js');
	include('plugins/addingBLs.js');

	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
		
	//echo "<h1>Welcome, $username</h1>";
		
	global $wpdb;
	
	
	?>
<!-- Button HTML (to Trigger Modal) -->
<div class="feedHeader">Explore & Create Events <a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">+</a> </div>
 
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
		
		$eventname = stripslashes($_POST['eventname']);
		
		if(isset($_POST['eventaddress'])) {
			$eventaddress = stripslashes($_POST['eventaddress']);
		}
		
		$eventdesc = stripslashes($_POST['eventdesc']);
		$eventcategory = $_POST['eventcategory'];
		
	
		
		if (insertEvent($eventname, $eventaddress, $eventdesc, $eventcategory)) {
			//echo "<br/> <br/> Thanks, $username!  You have successfully created an event. <br/>";
			$eventID = selectEventID($eventname);
			insertEventTag($eventID, $eventcategory);
			insertUserTag($eventcategory);
			discoverSecondaryTags($eventID);
		}
	}
	
	
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
							<br/><br/><br/><br/><br/>
		
							
							
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
							<br/><br/><br/><br/><br/>
		
							
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
							</div>
							</center>
							<br/><br/><br/>
		
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
}

	
/**
 * RECOMMENDER
 *
 */	
function recommendEvents($userid) {
	global $wpdb;
	
	//used to cap number of events shown in feed
	$maxNumberOfEvents = 50;
	$currentNumberOfEvents = 0;

	$bl_names= $_POST['blnames'];
	$event_id = $_POST['eventid'];
	
	/**** GET USERS BUCKETLIST IDs AND BUCKETLIST NAMES ****/
	$query = 'SELECT * FROM wp_grape_bucketlists WHERE CreatedByUser  =  '.$userid;

	$result = $wpdb->get_results($query);

	$blnames = array();
	
	foreach ($result as $row) {
		$BLname = $row->BucketListName;
		$BLID = $row->BucketListID;

		$blnames[$BLname] = $BLID;
	}
	//all events with tags the user has		
	$events = $wpdb->get_results('
			SELECT DISTINCT e.EventID, e.EventName, e.LocationAddress, e.Description, e.CreatedByUser, e.category
				FROM wp_grape_users AS u
				JOIN wp_grape_user_tags AS ut ON u.ID = ut.userID
				JOIN wp_grape_event_tags AS et ON ut.tagID = et.tag_id
				JOIN wp_grape_events AS e ON e.EventID = et.event_id
				WHERE u.ID ='.$userid);
				
	//get all weights for user tags
	$weightArray=array();
	$mainweightArray = array();		// associative array of tagIDs to their weight
	$weightQuery = "SELECT * FROM wp_grape_user_tags WHERE userID=".$userid;
	$weightResult = $wpdb->get_results($weightQuery);
	foreach ($weightResult as $row) {
		$weight=$row->weight;
		$tagID=$row->tagID;
		$weightArray['tagID']=(int)$tagID;
		$weightArray['weight']=(int)$weight;
		array_push($mainweightArray, $weightArray);
	}
	//sort the tags by weight
	asort($mainweightArray);echo "<br/>";
	//var_dump($mainweightArray);
	
	$tagsWithHighWeights = array();
	foreach($mainweightArray as $m) {
		array_push($tagsWithHighWeights, $m['tagID']);
		//echo "--".$m['tagID'];
	}
	//now select all events with the first tag in $tagsWithHighWeights, then the next, etc.	
		//showNewEvents($tagsWithHighWeights, $blnames);

	foreach($events as $event) {
		if ($currentNumberOfEvents < $maxNumberOfEvents) {
			$eventID = $event->EventID;
			$category = $event->category;
			$name = $event->EventName;
			$createdby = $event->CreatedByUser;
			$jpg = 'wp-content/plugins/grapevine/profilepictures/'.$event->CreatedByUser.'_thumb.jpg';
			$loc = $event->LocationAddress;
			$desc = $event->Description;
			$nicename = "";
			
			$nameq = 'SELECT u.user_nicename FROM wp_grape_users as u WHERE u.ID = '.$createdby;
			$result = $wpdb->get_results($nameq);
			foreach ($result as $row) {
				$nicename = $row->user_nicename;
			}
			
			// $event_tags = array();
// 			$qry="SELECT * FROM wp_grape_event_tags WHERE event_id=".$eventID;
// 			$qryresult = $wpdb->get_results($qry);
// 			foreach($qryresult as $q) {
// 				array_push($event_tags, $q->tag_id);
// 			}
// 			for($a=0; $a<count($event_tags); $a++) {
// 				for($b=0; $b<count($tagsWithHighWeights); $b++){
// 					if($event_tags[$a] == $tagsWithHighWeights[$b]) {
// 						//yes add this event to top of feed
// 						//showNewEvents($newEventsToShow, $blnames);
// 						//printThisEvent($eventID, $name, $createdby, $jpg, $loc, $desc, $nicename, $blnames);
// 						echo "<br/>yeah this tag has a high weight <br/> tagid is $event_tags[$a]";
// 						$a=count($event_tags);	//break out of first loop
// 						break;					//break out of current loop
// 					}
// 				}
// 			}

		printThisEvent($eventID, $name, $createdby, $jpg, $loc, $desc, $nicename, $blnames);		
		}
		$currentNumberOfEvents++;
	} //end of foreach loop
	
	

	// $events are all the events the user is already associated with (Don't show these again)
	$alreadyShownEventIDs = array();
	foreach($events as $event) {
		array_push($alreadyShownEventIDs, $event->EventID);
	}
	// get all the events in the DB
	$otherEventIDs = array();
	$query = "SELECT * FROM wp_grape_events";
	$result = $wpdb->get_results($query);
	foreach($result as $row) {
		array_push($otherEventIDs, $row->EventID);
	}
	//compare the 2 arrays and filter out eventIDs we already showed
	$newEventsToShow = array();
	for($i=0; $i<count($otherEventIDs); $i++) {
		for($j=0; $j<count($alreadyShownEventIDs); $j++) {
			if ($otherEventIDs[$i] == $alreadyShownEventIDs[$j])
				break;
			if (( $otherEventIDs[$i] != $alreadyShownEventIDs[$j] ) && ( $j==count($alreadyShownEventIDs)-1 ) )
				array_push($newEventsToShow, $otherEventIDs[$i]);
		}
	}
	
	//now print out other events that are not associated with the user (not recommended); Fill up to 50
	if ($currentNumberOfEvents < $maxNumberOfEvents) {
		showNewEvents($newEventsToShow, $blnames);
		$currentNumberOfEvents++;
	}
	
	
	if(isset($_POST['submitBLs'])){					
		$bl_names= $_POST['blnames'];
		$event_id = $_POST['event_id'];
		insertEventIntoBLs($bl_names, $event_id);
	}
			
}



function insertEventIntoBLs($bl_names, $event_id) {
	global $wpdb;			
	
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
		
		//add these tags to be associated with the user and update the weights (goes to events.php function updateWeight())
		addEventTagsForUser($event_id);
	}

}

function addEventTagsForUser($event_id){
	global $wpdb;
	$current_user = wp_get_current_user();
	$userID = $current_user->ID;
	
	//get all tags associated with this event
	$tagIDs = array();
	$query = "SELECT * FROM wp_grape_event_tags WHERE event_id=".$event_id;
	$result = $wpdb->get_results($query);
	foreach ($result as $row) {
		array_push($tagIDs, $row->tag_id);
	}
	
	//get all the user's tags
	$usersTags = array();
	$query2 = "SELECT * FROM wp_grape_user_tags WHERE userID=".$userID;
	$result2 = $wpdb->get_results($query2);
	foreach($result2 as $row){
		array_push($usersTags, $row->tagID);	
	}
	
	//insert these tags with user if she doesn't have them yet
	//	if she has them, just increment the weight counter
	if (count($usersTags) == 0) {
 		foreach($tagIDs as $tagID) {
 			$wpdb->insert( 'wp_grape_user_tags',
				array(	'userID' => $userID,
						'tagID' => $tagID),
				array( '%d', '%d' ) );	
		}
 	} else {
		for($i=0; $i<count($tagIDs); $i++) {
				for($j=0; $j<count($usersTags); $j++) {
					if ( $tagIDs[$i] == $usersTags[$j] ) {	// user already has that tag; just increment counter
						updateWeight($userID,$usersTags[$j]);
						break;								//because user already has that tag; increment $tagIDs
						}		
					if (( $tagIDs[$i] != $usersTags[$j] ) && ( $j==count($usersTags)-1 ) ) {
						//echo "we should insert this id: $tagIDs[$i]";
					    $wpdb->insert( 'wp_grape_user_tags',
		 					array(	'userID' => $userID,
		 							'tagID' => $tagIDs[$i]),
		 					array( '%d', '%d' ) );	
					}
				}
		}
 	}
}


function showNewEvents($newEventsToShow, $blnames) {
	global $wpdb;
	//get all info for eventIDs
	foreach ($newEventsToShow as $event) {
		$query = "SELECT * FROM wp_grape_events WHERE EventID=".$event;
		$result = $wpdb->get_results($query);
		foreach($result as $row) {
		
			$eventID = $row->EventID;
			$name = $row->EventName;
			$createdby = $row->CreatedByUser;
			$jpg = 'wp-content/plugins/grapevine/profilepictures/'.$row->CreatedByUser.'_thumb.jpg';
			$loc = $row->LocationAddress;
			$desc = $row->Description;
			$nicename = "";
			$nameq = 'SELECT u.user_nicename FROM wp_grape_users as u WHERE u.ID = '.$createdby;
			$result2 = $wpdb->get_results($nameq);
			foreach ($result2 as $row2) {
				$nicename = $row2->user_nicename;
			}
			printThisEvent($eventID, $name, $createdby, $jpg, $loc, $desc, $nicename, $blnames);
		}
	}

}




function printThisEvent($eventID, $name, $createdby, $jpg, $loc, $desc, $nicename, $blnames){
	//print info for event; cap at 50
	echo "<div class=\"well\">";
	echo "<div class=\"feedContent\">";
	echo "<div class=\"blHeader\"> ".$name."</div>";
	?>
		<div class="container">
			<div class="row">
				<div class="col-md-1">
					<?php
					$jpg = 'wp-content/plugins/grapevine/profilepictures/'.$createdby.'_thumb.jpg';
					$png = 'wp-content/plugins/grapevine/profilepictures/'.$createdby.'_thumb.png';	
					$gif = 'wp-content/plugins/grapevine/profilepictures/'.$createdby.'_thumb.gif';
					$jpeg = 'wp-content/plugins/grapevine/profilepictures/'.$createdby.'_thumb.jpeg';						
					if (file_exists($jpg)){
						echo "<div class='circular' style = 'background-image: url($jpg)'></div>";
					}
					else if (file_exists($jpeg)){
							echo "<div class='circular' style = 'background-image: url($jpeg)'></div>";
					}
					else if (file_exists($png)){
						echo "<div class='circular' style = 'background-image: url($png)'></div>";
					}
					
					else if (file_exists($gif)){
							echo "<div class='circular' style = 'background-image: url($gif)'></div>";
					}
					?>
				</div>
				<div class="col-md-5 paddedDiv createdBy">			
					<?php echo "<label>Created by User: </label> $nicename"; ?>
				</div>
				<div class="col-md-6 myBucketLists">			
					<?php echo "MY BUCKETLISTS"; ?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-6">			
					<?php
					if ($loc != null) 
						echo "<label>Location: </label> ".$loc."<br/>";
					echo "<label>Description: </label> ".$desc."<br/><br/>";
		
					//echo "<button id=\"$eventID\" name=\"AddToBL\" type=\"button\" class=\"btn btn-warning popover-toggle\" data-container=\"body\" data-toggle=\"popover\" data-placement=\"right\" rel=\"popover\" title=\"My Bucketlists\">Add to Bucketlist!</button>";
					//echo "<button id=\"$eventID\" class=\"AddToBL\" type=\"button\" title=\"My Bucketlists\" >Add to Bucketlist!</button>";
					//echo "<input type=\"submit\" name=\"showBLs$eventID\" id=\"$eventID\" value=\"Add to Bucketlist!\">";
					?>
				</div>
				<div class="col-md-6">
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
			</div>
	<?php
	echo "</div>";
	echo "</div>";
	echo "</div>";
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

function createModal(){

}