
<?php

require_once 'classes/SuperProduct.php';
require_once 'classes/Product.php';
require_once 'classes/GetInfoProduct.php';
require_once 'classes/Tech.php';
require_once 'classes/Weels.php';
require_once 'classes/Food.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Список товаров</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <table class="table table-bordered table-striped" align = "center">
        <thead>
            <tr class="danger">
                <th>Наименование товара</th>
                <th>Цена, руб.</th>
                <th>Скидка, % </th>
                <th>Цена со скидкой, руб.</th>
                <th>Стоимость доставки, руб.</th>
                <th>Итоговая стоимость, руб.</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //создаем объекты-товары и выводим таблицу со списком товаров
        $myTech[] = new Tech('Телевизор нового поколения', 30000, 'LG', 5);
        $myTech[] = new Tech('Стиральная машина', 12600, 'LG1250', 60);
        foreach ($myTech as $key => $value) 
        {
          echo "<tr>
          <td>" . $myTech[$key]->getInfoProduct() . "</td>
          <td>" . $myTech[$key]->getPrice() . "</td>
          <td>" . $myTech[$key]->getDiscount() . "</td>
          <td>" . $myTech[$key]->getDiscountPrice() . "</td>
          <td>" . $myTech[$key]->getDeliveryPrice() . "</td>
          <td>" . $myTech[$key]->getTotalPrice() . "</td></tr>";
        }
        
        $myWeel[] = new Weels('Резина летняя Dunlop SP Winter Sport 400','175/70 R13', 1930);
        $myWeel[] = new Weels('Резина летняя Kumho Ecowing ES01 KH27','165/60 R14', 2330);
        $myWeel[] = new Weels('Резина летняя Tigar Sigura','165/60 R14', 2420);
        foreach ($myWeel as $key => $value) 
        {
          echo "<tr>
            <td>" . $myWeel[$key]->getInfoProduct() . "</td>
            <td>" . $myWeel[$key]->getPrice() . "</td>
            <td>" . $myWeel[$key]->getDiscount() . "</td>
            <td>" . $myWeel[$key]->getDiscountPrice() . "</td>
            <td>" . $myWeel[$key]->getDeliveryPrice() . "</td>
            <td>" . $myWeel[$key]->getTotalPrice() . "</td></tr>";
        }
        $myFood[] = new Food('Томаты','Турция', 180, 20);
        $myFood[] = new Food('Огурцы','Россия', 120, 4);
        $myFood[] = new Food('Киви','Египет', 140, 15);
        foreach ($myFood as $key => $value) 
        {
          echo "<tr>
            <td>" . $myFood[$key]->getInfoProduct() . "</td>
            <td>" . $myFood[$key]->getPrice() . "</td>
            <td>" . $myFood[$key]->getDiscount() . "</td>
            <td>" . $myFood[$key]->getDiscountPrice() . "</td>
            <td>" . $myFood[$key]->getDeliveryPrice() . "</td>
            <td>" . $myFood[$key]->getTotalPrice() . "</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

