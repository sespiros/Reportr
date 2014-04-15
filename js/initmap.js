function initialize() {
  var myLatlng = new google.maps.LatLng(38.3752098,22.630499);
  var mapOptions = {
    zoom: 4,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Antikyra!'
  });
}

google.maps.event.addDomListener(window, 'resize', initialize);
google.maps.event.addDomListener(window, 'load', initialize);
/*
function fs() {
    var elem = document.getElementById("map-canvas");
 elem.style.position="absolute";
 elem.style.top = "30px";
 elem.style.width="100%";
 elem.style.height="100%";
}*/
