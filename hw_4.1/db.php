<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=global;charset=utf8", "stepcheva", "neto0999", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
	//нет соединения c БД
	echo "Database connection failed!";
    exit;
}