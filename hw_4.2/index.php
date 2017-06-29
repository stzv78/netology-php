<?php
session_start();
require_once 'DataBase.php';

$objDb = new DataBase;

$action = "";


if (isset($_POST['addTask'])) {
	$action = (isset($_POST['addTask'])) ? 'addTask': "";
	$description = (isset($_POST['addTask'])) ? strip_tags(htmlspecialchars($_POST['description'])) : "";
} elseif (isset($_GET['action'])) {
	$action = (isset($_GET['action'])) ? strip_tags(htmlspecialchars($_GET['action'])) : "";
	$id = ($_GET['id']);
	$description = strip_tags(htmlspecialchars($_GET['description']));
} elseif(isset($_GET['order'])) {
	$action = (isset($_GET['order'])) ? 'order' : "";
	$order = strip_tags(htmlspecialchars($_GET['order_by']));
} elseif (isset($_POST['change'])) {
	$action = (isset($_POST['change'])) ? 'change' : "";
	$description = strip_tags(htmlspecialchars($_POST['description']));
	$id = ($_POST['id']);
}

switch ($action) {
    case 'addTask':
        //добавляем задачу
        $objDb->insertData($description);
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
}

if ($action !== 'order') {
	$task = $objDb->selectAllData('date_added');
} else {
	$task = $objDb->selectAllData($order);
}

require_once 'tmpl.php';

?>
