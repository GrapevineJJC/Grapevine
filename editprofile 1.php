<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>
<link rel="stylesheet" type="text/css" href="wp-content/plugins/grapevine/css/grapevine.css"/>
</head>
<body>

<?php

function editprofile(){

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
		$phone = $row->user_phone;
		$bio = $row->user_bio;
	}
?>

<center>



<div class="promo" id="home" style="background-image:url(img/promo.jpg);">
<h1>Edit Your Profile!</h1><br/>
<form method="post">

<div class="row">
  <div class="col-md-4">
  		<label>Your Name:</label><br/>
		<input type="text" id="name" name="name" value ="<?php echo htmlspecialchars($nicename); ?>" placeholder="Name" /><br/><br/><br/>
  </div>
  
  <div class="col-md-4">
  	<label>Your email:</label><br/>
	<input type="text" id="email" name="email" value ="<?php echo htmlspecialchars($email); ?>"placeholder="Email Address" /><br/><br><br/>
  </div>
  
  
  <div class="col-md-4">
  	<label>Your Phone Number:</label><br/>
	<input type="text" id="phone" name="phone" value ="<?php echo htmlspecialchars($phone); ?>"placeholder="Phone Number" /><br/><br>
  </div>
</div>

                
	<label>Your Bio:</label><br/>
	<textarea id="bio" name="bio" rows="10" cols="50" value ="<?php echo htmlspecialchars($bio); ?>" placeholder="Enter Your Bio"></textarea><br/><br/>
	
	<input type="submit" id="updatePro" name="updatePro" value="Update Pro" style="color: black; font-size: 16px;"/>
</form><br/><br/>




<lablel>Your Profile Picture:<label></br>
<form class="well" action="wp-content/plugins/grapevine/upload_profile_pictures.php" method="post" enctype="multipart/form-data">
	Select image to upload:<br/>
	<input type="file" name="fileToUpload" id="fileToUpload"><br/>
	<input type="submit" value="Upload Image" name="submit">
</form><br/><br/>
</div>

<?php
	if(isset($_POST['updatePro'])){
		echo "I clicked update profile Button";
		

		}
}

		/*if(isset($_POST['name'])) 
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
		//if(isset($_POST['fileToUpload']))
		//	$userPhoto = $_POST['fileToUpload'];
		//else
		//	$userPhoto = NULL;
	
		//updatePro($userName, $userEmail, $userPhone, $userBio);
	}
}

function updatePro($userName, $userEmail, $userPhone, $userBio){			
		$wpdb->update( 'wp_grape_users',
			array(	'user_nicename' => $userName),
			array(	'user_email' => $userEmail),		// WHERE clause
			array(	'user_phone' => $userPhone),
			array(	'user_bio' => $userBio),
			array( '%s' ),
			array( '%s' ),
			array( '%d' ),							// data format
			array( '%s' )	);						// WHERE format
}

/*	$currUser = wp_get_current_user(); 	
	$update_query_start = "UPDATE wp_grape_users SET";
	$update_query_middle = "";
	$update_query_end = " WHERE ID = " . $currUser->ID;
	
	$update_query_middle .= " user_nicename = 'Julezzz Elizabeth' ";
	
	if($userName != NULL) {
		if(strlen($update_query_middle) == 0 )
			$update_query_middle .= " user__nicename = '" . $userName."'";
		else
			$update_query_middle .= ", user_nicename = '" . $userName."'";
	}
	if($userEmail != NULL) {
		if(strlen($update_query_middle) == 0 )
			$update_query_middle .= " user_email = '" . $userEmail."'";
		else
			$update_query_middle .= ", user_email = '" . $userEmail."'";
	}
	if($userPhone != NULL) {
		if(strlen($update_query_middle) == 0 )
			$update_query_middle .= " user_phone = '" . $userPhone."'";
		else
			$update_query_middle .= ", user_phone = '" . $userPhone."'";
	}
	if($userBio != NULL) {
		if(strlen($update_query_middle) == 0 )
			$update_query_middle .= " user_bio = '" . $userBio."'";
		else
			$update_query_middle .= ", user_bio = '" . $userBio."'";
	}

	$full_query = $update_query_start . $update_query_middle . $update_query_end;
	
	if(strlen($update_query_middle) != 0)
		$wpdb->query($wpdb->prepare($full_query));*/