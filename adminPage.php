<?php
require_once('create_db_request.php');
require_once('user.php');

    $userID = getCurUserID();
    $query = "SELECT * FROM users WHERE id = '$userID'";
    $res = doRequest($query);
    if ($res) {
        $user = mysqli_fetch_array($res);
        $userLogin = $user['login'];
    }
    else echo 'Что-то пошло не так';


?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Админская</title>
    </head>
    <body style="align-content: center">

    <?php include "menu.html"; ?>

    <div>Страничка админа</div>

    <?php

    $query = "SELECT * FROM users WHERE online=1";
    $res = doRequest($query);
    if ($res) {
        $user = mysqli_fetch_array($res);
        $userLogin = $user['login'];
        if ($userLogin == 'admin') echo 'Hello admin';
        else echo 'You are not admin, kish kish from here';
    }
    else echo 'Что-то пошло не так';

    ?>

    <div><a href="index.php">На главную страницу сайта</a></div>
    </body>
    </html>

<?php

?>