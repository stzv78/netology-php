<?php
session_start();
require_once 'app/autoloader.php';
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
<form action='cart.php' method='POST'>
    <table class="table table-bordered table-striped table-condensed" align = "center">
        <thead>
            <tr class="danger">
                <th>Наименование товара</th>
                <th>Цена, руб.</th>
                <th>Скидка, % </th>
                <th>Цена со скидкой, руб.</th>
                <th>Стоимость доставки, руб.</th>
                <th>Итоговая стоимость, руб.</th>
                <th>В корзину</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //создаем объекты-товары и выводим таблицу со списком товаров
        $myTech[] = new classes\tech\Tech('Телевизор нового поколения', 30000, 'LG');
        $myTech[] = new classes\tech\Tech('Стиральная машина', 12600, 'LG1250');
        foreach ($myTech as $key => $value) 
        {
          echo "<tr>
          <td>" . $myTech[$key]->getInfoProduct() . "</td>
          <td>" . $myTech[$key]->getPrice() . "</td>
          <td>" . $myTech[$key]->getDiscount() . "</td>
          <td>" . $myTech[$key]->getDiscountPrice() . "</td>
          <td>" . $myTech[$key]->getDeliveryPrice() . "</td>
          <td>" . $myTech[$key]->getTotalPrice() . "</td>";
          echo '<td><input type="checkbox" name="$myTech[' . $key . ']" value=$myTech[' .$key. ']></td></tr>';
        }
        
        $myWeel[] = new classes\weels\Weels('Резина летняя Dunlop SP Winter Sport 400','175/70 R13', 1930);
        $myWeel[] = new classes\weels\Weels('Резина летняя Kumho Ecowing ES01 KH27','165/60 R14', 2330);
        $myWeel[] = new classes\weels\Weels('Резина летняя Tigar Sigura','165/60 R14', 2420);
        foreach ($myWeel as $key => $value) 
        {
          echo "<tr>
            <td>" . $myWeel[$key]->getInfoProduct() . "</td>
            <td>" . $myWeel[$key]->getPrice() . "</td>
            <td>" . $myWeel[$key]->getDiscount() . "</td>
            <td>" . $myWeel[$key]->getDiscountPrice() . "</td>
            <td>" . $myWeel[$key]->getDeliveryPrice() . "</td>
            <td>" . $myWeel[$key]->getTotalPrice() . "</td>";
            echo '<td><input type="checkbox" name="$myWeel[' .$key. ']" value="$myWeel[' .$key. ']"></td></tr>';
        }
        $myFood[] = new classes\food\Food('Томаты','Турция', 180, 20);
        $myFood[] = new classes\food\Food('Огурцы','Россия', 120, 4);
        $myFood[] = new classes\food\Food('Киви','Египет', 140, 15);
        foreach ($myFood as $key => $value) 
        {
          echo "<tr>
            <td>" . $myFood[$key]->getInfoProduct() . "</td>
            <td>" . $myFood[$key]->getPrice() . "</td>
            <td>" . $myFood[$key]->getDiscount() . "</td>
            <td>" . $myFood[$key]->getDiscountPrice() . "</td>
            <td>" . $myFood[$key]->getDeliveryPrice() . "</td>
            <td>" . $myFood[$key]->getTotalPrice() . "</td>";
            echo '<td><input type="checkbox" name="$myFood[' .$key. ']" value="$myFood[' .$key. ']"></td></tr>';
        }
        ?>
        </tbody>
    </table>
    <input type="submit" class="btn btn-primary" value="Оформить заказ">
    <input type="reset" class="btn btn-default" value="Очистить форму">
<form>
</div>
</body>
</html>
