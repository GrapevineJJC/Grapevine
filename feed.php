<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>
<link rel="stylesheet" type="text/css" href="wp-content/plugins/grapevine/css/grapevine.css"/>
</head>



<?php

function feed() {
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	
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
                    <input type="text" id="email" name="email" placeholder="Email Address" /><br/><br><br/>

                    <label>Your Phone Number:</label><br/>
					<input type="text" id="phone" name="phone" placeholder="Phone Number" /><br/><br>

					<label>Your Bio:</label><br/>
					<textarea id="bio" name="bio" rows="10" cols="50" placeholder="Enter Your Bio"></textarea><br/><br/>

		 			<lablel>Your Profile Picture:<label></br>
		 			<form action="wp-content/plugins/grapevine/upload.php" method="post" enctype="multipart/form-data">
    					Select image to upload:<br/>
    					<input type="file" name="fileToUpload" id="fileToUpload"><br/>
    					<input type="submit" value="Upload Image" name="submit">
					</form><br/><br/>

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
	
	// Later, if the user is simply editting info (not inputting for first time), we need to only update if they updated their info, not set database to NULL
	$wpdb->update( 'wp_grape_users',
			array(	'user_name' => $userName),
			array(	'user_email' => $userEmail),
			array(	'user_phone' => $userPhone),
			array(	'user_bio' => $userBio),
			array(	'user_image' => $userPhoto),
			array(	'ID' => $currUser->ID),		// WHERE clause
			array( '%s, %s, %s, %s, %s' ),		// data format
			array( '%d' )	);					// WHERE format
	
	echo "Am I here???";
}
	
	



function showFeed() {

	echo "<center>Welcome to your Feed! <br/></center>";
	echo "<center>Check out all these cool events</center>";
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





