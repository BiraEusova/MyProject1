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

    <p>Страница редактирования заметки </p>

    <form action="" method="post">
        <label for="title">Заголовок</label>
        <div>
            <input name="title" id="title" type="text" required="required" value = "<?php echo $note['title'];?>">
        </div>

        <input type="hidden" name="actionFunc" value="func" />
        <input type="hidden" name = "note" id = "note" value="<?php echo $note['id']?>" />

        <label for="article">Текст заметки</label>
        <div style="width=300px; height=100px">
            <textarea name="article" id="article" required="required" ><?php echo $note['article'];?></textarea>
        </div>
        <div style="width: 300px">
            <input type="submit" name="submit" id="submit" value="Изменить"/>
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

    $title = $_POST['title'];
    $article =$_POST['article'];

    $update_query = "UPDATE notes SET title='$title', article='$article' WHERE id = $note_id";
    $update_result = doRequest($update_query);

    if($update_result) echo 'Отправлено!';
    else echo 'что-то пошло не так';
}

?>
