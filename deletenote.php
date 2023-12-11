<?php
require_once('create_db_request.php');

$note_id = $_GET['note'];

$query = "SELECT created, title, article FROM notes WHERE id =".$note_id;
$res = doRequest($query);
if ($res){
    $note = mysqli_fetch_array($res);
    $title = $note['title'];
    $article = $note['article'];
}

?>
<html>
<body>

<p>Страница удаления заметки </p>

<form action="" method="post">
    <label for="title">Заголовок</label>
    <div>
        <p><?php echo $note['title'];?></p>
    </div>

    <input type="hidden" name="actionFunc" value="func" />
    <input type="hidden" name = "note" id = "note" value="<?php echo $note['id']?>" />

    <label for="article">Текст заметки</label>
    <div style="width=300px; height=100px">
        <p><?php echo $note['article'];?></p>
    </div>
    <div style="width: 300px">
        <input type="submit" name="submit" id="submit" value="Удалить"/>
    </div>
</form>

<div><a href="index.php">На главную страницу сайта</a></div>
</body>
</html>

<?php

if(isset($_POST['actionFunc'])){
    $action_func = $_POST['actionFunc'];
    if (function_exists($action_func)){
        $action_func($note_id); //Здесь вызов функции в нашем случае PlusTime;
    }
    else{
        echo 'rrr';
    }
}

function func($note_id){

    $update_query = "DELETE FROM notes WHERE id = $note_id";
    $update_result = doRequest($update_query);

    if($update_result) echo 'Удалено!';
    else echo 'что-то пошло не так';
}

?>
