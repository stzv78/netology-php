<?php

if ($_FILES)
{   
	$error = $_FILES['userfile']['error'];
	if (!$error) 
	{ 
		$name = basename($_FILES['userfile']['name']);
		$uploaddir = getcwd() . '/tests/' . $name;
		if (file_exists($uploaddir)) //проверяем наличие одноименного файла на сервере
		{
		    echo "Файл $name уже существует. Выберите другой файл!</br>";
		} else {
		    //перемещаем файл из временной директории
			$tmp_name = $_FILES['userfile']['tmp_name'];
        	move_uploaded_file($tmp_name, $uploaddir);
        	echo "Файл $name успешно отправлен!</br>";
        }
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
    <p><a href="list.php">Перейти к списку доступных тестов</a></p>
</form>
</span>
</body>
</html>



