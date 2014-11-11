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
?>

<script type="text/javascript">

$(document).ready(function(){
	
		$("#blButton").click(function(){
			$("#blModal").modal('show');
		});
		
		//$( "#createBL" ).click(function() {
			
			//get the values in input fields
			//var name = $('#BLname').val();
			//var desc = $('textarea#BLdesc').val();
  			//alert( "USER ID:<br/>BL Name: "+name+"<br/>Descrption: <br/>." + desc );
		//});
});

</script>
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
                    <h1 class="modal-title">Create Your Bucketlist</h1>
                </div>
                <div class="modal-body">
                                  
                    <center>
                    <img src="http://2.bp.blogspot.com/-n1da2kDa_ZY/UXeCtSd5KJI/AAAAAAAAAMw/0ktttvBNCWU/s1600/check_box.png" alt="checkbox picture" height="50" width="50" /><br/>

                    <p>Give it a name and description!</p></center>
                   
                   <label>Bucketlist Name:</label><br/>
                   <input type="text" id="BLname" placeholder="E.g. Senior Year Bucketlist" /><br/><br/>
                    
                    <label>Description:</label><br/>
                    <textarea id="BLdesc" placeholder="E.g. Restaurants and bars to try, spring break destinations, and adventures in Boston!" row="20" cols="50" maxlength="150"></textarea><br/><br/>
		 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createBL" onclick="insert()">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>
<br/><br/><br/>
<?php
}

function insert(){
	die("in insert()");
	echo "IN THE INSERT FUNCTION";
}