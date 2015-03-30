<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>
<link rel="stylesheet" type="text/css" href="wp-content/plugins/grapevine/css/grapevine.css"/>
</head>

<script>
#event {
    height: 500px;
    width: 200px;
    border: 1px solid lightgrey;
}
</script>

<?php

function feed() {

	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	
	echo "<h1>Welcome, $username</h1>";
		
	global $wpdb;
	if ($current_user->returning_user == 0 ) {
		echo '$user->returning_user is'.$current_user->returning_user.' in the if statement!';
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
		//echo '$user->returning_user is'.$username;
		//return home_url("/?page_id=2"); // Else, returning user, bring to events page
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

	}
}




// 
// 
// // Uploading Image stuff
// function getImageData() {
// 	$imageName = mysql_real_escape_string($_FILES["fileToUpload"]["name"]);
// 	$imageData = mysql_real_escape_string(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));
// 	$imageType = mysql_real_escape_string($_FILES["image"]["type"]);
// 	
// 	if(substr($imageType,0,5) == "image") {
// 		// insert into database
// 		insertImage($imageData);
// 		echo "Image Uploaded Sucessfully";
// 		// show the image back to us
// 	} else {
// 		echo "Only images are allowed!";
// 	}
// }
// 
// function insertImage($imageData) {
// 	global $currUser;	
// 	global $wpdb;
// 	
// 	$currUser = wp_get_current_user(); 
// 	
// 	$wpdb->update( 'wp_grape_events',
// 				array(	'user_image' => $imageData),
// 				array(	'ID' => $currUser->ID),			// WHERE clause
// 				array( '%s' ),							// data format
// 				array( '%d' )	);						// WHERE format
// }
// 
// 
// 
// 
// 
// 
// 
// // upload photo to fetch if we tried to upload
// if(isset($_POST['submit'])) {
// 	getImageData();
// }





