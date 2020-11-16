<?php
function connect($host="127.0.0.1", $user="root", $pass="123456", $dbname="travels") {
    $link = mysqli_connect($host, $user, $pass, $dbname);
    if(!$link) {
        echo "Ошибка: невозможно установить соединение с MySQL";
        echo "Код ошибки errno".mysqli_connect_errno();
        echo "Текст ошибки".mysqli_connect_error();
        exit;
    }
    if(!mysqli_set_charset($link, "utf8")) {
        echo "Ошибка при загрузке кодировки символов utf8".mysqli_error($link);
        exit;
    }
    echo "Connect was successfully MySQL".PHP_EOL;
    return $link;
}


function register($login, $pass1, $pass2, $email) {
    $login = trim(htmlspecialchars($login));
    $pass1 = trim(htmlspecialchars($pass1));
    $pass2 = trim(htmlspecialchars($pass2));
    $email = trim(htmlspecialchars($email));

    if($login === '' || $pass1 === '' || $pass2 === '' || $email === '') {
        echo "<h3 class='text-danger'>Заполните все поля</h3>";
        return false;
    }

    if(strlen($login) < 3 || strlen($login) > 32 || strlen($pass1) < 3 || strlen($pass1) > 64 ) {
        echo "<h3 class='text-danger'>Не корректная длина полей</h3>";
        return false;
    }

    if($pass1 !== $pass2) {
        echo "<h3 class='text-danger'>Пароли не совпадают</h3>";
        return false;
    }

    // хэшируем пароль
    $pass = password_hash($pass1, PASSWORD_BCRYPT);

    // создание запроса на вставку данных о пользователе в таблицу users
    $ins = "INSERT INTO users(login, pass, email, roleid) VALUES('$login', '$pass', '$email', 2)";
    $link = connect();
    mysqli_query($link, $ins); // выполняем запрос в БД

    $err = mysqli_errno($link);
    if($err) {
        echo "Error code: $err <br>";
        exit;
    }

    return true;
}

function login($login, $pass) {
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));

    if($login === '' || $pass === '') {
        echo '<h3 class="text-danger">Заполните все поля</h3>';
        return false;
    }

    if(strlen($login) < 3 || strlen($login) > 32 || strlen($pass) < 3 || strlen($pass) > 64 ) {
        echo "<h3 class='text-danger'>Не корректная длина полей</h3>";
        return false;
    }

    $link = connect();
    $res = mysqli_query($link,"SELECT email FROM users WHERE login='$login'");
    if($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        if(password_verify($pass, $row[2])) {
            $_SESSION['ruser'] = $login;
            if($row[6] == 1) {
                $_SESSION['radmin'] = $login;
            }
        }
    } else {
        echo "<h3 class='text-danger'>Пользователь не найден</h3>";
        return false;
    }
}