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

    <input type="hidden" name = "note" id = "note" value="<?php echo $note['id']?>" />

    <div style="width: 300px">
        <input type="submit" name="submit" id="submit" value="Удалить"/>
    </div>
</form>

<div><a href="index.php">На главную страницу сайта</a></div>
<div><a href='comments.php?note=<?php echo $note_id ?>'>Назад</a></div>

</body>
</html>

<?php

if(isset($_POST['actionFunc'])){
    $action_func = $_POST['actionFunc'];
    if (function_exists($action_func)){
        $action_func($note_id);
    }
    else{
        echo 'rrr';
    }
}

function func($note_id){

     $query_comments = "SELECT * FROM comments WHERE art_id =".$note_id;
     $res = doRequest($query_comments);

     while ($comment = mysqli_fetch_array($res)) {
         $resComment [] = $comment;
     }

    if ($resComment) {
        foreach ($resComment as $comment) {
             $query_delete_comment = "DELETE FROM comments WHERE id = ".$comment['id'];
             $delete_comment_result = doRequest($query_delete_comment);
             if ($delete_comment_result) echo 'Also comment '.$comment['id'].' was deleted', "<br>";
        }
    }

    $delete_query = "DELETE FROM notes WHERE id = $note_id";
    $delete_result = doRequest($delete_query);

    if($delete_result) echo 'Удалено!', "<br>";
    else echo 'что-то пошло не так', "<br>";
}

?>
