<!DOCTYPE html>
<html lang="en">
<head>

  <title>jQuery UI Droppable - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>


#canvas {
    height: 500px;
    width: 200px;
    border: 1px solid lightgrey;
}

.square, .rect {
    display: inline-block;
    height: 50px;
    width: 50px;
    border: 1px solid lightblue;
    text-align: center;
}

.square {
    background-color: lightyellow;
}

  </style>
  <script>

//Draggable/Droppable
$(function() {
    $(document).ready(function(){
		$(".square").draggable({helper: 'clone'});
		$(".rect").draggable({helper: 'clone'});
       	console.log( $(this) );
       		
		$("#canvas").droppable({
   		 	accept: ".rect, .square",
    		drop: function(ev,ui){
        		$(ui.draggable).clone().appendTo(this);
        		//alert("item dropped");
        		console.log( $(ui.draggable).attr("id") );      		
   		 }
	})})
});


     		 
  </script>
</head>
<body>
 
<?php
function addToBucketlist(){
?>

<div id="square1" class="square"></div>
<div id="square2" class="square"></div>
<div id="square3" class="square"></div>

<div class="rect"></div>
<div class="rect"></div>
<div class="rect"></div>

<div id="canvas"></div>

<!-- 
<div id="draggable1" class="ui-widget-content">
  <p>Event</p>
  <img src="wp-content/plugins/grapevine/img/bucket.png"/>
</div>

<div id="draggable2" class="ui-widget-content">
  <p>Event</p>
  <img src="wp-content/plugins/grapevine/img/bucket.png"/>
</div>


<div id="draggable3" class="ui-widget-content">
  <p>Event</p>
  <img src="wp-content/plugins/grapevine/img/bucket.png"/>
</div>

 
<div id="droppable" class="ui-widget-header">
  <p>My Bucketlist</p>
</div>
<br/><br/>
 -->
 
 
<?php
}
?>

 
 
 
</body>
</html>