    <div class="google-map-canvas" id="map-canvas"></div>

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
        <div class="container text-center">
            <h1 class="hidden">Footer</h1>
            <p class="text-muted">&copy Copyright 2013.</p>
        </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="views/js/bootstrap.min.js"></script>
    <script src="views/js/app.js"></script>
  </body>
</html>
