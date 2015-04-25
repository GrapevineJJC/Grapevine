<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() { 
  	var myCenter = new google.maps.LatLng(42.335549, -71.168495);
  	var bounds = new google.maps.LatLngBounds();

	var mapProp = {
    	center:myCenter,
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
  
  	// Multiple Markers
	var markers = [
    		[42.335549, -71.168495],
        	[42.350000, -71.200000]
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
        });
        
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
        
  	// SINGLE MARKER	
 	/* var marker = new google.maps.Marker({
  			position:myCenter,
  			animation:google.maps.Animation.DROP,
  			title:'Click to zoom'
			});
  	marker.setMap(map);	*/

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

</script>