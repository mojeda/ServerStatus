<?php if(isset($_GET['id'])) { $name = htmlspecialchars($_GET['id']); } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ServerStatus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/themes/pingstatus/js/pace.js"></script>
    <style>.pace .pace-progress {background: #b30000;position: fixed;z-index: 2000;top: 0;left: 0;height: 2px;-webkit-transition: width 1s;-moz-transition: width 1s;-o-transition: width 1s;transition: width 1s;}.pace-inactive {display: none;}</style>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/themes/pingstatus/css/custom.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="/themes/pingstatus/js/chart.js"></script>
  </head>

  <body>
<?php require_once('menu.php'); ?>