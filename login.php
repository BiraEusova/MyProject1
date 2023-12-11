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

<div>Страница входа</div>
<form action="login.php" method="post" style="align-content: center; align-self: center">

    <div>
        <label for="login">Логин</label>
        <input name="login" id="login" type="text" required="required">
    </div>

    <div>
        <label for="password">Пароль</label>
        <input name="password" id="password" type="text" required="required">
    </div>

    <div>
        <button type="submit" name="submit">Войти</button>
    </div>
</form>
<div><a href="index.php">На главную страницу сайта</a></div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login = '$login' AND password ='$password'";
    $res = doRequest($query);
    if ($res) {
        $user = mysqli_fetch_array($res);
        $query = "UPDATE users SET online=1 WHERE login = '$login' AND password ='$password'";
        $res = doRequest($query);
        $userLogin = $user['login'];
        if ($res) {
            echo 'Привет, '.$userLogin;
            setUserID($user['id']);
        }
        else echo 'Что-то пошло не так';

    }
    else echo 'Что-то пошло не так';

}
?>