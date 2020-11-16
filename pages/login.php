<?php
if(isset($_SESSION['ruser'])) {
    echo '<form action="index.php';
    if(isset($_GET['page'])) echo "?page=".$_GET['page'];
    echo '" class="input-group" method="post">';
    echo "<h4>Привет,".$_SESSION['ruser']."</h4>";
    echo '</form>';
} else {
    echo '<form action="index.php';
    if(isset($_GET['page'])) echo "?page=".$_GET['page'];
    echo '" class="input-group" method="post">';

    echo '<input type="text" name="login" placeholder="login">';
    echo '<input type="password" name="pass" placeholder="password">';
    echo '<input type="submit" name="auth" value="Login" class="btn btn-info">';
    echo '</form>';

    // обработчик логина
    if(isset($_POST['auth'])) {
        login($_POST['login'], $_POST['pass']);
    }
}