$(window).load(function() {
    function updateMarker(pos) {
        $('#debug').text(pos);
        $('#lat_field').val(pos.k);
        $('#lon_field').val(pos.A);
    }

    function loadMap(coords) {
        var mapOptions = {
            center: new google.maps.LatLng(coords.lat, coords.long),
            zoom: 11,
            disableDefaultUI: true
        };

        $('#debug').text(mapOptions.center);
        $('#lat_field').val(coords.lat);
        $('#lon_field').val(coords.long);

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
        loadMap(greeceLatLng);
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getCoords, geolocationError);
    } else {
        loadMap(greeceLatLng);
    };

    $('#add-file-input').click(function() {
        var size = $('input[type="file"]').size();
        if ( size < 4) {
            $(this).parent().append('<input class="upload" type="file" accept="image/*;capture=camera" name="images[]">');
        }
    });
});

$("#ajaxform").submit(function(e)
{
    var formObj = $(this);
    var formURL = formObj.attr("action");
    var formData = new FormData(this);
    $.ajax({
        url: formURL,
    type: 'POST',
        data:  formData,
    mimeType:"multipart/form-data",
    contentType: false,
        cache: false,
        processData:false,
    success: function(data, textStatus, jqXHR)
    {
        var content = $( data ).find(".popup");
        $( "#errors" ).empty().prepend(content);

        content[0].style.opacity = 0;

        //Make sure the initial state is applied.
        window.getComputedStyle(content[0]).opacity;

        content[0].style.opacity = 1;

        if ($( data ).find(".popup").hasClass("alert-info")) {
            document.getElementById("ajaxform").reset();
        }

    },
     error: function(jqXHR, textStatus, errorThrown)
     {
     }
    });
    e.preventDefault(); //STOP default action
});

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
