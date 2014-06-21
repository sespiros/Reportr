// slightly modified myreports.js fix for map in dynamic content
// http://goo.gl/A2rh2I
$('#12').on('shown.bs.modal', function () {
	console.log("modal_shown");
	// find coordinates
	var maps_data = $('.small-map-data');
	maps_data.each(function(i, e) {
		var that = $(this);
		var lat = that.find('span[data-lat]').data('lat');
		var long = that.find('span[data-long]').data('long');

		var mapOptions = {
			center: new google.maps.LatLng(lat, long),
			zoom: 16,
			disableDefaultUI: true
		};
		var map = new google.maps.Map(that.siblings('.small-map-view')[0], mapOptions);
		var marker = new google.maps.Marker({
			position: mapOptions.center,
			map: map
		});
	});
});
