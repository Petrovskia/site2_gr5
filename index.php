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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <header class="col-12">
            <?php include_once("pages/login.php")?>
        </header>
    </div>

    <div class="row">
        <nav class="col-12 mt-4">
            <?php include_once("pages/menu.php"); ?>
        </nav>
    </div>

    <div class="row">
        <section class="col-12 my-5">
            <?php
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
                if($page === '1') include_once("pages/tours.php");
                if($page === '2') include_once("pages/comments.php");
                if($page === '3') include_once("pages/registration.php");
                if($page === '4') include_once("pages/admin.php");
            }
            ?>
        </section>
    </div>

    <footer class="lead text-center bg-primary">Step Academy by Aleksey Petrovskiy &copy; 2020</footer>
</div>
</body>
</html>
