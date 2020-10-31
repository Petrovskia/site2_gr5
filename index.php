<?php
session_start();
require_once ("pages/functions.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site 2. Tours</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <header class="col-12">

        </header>
    </div>

    <div class="row">
        <nav class="col-12">
            <?php include_once("pages/menu.php"); ?>
        </nav>
    </div>

    <div class="row">
        <section class="col-12">
            <?php
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
                if($page === 1) include_once("pages/tours.php");
                if($page === 2) include_once("pages/comments.php");
                if($page === 3) include_once("pages/registration.php");
                if($page === 4) include_once("pages/admin.php");
            }
            ?>
        </section>
    </div>

    <footer class="lead text-center bg-primary">Step Academy by Aleksey Petrovskiy &copy; 2020</footer>
</div>
</body>
</html>
