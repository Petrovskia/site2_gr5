<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
include_once("functions.php");
connect();

// int - тип данных для целых чисел (т.е. 1, 2, 3 ит.д)
// varchar - строковый тип данных

// not null - не пустое
// auto_increment - значения в данном поле будут автоматически увеличиваться на 1. При создании новых записей.
// unique - данные в этом поле не могут повторяться
// delete cascade - если будет удалено родительское поле, то все дочерние поля завязанные с ним будут удалены.

// primary key - ключевое поле, всегда должно быть у идентификатора. Будет создаваться автоматически и менять его самостояетельно не нужно.
// foreign key - устанавливает внешний ключ, который связаывает поле текущей таблицы с полем другой таблицы

// создание таблицы Стран и полей к ней
$ct1 = 'CREATE TABLE countries(
id int not null auto_increment primary key,
country varchar(64) not null unique 
)default charset="utf8"';

$ct2 = 'CREATE TABLE cities(
id int not null auto_increment primary key,
city varchar(64) not null,
countryid int,
foreign key(countryid) references countries(id) on delete cascade
)default charset="utf8"';



?>
</body>
</html>

