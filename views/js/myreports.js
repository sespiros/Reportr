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
