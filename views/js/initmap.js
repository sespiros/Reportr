var map;
var markers = [];
var oldMarkers = [];
var infowindow;
var markerBounds;
var greenIcon = 'views/images/icon_green.png';

$(document).ready(function(){
	refreshStats();
});

function refreshStats(){
	$('#stats').load('resources/stats.php', function(){
		setTimeout(refreshStats, 5000);
	});
}

function initialize() {
	var mapOptions = {
		zoom: 8,
		disableDefaultUI: true
	}
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	infowindow = new google.maps.InfoWindow({
		maxWidth: 200
	});	
	markerBounds = new google.maps.LatLngBounds();

	var data = parseXML('resources/last.php');
	markers = data.getElementsByTagName("marker");

	for (var i = 0; i < markers.length; i++)
	{
		var p = markers[i];
		marker = addMarker(p);
		marker.setAnimation( google.maps.Animation.DROP );
	}
	
	map.fitBounds(markerBounds);
	oldMarkers = markers;
	setTimeout(updateMarkers, 5000);
}

function updateMarkers() {
	var data = parseXML('resources/last.php');
	markers = data.getElementsByTagName("marker");

	for (var i = 0; i < markers.length; i++)
	{
		var p = markers[i];
		//TODO check the marker status and change colour dynamically
		if ( !markerExists(p) ) {
			marker = addMarker(p);
			marker.setAnimation( google.maps.Animation.DROP );
			map.fitBounds(markerBounds);
		}
	}
	oldMarkers = markers;
	setTimeout(updateMarkers, 5000);
}

function addMarker(p) {
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
	});

	if (statusMsg == "Closed") {
		marker.setIcon(greenIcon);
	}
	
	//add Infowindows
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

	return marker;
}

function parseXML(url) {
	// get markers info from xml page
	var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	request.open('GET', url, false);
	request.send(null);

	return request.responseXML;
}

function markerExists(p) {
	var i;
    for (i = 0; i < oldMarkers.length; i++) {
        if (oldMarkers[i].getAttribute('id') == p.getAttribute('id')) {
            return true;
        }
    }

    return false;
}

google.maps.event.addDomListener(window, 'resize', initialize);
google.maps.event.addDomListener(window, 'load', initialize);
