<?php

class Posts 
{   
    public $name; 
    public $description; 
    
    public function __construct($name, $description) 
    { 
    	$this->name = $name; 
      $this->description = $description; 
    } 

    public function getNewsName() 
    { 
      return $this->name; 
    } 
    
    public function getNewsDescription() 
    { 
      return $this->description; 
    } 
} 

//здесь тестируем класс

// формируем url для запроса
	$url = "https://newsapi.org/v1/sources?language=en&country=gb";
// делаем запрос к API
	$data = file_get_contents($url);
    
        if($data)
        {
    		  // декодируем полученные данные в массив
   			  $dataJson = json_decode($data,true);

          //создаем массив объектов-новостных ресурсов
   			  foreach ($dataJson['sources'] as $key => $value) 
          {
   			   $news[] = new Posts($value['name'], $value['description']);
   			  }  

   			} else {
    	     echo "Сервер не доступен!";
    	  };
?>

<!DOCTYPE html>
<html>
<head>
    <title>Список новостных сайтов</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="danger">
                <th>Название</th>
                <th>Описание</th>
            </tr>
       </thead>

        <tbody>
        <?php 
            foreach ($news as $key => $value) 
            {
                echo "<tr>";
                echo "<td>". $news[$key]->getNewsName() . "</td>";
                echo "<td>". $news[$key]->getNewsDescription() . "</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
      


