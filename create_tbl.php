<?php
$localhost = "localhost";
$db = "TSUdb";
$user = "admin";
$password = "admin";
$link = mysqli_connect($localhost, $user, $password, $db);
if ($link) {
    echo "Соединение с сервером установлено", "<br>";
} else {
    echo "Нет соединения с сервером";
}

$query = "CREATE TABLE notes
    (id INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id),
    created DATE,
    title VARCHAR (20),
    article VARCHAR (255))";

$create_tbl = mysqli_query($link, $query);
if ($create_tbl) {
    echo "таблица notes создана";
} else {
    echo "таблица notes не создана";
}