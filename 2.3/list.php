<?php
$dir = getcwd() . '/tests/';
$filelist = scandir($dir, 1);//получаем в массив все файлы из папки с тестами 

//если в папке есть файлы с тестами, то выводим их нумерованным списком
function GetList($filelist)
{   
    if (!$filelist) {
        echo "<h3>Тесты не найдены!</h3>";
    } else {
        echo "<h3>Список тестов:</h3><ol>";
        foreach ($filelist as $i => $file) { 
            if (!in_array($file, array('.', '..'))) {
                echo '<li>' . $file . '</li>';
            }
        }
        echo "</ol>"; 
    }
}

//получаем содержимое теста по его номеру ($id)
function GetTest($filelist)
{   
    foreach ($filelist as $i => $file) { 
        if (!in_array($file, array('.', '..'))) {
            $id = $i+1;
            echo "<option value=\"$id\">" . $file . "</option>";
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список тестов</title>
</head>
<body>
<span>
<?php GetList($filelist)?>
<form action="test.php" method="get">
    <fieldset>
        <legend>Выберите тест для загрузки:</legend>
        <select name="test_id">
        <?php GetTest($filelist) ?>
        </select>
       <input type="submit" value="Отправить">
    </fieldset>
</form>
<p><a href="admin.php">Загрузить новый тест</a></p>
</span>
</body>
</html>
