<?php
require_once 'classes/DataBase.php';
session_start();

//авторизованный пользователь
$user = $_SESSION['login'];
$user_id = $_SESSION['user_id'];

$objDb = new DataBase;
$action = "";


if (isset($_POST['create'])) {
	$action = (isset($_POST['create'])) ? 'create': "";
    $name = $_POST['name'];
	} 
    //else { 
    // обработка остальных запросов 
    // } l

switch ($action) {
    case 'create':
        //создаем таблицу 
        if (!ctype_space($name)){
            $objDb->createTable($name);
            } else {
            echo "<p style='color: red;'>Некорретный ввод имени таблицы!</p>";
        }
        break;
    case 'dropColumn':
        //удалить стоблец
        $objDb->dropColumn('myTable', 'colum3');
        break;
    case 'editColumnType':
        //изменяем тип поля
        $objDb->editColumnType('myTable', 'colum2', 'int(11)');
        break;
    case 'renameColumn':
        //переименовываем столбец
        $objDb->renameColumn('myTable', 'colum2', 'newColumn', 'int(11)');
        break;
}

//получаем список всех таблиц в БД
$tableList = $objDb->showTables();

//выводим список таблиц
if ($tableList) {
    echo '<h4>Список таблиц базы данных " '. $objDb->dbname . '":</h4><ul>';
    
    foreach ($tableList as $value) {
        echo "<li><a href=\"manager.php?name=$value\">$value</a></li>";
        
        //выводим поля для выбранной таблицы 
        if (isset($_GET['name']) && ($_GET['name'] === $value)) {
            foreach ($objDb->infoTable($value) as $fields) {
            echo "<b>" . $fields['Field'] .": </b>". $fields['Type']. "</br>"; 
            }
        }
    }
    echo "</ul>";
} else {
    echo '<h4>Нет таблиц в базе данных " '. $objDb->dbname . '":</h4>';
}



//require_once 'tmpl1.php';


function displayTypes($users) {   
    foreach ($users as $val) { 
            echo '<option value=" '. $val['id'] . '"\>' . $val['login'] . '</option>';
    } 
}
?>