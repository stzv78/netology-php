<?php
session_start();
if (isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];
    $role = $_SESSION['role'];
} else {
    header('Location: login.php');
    exit;
}


//получаем в массив $filelist список всех тестов в папке 
$dir = getcwd() . '/tests/';
$filelist = scandir($dir, 1);

//получаем текущий $id файла теста 
if (isset($_POST['test_id'])) {	
    $id = (int)(htmlspecialchars(stripslashes($_POST['test_id'])));

} elseif (isset($_GET['test_id'])&&(is_numeric($_GET['test_id']))) {
    $id = htmlspecialchars(stripslashes($_GET['test_id']))-1;
} else {
    die("Недопустимые данные!");
}

$id = (intval($id));

if (($_GET['status']) === 'Удалить тест') {
    
    if ($role = 'admin') {
    
    $filepath = $dir . $filelist[$id];
    DeleteList($filelist, $filepath);
    die("Файл $filepath удален! <p><a href=\"list.php\">Список тестов</a></p>");
} 
}


if ($id <= (count($filelist)-3)&&($id >= 0)) {
    //читаем в массив содержимое файла теста
    $json = $dir . "$filelist[$id]";
    $test = json_decode(file_get_contents($json), true);
    
    //обрабатываем $_POST
    if (isset($_POST['test_id'])) {	
        
        //проверяем ответы пользователя, если они получены
        if (isset($_POST['userAnswer'])){
            
            $userAnswer = $_POST['userAnswer'];
            if(count($userAnswer) === count($test)) {	
                $result = 0;
                    
                foreach ($test as $key => $value) {	
                    if ($value['correct'] == $userAnswer[$key]) {
                        $result++;
                    }
                }
                
                echo "$userName, Ваш результат: $result правильных из " . count($userAnswer);
                $_SESSION['result'] = $result;
                if ($result > 0) {
                    //передаем в сертификат имя пользователя и его результат
                    echo '<p><a href="image/cert.php">Скачать сертификат</a></p>';
                } else {
                    echo '<p>Тест не пройден, пройдите заново!</p>';
                }

            } else {
                echo 'Не все поля формы заполнены. Повторите ввод!';
            }
        } else {
            echo 'Введите ответы!';
        }
    }
} else {
    header('Location: 404.php');
}

function DeleteList($filelist, $filepath)
{   
    if (!$filelist) {
        echo "<h3>Тесты не найдены!</h3>";
    } else {
        unlink($filepath);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Окно теста</title>
    <style type="text/css">
    div {
        background: #fff; /* Цвет фона */
        color: #000; /* Цвет текста */
        padding: 5px; /* Поля вокруг текста */
        margin-top: 5px; /* Отступ сверху */
    }
    li {
        list-style-type: none;
    }
  
    </style>

</head>
<body>
<form action="test.php" method="post">
<div>
<fieldset>
    <legend><h3>Тест <?php echo $filelist[$id]?></h3></legend>
    <input name="test_id" type="hidden" value="<?php echo $id ?>">
    <?php
    foreach ($test as $key => $value) 
    {	
        echo "<strong> $key. ". $value['textQwestion'] . "</strong>";
        foreach ($value['answer'] as $k => $val) 
        {
            echo  "<li><input type=\"radio\" name=\"userAnswer[" . $key . "]\" value=\"" . $k . "\" required>$val</li>";
        }
    }
    ?>
    <input type="submit" value="Проверить тест">
<p><a href="list.php">Выбрать другой тест</a></p>
</div>
</form>
</body>
</html>