<?php

	//получаем в массив $filelist список всех тестов в папке 
	$dir = getcwd() . '/tests/';
	$filelist = scandir($dir, 1);
	
	//получаем текущий $id файла теста 
	if (isset($_POST['test_id']))
	{	
		$id = htmlspecialchars(stripslashes($_POST['test_id']));
		
	} elseif (isset($_GET['test_id'])&&(is_numeric($_GET['test_id'])))
	{
		$id = htmlspecialchars(stripslashes($_GET['test_id']))-1;
	} 
	else 
	{
		die("Недопустимые данные!");
	}
	
	$id = (intval($id));
	
	if ($id <= (count($filelist)-3)&&($id >= 0))
	{
		//читаем в массив содержимое файла теста
		$json = $dir . "$filelist[$id]";
		$test = json_decode(file_get_contents($json), true);
	
	//обрабатываем $_POST
		if (isset($_POST['test_id']))
		{	
			//проверяем отправку имени пользователя
			if  (!($_POST['userName']))
			{
				echo "Введите свое имя!";
			} else {
				//проверяем ответы пользователя, если они получены
				if (isset($_POST['userAnswer']))
				{
					$userAnswer = $_POST['userAnswer'];
					if(count($userAnswer) === count($test))	
					{	
						$result = 0;
						foreach ($test as $key => $value)
						{	
							if ($value['correct'] == $userAnswer[$key])
							{
								$result++;
							}
						}
						echo "Ваш результат: $result правильных из " . count($userAnswer);
						
						//получаем данные с именем и фамилией пользователя
						$userName = strip_tags($_POST['userName']);
						
						//передаем в сертификат имя пользователя и его результат
						echo "<p><a href=\"image/cert.php?userName=$userName&result=$result\">Скачать сертификат</a></p>";
					
					} else {
		    			echo "Не все поля формы заполнены. Повторите ввод!";
		    		}
	    		} else {
	    			echo "Введите ответы!";
	    		}
			}
		}
	} else {
		header('Location: 404.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Окно создания теста</title>
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
	<input name="userName" type="text" size="50" value="" placeholder="Введите Ваше имя и фамилию" autocomplete="on">
	<input type="submit" value="Проверить тест">
<p><a href="list.php">Выбрать другой тест</a></p>
</div>
</form>
</body>
</html>