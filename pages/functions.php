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