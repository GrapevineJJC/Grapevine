<<<<<<< Updated upstream
<?php
function editprofile(){

include('plugins/accordionPlugin.js');

	global $wpdb;	
=======
<?php
function editprofile(){

include('plugins/accordionPlugin.js');

?>
<h1><center>Update Your Preferences</center><br/></h1>
<?php

	global $wpdb;
>>>>>>> Stashed changes
	
	$current_user = wp_get_current_user();
	$currID = $current_user->ID;
	//echo "current user id is $current_user->ID<br/><br/>";

	
	
	$query = 'SELECT * FROM wp_grape_users WHERE ID  =  '.$currID;
	
	$result = $wpdb->get_results($query);
	
	//Query for current users info. Pre-populate editprofile form.
	foreach ($result as $row) {
		$nicename = $row->user_nicename;
		$email = $row->user_email;
	}
	
<<<<<<< Updated upstream
	echo "current id $currID \n";
	echo "current nicename $nicename \n";
	echo "current email $email \n";
=======
	//echo "current id $currID \n";
	//echo "current nicename $nicename \n";
	//echo "current email $email \n";
>>>>>>> Stashed changes

	showTags();
	updateProfileWithNewTags();
}

function showTags(){
?>
	<form method="post">
		<div id="accordion">
					
		<!-- PRIMARY TAGS -->
		<h3 style="color: #2B989E"><b>Check all tags that interest you:</b></h3>
		<div>	
		<?php
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID FROM wp_grape_tags_primary');
			foreach ($result as $row) {
				echo "<input type=\"checkbox\" name=\"usertags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
			?>
		</div>
							
		<!-- SECONDARY TAGS -->
		<?php
		global $wpdb;
		$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
		?>
		
		<!--   FOOD TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Restaurants:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 1) {
				echo "<input type=\"checkbox\" name=\"foodtags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
														
		<!--   SPORTS TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Sports:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 2) {
				echo "<input type=\"checkbox\" name=\"sportstags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
							
		<!--   FITNESS TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Fitness:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 3) {
				echo "<input type=\"checkbox\" name=\"fitnesstags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
							
		<!--   BARS TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Bars:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 4) {
				echo "<input type=\"checkbox\" name=\"barstags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
							
		<!--   MUSIC TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Music:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 5) {
				echo "<input type=\"checkbox\" name=\"musictags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
							
		<!--   THEATRE TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Theatre:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 6) {
				echo "<input type=\"checkbox\" name=\"theatretags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
							
		<!--   MUSEUMS TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Museums:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 7) {
				echo "<input type=\"checkbox\" name=\"museumtags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
							
		<!--   GAMING TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Gaming:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 8) {
				echo "<input type=\"checkbox\" name=\"gamingtags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
							
		<!--   OUTDOOR TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Outdoors:</b></h3>
		<div>	
		<?php
		foreach ($result as $row) {
			if($row->parentID == 9) {
				echo "<input type=\"checkbox\" name=\"outdoortags[]\" value=\"$row->tagID\">";
				echo " $row->tagName";
				echo "<br/>";
			}
		}
		?>
		</div>
	</div> <!-- end accordion -->

	<br/><br/><br/>
	
	<input type="submit" id="updatePro" name="updatePro" value="Update Profile" style="color: black; font-size: 16px;"/>
	</form>	
<?php	
}

<<<<<<< Updated upstream


=======


>>>>>>> Stashed changes
function updateProfileWithNewTags() {
  	global $wpdb;
	$current_user = wp_get_current_user();
	$currID = $current_user->ID;
	$currName = $current_user->user_nicename;
<<<<<<< Updated upstream
  	echo "current user is  $currID <br>";
  	echo "current user is $currName <br>";
=======
  	//echo "current user is  $currID <br>";
  	//echo "current user is $currName <br>";
>>>>>>> Stashed changes
  	
  	$newTags = array();
	if ( isset($_POST["updatePro"]) ) {
	
		if(isset($_POST["usertags"])) {
			$primaryTags = $_POST["usertags"];
			foreach ($primaryTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}
		}
		if(isset($_POST["foodtags"])) {
			$foodTags = $_POST["foodtags"];
			foreach ($foodTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}	
		}
		if(isset($_POST["sportstags"])) {	
			$sportsTags = $_POST["sportstags"];
			foreach ($sportsTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}
		}
		if(isset($_POST["fitnesstags"])) {	
			$fitnessTags = $_POST["fitnesstags"];
			foreach ($fitnessTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}	
		}	
		if(isset($_POST["barstags"])) {			
			$barsTags = $_POST["barstags"];
			foreach ($barsTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}				
		}
		if(isset($_POST["theatretags"])) {
			$theatreTags = $_POST["theatretags"];
			foreach ($theatreTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}		
		}	
		if(isset($_POST["museumtags"])) {		
			$museumTags = $_POST["museumtags"];
			foreach ($museumTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}
		}
		if(isset($_POST["musictags"])) {		
			$musicTags = $_POST["musictags"];
			foreach ($musicTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}
		}
		if(isset($_POST["gamingtags"])) {	
			$gamingTags = $_POST["gamingtags"];
			foreach ($gamingTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}		
		}		
		if(isset($_POST["outdoortags"])) {
			$outdoorTags = $_POST["outdoortags"];
			foreach ($outdoorTags as $tag) {
				echo "$tag \t";
				array_push($newTags, $tag);				
			}	
		}			
		
		//store $newTags in DB
		foreach ($newTags as $tag) { 		
			$count = 0;
			
			$query = 'SELECT COUNT(*) as count, tagID, weight FROM wp_grape_user_tags WHERE tagID = '.$tag.' AND userID = '.$currID.' ';
			echo $query;
			
			$result = $wpdb->get_results($query);
		
			//Query for current users info. Pre-populate editprofile form.
			foreach ($result as $row) {
				$count = $row->count;
				$weight = $row->weight;
			}
			
			echo "Count is $count and weight is $weight";
			
			if($count == 0){
			
				 $wpdb->insert( 'wp_grape_user_tags',
					array(	'userID' => $currID,
							'tagID' => $tag),
					array( '%d', '%d' ) );
			}
			
			else if ($count > 0){
					$newweight = $weight + 1;
					echo "New weight for tag id $tag is $newweight";
					$wpdb->update( 'wp_grape_user_tags',
						array(	'weight' => $newweight),
						array(	'ID' => $currID),		// WHERE clause
						array( '%d' ),							// data format
						array( '%d' )	);						// WHERE format
			}
		}
	}
}	
?>