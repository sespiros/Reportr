<?php include('_header.php');?>
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
                <li><a href="myreports.php">My Reports</a></li>
                <li class="active"><a href="#">New Report</a></li>
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

    <div class="container push-down">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form method="post" enctype="multipart/form-data" action="newreport.php" id="ajaxform" name="ajaxform" role="form">
                    <div class="form-group">
                        <!--<label for="title_field">Τίτλος</label>-->
                        <input placeholder="Τίτλος" class="form-control" id="title_field" type="text" name="title">
                    </div>
                    <div class="form-group">
                        <!--<label for="category_field">Κατηγορία</label>-->
                        <select id="category_field" class="form-control" name="category">
                        <option value="" disabled selected>Επίλεξε κατηγορία</option>
                        <?php 
                            require_once('config/connect.php');

                            $stmt = $pdo->prepare("SELECT * FROM web_categories");
                            if ($stmt->execute()) {
                                while ($row = $stmt->fetch()) {
                        ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <!--<label for="description_field">Περιγραφή</label>-->
                        <textarea placeholder="Περιγραφή αναφοράς" rows="4" class="form-control" id="description_field" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <div id="map-container" style="height: 300px; width: 100%;">
                        </div>
                        <input class="hidden" id="lat_field" type="text" name="latitude">
                        <input class="hidden" id="lon_field" type="text" name="longitude">
                        <span id="debug"></span>
                    </div>
                    <div class="form-group clearfix"> 
                        <span id="add-file-input" class="fontawesome-plus pull-left"></span>
                        <input type="file" accept="image/*;capture=camera" name="images[]">
                    </div>
                    <button type="submit" class="btn btn-primary" name="newreport">Υποβολή</button>
                </form>
                <div class="alert alert-danger hidden" id="errors">
                    errors
                </div>
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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="views/js/newreport.js"></script>
  </body>
</html>
