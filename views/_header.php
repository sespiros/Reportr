<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportr</title>

    <!-- Bootstrap -->
    <link href="views/css/bootstrap.min.css" rel="stylesheet">

    <link href="views/css/reportr.css" rel="stylesheet">
    <link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=fontawesome">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="views/js/initmap.js"></script>
  </head>
  <body>

<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo '<div class="popup alert-danger"><strong>Oh snap! </strong>'.$error.'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo '<div class="popup alert-info">'.$message.'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
        }
    }
}
?>
