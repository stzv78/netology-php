<?php
session_start();
require_once 'app/autoloader.php';

$_SESSION['products'] = $_POST;

$myCart = new classes\cart\Cart();

foreach ($_SESSION['products']  as $key => $value) {
        	foreach ($value as $k => $val) {
        		$myCart->addProduct($val);
        	}
        }

$myCart->printProduct();
echo $myCart->product{0}->getTotalPrice();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ваша корзина</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>

<body>
<div class="container">
<form action='сart.php' method='POST'>
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr class="danger">
                <th>Наименование товара</th>
                <th>Стоимость с учетом скидки и доставки, руб.</th>
                <th>Количество, шт/кг</th>
            </tr>
        </thead>
        <tbody>
        <form action="order.php" metod="GET">
        <?php


        ?>
        <input type="number" min="1" max="3" value="" >
        