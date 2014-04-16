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
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login</a>
                    <ul class="dropdown-menu" style="padding:17px; min-width:300px;">
                        <form class="form" method="post" action="index.php" name="loginform">
                            <div class="form-group">
                            <input type="text" placeholder="Email" class="form-control" id="user_email" name="user_email">
                            </div>
                            <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" id="user_password" name="user_password">
                            </div>
                            <div class="form-group fix">
                                <?php
                                //require_once('/opt/lampp/htdocs/reportr/libraries/recaptchalib.php');
                                //$publickey = "6LfM3PESAAAAANjOP00eJDS1h2ScuONJrXjXJFqn"; // you got this from the signup page
                                //echo recaptcha_get_html($publickey);
                                //?>    
                            </div>
                            <label class="checkbox">
                                <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1"> Remember me </input> 
                            </label>
                            <a class="btn" href="register.php">Register</a>
                            <button type="submit" name="login" class="btn btn-primary pull-right" >Login</button>
                        </form>
                    </ul>
                </li>
            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
        </nav>
    </header>

<?php include('_footer.php'); ?>
