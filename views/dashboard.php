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
				<div id="content-open"></div>
				<div id="page-selection-open"></div>
			</div>
			<div class="col-md-5">
				<div id="content-closed"></div>
				<div id="page-selection-closed"></div>
			</div>
            <div class="col-md-2">
                <h3>Προσθήκη Κατηγορίας</h3>
				<div id="categories" class="form-group">
<?php
foreach($controls->categories as $name){
?>
	<div class="btn-group btn-group-xs">
	<button id="<?php echo $name['id']; ?>" type="button" class="category btn btn-default"><?php echo $name['name']; ?></button>
    <button type="button" class="catRemove btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
	</div>
<?php
}
?>
				</div>
				<span class="label label-default">Click to edit</span>
                <form id="categoryForm" role="form" method="post">
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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="views/js/jquery.bootpag.min.js"></script>
    <script src="views/js/dashboard.js"></script>
  </body>
</html>
