<?php

function doRequest($query){
    $localhost = "localhost";
    $db = "TSUdb";
    $user = "admin";
    $password = "admin";
    $link = mysqli_connect($localhost, $user, $password, $db);
    return mysqli_query($link, $query);
}
