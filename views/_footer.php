    <div id="map-canvas" style="height: 70%; width: 100%;"></div>

<?php
    require_once('config/connect.php');

    $stmt = $pdo->prepare('SELECT COUNT(*) as total FROM web_reports');
    if ($stmt->execute()) {
        $res = $stmt->fetch();
        $totalReports = $res['total'];
    }

    $stmt = $pdo->prepare('SELECT COUNT(*) as open FROM web_reports WHERE status=\'Open\'');
    if ($stmt->execute()) {
        $res = $stmt->fetch();
        $openReports = $res['open'];
    }

    // average time in minutes
    $stmt = $pdo->prepare('SELECT ROUND(AVG(TIME_TO_SEC(TIMEDIFF(time_closed, time_submitted)) / 60), 2) as average_time FROM web_reports WHERE status=\'Closed\'');
    if ($stmt->execute()) {
        $res = $stmt->fetch();
        $averageTime = $res['average_time'];
    }

?>

    <article class="stats">
        <div class="container-fluid">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-xs-6 col-sm-3 stat">
                <div class="content">
                    <h1><span class="fontawesome-folder-close-alt"></span> <?php echo $totalReports; ?> </h1>
                    <h3>Total Reports</h3>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 stat">
            <div class="content">
                <h1><span class="fontawesome-folder-open-alt"></span> <?php echo $openReports; ?> </h1>
                <h3>Open Reports</h3>
            </div>
            </div>
            <div class="col-xs-6 col-sm-3 stat">
            <div class="content">
                <h1><span class="fontawesome-ok"></span> <?php echo ($totalReports - $openReports); ?> </h1>
                <h3>Closed Reports</h3>
            </div>
            </div>
            <div class="col-xs-6 col-sm-3 stat">
            <div class="content">
                <h1><span class="fontawesome-bar-chart"></span> <?php echo $averageTime; ?> <small>min</small> </h1>
                <h3>Average response time</h3>
            </div>
                
            </div>

            <hr>

            </div>
        </div>
    </article>

    <footer>
    <div class="sticky-footer">
        <div class="container text-center">
            <h1 class="hidden">Footer</h1>
            <p class="text-muted">&copy Copyright 2013.</p>
        </div>
    </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="views/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        function initialize() {
            var mapOptions = {
                zoom: 8,
                disableDefaultUI: true
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var markerBounds = new google.maps.LatLngBounds();
            var markers = [];
<?php
    $sql = "SELECT title, description, name, time_submitted, status, latitude, longitude 
            FROM web_reports, web_report_details, web_categories WHERE 
            web_reports.id=web_report_details.report_id and web_report_details.category_id=web_categories.id
            ORDER BY time_submitted LIMIT 20";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
            echo 
"           var latLng = new google.maps.LatLng(".$row['latitude'].", ".$row['longitude'].");\n";
            echo 
"           markers.push(addMarker(latLng, map));\n";
            echo
"           markerBounds.extend(latLng);\n";
        }
        echo 
"           map.fitBounds(markerBounds)\n";
    }
?>

            markers.foreach(function(marker) {
                google.maps.event.addListener(marker, 'click', function() {
                    map.setZoom(8);
                    map.setCenter(marker.getPosition());
                });
            });
        }

        function addMarker(latLng, map) {
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                animation: google.maps.Animation.DROP
            });

            return marker;
        }

        google.maps.event.addDomListener(window, 'resize', initialize);
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </body>
</html>
