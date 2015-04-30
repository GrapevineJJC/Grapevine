<?php function maps() { ?>

	<body onload="load()">
 	<div id="googleMap" style="width:900px;height:550px;"></div>
	</body>

	
	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>
	function load() { 
  	alert("got here!");
  	var map = new google.maps.Map(document.getElementById("googleMap"), {
       // center: new google.maps.LatLng(47.6145, -122.3418),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;
      
      if (navigator.geolocation) {
     	navigator.geolocation.getCurrentPosition(function (position) {
         		currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
     			map.setCenter(currentLocation);
     			//alert("Current location is (" + position.coords.latitude + ", " + position.coords.longitude + ").");
     	});
 	}
  	
  	downloadUrl("wp-content/plugins/grapevine/turnToXML.php", function(data) {
  		var xml = data.responseXML;
  		var markers = xml.documentElement.getElementsByTagName("marker");
  		for (var i = 0; i < markers.length; i++) {
    	var name = markers[i].getAttribute("EventName");
    	var address = markers[i].getAttribute("Address");
    	var type = markers[i].getAttribute("Category");
    	var point = new google.maps.LatLng(
        	parseFloat(markers[i].getAttribute("Latitude")),
        	parseFloat(markers[i].getAttribute("Longitude")));
    	var html = "<b>" + name + "</b> <br/>" + address;
    	var icon = customIcons[type] || {};
    	var marker = new google.maps.Marker({
      	map: map,
      	position: point,
      	icon: icon.icon
    });
    bindInfoWindow(marker, map, infoWindow, html);
  }
});
}

	function bindInfoWindow(marker, map, infoWindow, html) {
		  google.maps.event.addListener(marker, 'click', function() {
			infoWindow.setContent(html);
			infoWindow.open(map, marker);
		  });
		}

	function downloadUrl(url,callback) {
		 var request = window.ActiveXObject ?
		 new ActiveXObject('Microsoft.XMLHTTP') :
		 new XMLHttpRequest;

		request.onreadystatechange = function() {
			if (request.readyState == 4) {
				request.onreadystatechange = doNothing;
				callback(request, request.status);
			}
		};

		request.open('GET', url, true);
		request.send(null);
	}

		function doNothing() {}
	
	</script> 
 	
<?php }	?>