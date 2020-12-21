function initMap() {
	// The location of Uluru
	var uluru = {lat: 33.831766, lng: -117.911951};
	// The map, centered at Uluru
	var map = new google.maps.Map(document.getElementById('google-map'), {
	    zoom: 14, 
	    center: uluru,
	    gestureHandling: 'cooperative'
	});
	// The marker, positioned at Uluru
	var marker = new google.maps.Marker({position: uluru, map: map});
}