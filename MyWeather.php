<?php
$city = "Ульяновск"; 
$appid = "4b4c6388094b33baacb43cb677b27c64";
$mode = "json"; 
$units = "metric";
$lang = "ru";
 
// формируем url для запроса
$url = "http://api.openweathermap.org/data/2.5/forecast/daily?q=$city&appid=$appid&mode=$mode&units=$units&lang=$lang";
// делаем запрос к API
$data = file_get_contents($url);

function makeTable($data, $city = "Ульяновск") {
  // декодируем полученные данные
    $dataJson = json_decode($data);

    // забираем в массив погодные условия для текущего дня
    $arrayDays = $dataJson->list[0];

    //получаем и выводим текущую дату 
    $dat=explode(".", date("d.m.Y"));
    
    switch ($dat[1])
      {
        case 1: $m='января'; break;
        case 2: $m='февраля'; break;
        case 3: $m='марта'; break;
        case 4: $m='апреля'; break;
        case 5: $m='мая'; break;
        case 6: $m='июня'; break;
        case 7: $m='июля'; break;
        case 8: $m='августа'; break;
        case 9: $m='сентября'; break;
        case 10: $m='октября'; break;
        case 11: $m='ноября'; break;
        case 12: $m='декабря'; break;
      }
    // выводим данные в таблицу
      echo "<table class = \"table\" opacity = 0>";
      echo "<tr>" . $dat[0] . "&nbsp;" . $m . "&nbsp;" . $dat[2] . "</tr>";
      echo "<tr align = \"center\"><td><h2>" . $city . "</h2>";   
        echo "<img src =\"http://openweathermap.org/img/w/" . $arrayDays->weather[0]->icon . ".png\" height=100px> <h1>" . $arrayDays->temp->day . "&deg C</h1></td></tr>"; 
        echo "<tr><td>";
        echo "Скорость ветра: " . $arrayDays->speed . "м/с <br/>";
        echo "Осадки: " . $arrayDays->weather[0]->description . "<br/>";
        echo "Давление: " . $arrayDays->pressure . "<br/>";
        echo "Влажность: " . $arrayDays->humidity . "% <br/>";
        echo "</td></tr></table>";
}
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <title>Погода в Ульяновске</title>
  <style>
   body {
    background: url(http://www.hdoboi.org/pic/201309/1920x1080/hdoboi.org-48628.jpg) no-repeat;
    -moz-background-size: 100%; /* Firefox 3.6+ */
    -webkit-background-size: 100%; /* Safari 3.1+ и Chrome 4.0+ */
    -o-background-size: 100%; /* Opera 9.6+ */
    background-size: 100%; /* Современные браузеры */
	}

    div {
    background: #000; /* Цвет фона */
    color: #fff; /* Цвет текста */
    padding: 5px; /* Поля вокруг текста */
    -moz-border-radius: 5px; /* Для Firefox 3 */
    -webkit-border-radius: 5px; /* Для Safari 4 и Chrome */
    border-radius: 0, 5px; /* Для современных браузеров */
    opacity: 0.6; /* Прозрачность */
    margin-top: 50px; /* Отступ сверху */
    margin-left: 40%; /* Отступ слева */
    width: 230px;
    }

  </style>
 </head>
 <body>
 	<div >
 	<?php
 	// если получили данные
	if($data){
    makeTable($data);   
    }else{
    	echo "Сервер не доступен!";
	}	
  ?>
 	</div>
 </body>
</html>
