<h3 class="lead">Registration</h3>

<?php
if(!isset($_POST['regbtn'])) {
?>

    <form action="index.php?page=3" method="post">
        <div class="form-group">
            <label for="login">Login:
                <input type="text" class="form-control" name="login" id="login" autocomplete="off">
            </label>
        </div>
        <div class="form-group">
            <label for="pass1">Password:
                <input type="password" class="form-control" name="pass1" id="pass1">
            </label>
        </div>
        <div class="form-group">
            <label for="pass2">Password confirm:
                <input type="password" class="form-control" name="pass2" id="pass2">
            </label>
        </div>
        <div class="form-group">
            <label for="email">Email:
                <input type="email" class="form-control" name="email" id="email">
            </label>
        </div>
        <input type="submit" name="regbtn" class="btn btn-primary" value="Register">
    </form>

<?php
} else {
    if(register($_POST['login'], $_POST['pass1'], $_POST['pass2'], $_POST['email'])) {
        echo "<h3 class='text-success'>Пользователь добавлен</h3>";
    }
}
