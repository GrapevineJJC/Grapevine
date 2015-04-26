<?php
		$name = $_POST['name'];
		//echo "The nice name is now: $name";	
		
	global $currUser;	
	global $wpdb;
	
	//$currUser = wp_get_current_user(); 
	
	$wpdb->insert( 'wp_grape_bucketlists',
				array(	'CreatedByUser' => 0,
						'BucketListName' => "hi",
						'Description' => "hi",
						'NumberOfEvents' => 0),
				array( '%d', '%s', '%s', '%d' ) );	
				
		header('Location: http://cscilab.bc.edu/~baconju/foo/?page_id=87');