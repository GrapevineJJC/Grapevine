<?php
function launchHomePage(){

echo "<script type='text/javascript'>";
echo "$('.carousel').carousel()";
echo "</script>";

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

     <!-- ///  begin content  /// -->
    <div id="promo-carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
  	<ol class="carousel-indicators">
    	<li data-target="#promo-carousel" data-slide-to="0" class="active"></li>
		<li data-target="#promo-carousel" data-slide-to="1"></li>
		<li data-target="#promo-carousel" data-slide-to="2"></li>
	</ol>
	
	<!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="wp-content/plugins/grapevine/img/carousel/rockshow.jpg" alt="Rock concert image">
        <div class="carousel-caption">
          <h3>Recommender System suggests activities based on your preferences.</h3>
      </div>
    </div>
    <div class="item">
      <img src="wp-content/plugins/grapevine/img/carousel/skydiving.jpg" alt="Skydiving picture">
      <div class="carousel-caption">
          <h3>See what your friends are doing and add it to your bucketist.</h3>
      </div>
    </div>
    <div class="item">
      <img src="wp-content/plugins/grapevine/img/carousel/hotairballoon.jpg" alt="Camping couple">
      <div class="carousel-caption">
          <h3>Embark on adventures and share with friends.</h3>
      </div>
    </div>  
                      
  </div>
 
  <!-- Controls -->

</div> <!-- Carousel -->
	


<?php
}
?>