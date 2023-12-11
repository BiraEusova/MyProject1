<?php
$localhost = "localhost";
$db = "TSUdb";
$user = "admin";
$password = "admin";
$link = mysqli_connect ($localhost, $user, $password, $db);
if ($link) {
    //echo "Соединение с сервером установлено", "<br>";
} else {
    //echo "Нет соединения с сервером";
}

$query = "CREATE DATABASE $db";
$create_db = mysqli_query($link, $query);
if ($create_db) {
    //echo "База данных $db успешно создана";
} else {
    //echo "База не создана";
}
