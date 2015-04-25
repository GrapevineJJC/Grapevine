<?php
function propic(){

	global $wpdb;	
	
	$current_user = wp_get_current_user();
	$currID = $current_user->ID;
	//echo "current user id is $current_user->ID<br/><br/>";
	
?>
<!-- Edit Profile Picture -->
			<center>
			<?php
			$jpg = 'wp-content/plugins/grapevine/profilepictures/'.$currID.'.jpg';
			$png = 'wp-content/plugins/grapevine/profilepictures/'.$currID.'.png';
			$gif = 'wp-content/plugins/grapevine/profilepictures/'.$currID.'.gif';
			$jpeg = 'wp-content/plugins/grapevine/profilepictures/'.$currID.'.jpeg';
			
			//$filename = 'wp-content/plugins/grapevine/profilepictures/'.$currID.'.jpg';

			if (file_exists($jpg))
					echo "<img src=\"$jpg\" alt=\"Profile Picture\" /><br/>";
			else if (file_exists($png))
					echo "<img src=\"$png\" alt=\"Profile Picture\" /><br/>";
			else  if (file_exists($gif))
					echo "<img src=\"$gif\" alt=\"Profile Picture\" /><br/>";
			else if (file_exists($jpeg))
					echo "<img src=\"$jpeg\" alt=\"Profile Picture\" /><br/>";
			else
					echo "<img src=\"wp-content/plugins/grapevine/img/blank.jpg\" width=\"180\" height=\"180\" alt=\"No Profile Picture\" /><br/>";
			
			$code = 3;
			
			if(isset($_GET['error']))
				$code = $_GET['error'];
			
			switch($code){
				case 0:
					echo "Sorry, your file is too large.";
					break;
				
				case 1:
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					break;
					
				case 2:
					echo "Sorry, there was an error uploading your file.";
					break;
				
				case 3:
					echo "";
					break;
			}
			
			?>
			<br/>
			<form class="well" action="wp-content/plugins/grapevine/upload_profile_pictures.php" method="post" enctype="multipart/form-data">
				Select image to upload:<br/>
				<?php
				echo "<input type=\"hidden\" name=\"currID\" value=\"$currID\"/>" ?>
				<input type="file" name="fileToUpload" id="fileToUpload"><br/>
				<input type="submit" value="Upload Image" name="uploadImage" id="uploadImage">
			</form> 
<?php
}