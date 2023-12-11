<?php require_once('create_db_request.php'); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Отправка почты</title>
</head>
<body style="align-content: center">

<?php include "menu.html"; ?>

    <p>Добавить новую заметку: </p>

    <form action="newnote.php" method="post">
        <label for="title">Заголовок</label>
        <div>
            <input name="title" id="title" type="text" required="required">
        </div>

        <input name="created" id="created" type="hidden" value ="<?php echo date("yyyy-mm-dd");?>">

        <label for="article">Текст заметки</label>
        <div style="width=300px; height=100px">
            <textarea name="article" id="article" required="required"></textarea>
        </div>
        <div style="width: 300px">
            <button type="submit" name="submit">Отправить</button>
        </div>
    </form>

    <div><a href="index.php">На главную страницу сайта</a></div>

</body>
</html>

<style>
    input {
        width: 298px;
        height: 20px
    }

    textarea {
        width: 300px;
        height: 40px
    }

    button {
        width: 306px;
    }
</style>

<?php
if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $article = $_POST['article'];
    $created = $_POST['created'];

    $query = "INSERT INTO notes (title, created, article) VALUES ('$title','$created','$article')";
    $res = doRequest($query);

    if($res) echo 'Отправлено!';
    else echo 'что-то пошло не так';
}
?>