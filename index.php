<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<!--    <link rel="import" href="./menu.html">-->
<!--    <iframe style="width:100%; border: 0px" src="menu.html"></iframe>-->
<!--    <object data="menu.html"></object>-->
    <?php include "menu.html"; ?>

    <?php
        $query = "SELECT * FROM notes";
        $localhost = "localhost";
        $db = "TSUdb";
        $user = "admin";
        $password = "admin";
        $link = mysqli_connect($localhost, $user, $password, $db);
        $select_note = mysqli_query($link, $query);
        while ($note = mysqli_fetch_array($select_note)){
            echo $note['id'], "<br>"; ?>
            <a href="comments.php?note=<?php echo $note['id']; ?>">
                <?php echo $note ['title'], "<br>";?>
            </a>
            <?php
            echo $note ['created'], "<br>";
            echo $note ['article'], "<br>";
        }
    ?>

</body>
</html>

<style>
    iframe {
        position: fixed;
        top: 0px;
        left: 0px;
        right: 0px;
</style>
