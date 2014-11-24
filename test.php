<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


<?php

//print_r($_POST);
  	global $currUser;
 	$currUser = wp_get_current_user();
 	 	echo 'User ID: ' . $currUser->ID . '<br />'; 
 	
 	//$name = $_POST["blname"];
 	//$desc = $_POST["bldesc"];
 	
 	$name = 'testing';
	$desc = "testing";
	
	//var_dump();

	global $wpdb;
	$wpdb->insert( 'grape_bucketlists',
				array(	'CreatedByUser' => 20,
						'BucketListName' => $name,
						'Description' => $desc),
				array( '%d', '%d', '%s', '%s' ) );
//echo "In test.php";*/