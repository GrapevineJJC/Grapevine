<?php
function editpro(){	
include('autocomplete.js');
?>

<div class="ui-widget">
	<form method="post">
  		<label for="tags">Tag programming languages: </label>
  		<input id="tags" name="tags" size="50">
  		<input type="submit" name="submit" onclick="gettags();" value="Submit" />
  	</form>
</div>
<?php	

	if(isset($_POST['submit'])){
		echo "submit clicked";
		$result = $_POST['tagNames'];
		echo "tags is $result";
	}

}