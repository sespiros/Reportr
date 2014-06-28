(function() {
    $(window).load(function() {

        $('.collapse').on('shown.bs.collapse', function(e) {
            // find coordinates
            var maps_data = $(this).find('.small-map-data');

            // if map is already loaded, do not reload
            if ($(this).find('.small-map-view').contents().length != 0)
                return;
                
            maps_data.each(function(i, e) {
                var that = $(this);
                var lat = that.find('span[data-lat]').data('lat');
                var long = that.find('span[data-long]').data('long');

                var mapOptions = {
                    center: new google.maps.LatLng(lat, long),
                    zoom: 14,
                    disableDefaultUI: true
                };
                var map = new google.maps.Map(that.siblings('.small-map-view')[0], mapOptions);
                var marker = new google.maps.Marker({
                    position: mapOptions.center,
                    map: map
                });
            });
        });
    });
})();

	$(document).on("click", ".editUser", function() {
		username = $(document).find('.user-img').text(); 
		username = username.trim();

		var post_data = { user_name: username, user_edit: 1 };
		$.post( "edit.php", post_data )
		  .done(function( data ) {
			  var content = $( data )[35]; //mou exei spasei ta neura giati to .find('#edit-header') den douleuei
			  $('#modalUserForm').empty().append(content);
		  })
	});
