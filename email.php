<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Отправка почты</title>
</head>
<body style="align-content: center">

    <?php include "menu.html"; ?>

    <div>какой-то пояснительный текст</div>
    <form action="email.php" method="post" style="align-content: center; align-self: center">

        <div>
            <label for="theme">Тема сообщения</label>
            <input name="theme" id="theme" type="text" required="required">
        </div>

        <div>
            <label for="text">Текст сообщения</label>
            <input name="text" id="text" type="text" required="required">
        </div>

        <div>
            <button type="submit" name="submit">Отправить</button>
        </div>
    </form>
    <div><a href="index.php">На главную страницу сайта</a></div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {

    $text = $_POST['text'];
    $theme = $_POST['theme'];

    if (!$theme) echo 'Нет темы';
    if (!$text) echo 'Нет текста';

    $to = 'mail@example.com';
    $subject = $theme;
    $message = $text;

    $mail = mail($to, $subject, $message);
    if ($mail) echo 'Отправлено!';
    else echo 'что-то пошло не так';

}
?>