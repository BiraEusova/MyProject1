<?php
require_once('create_db_request.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <?php include "menu.html"; ?>

    <?php
        $query_allnotes = "SELECT COUNT(id) AS allnotes FROM notes";
        $allnotes = doRequest($query_allnotes);
        $row_allnotes = mysqli_fetch_assoc ($allnotes);
        $allnotes_num = $row_allnotes['allnotes'];
        mysqli_free_result ($allnotes);
    ?>
    <h2>Полезная информация:</h2>
    <div>Сделано заметок: <?php echo $allnotes_num ?> </div>

    <?php
        $query_allcomments = "SELECT COUNT(id) AS allcomments FROM comments";
        $allcomments = doRequest($query_allcomments);
        $row_allcomments = mysqli_fetch_assoc ($allcomments);
        $allcomments_num = $row_allcomments['allcomments'];
        mysqli_free_result ($allcomments);
    ?>
    <div>Оставлено комментариев: <?php echo $allcomments_num ?> </div>

    <?php
        $date_array = getdate();
        $begin_date = date ("Y-m-d", mktime(0,0,0,$date_array['mon'],1, $date_array['year']));
        $end_date = date ("Y-m-d", mktime(0,0,0, $date_array['mon'] + 1,0, $date_array['year']));
        $query_lmnotes = "SELECT COUNT(id) AS lmnotes FROM notes WHERE created>='$begin_date' AND created<='$end_date'";
        $lmnotes = doRequest($query_lmnotes);
        $row_lmnotes = mysqli_fetch_assoc($lmnotes);
        $lmnotes_num = $row_lmnotes['lmnotes'];
        mysqli_free_result ($lmnotes);
    ?>
    <div>За последний месяц я создал заметок: <?php echo $lmnotes_num;?> </div>

    <?php
    $query_lmcomments = "SELECT COUNT(id) AS lmcomments FROM comments WHERE created>='$begin_date' AND created<='$end_date'";
    $lmcomments = doRequest($query_lmcomments);
    $row_lmcomments = mysqli_fetch_assoc ($lmcomments);
    $lmcomments_num = $row_lmcomments['lmcomments'];
    mysqli_free_result ($lmcomments);
    ?>
    <div>За последний месяц оставлено комментариев: <?php echo $lmcomments_num ?></div>

    <?php
    $query_last_note = "SELECT id, title FROM notes ORDER BY created DESC LIMIT 0,1";
    $lastnote =doRequest($query_last_note);
    if ($lastnote){
        $note = mysqli_fetch_array($lastnote);
        $title = $note['title'];
        $id = $note['id'];
    ?>
       <div><a href="comments.php?note=<?php echo $id;?>">Последняя заметка: <?php echo $title;?> </a></div>
    <?php
    }
    else {
    ?>
    <div>Заметок нет</div>
    <?php
    }
    ?>

    <?php
    $query_mcnote = "SELECT notes.id, notes.title FROM comments, notes WHERE comments.art_id=notes.id GROUP BY notes.id ORDER BY COUNT(comments.id) DESC LIMIT 0,1";
    $commentNote =doRequest($query_mcnote);
    if ($commentNote){
        $note = mysqli_fetch_array($commentNote);
        $title = $note['title'];
        $id = $note['id'];
        ?>
        <div><a href="comments.php?note=<?php echo $id;?>">Самая комментируемая заметка: <?php echo $title;?> </a></div>
        <?php
    }
    else {
        ?>
        <div>Заметок нет</div>
        <?php
    }
    ?>

    <a href="index.php">На главную страницу сайта</a>
</body>
</html>