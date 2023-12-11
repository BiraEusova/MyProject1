<?php
require_once('create_db_request.php');
$note_id = $_GET['note'];

$query = "SELECT created, title, article FROM notes WHERE id =".$note_id;
$res = doRequest($query);
$note = mysqli_fetch_array($res);
echo $note['id'], "<br>";
echo $note ['title'], "<br>";
echo $note ['created'], "<br>";
echo $note ['article'], "<br>";
echo "<br>";?>

<div>
    <a href="editnote.php?note=<?php echo $note_id;?>">Изменить заметку</a>
</div>
<div>
    <a href="deletenote.php?note=<?php echo $note_id;?>">Удалить заметку</a>
</div>

<?php
$query_comments = "SELECT * FROM comments WHERE art_id =".$note_id;
$res = doRequest($query_comments);

//$resComment = [];
while ($comment = mysqli_fetch_array($res)) {
    $resComment [] = $comment;
}

if (!$resComment) echo "No comments";
else {
    echo "Комментарии:", "<br>", "<br>";
    foreach ($resComment as $comment) {
        echo $comment['id'], "<br>";
        echo $comment ['created'], "<br>";
        echo $comment ['author'], "<br>";
        echo $comment ['comment'], "<br>";
        echo "<br>";
    }
}

