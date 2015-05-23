<?php
$target_dir = "profilepictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$curr_id = $_POST['currID'];
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
       // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
      //  echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";
    $uploadOk = 0;
}

//Check to see if image for user already exists:
$jpg = 'profilepictures/'.$curr_id.'.jpg';
$png = 'profilepictures/'.$curr_id.'.png';
$gif = 'profilepictures/'.$curr_id.'.gif';
$jpeg = 'profilepictures/'.$curr_id.'.jpeg';

if (file_exists($jpg)){
	unlink($jpg);
	unlink('profilepictures/'.$curr_id."_thumb.jpg");
	}
else if (file_exists($png)){
	unlink($png);
	unlink('profilepictures/'.$curr_id."_thumb.png");
	}
else  if (file_exists($gif)){
	unlink($gif);
	unlink('profilepictures/'.$curr_id."_thumb.gif");
	}
else if (file_exists($jpeg)){
	unlink($jpeg);
	unlink('profilepictures/'.$curr_id."_thumb.jpeg");
	}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
   // echo "Sorry, your file is too large.";
    $uploadOk = 0;
    header('Location: http://cscilab.bc.edu/~baconju/foo/?page_id=85&error=0');
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    header('Location: http://cscilab.bc.edu/~baconju/foo/?page_id=85&error=1');
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	//IF SUCCESSFULLY UPLOADED
    //if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "profilepictures/".$curr_id.".".$imageFileType)){
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.\n";
        //echo "Renamed to username.extension \n";
       // echo "User who uploaded is ID $curr_id";
       
       
       
       //CREATE THUMBNAIL
       $original = 'profilepictures/'.$curr_id.'.'.$imageFileType;
       $thumbnail = 'profilepictures/'.$curr_id."_thumb";
       //echo "New file will be called $thumbnail";
       
     	//Copy & Resize Images
    	if (!copy($original, $thumbnail)) {
   			//echo "failed to copy $file...\n";
		}
		else{
			//echo "Copy success. Now resizing \n";
			resize(180, $thumbnail, $original);
			//header('Location: http://cscilab.bc.edu/~baconju/foo/?page_id=85&error=success');
		}  
		
		
		
		//CREATE MEDIUM SIZE
		//CREATE THUMBNAIL
       $original = 'profilepictures/'.$curr_id.'.'.$imageFileType;
       $medium = 'profilepictures/'.$curr_id."_med";
       //echo "New file will be called $thumbnail";
       
     	//Copy & Resize Images
    	if (!copy($original, $medium)) {
   			//echo "failed to copy $file...\n";
		}
		else{
			//echo "Copy success. Now resizing \n";
			resize(300, $medium, $original);
<<<<<<< Updated upstream
			header('Location: http://cscilab.bc.edu/~baconju/foo/?page_id=85&error=success');
=======
			header('Location: http://cscilab.bc.edu/~baconju/foo/?page_id=85&error=3');
>>>>>>> Stashed changes
		}                  
    } else {
       // echo "Sorry, there was an error uploading your file.";
        header('Location: http://cscilab.bc.edu/~baconju/foo/?page_id=85&error=2');
    }
}


function resize($newWidth, $targetFile, $originalFile) {

    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default: 
                    throw Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    //$newHeight = $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile.$new_image_ext");
}
?>
