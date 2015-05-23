<?php function turnToXML () {
	
<<<<<<< Updated upstream
	$connection=mysql_connect ('localhost', "cavaliej", "HtcQdGZK");
	if (!$connection) {
	  die('Not connected : ' . mysql_error());
	}

	// Set the active MySQL database
	$db_selected = mysql_select_db("grapevine", $connection);
	if (!$db_selected) {
	  die ('Can\'t use db : ' . mysql_error());
	}

	// Select all the rows in the markers table
	$query = "SELECT EventName, LocationAddress, Latitude, Longitude, category from wp_grape_events";
	$result = mysql_query($query);
	if (!$result) {
	  die('Invalid query: ' . mysql_error());
	}

=======
	global $wpdb;

	// Select all the rows in the markers table
	$query = "SELECT EventName, LocationAddress, Latitude, Longitude, category from wp_grape_events";
	$result = $wpdb->get_results($query);
	
>>>>>>> Stashed changes
	// Start XML file, echo parent node
	echo '<markers>';

	// Iterate through the rows, printing XML nodes for each
<<<<<<< Updated upstream
	while ($row = @mysql_fetch_assoc($result)){
	  	$xmlName = parseToXML($row['EventName']);
=======
	foreach ($result as $row){
	  	$xmlName = parseToXML($row->EventName);
>>>>>>> Stashed changes

	  // ADD TO XML DOCUMENT NODE
	  	echo '<marker ';
	  	echo 'Name="' .$xmlName. '" ';
<<<<<<< Updated upstream
	  	echo 'Address="' . parseToXML($row['LocationAddress']) . '" ';
	  	echo 'Latitude="' . $row['Latitude'] . '" ';
	  	echo 'Longitude="' . $row['Longitude'] . '" ';
	  	echo 'Category="' . $row['Category'] . '" ';
=======
	  	echo 'Address="' . parseToXML($row->LocationAddress) . '" ';
	  	echo 'Latitude="' . $row->Latitude . '" ';
	  	echo 'Longitude="' . $row->Longitude . '" ';
	  	echo 'Category="' . $row->Category . '" ';
>>>>>>> Stashed changes
	  	echo '/>';
	}

		// End XML file
		echo '</markers>';
		
	function parseToXML($htmlStr)
	{
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
	}

}?>
