<?php
function editpro(){	
	global $wpdb;	
	
	$current_user = wp_get_current_user();
	$currID = $current_user->ID;
	echo "current user id is $current_user->ID<br/><br/>";
	
	$query = 'SELECT * FROM wp_grape_users WHERE ID  =  '.$currID;
	$result = $wpdb->get_results($query);
	
	$nicename="";
	$email="";
	
	//Query for current users info. Pre-populate form.
	foreach ($result as $row) {
		$nicename = $row->user_nicename;
		$email = $row->user_email;
	}
	
	echo "nicename is $nicename and email is $email\n";
	
	createForm($nicename, $email);
	//handleForm();
}



function createForm($nicename, $email){
?>

	<center>
	<h1>Edit Your Profile</h1>
	
	<form method="post" action="wp-content/plugins/grapevine/editprowork.php">
		<input type="text" name="name" value="<?php echo $nicename; ?>" placeholder="Name" />
		<input type="submit" name="submit" value="Submit">
	</form>

<?php
}