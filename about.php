<?php
$name = "Зоя";
$surname = "Степчева";
$age = 38;
$mail = 'stzv78@gmail.com';
$city = 'Ульяновск';
$about = 'Технический писатель в АИС "Город"';
?>
<!Doctype html>
<!DOCTYPE html>
<html>
<head>
	<title><?= $surname . ' ' . $name; ?></title>
	<meta charset = "utf-8">
	<style type = "text/css">

        body {
            font-family: sans-serif;  
        }
            
        dl {
            display: table-row;
        }
            
        dt, dd {
            display: table-cell;
            padding: 3px 8px;
        }
    </style>
</head>

<body>
	<h1>Страница пользователя <?=$surname.' '.$name; ?></h1>
        <dl>
            <dt>Имя</dt>
            <dd><?= $name; ?></dd>
        </dl>
        <dl>
            <dt>Возраст</dt>
            <dd><?= $age; ?></dd>
        </dl>
        <dl>
            <dt>Адрес электронной почты</dt>
            <dd><?php echo '<a href=/'. $mail . '/">' . $mail . '</a>'; ?></dd>
        </dl>
        <dl>
            <dt>Город</dt>
            <dd><?= $city; ?></dd>
        </dl>
        <dl>
            <dt>О себе</dt>
            <dd><?= $about; ?></dd>
        </dl>
	
</body>
</html>
