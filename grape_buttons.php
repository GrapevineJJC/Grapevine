<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!--  -->



<script type="text/javascript">

$(document).ready(function(){
	
		$("#blButton").click(function(){
			$("#blModal").modal('show');
		});
		
		$("#blItemButton").click(function(){
			$("#blitemModal").modal('show');
		});
		
		$( "#createBL" ).click(function() {
			
			//get the values in input fields
			var name = $('#BLname').val();
			var desc = $('textarea#BLdesc').val();
  			alert( "USER ID:<br/>BL Name: "+name+"<br/>Descrption: <br/>." + desc );
  			
  			$.ajax({
  				url: 'test.php',
  				data: name,
  				success: function() {
    			alert('Bucketlist created');
  				}
			});
			
			return false;
		});

		$( "#createItem" ).click(function() {
  			alert( "Handler for .click() called." );
		});
});

</script>
</head>

<body>
<br/>
<!-- This is the html for the Bucketlist Modal. -->
<!-- Users click button to launch modal, enter the input fields, and insert into db -->
<div class="bucketlistModal">
    <!-- Button HTML (to Trigger Modal) -->
    <center><a href="#" id="blButton" class="btn btn-lg btn-success">Create Bucketlist!</a></center>
    
    <!-- Modal HTML -->
    <div id="blModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Create Your Bucketlist</h4>
                </div>
                <div class="modal-body">
                                  
                    <center>
                    <img src="http://2.bp.blogspot.com/-n1da2kDa_ZY/UXeCtSd5KJI/AAAAAAAAAMw/0ktttvBNCWU/s1600/check_box.png" alt="checkbox picture" height="50" width="50" /><br/>

                    <p>Give it a name and description!</p></center><br/><br/>
                   
                   <label>Bucketlist Name:</label><br/>
                   <input type="text" id="BLname" placeholder="E.g. Senior Year Bucketlist" /><br/><br/><br/>
                    
                    <label>Description:</label><br/>
                    <textarea id="BLdesc" placeholder="E.g. Restaurants and bars to try, spring break destinations, and adventures in Boston!" row="20" cols="50" maxlength="150"></textarea><br/><br/>
		 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createBL">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>
<br/><br/><br/>

<!-- This is the html for the Bucketlist Item Modals. -->
<!-- Users click button to launch modal, enter the input fields, and insert into db -->
<div class="bucketlistitemModal">
    <!-- Button HTML (to Trigger Modal) -->
    <center><a href="#" id="blItemButton" class="btn btn-lg btn-success">Create Event!</a></center>
    
    <!-- Modal HTML -->
    <div id="blitemModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Create Your Bucketlist Event</h4>
                </div>
                <div class="modal-body">                  
                    <center><p>Give it a name, description, and category!</p></center><br/><br/>
                   
                   <label>Event Name:</label><br/>
                    <input type="text" placeholder="E.g. Senior Year Bucketlist" /><br/><br/><br/>
                    
                    <label>Description:</label><br/>
                    <textarea id="BLdesc" placeholder="E.g. Restaurants and bars to try, spring break destinations, and adventures in Boston!" row="20" cols="50" maxlength="150"></textarea><br/><br/><br/>
                    
                    <label>Category:</label><br/>
                    <select>
                    	<option value="food">Food & Dining</option>
                   	 <option value="nightlife">Nightlife</option>
                    	<option value="entertainment">Entertainment</option>
                    	<option value="academic">Academic</option>
                    	<option value="travel">Travel</option>
                    </select>
		 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createItem">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>                                		

 
<?php
defined('ABSPATH') or die("No script kiddies please!");
 
 add_action( 'init', 'testing_grapevine' );
 
 function testing_grapevine(){
 	global $currUser;
 	$currUser = wp_get_current_user();
 	echo 'User ID: ' . $currUser->ID . '<br />'; 
 	
 

$name = 'Fall Festivities';
$desc = "La la la apple picking";
	
 }

function returnUserID(){
  	global $currUser;
 	$currUser = wp_get_current_user();
 	return $currUser->ID;
}

function insertBL(){
  	global $currUser;
 	$currUser = wp_get_current_user();
 	echo 'User ID: ' . $currUser->ID . '<br />'; 
 	
 	$name = 'Fall Festivities';
	$desc = "La la la apple picking";

	global $wpdb;
	$wpdb->insert( 'grape_bls',
				array( 'BucketListID' => NULL,
						'CreatedByUser' => ($currUser->ID),
						'BucketListName' => $name,
						'Description' => $desc),
				array( '%d', '%d', '%s', '%s' ) );
}
?>