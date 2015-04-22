<?php
function editprofile(){

include('plugins/accordionPlugin.js');

	global $wpdb;	
	
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
?>

<center>

<div id="home">
<!-- <div class="promo" id="home" style="background-image:url(img/promo.jpg);"> -->
<h1>Edit Your Profile!</h1><br/>
<form method="post">
	
	<div class="row">
	  <center>
	  <div style="float:center; class:col-md-4">
			<label>Your Name:</label><br/>
			<input type="text" id="name" name="name" value ="<?php echo htmlspecialchars($nicename); ?>" placeholder="Name" /><br/>
	  </div><br/>
	  </center>
	  <center>
	  <div style="float:center; class:col-md-4">
		<label>Your Email:</label><br/>
		<input type="text" id="email" name="email" value ="<?php echo htmlspecialchars($email); ?>"placeholder="Email Address" /><br/>
	  </div><br/>
	  </center>
	</div>
	
	<center>
		<table>
		<tr>
		<td>
			<label>Your Profile Picture:<label><br/>
		</td>
		<td>
			<center>
		<!--	<form class="well" action="wp-content/plugins/grapevine/upload_profile_pictures.php" method="post" enctype="multipart/form-data">
				Select image to upload:<br/>
				<input type="file" name="fileToUpload" id="fileToUpload"><br/>
				<input type="submit" value="Upload Image" name="submit">
			</form> -->
			</center><br/><br/>
		</td>
		</tr>
		</table>
	</center>
	
	
	<div class="ui-widget">
	  <label for="tags">Tag Your Interests (e.g. Sports, Food, Nightlife): </label>
	  <input id="tags">
	</div>
	
	<div class="ui-widget">
	  <label for="restaurantTags">Tag Your Favorite Kinds of Restaurants (e.g. Italian, Mexican, Brunch, Dim Sum): </label>
	  <input id="restaurantTags">
	</div>
	
	<div><br/><br/><br/><br/></div>
	

						<!-- (EDIT THIS AFTER TALKING TO ALVAREZ)
							Here we should query the database for all existing tags.
							If that tag is already associated with the user, don't display it.
							Display a total of XX tags at all times.
								(Ideally, make it responsive so that once a tag is checked, it goes
								away and a new one pops up in its place.  This is only for editprofile.php,
								not feed.php.)
							Hardcoded a few tags for now.  2/15/2015      
							I added some additional tags [Julia 2/16/2015]           -->
	
	
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
		
		<!--   FOOD TAGS   -->					 
		<h3 style="color: #38C0C7"><b>Restaurants:</b></h3>
		<div>	
		<?php
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
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
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
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
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
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
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
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
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
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
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
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
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
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
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
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
			global $wpdb;
			$result = $wpdb->get_results('SELECT tagName, tagID, parentID FROM wp_grape_tags_secondary');
			foreach ($result as $row) {
				if($row->parentID == 9) {
					echo "<input type=\"checkbox\" name=\"outdoortags[]\" value=\"$row->tagID\">";
					echo " $row->tagName";
					echo "<br/>";
				}
			}
		?>
		</div>
	</div>
	
	<div><br/><br/><br/></div>
	
		<input type="submit" id="updatePro" name="updatePro" value="Update Profile" style="color: black; font-size: 16px;"/>
</form>
<?php
updateProfileWithNewTags();
?>
<br/><br/>

</div>

<?php
}

  /* Update DB with new tags - store tag ID in wp_grape_user_tags associated with current user*/
function updateProfileWithNewTags() {
  	global $wpdb;
	$current_user = wp_get_current_user();
	$currID = $current_user->ID;
	$currID = 1;								// HARDCODED FOR NOW ---- TAKE OUT LATER
  	echo "current user is  $currID <br>";
  	
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
				$wpdb->insert( 'wp_grape_user_tags',
					array(	'userID' => $currID,
							'tagID' => $tag),
					array( '%d', '%d' ) );
			}
  		}
  		
  		/* Update DB with name and email */
  		$updatedName = $_POST["name"];
  		$updatedEmail = $_POST["email"];
		echo "name and email are: $updatedName and $updatedEmail";
}
?>