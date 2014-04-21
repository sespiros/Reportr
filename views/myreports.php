<?php include('_header.php'); ?>

    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Reportr</a>
            </div>

            <div class="collapse navbar-collapse" id="main-nav">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="index.php">Incident Map</a></li>
                <li class="active"><a href="#">My Reports</a></li>
                <li><a href="newreport.php">New Report</a></li>

<?php if ($login->isUserAdmin() == true) {
    echo '<li><a href="dashboard.php">Dashboard</a></li>';
}?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                <a href="#" class="navbar-brand dropdown-toggle user-img" data-toggle="dropdown"><?php echo $_SESSION['user_name'] . " " . $login->user_gravatar_image_tag?></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="edit.php">Edit profile</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>
    </header>

    <div class="container">
    <h3>Οι αναφορές μου</h3>
<?php 
    require_once('config/connect.php');

    $stmt = $pdo->prepare("SELECT * FROM web_reports INNER JOIN web_report_details on web_reports.id=web_report_details.event_id WHERE submitted_id=:sid");
    $stmt->bindParam(':sid', $_SESSION['user_id']);
    if ($stmt->execute()) {
?>
<table class="table">
    <thead>

        <tr>
            <th>Title</th>
            <th>Time</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
<?php
        while ($row = $stmt->fetch()) {
?>
    <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['time_submitted']; ?></td>
        <td><a href="#" class="btn btn-primary">Details</a></td>
    </tr>
<?php
        }
?>
    </tbody>
</table>
<?php
    }
?>
</div>
    <footer>
        <div class="container">
            <h1 class="hidden">Footer</h1>
            <p class="text-muted">&copy Copyright 2013.</p>
        </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="views/js/bootstrap.min.js"></script>
  </body>
</html>
