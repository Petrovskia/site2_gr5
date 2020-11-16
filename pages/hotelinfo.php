<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
<?php
include_once ('functions.php');
$link = connect();
if(isset($_GET['hotel'])) {
    $hotelid = $_GET['hotel'];
    $res = mysqli_query($link, "SELECT * FROM hotels WHERE id=$hotelid");
    $row = mysqli_fetch_array($res, MYSQLI_NUM);
    $hname = $row[1];
    $hstars = $row[4];
    $hcost = $row[5];
    $hinfo = $row[6];
    mysqli_free_result($res);

    echo '<div class="container text-center">';
    echo  "<h1>Отель $hname</h1>";
    for($i=0; $i<$hstars; $i++){
        echo '<img src="../images/star.png" alt="star" draggable="false" style="width: 50px;">';
    }
    echo '<hr>';
    echo  "<h2 class='lead'>Полная информация $hname</h2>";
    echo "<h4 class='lead'>$hinfo</h4>";
    echo '<hr>';
    // Вывод изображений отеля
    $res = mysqli_query($link, "SELECT imagepath FROM images WHERE hotelid=$hotelid");
    echo  "<h2 class='lead'>Фотографии отеля $hname:</h2>";
    echo '<ul style="list-style-type: none" class="d-flex">';
    while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        echo "<li><img src='../$row[0]' alt='photo' class='img-fluid'></li>";
    }
    echo '</ul>';
    echo '</div>';
}
?>
</body>
</html>