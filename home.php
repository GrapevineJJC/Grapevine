<!DOCTYPE html>
<html lang="en">
<head>
<title>Grapevine!</title>

<!-- ///  bootstrap.css  /// -->
<link rel="stylesheet" type="text/css" href="bootstrap-3.1.1/css/bootstrap.css">
<script src="bootstrap-3.1.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript">
$('.carousel').carousel()
</script>
</head>

<body>
    
<?php

function launchHomePage(){

	//If a user is not logged in, they should not be able to see the regular content.
	//Provide error message, 
	if (false == is_user_logged_in()){
		//echo 'Sorry you must be logged in to see this page.<br/><br/>';
		echo "<img title='Grapevine Home' src='wp-content/plugins/grapevine/img/Grapevine_Logo.png' alt='Home' align='middle'/>";
	
		?>
		</div>
		<div class="well" style="">
		<center><h1><b>Create, Discover, Check It Off!</b></h1><br/><br/><br/></center>
    	<div class="container">
        <div class="row">
            <div class="col-md-4"><img src="wp-content/plugins/grapevine/img/bucket.png"/></div>
            <div class="col-md-4"><img src="wp-content/plugins/grapevine/img/world.png" /></div>
            <div class="col-md-4"><img src="wp-content/plugins/grapevine/img/check.png" /></div>
            <div class="clearfix visible-md-block"></div>
            <div class="col-md-4"><p><b>Create Your Bucketlists!</b></p></div>
            <div class="col-md-4"><p><b>Discover Super Cool Things to Do!</b></p></div>
            <div class="col-md-4"><p><b>Check Items Off With Friends!</b></p></div>
            <div class="clearfix visible-md-block"></div>
        </div>
    </div>
    </div>
    	
    	<br/><br/><br/>
    	<center>
    	<div class="container-fluid">
        <div class="row">
			<div class="col-md-5"><p><a href="http://cscilab.bc.edu/~baconju/foo/?login"><img src="wp-content/plugins/grapevine/img/Login_Button.png" alt="Login" height="100" width="200"></a></p></div>
            <!--<div class="col-md-5"><p><a href="http://cscilab.bc.edu/~baconju/foo/?login"><button type="button" class="btn btn-success btn-lg">Login</button></a></p></div>-->
			<div class="col-md-5"><p><a href="http://cscilab.bc.edu/~baconju/foo/?login&action=register"><img src="wp-content/plugins/grapevine/img/Register_Button.png" alt="Login" height="100" width="200"></a></p></div>
            <!--<div class="col-md-5"><p><a href="http://cscilab.bc.edu/~baconju/foo/?login&action=register"><button type="button" class="btn btn-success btn-lg">Register</button></a></p></div>-->
            <div class="clearfix visible-md-block"></div>
        </div>
    </div>
    </div>	
		
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
      <img src="http://www.medicalnewstoday.com/images/articles/271156-grapes.jpg" alt="grapes"/>
      <div class="carousel-caption">
        <h1>Caption 1</h1>
      </div>
    </div>
    <div class="item">
      <img src="http://yspk.co/nlcfsaginaw/wp-content/uploads/sites/9/2013/08/bucketlist.jpg" alt="..."/>
      <div class="carousel-caption">
    	<h1>Caption 2 </h2>
      </div>
    </div>
    <div class="item">
    <img src="http://www.brownrowe.com/sites/default/files/projects/boston_college_gasson_hall.jpg" alt="..."/>
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