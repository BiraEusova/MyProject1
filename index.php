<?php require_once('create_db_request.php'); ?>
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
        $query = "SELECT * FROM notes ORDER BY created DESC";
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

    <form action="" method="get">

        <label for="search">Поиск</label>
        <input type="text" name = "search" id = "search"/>

        <input type="hidden" name="actionFunc" value="func" />

        <div style="width: 300px">
            <input type="submit" name="submit" id="submit" value="Поиск"/>
        </div>
    </form>

</body>
</html>

<style>
    iframe {
        position: fixed;
        top: 0px;
        left: 0px;
        right: 0px;
</style>

<?php
if(isset($_GET['actionFunc'])){
    $action_func = $_GET['actionFunc'];
    if (function_exists($action_func)){
        $action_func();
    }
    else{
        echo 'rrr';
    }
}
    function func()
    {
        $user_search = $_GET['search'];
        $where_list = array();
        $query_usersearch = "SELECT * FROM notes";
        $clean_search = str_replace(',', ' ', $user_search);
        $search_words = explode(' ', $clean_search);

        $final_search_words = array();

        if (count($search_words) > 0) {
            foreach ($search_words as $word) {
                if (!empty($word)) {
                    $final_search_words[] = $word;
                }
            }
        }

        foreach ($final_search_words as $word) {
            $where_list[] = " article LIKE '%$word%'";
        }

        $where_clause = implode(' OR ', $where_list);
        if (!empty($where_clause)) {
            $query_usersearch .= " WHERE $where_clause";
        }

        $res_query = doRequest($query_usersearch);

        while ($res_array = mysqli_fetch_array($res_query)) {
            echo $res_array['id'], "<br>";
            echo $res_array['article'], "<br>", "<hr>", "<br>";
        }
    }
?>

