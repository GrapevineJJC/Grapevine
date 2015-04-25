<?php
function propic(){
?>
<!-- Edit Profile Picture -->
			<center>
			<?php echo "<img src=\"wp-content/plugins/grapevine/profilepictures/$currID.jpg\"><br/>";
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