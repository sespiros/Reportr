<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/reportr.css" rel="stylesheet">
    <link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=fontawesome">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="js/initmap.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 
  </head>
  <body>
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
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login</a>
                    <ul class="dropdown-menu" style="padding:17px; min-width:300px;">
                        <form class="form" method="post" action="includes/process_login.php" name="login_form">
                            <div class="form-group">
                            <input type="text" placeholder="Email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                            </div>
                            <label class="checkbox">
                                <input type="checkbox" value="remember-me"> Remember me </input> 
                            </label>
                            <a class="btn" href="#">Register</a>
                            <button type="submit" class="btn btn-primary pull-right" onclick="formhash(this.form, this.form.password)" >Login</button>
                        </form>
                    </ul>
                </li>
            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>
    </header>

    <div class="google-map-canvas" id="map-canvas"></div>

    <article class="stats">
        <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-xs-6 col-sm-3 stat">
            <h1><span class="fontawesome-folder-close-alt"></span> 100 </h1>
            <h3>Total Reports</h3>
            </div>
            <div class="col-xs-6 col-sm-3 stat">
            <h1><span class="fontawesome-folder-open-alt"></span> 80 </h1>
            <h3>Open Reports</h3>
            </div>
            <div class="col-xs-6 col-sm-3 stat">
            <h1><span class="fontawesome-ok"></span> 10 </h1>
            <h3>Closed Reports</h3>
            </div>
            <div class="col-xs-6 col-sm-3 stat">
            <h1><span class="fontawesome-bar-chart"></span> 10 </h1>
            <h3>Average response time <small> in seconds</small></h3>
                
            </div>

            <hr>

            </div>
        </div>
    </article>

    <footer>
        <div class="container">
            <h1 class="hidden">Footer</h1>
            <p class="text-muted">&copy Copyright 2013.</p>
        </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
