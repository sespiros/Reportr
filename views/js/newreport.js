$(window).load(function() {
    function updateMarker(pos) {
        $('#debug').text(pos);
    }

    function loadMap(coords) {
        var mapOptions = {
            center: new google.maps.LatLng(coords.lat, coords.long),
            zoom: 11,
            disableDefaultUI: true
        };

        $('#debug').text(mapOptions.center);

        var map = new google.maps.Map($('#map-container')[0], mapOptions);
        var marker = new google.maps.Marker({
            draggable: true,
            position: mapOptions.center,
            map: map,
            title: 'Report Position'
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            updateMarker(marker.getPosition());
        });
    }

    function getCoords(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        console.log(lat, long);

        loadMap({
            lat: lat,
            long: long
        });
    }

    var greeceLatLng = {
        lat: 39.00,
        long: 22.00
    };
    function geolocationError(err) {
        console.log('Error: ' + err.code);
        $('#errors').append('<p>' + err.code + '</p>');
        $('#errors').removeClass('hidden');
        loadMap(greeceLatLng);
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getCoords, geolocationError);
    } else {
        loadMap(greeceLatLng);
    };

    $('#add-file-input').click(function() {
        if ($('input[type="file"]').size() < 4) {
            $(this).before('<input type="file" accept="image/*;capture=camera">');
        }
    });
});
