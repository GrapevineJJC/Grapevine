<?php
function addToBucketlist(){
?>
<center>
<div id="dhtmlgoodies_dragDropContainer">
	<div id="topBar">
		<!-- <img src="wp-content/plugins/grapevine/img/bucket.png"> -->
		<h1>What Interests You?</h1>
	</div>
	<div id="dhtmlgoodies_listOfItems">
		<div>
			<p>Interests</p>
		<ul id="allItems">
			<li id="node1">Food</li>
			<li id="node2">Bars</li>
			<li id="node3">Theater</li>
			<li id="node4">Fitness</li>
			<li id="node5">Music</li>
			<li id="node6">Academics</li>
			<li id="node7">Outdoors</li>
			<li id="node8">Spots</li>
			<li id="node9">Recreation</li>
		</ul>
		</div>
	</div>
	<div id="dhtmlgoodies_mainContainer">
		<!-- ONE <UL> for each "room" -->
		<div>
			<p>My Bucket</p>
			<ul id="box1">
			</ul>
		</div>
	</div>
</div>
<div id="footer">
	<form action="aPage.html" method="post"><input type="button" onclick="saveDragDropNodes()" value="Save"></form>
</div>
<ul id="dragContent"></ul>
<div id="dragDropIndicator"><img src="wp-content/plugins/grapevine/img/insert.gif"></div>
<div id="saveContent"><!-- THIS ID IS ONLY NEEDED FOR THE DEMO --></div>
</center>
 
<?php
}
?>