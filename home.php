<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
$('.carousel').carousel()
</script>
<?php

function launchHomePage(){

	//If a user is not logged in, they should not be able to see the regular content.
	//Provide error message, 
	if (false == is_user_logged_in()){
		echo "Sorry you must be logged in to see this page.<br/><br/>";
		?>
		<a href="http://cscilab.bc.edu/~baconju/foo/?login">Login</a><br/><br/>
		
		<a href="http://cscilab.bc.edu/~baconju/foo/?login&action=register">Register</a><br/><br/>
		<?php
		return;
	}
		//Otherwise, user is logged in. Display regular content
?>
	<center>
	This is the homepage which may display upcoming events, your bucketlists, etc.
	
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
    	<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    	<li data-target="#carousel-example-generic" data-slide-to="1"></li>
    	<li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/grapes.jpg" alt="grapes">
      <div class="carousel-caption">
        <h1>Caption 1</h1>
      </div>
    </div>
    <div class="item">
      <img src="..." alt="...">
      <div class="carousel-caption">
    	<h1>Caption 2 </h2>
      </div>
    </div>
    <div class="item">
    <img src="..." alt="...">
      <div class="carousel-caption">
    	<h1>Caption 3 </h2>
    	</div>
    	</div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	
	

<?php
}