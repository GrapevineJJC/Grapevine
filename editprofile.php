<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>
<link rel="stylesheet" type="text/css" href="wp-content/plugins/grapevine/css/grapevine.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

<script>
//Autocomplete for interest tags
$(function() {
    var availableTags = [
      "Art",
      "Beauty",
      "Beer",
      "Books",
      "College",
      "Food",
      "Gaming",
      "Movies",
      "Music",
      "Nightlife",
      "Recreation",
      "Shopping",
      "Sports",
      "Technology",
      "Volunteering"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
  
  //Autocomplete for restaurant tags
$(function() {
    var availableTags = [
      "American",
      "Barbecue",
      "Brunch",
      "Chinese",
      "Cuban",
      "Deli",
      "Dessert",
      "Dim Sum",
      "Diner",
      "Fast Food",
      "French",
      "German",
      "Greek",
      "Indian",
      "Japanese",
      "Korean",
      "Latin American",
      "Mexican",
      "Pizzeria",
      "Pubs/Grills",
      "Seafood",
      "Southern",
      "Spanish",
      "Tapas",
      "Thai",
      "Vegan",
      "Vietnamese"      
    ];
    $( "#restaurantTags" ).autocomplete({
      source: availableTags
    });
  });
  

</script>
</head>
<body>



<?php

function editprofile(){

	if(isset($_POST['updatePro'])){
		echo "I clicked update profile Button";
	}
		
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



<div class="promo" id="home" style="background-image:url(img/promo.jpg);">
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

<div class="ui-widget">
  <label for="tags">Tag Your Interests (e.g. Sports, Food, Nightlife): </label>
  <input id="tags">
</div>

<div class="ui-widget">
  <label for="restaurantTags">Tag Your Favorite Kinds of Restaurants (e.g. Italian, Mexican, Brunch, Dim Sum): </label>
  <input id="restaurantTags">
</div>
					<!-- (EDIT THIS AFTER TALKING TO ALVAREZ)
						Here we should query the database for all existing tags.
						If that tag is already associated with the user, don't display it.
						Display a total of XX tags at all times.
							(Ideally, make it responsive so that once a tag is checked, it goes
							away and a new one pops up in its place.  This is only for editprofile.php,
							not feed.php.)
						Hardcoded a few tags for now.  2/15/2015      
						I added some additional tags [Julia 2/16/2015]           -->
				<label style="float: left;"><b>Check all tags that interest you:</b></label><br/>
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
					
					<div>
					<br/><br/>
					</div>
					
					<!-- Additional preference updates to refine recommendations upon
						 very first log-in. 	2/16/2015		--> 
						 
					<label style="float: left;"><b>If you are interested in sports, check your favorite(s):</b></label><br/>
					<center>
					<div style="float: left; text-align:left; width: 33%;">
						<input type="checkbox" name="sportstags[]" value="football"/> Football <br/>
						<input type="checkbox" name="sportstags[]" value="hockey"/> Hockey <br/>
						<input type="checkbox" name="sportstags[]" value="basketball"/> Basketball <br/>
					</div>
					<div style="float: left; text-align:left; width: 33%;">
						<input type="checkbox" name="sportstags[]" value="baseball"/> Baseball<br/>
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
					
					<label style="float: left;"><b>If applicable, let us know what kinds of restaurants you like:</b></label><br/>
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
						<input type="checkbox" name="foodtags[]" value="german"/> German<br/>
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
					<br/><br/><br/><br/>

<div><br/><br/><br/></div>
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

	<input type="submit" id="updatePro" name="updatePro" value="Update Profile" style="color: black; font-size: 16px;"/>
</form><br/><br/>

</div>

<?php

}

		/*if(isset($_POST['name'])) 
			$userName = $_POST['name'];
		else 
			$userName = NULL;
		if(isset($_POST['email'])) 
			$userEmail = $_POST['email'];
		else
			$userEmail = NULL;

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

	$full_query = $update_query_start . $update_query_middle . $update_query_end;
	
	if(strlen($update_query_middle) != 0)
		$wpdb->query($wpdb->prepare($full_query));*/