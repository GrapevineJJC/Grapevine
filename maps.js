function initialize() { 
  var myCenter = new google.maps.LatLng(42.335549, -71.168495);
  var mapProp = {
    center:myCenter,
    zoom:10,
   
    panControl:true,
	
	zoomControl:true,
		zoomControlOptions: {
    		style:google.maps.ZoomControlStyle.LARGE
		},
	
	mapTypeControl:true,
		mapTypeControlOptions: {
    		style:google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
	
	//scaleControl:true,
	
	streetViewControl:true,
	
	//overviewMapControl:true,
	//rotateControl:true,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  
  // RED MARKER	
  var marker = new google.maps.Marker({
  		position:myCenter,
  		animation:google.maps.Animation.DROP,
  		title:'Click to zoom'
		});
  marker.setMap(map);	

  // ZOOM WHEN CLICKING ON RED MARKER
  google.maps.event.addListener(marker, 'click', function() {
  		map.setZoom(15);
  		map.setCenter(marker.getPosition());
  });
  
  // SET MARKERS & OPEN INFO-WINDOWS FOR EACH MARKER
 /* google.maps.event.addListener(map, 'click', function(event) {
  		placeMarker(event.latLng, map, marker);
  }); */
  
}

function placeMarker(location, map, marker) {
  var marker = new google.maps.Marker({
    		   position: location,
               map: map,
  });
  var infowindow = new google.maps.InfoWindow({
   	 			   content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
  });
  infowindow.open(map,marker);
}