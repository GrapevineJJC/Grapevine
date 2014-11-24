<!DOCTYPE html>
<html lang="en">
<head>
<title>Create A Bucketlist</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<?php

function testBucketlist(){
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	
	echo "<h1>Welcome, $username</h1>";

?>

<script type="text/javascript">

$(document).ready(function(){
	
		$("#blButton").click(function(){
			$("#blModal").modal('show');
		});
			
});

</script>
<!-- This is the html for the Bucketlist Modal. -->
<!-- Users click button to launch modal, enter the input fields, and insert into db -->
<div class="bucketlistModal">
    <!-- Button HTML (to Trigger Modal) -->
    <center><a href="#" id="blButton" class="btn btn-lg btn-success">Create Bucketlist!</a></center>
    
    <!-- Modal HTML -->
    <div id="blModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h1 class="modal-title">Create Your Bucketlist</h1>
                </div>
                <form method="post">
                <div class="modal-body">
                                  
                    <center>
                    <img src="http://2.bp.blogspot.com/-n1da2kDa_ZY/UXeCtSd5KJI/AAAAAAAAAMw/0ktttvBNCWU/s1600/check_box.png" alt="checkbox picture" height="50" width="50" /><br/>

                    <p>Give it a name and description!</p></center>
                    

                   <label>Bucketlist Name:</label><br/>
                   <input type="text" name="BLname" id="BLname" placeholder="E.g. Senior Year Bucketlist" /><br/><br/>
                    
                    <label>Description:</label><br/>
                    <textarea id="BLdesc" name="BLdesc" placeholder="E.g. Restaurants and bars to try, spring break destinations, and adventures in Boston!" row="20" cols="50" maxlength="150"></textarea><br/><br/>
		 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="BLCancel" name="BLCancel" style="color: black; font-size: 16px;">Cancel</button>
                    <input type="submit" class="btn btn-default" id="CreateBucketList" name="CreateBucketList" value="Create" style="color: black; font-size: 16px;"/>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br/><br/><br/>
  
<?php

if(isset($_POST['CreateBucketList'])){
	$BLname = $_POST['BLname'];
	$BLdesc = $_POST['BLdesc'];
	insertBL($BLname, $BLdesc);
}
}

function insertBL($BLname, $BLdesc){

  	global $currUser;	
	global $wpdb;
	
	$currUser = wp_get_current_user(); 
	
	$wpdb->insert( 'wp_grape_bucketlists',
				array(	'CreatedByUser' => $currUser->ID,
						'BucketListName' => $BLname,
						'Description' => $BLdesc),
				array( '%d', '%s', '%s' ) );	
}