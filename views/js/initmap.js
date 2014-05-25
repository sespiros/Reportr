function initialize() {
	var mapOptions = {
		zoom: 8,
		disableDefaultUI: true
	}
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	var markerBounds = new google.maps.LatLngBounds();
	var markers = [];
	var infowindow = new google.maps.InfoWindow({
		maxWidth: 200
	});	

	var greenIcon = 'views/images/icon_green.png';

	// get markers info from rss page
	var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

	request.open('GET', 'last.php', false);
	request.send(null);

	var data = request.responseXML;

	markers = data.getElementsByTagName("marker");

	for (var i = 0; i< markers.length; i++)
	{
		var p = markers[i];
		var title = p.getAttribute("title");
		var description = p.getAttribute("description");
		var statusMsg = p.getAttribute("status");
		var category = p.getAttribute("category");
		var lat = p.getAttribute("latitude");
		var lon = p.getAttribute("longitude");
		var latlng = new google.maps.LatLng(lat, lon);
		markerBounds.extend(latlng);
		
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			animation: google.maps.Animation.DROP
		});

		if (statusMsg == "Closed") {
			marker.setIcon(greenIcon);
		}

		var contentString = '<div>'+
			'<h4>'+title+'</h4>'+
			'<div>'+
			'<p>' + description +'</p>'+
			'</div>'+
			'</div>';

		google.maps.event.addListener(marker, 'click', (function(contentString) {
			return function() {
				//map.setZoom(10);
				//map.setCenter(this.getPosition());
				infowindow.setContent(contentString);
				infowindow.open(map, this);
			}
		})(contentString));;
	}
	
	map.fitBounds(markerBounds);
}

google.maps.event.addDomListener(window, 'resize', initialize);
google.maps.event.addDomListener(window, 'load', initialize);
