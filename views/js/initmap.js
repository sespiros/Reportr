/*jslint browser: true*/
/*global $, jQuery, alert, google*/
var map;
var markers = [];
var oldMarkers = [];
var infowindow;
var markerBounds;
var greenIcon = 'views/images/icon_green.png';

function refreshStats() {
    "use strict";
	$('#stats').load('resources/stats.php', function () {
        $('#map-canvas').height($(window).height() - $('.navbar').height() - $('.stat').outerHeight());
		setTimeout(refreshStats, 5000);
	});
}

$(document).ready(function () {
    "use strict";
	refreshStats();
});

function parseXML(url) {
    "use strict";
	// get markers info from xml page
	var request = window.XMLHttpRequest ? new XMLHttpRequest() : new window.ActiveXObject("Microsoft.XMLHTTP");
	request.open('GET', url, false);
	request.send(null);

	return request.responseXML;
}

function addMarker(p) {
    "use strict";
	var title = p.getAttribute("title"),
	    description = p.getAttribute("description"),
	    statusMsg = p.getAttribute("status"),
	    category = p.getAttribute("category"),
	    lat = p.getAttribute("latitude"),
	    lon = p.getAttribute("longitude"),
	    diff = p.getAttribute("timeDiff"),
	    latlng = new google.maps.LatLng(lat, lon),
        contentString,
        marker;

	markerBounds.extend(latlng);

	marker = new google.maps.Marker({
		position: latlng,
		map: map
	});

	if (statusMsg === "Closed") {
		marker.setIcon(greenIcon);
	}

	//add Infowindows
	contentString = '<div>' +
		'<h4>' + title + '</h4>' +
		'<div>' +
		'<p>' + description + '</p>' +
		'</div>' +
                '<small>πριν ' + diff + '</small>' +
		'</div>';

	google.maps.event.addListener(marker, 'click', (function (contentString) {
		return function () {
			//map.setZoom(10);
			//map.setCenter(this.getPosition());
			infowindow.setContent(contentString);
			infowindow.open(map, this);
		};
	}(contentString)));

	return marker;
}

function markerExists(p) {
    "use strict";
	var i;
    for (i = 0; i < oldMarkers.length; i += 1) {
        if (oldMarkers[i].getAttribute('id') === p.getAttribute('id')) {
            return true;
        }
    }

    return false;
}

function markerChanged(p) {
    "use strict";
	var i;
    for (i = 0; i < oldMarkers.length; i += 1) {
        if (oldMarkers[i].getAttribute('id') === p.getAttribute('id')) {
            if (oldMarkers[i].getAttribute('status') !== p.getAttribute('status')) {
                return i;
            }
        }
    }

    return 0;
}

function updateMarkers() {
    "use strict";
	var data = parseXML('resources/last.php'), i, p, marker, statusMsg, ret;
	markers = data.getElementsByTagName("marker");

	for (i = 0; i < markers.length; i += 1) {
		p = markers[i];
        statusMsg = p.getAttribute("status");
		//TODO check the marker status and change colour dynamically
		if (!markerExists(p)) {
			marker = addMarker(p);
			marker.setAnimation(google.maps.Animation.DROP);
			map.fitBounds(markerBounds);
		} else {
            markers[i].setMap(null);
            //if exists replace color
            ret = markerChanged(p);
            if (ret) {
                console.log('changed');
                marker = addMarker(p);
                marker.setIcon(greenIcon);
                map.fitBounds(markerBounds);
            }
        }
	}
	oldMarkers = markers;
	setTimeout(updateMarkers, 5000);
}

function initialize() {
    "use strict";
    var i, data, p, marker, mapOptions = {
		zoom: 8,
		disableDefaultUI: true
    };
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	infowindow = new google.maps.InfoWindow({
		maxWidth: 200
	});
	markerBounds = new google.maps.LatLngBounds();

	data = parseXML('resources/last.php');
	markers = data.getElementsByTagName("marker");

	for (i = 0; i < markers.length; i += 1) {
		p = markers[i];
		marker = addMarker(p);
		marker.setAnimation(google.maps.Animation.DROP);
	}


	map.fitBounds(markerBounds);
	oldMarkers = markers;
	setTimeout(updateMarkers, 5000);
}



google.maps.event.addDomListener(window, 'resize', initialize);
google.maps.event.addDomListener(window, 'load', initialize);

$(document).on("click", ".editUser", function () {
    "use strict";
    var username = $(document).find('.user-img').text().trim(),
	    post_data = { user_name: username, user_edit: 1 };
	$.post("edit.php", post_data)
	    .done(function (data) {
	        var content = $(data)[35]; //mou exei spasei ta neura giati to .find('#edit-header') den douleuei
	        $('#modalUserForm').empty().append(content);
	    });
});
