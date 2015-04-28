<?php
function testBucketlist(){

	global $wpdb;
	
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	$currID = $current_user->ID;
	
	
	echo "<div class=\"pageHeader\">My Bucketlists <a href=\"#blModal\" role=\"button\" class=\"btn btn-lg btn-primary\" data-toggle=\"modal\">+</a><br/><br/></div>";
	
	//echo ' <a href="#blModal" role="button" class="btn btn-lg btn-primary" data-toggle="modal">+</a><br/><br/>';

	//Query bucketlist database for user's list of bucketlists
	$query = 'SELECT * FROM wp_grape_bucketlists WHERE CreatedByUser  =  '.$currID;
	
	$result = $wpdb->get_results($query);
?>
<!-- <div class="row"> -->
<?php
	//Query for current users info. Pre-populate editprofile form.
	$blids = array();
?>
	
	<div class="container">
	<div class="row">

	<?php foreach ($result as $row) { ?>
 			<div class="col-md-4">
				<form method="post">
					
					<?php
					$BLID = $row->BucketListID;
					array_push($blids, $BLID);
					
					$BLname = $row->BucketListName;
					$desc = $row->Description;
					$numEvents = $row->NumberOfEvents;
					
					echo "<button id=\"$BLID\" name=\"$BLID\" class=\"blButton\" value=\"$BLID\" />";
						echo "<input type=\"hidden\" class=\"op\" name=\"op\" value=\"$BLID\" />";
						
						echo "<p class=\"blHeader\">".$BLname."</p>";
						echo "<p class=\"blDesc\">".$desc."</p><br/><br><br/>";
						//echo "<p class=\"blHeader\">".$BLID."</p>";
						
						echo "<p class=\"blNumEvents\">".$numEvents." event(s)</p>";
					echo "</button>";
				echo "</form>";
			echo "</div>";
		}
		echo "</div>";
		echo "</div><br/>";
		
			foreach($blids as $id){
				if(isset($_POST[$id])){
					displayBL($id);
				}
			}
?>

<script type="text/javascript">
$(document).ready(function(){
	$('.form')[0].reset(
	);

		$(".btn").click(function(){
			$("#blModal").modal('show');
		});
});
</script>
    
    <!-- Modal HTML -->
    <div id="blModal" class="modal fade">
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
<!-- </div> -->
<br/><br/><br/>
  
<?php

		if(isset($_POST['update'])){
			$updates = $_POST['completed'];
			//var_dump($updates);			
	
			//Iterate through bucketlists checked and insert Event into BL
			foreach($updates as $ups){
				//echo "$ups";
				
				$update_query = "UPDATE wp_grape_blJoinEvents SET isCompleted = 1 WHERE EventID = ".$ups;
				//echo "$update_query";
				$wpdb->query($update_query);
			}
			
			
		}
		
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
						'BucketListName' => htmlentities($BLname),
						'Description' => $BLdesc,
						'NumberOfEvents' => 0),
				array( '%d', '%s', '%s', '%d' ) );	
				

}

function displayBL($id){	
	global $wpdb;
	$query = 'SELECT e.EventID, e.EventName, e.LocationAddress, e.Description, e.category, blj.isCompleted
			from wp_grape_blJoinEvents as blj
			JOIN wp_grape_events as e
			WHERE e.EventID=blj.EventID
			AND blj.BucketlistID = '.$id;
	
	$result = $wpdb->get_results($query);

	?> <form method="post"> <?php	
	
	//print info for event
	foreach ($result as $row) {			
			$eventID = $row->EventID;
			$name = $row->EventName;
			$loc = $row->LocationAddress;
			$desc = $row->Description;
			$completed = $row->isCompleted;
			$category = $row->category;
			
			$checked="";
			if($completed == 1)
				$checked = "checked";
			
 			echo "<div class=\"well\">";
			echo "<div class=\"feedContent\">";
			echo "<div class=\"blHeader\"> ".$name."</div>";
			
			//echo "<input type=\"checkbox\" name=\"completed\" data-size=\"xl\">";
			?>			
							<div class="row">
								<div class="col-md-2">
								<?php getCat($category); ?>
								</div>
								
								<div class="col-md-7"><?php
								//if ($event->LocationAddress != null) 
								echo "<label>Location: </label> ".$loc."<br/><br/>";
								echo "<label>Description: </label> ".$desc."<br/><br/>"; ?>
								</div>
								
								<div class="col-md-3">
								<?php echo "<input type=\"checkbox\" name=\"completed[]\" class=\"blCheck\" value=\"$eventID\" $checked>";?>
								</div>
							</div>
 			</div>
 			</div>
<?php } ?>
		<center><button type="submit" name="update" class="updateBtn" value="Update" />Update</button></center>
		</form>
<?php
}

function getCat($category){
			switch($category){
				case 1:
					//echo "Restaraunts<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/dining.png' height=\"100\" width=\"100\" />";
					break;
				case 2:
					//echo "Sports<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/baseball.png' height=\"100\" width=\"100\" />";
					break;
				case 3:
					//echo "Fitness<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/fit.jpg' height=\"100\" width=\"100\" />";
					break;
				case 4:
					//echo "Bars<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/bar.png' height=\"100\" width=\"100\" />";
					break;
				case 5:
					//echo "Music<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/music.png' height=\"100\" width=\"100\" />";
					break;
				case 6:
					//echo "Theater<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/theater.png' height=\"100\" width=\"100\" />";
					break;
				case 7:
					//echo "Museums<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/museum.png' height=\"100\" width=\"100\" />";
					break;
				case 8:
					//echo "Gaming<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/gaming.png' height=\"100\" width=\"100\" />";
					break;
				case 9:
					//echo "Outdoors<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/outdoor.png' height=\"100\" width=\"100\" />";
					break;
				default: echo "";
						break;				
			}
}

function getSmallCat($category){
			switch($category){
				case 1:
					//echo "Restaraunts<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/dining.png' height=\"50\" width=\"50\" />";
					break;
				case 2:
					//echo "Sports<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/baseball.png' height=\"50\" width=\"50\" />";
					break;
				case 3:
					//echo "Fitness<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/fit.jpg' height=\"50\" width=\"50\" />";
					break;
				case 4:
					//echo "Bars<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/bar.png' height=\"30\" width=\"30\" />";
					break;
				case 5:
					//echo "Music<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/music.png' height=\"30\" width=\"30\" />";
					break;
				case 6:
					//echo "Theater<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/theater.png' height=\"30\" width=\"30\" />";
					break;
				case 7:
					//echo "Museums<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/museum.png' height=\"30\" width=\"30\" />";
					break;
				case 8:
					//echo "Gaming<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/gaming.png' height=\"30\" width=\"30\" />";
					break;
				case 9:
					//echo "Outdoors<br/>";
					echo "<img src='wp-content/plugins/grapevine/img/categories/outdoor.png' height=\"50\" width=\"50\" />";
					break;
				default: echo "";
						break;				
			}
}