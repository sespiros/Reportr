(function() {
    $(window).load(function() {
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
                map: map,
                title: 'Title'
            });
        });
    });
})();
