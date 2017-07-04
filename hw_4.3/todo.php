<?php
require_once 'classes/DataBase.php';
session_start();

//авторизованный пользователь
$user = $_SESSION['login'];
$user_id = $_SESSION['user_id'];

$objDb = new DataBase;
$action = "";

print "<pre>";
var_dump($_POST);
print "</pre>";

if (isset($_POST['addTask'])) {
	$action = (isset($_POST['addTask'])) ? 'addTask': "";
	$description = (isset($_POST['addTask'])) ? strip_tags(htmlspecialchars($_POST['description'])) : "";
} elseif (isset($_GET['action'])) {
	$action = (isset($_GET['action'])) ? strip_tags(htmlspecialchars($_GET['action'])) : "";
	$id = intval($_GET['id']);
	$description = strip_tags(htmlspecialchars($_GET['description']));
} elseif(isset($_POST['order'])) {
	$action = (isset($_POST['order'])) ? 'order' : "";
	$order = strip_tags(htmlspecialchars($_POST['order_by']));
} elseif (isset($_POST['change'])) {
	$action = (isset($_POST['change'])) ? 'change' : "";
	$description = strip_tags(htmlspecialchars($_POST['description']));
	$id = intval($_POST['id']);
} elseif (isset($_POST['assigned'])) {
	$action = (isset($_POST['assigned_user_id'])) ? 'assigned_user_id' : "";
	$assigned_user_id = strip_tags(htmlspecialchars($_POST['assigned_user_id']));
	$id = intval($_POST['id']);
}

switch ($action) {
    case 'addTask':
        //добавляем задачу 
        if (!ctype_space($description)){
            $objDb->insertData($description, $user_id);
        } else {
            echo "<p style='color: red;'>Некорретный ввод!</p>";
        }
        break;
    case 'change':
        //изменяем задачу
        $objDb->editData($id, $description);
        break;
    case 'done':
        //отмечаем задачу
        $objDb->markData($id);
        break;
    case 'delete':
        //удаляем задачу
        $objDb->deleteData($id);
        break;
    case 'assigned_user_id':
        //назначаем задачу пользователю
        $objDb->setAssignedUserId($id, $assigned_user_id);
        break;
       
}

$order  = ($action == 'order') ?  $order : "date_added";

$tasks  = $objDb->selectUsersTasks($order);

$users = $objDb->selectAllData('user', 'id');


$myTasks = $objDb->selectMyTasks($user_id, $order);
//получить список пользователей из таблицы user
//получить список всех задач из таблицы task
//запросить страницу cо списком дел
require_once 'tmpl.php';


function displayUserList($users) {   
    foreach ($users as $val) { 
            echo '<option value=" '. $val['id'] . '"\>' . $val['login'] . '</option>';
    } 
}
?>