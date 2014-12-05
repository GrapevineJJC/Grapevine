<!doctype html>
<html lang="en">
<head>


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
 
<?php
}
?>

</body>
</html>