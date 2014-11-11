<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>

<?php

function testEvents(){
?>

<script type="text/javascript">
$(document).ready(function(){		
		$("#blItemButton").click(function(){
			$("#blitemModal").modal('show');
		});

		$( "#createItem" ).click(function() {
  			alert( "Handler for .click() called." );
		});
});
</script>

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

<?php
}