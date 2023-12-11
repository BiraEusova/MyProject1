<?php require_once('create_db_request.php');

if (isset($_POST["MAX_FILE_SIZE"])) {
    $err = array();

    if (!is_uploaded_file($_FILES["filename"]["tmp_name"])) {
        $err[] = "Ошибка загрузки файла1";
    }
    if ($_FILES["filename"]['error'] != 0) {
        $err[] = "Ошибка загрузки файла2";
    }
    if ($_FILES["filename"]['size'] > $_POST["MAX_FILE_SIZE"]) {
        $err[] = "Файл слишком большой3";
    }

    $fileTmpPath = $_FILES['filename']['tmp_name'];
    $fileName = $_FILES['filename']['name'];
    $fileSize = $_FILES['filename']['size'];
    $fileType = $_FILES['filename']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $allowedfileExtensions = array('jpg', 'png', 'jpeg');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
        if (count($err) == 0) {
            //Если файл загружен успешно, то перемещаем в конечную директорию
            move_uploaded_file($_FILES["filename"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/MyProject1/photo/" . $_FILES["filename"]["name"]);
        } else {
            #Вывод ошибок проверок
            foreach ($err as $error) {
                print $error . "<br>";
            }
            //var_dump($_POST);
            //var_dump($_FILES);
            //var_dump($_FILES['filename']);
        }
    }
    else
    {
        $message = 'Загрузка не удалась. Допустимые типы файлов: ' . implode(',', $allowedfileExtensions);
    }

}


if (isset($_POST["file_delete"])) {
    $file_name = $_SERVER['DOCUMENT_ROOT'] . "/MyProject1/photo/" . $_POST["file_delete"];
    unlink($file_name);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php include "menu.html"; ?>

<div>Фотографии:</div>

<form action="photo.php" enctype="multipart/form-data" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="307200" /> <!-- 300КБ-->
    <input type="file" name="filename" class="select_file"/>
    <input type="submit" name="submit" value="Добавить"/>
</form>

<?php
    $image_dir_path = $_SERVER['DOCUMENT_ROOT']."/MyProject1/photo";
    $image_dir_id = opendir($image_dir_path);

    //$array_files = null;
    $i = 0;
    while(($path_to_file = readdir($image_dir_id)) !== false)
        {
            if(($path_to_file !=".") && ($path_to_file !=".."))
            {
                $array_files[$i] = basename($path_to_file); $i++;
            }
        }
    closedir($image_dir_id);
?>

<?php
    $array_files_count = count($array_files);
    if ($array_files_count)
    {
        ?>
        <hr/>
        <?php
        sort($array_files);
        for ($i=0; $i<$array_files_count; $i++)
        {
            ?>
            <p><a href="/photo/<?php echo $array_files[$i];
                ?>" target="_blank">
                    <?php echo $array_files[$i];
                    ?></a></p>
            <?php
        }
    }
?>

<hr/>


<form name="file_delete" action="photo.php" method="post"
      enctype="application/x-www-formurlencoded">
    Файл
    <select name = "file_delete" size="1">
        <?php for ($i=0; $i<$array_files_count; $i++)
        {
        ?>
            <option><?php echo $array_files[$i]; ?></option>
        <?php
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Удалить"/>
</form>



<div><a href="index.php">На главную страницу сайта</a></div>

</body>
</html>


