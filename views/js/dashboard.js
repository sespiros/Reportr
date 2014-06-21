// slightly modified myreports.js fix for map in dynamic content
// http://goo.gl/A2rh2I
var map = [];

$(document).ready(function(){
	var totals;
	$('#content-open').load('resources/openReports.php', function() {
		totals = parseInt($('#content-open').find('#totalopen').html());

		// init bootpag
		$('#page-selection-open').bootpag({
			total: totals,
			page: 1,
			maxVisible: 4
		}).on("page", function(event, /* page number here */ num){
				$("#content-open").load('resources/openReports.php', {page: num});
		});

		$('.modal').on('shown.bs.modal', function (e) {
			var i = e.currentTarget.id;
			if (map[i] == undefined){
				// find coordinates
				var that = $(this);
				var lat = that.find('span[data-lat]').data('lat');
				var long = that.find('span[data-long]').data('long');

				var mapOptions = {
					center: new google.maps.LatLng(lat, long),
					zoom: 16,
					disableDefaultUI: true
				};
				map[i] = new google.maps.Map(document.getElementById('map'+i), mapOptions);
				var marker = new google.maps.Marker({
					position: mapOptions.center,
					map: map[i]
				});
			}else{		
				var center = map[i].getCenter();
				google.maps.event.trigger(map[i], "resize");
				map[i].setCenter(center);
			}
		});
	});
	
	$('#content-closed').load('resources/closedReports.php', function() {
		totals = parseInt($('#content-closed').find('#totalclosed').html());

		// init bootpag
		$('#page-selection-closed').bootpag({
			total: totals,
			page: 1,
			maxVisible: 4
		}).on("page", function(event, /* page number here */ num){
				$("#content-closed").load('resources/closedReports.php', {page: num});
		});
	});

	$("#f0").submit(); 
});

