<?php

function editprofile(){
?>
<center>
<h1>Edit Your Profile!</h1><br/>

<input type="text" name="name" placeholder="Name" /><br/><br/>

<input type="text" name="email" placeholder="Email Address" /><br/><br>

<input type="text" name="phone" placeholder="Phone Number" /><br/><br>

<textarea rows="10" cols="50" placeholder="Enter Your Bio"></textarea><br/><br/>

<form action="wp-content/plugins/grapevine/upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:<br/>
    <input type="file" name="fileToUpload" id="fileToUpload"><br/>
    <input type="submit" value="Upload Image" name="submit">
</form><br/><br/>

<button class="btn btn-lg btn-success">Update Profile</button>


<?php
}