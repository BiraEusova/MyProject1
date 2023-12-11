<?php
require_once('create_db_request.php');
require_once('user.php');
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Отправка почты</title>
    </head>
    <body style="align-content: center">

    <?php include "menu.html"; ?>

    <div>Страница выхода</div>
    <form action="logout.php" method="post" style="align-content: center; align-self: center">
        <div>
            <button type="submit" name="submit">Выйти</button>
        </div>
    </form>
    <div><a href="index.php">На главную страницу сайта</a></div>
    </body>
    </html>

<?php
if (isset($_POST['submit'])) {

    $query = "SELECT * FROM users WHERE online=1";
    $res = doRequest($query);
    if ($res) {
        $user = mysqli_fetch_array($res);
        $userID = $user['id'];
        $query = "UPDATE users SET online=0 WHERE id = '$userID'";
        $res = doRequest($query);
        if ($res) echo 'До свидания!';
        else echo 'Что-то пошло не так';
    }
    else echo 'Что-то пошло не так';

}
?>