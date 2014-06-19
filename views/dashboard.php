<?php include('_header.php'); ?>

<?php
    require_once('config/connect.php');

    if (isset($_POST['categorySubmit'])) {
        $catStmt = $pdo->prepare('SELECT count(*) FROM web_categories WHERE name=:catName');
        $catStmt->bindParam('catName', $_POST['categoryName']);
        if ($catStmt->execute()) {   
            $row = $catStmt->fetch(PDO::FETCH_NUM);
            $nrows = $row[0];
        }

        // only if category doesn't exist, add it
        if ($nrows == 0) {
            $addStmt = $pdo->prepare('INSERT INTO web_categories (name) VALUES (:catName)');
            $addStmt->bindParam('catName', $_POST['categoryName']);
            if (!$addStmt->execute()) {
                die('Error!');
            }
        }
    }

?>

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
                <li><a href="myreports.php#">My Reports</a></li>
                <li><a href="newreport.php">New Report</a></li>
                <li class="active"><a href="#">Dashboard</a></li>
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
        <h2 class="text-center">Dashboard</h2>
        <div class="row">
            <div class="col-md-5">
                <h3>Ανοιχτές Αναφορές</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Αριθμός αναφοράς</th>
                            <th>Τίτλος</th>
                            <th>Ώρα υποβολής</th>
                            <th>Ενέργειες</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    require_once('config/connect.php');

    $stmt = $pdo->prepare("SELECT id, title, time_submitted FROM web_reports INNER JOIN web_report_details ON web_reports.id = web_report_details.report_id WHERE
        status='Open' ORDER BY time_submitted");
    if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["title"]; ?></td>
                            <td><?php echo $row["time_submitted"]; ?></td>
                            <td><a href="#">Προβολή</a></td>
                        </tr>
<?php
        }
    }
?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <h3>Επιλυμένες Αναφορές</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Αριθμός αναφοράς</th>
                            <th>Τίτλος</th>
                            <th>Ημερομηνία επίλυσης</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    require_once('config/connect.php');

    $stmt = $pdo->prepare("SELECT id, title, time_closed FROM web_reports INNER JOIN web_report_details ON web_reports.id = web_report_details.report_id WHERE
        status='Closed' ORDER BY time_submitted");
    if ($stmt->execute()) {
        while ($row = $stmt->fetch()) {
?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["title"]; ?></td>
                            <td><?php echo $row["time_closed"]; ?></td>
                            <td>admin</td>
                        </tr>
<?php
        }
    }
?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2">
                <h3>Προσθήκη Κατηγορίας</h3>
                <form role="form" method="post">
                    <div class="form-group">
                        <label for="categoryNameId">Όνομα Κατηγορίας</label>
                        <input type="text" id="categoryNameId" name="categoryName" class="form-control">
                    </div>
                    <button type="submit" name="categorySubmit" class="btn btn-primary">Προσθήκη</button>
                </form>
            </div>
        </div>
    </div>

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
  </body>
</html>
