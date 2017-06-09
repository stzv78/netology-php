<?php
session_start();
if ($_SESSION['role'] == "guest") {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

if (isset($_FILES['userfile']['name'])) {   
    $error = $_FILES['userfile']['error'];
    if (!$error) {   

        $file = pathinfo($_FILES['userfile']['name']);
        $name = $file['basename'];
        $type = $file['extension'];
        $extentions = "json";
        
        //проверяем расширение файла
        if ($type != $extentions) {
            echo "Файл имеет недопустимое расширение!";
        } else {
            $uploaddir = getcwd() . '/tests/' . $name;
            //проверяем наличие одноименного файла на сервере
            if (file_exists($uploaddir)) {
               echo "Файл $name уже существует. Выберите другой файл!</br>";
            } else {
                //перемещаем файл из временной директории
                $tmp_name = $_FILES['userfile']['tmp_name'];
                move_uploaded_file($tmp_name, $uploaddir);
                header('Location: list.php');
                exit;
            }
        }
    } elseif (empty($_FILES['userfile']['name'])) {
        echo "Файл не выбран!\n";
    } else {
        echo "Ошибка загрузки файла!\n";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Загрузить файл теста</title>
    <meta charset="utf-8">
</head>
<body>
<span>
<form enctype="multipart/form-data" action="admin.php" method="POST">
    <fieldset>
        <legend><strong>Выберите файл для загрузки:</strong></legend>
        <input name="userfile" type="file" placeholder="Выбрать файл с тестом:"></input>
        <button type="submit" value="Отправить файл">Отправить файл</button>
    </fieldset>
</form>
<p><a href="list.php">Список загруженных тестов</a></p>
<p><a href="login.php">Выйти</a></p>
</span>
</body>
</html>



