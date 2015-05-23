<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
<<<<<<< Updated upstream

//google.maps.event.addDomListener(window, 'load', initialize);

function load() { 
  	
  	var map = new google.maps.Map(document.getElementById("googleMap"), {
        center: new google.maps.LatLng(47.6145, -122.3418),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;
  	
  	downloadUrl("phpsqlajax_genxml.php", function(data) {
  		var xml = data.responseXML;
  		var markers = xml.documentElement.getElementsByTagName("marker");
  		for (var i = 0; i < markers.length; i++) {
    	var name = markers[i].getAttribute("name");
    	var address = markers[i].getAttribute("address");
    	var type = markers[i].getAttribute("type");
    	var point = new google.maps.LatLng(
        	parseFloat(markers[i].getAttribute("lat")),
        	parseFloat(markers[i].getAttribute("lng")));
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
/*
=======
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() { 
  	
>>>>>>> Stashed changes
  	var bounds = new google.maps.LatLngBounds();

	var mapProp = {
    	zoom:10,
   		panControl:true,
		zoomControl:true,
		zoomControlOptions: { style:google.maps.ZoomControlStyle.LARGE},
		mapTypeControl:true,
		mapTypeControlOptions: { style:google.maps.MapTypeControlStyle.DROPDOWN_MENU },
		streetViewControl:true,
		mapTypeId:google.maps.MapTypeId.ROADMAP
  	};
  
  	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  	
  	if (navigator.geolocation) {
     	navigator.geolocation.getCurrentPosition(function (position) {
         		currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
     			map.setCenter(currentLocation);
     			//alert("Current location is (" + position.coords.latitude + ", " + position.coords.longitude + ").");
     	});
 	}
<<<<<<< Updated upstream
 	
 	
 	
 	/*var ARRAYFROMPHP = [];
	$(document).ready(function(){
		$.getJSON('wp-content/plugins/grapevine/maps.php', function(data){
 			alert("got here");
 			ARRAYFROMPHP = data;
 			alert(ARRAYFROMPHP);
		});
	}); */
 	
 	/*$(document).ready(function(){
			
			
			$.ajax({
    			type: 'POST',
   		 		url: 'wp-content/plugins/grapevine/maps.php',
    			success: 	function(result) {
        						var data = jQuery.parseJSON(result);
        						alert(data.stuff);
    						}
			});
			
                //start ajax request
             /*   var request = $.ajax({
                    url: "wp-content/plugins/grapevine/maps.php",
                    type: "GET",
                    data: dataString,
                    dataType: "json"
                }); 
                
                var request = $.ajax({
       					 url: "wp-content/plugins/grapevine/maps.php",
        				dataType: 'application/json',
        				complete: function(data){
            			alert(data)
        		},
        		success: function(data){
            		alert(data)
        		}
                    
                request.done ( function( data ) {  
                    	setMarkers(data);
                });
                    
                request.fail (function(jqXHR, textStatus) {
						alert( "Request failed: " + textStatus );
				 });
			});

	}) */

  	/* var LatLngArray;
  	var markers = new Array();
  	LatLngArray = LatLngPairs.split("] ");
  	
  	for (int i = 0; i < LatLngArray.length; i++) {
  		markers[i] = LatLngArray[i];
  	}   */
  	  
  	// Multiple Markers
	/*var markers = [
    		[42.335549, -71.168495],
        	[40.350000, -71.200000],
        	[44.234234, -71.189284]
=======
  	  
  	// Multiple Markers
	var markers = [
    		[42.335549, -71.168495]
>>>>>>> Stashed changes
    ];
    
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            				position: position,
            				map: map,
<<<<<<< Updated upstream
    });
=======
        });
>>>>>>> Stashed changes
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));
        
        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
	}
	
	// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
<<<<<<< Updated upstream
=======
        
  	// SINGLE MARKER	
 	/* var marker = new google.maps.Marker({
  			position:myCenter,
  			animation:google.maps.Animation.DROP,
  			title:'Click to zoom'
			});
  	marker.setMap(map);	*/
>>>>>>> Stashed changes

  	// ZOOM WHEN CLICKING ON MARKER
 	/* google.maps.event.addListener(marker, 'click', function() {
  			map.setZoom(15);
  			map.setCenter(marker.getPosition());
  	});*/
  
  	// SET MARKERS & OPEN INFO-WINDOWS FOR EACH MARKER
 	/* google.maps.event.addListener(map, 'click', function(event) {
  			placeMarker(event.latLng, map, marker);
  	}); */
  
}

/*function placeMarker(location, map, marker) {
  		var marker = new google.maps.Marker({
    		   		position: location,
               		map: map,
  		});
  		var infowindow = new google.maps.InfoWindow({
   	 			   	content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  		});
  		infowindow.open(map,marker);
}*/
<<<<<<< Updated upstream
/*
function setMarkers(data) {
	alert("got here!");
	/*for (int i=0; i<data.length; i++) {
		print(data[i]);
	}*/
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
	
=======

>>>>>>> Stashed changes
</script>