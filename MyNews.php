<?php

class Posts 
{   
    private $name; 
    private $description;
    private $url;

    public function __construct($name, $description, $url) 
    { 
      $this->name = $name; 
      $this->description = $description;
      $this->url = $url; 
    } 
   
    public function getNewsName() 
    { 
      return $this->name; 
    } 
    
    public function getNewsDescription() 
    { 
      return $this->description; 
    } 

    public function getNewsUrl()
    {
      return $this->url; 
    }
} 

class PostRequest
{
    public $urlNewsServer;
    public $responseFromNewsServer;
    public $dataJson;
    public $error;
    public $news = array();

  public function __construct($urlNewsServer) 
  {
    // задаем url для запроса
    $this->urlNewsServer = $urlNewsServer;
    // получаем новости с сервера 
    $this->responseFromNewsServer = $this->getPostUrl();

    if ($this->responseFromNewsServer)
        {
          // декодируем полученные данные в массив
          $this->dataJson = json_decode($this->responseFromNewsServer,true);
          
          if ($this->dataJson) {
            //создаем массив объектов-новостей
            foreach ($this->dataJson['sources'] as $key => $value) 
            { 
              $this->news[] = new Posts($value['name'], $value['description'], $value['url']);
            }
          } else {
            $this->error = true;
            die("Ошибка файла");
          }
        } else {
          $this->error = true;
          die("Сервер не доступен");
        }
  }

  public function getPostUrl() 
  { 
    // делаем запрос к API и отдаем ответ сервера в конструктор
    $this->responseFromNewsServer = file_get_contents($this->urlNewsServer);
    return $this->responseFromNewsServer;
  }
}


$language = 'en'; //язык новостных каналов
$country = 'gb'; //страна новостных каналов
$myUrl = "https://newsapi.org/v1/sources?language=". $language ."&country=". $country;

$postRequest = new PostRequest($myUrl); // создаем объект с источником новостей

?>
<!DOCTYPE html>
<html>
<head>
    <title>Список новостных каналов</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="danger">
                <th>Наименование канала</th>
                <th>Тематика новостей</th>
            </tr>
       </thead>

        <tbody>
        <?php 
            foreach ($postRequest->news as $key => $value) 
            {
                echo "<tr>";
                echo "<td>". $value->getNewsName() . "</td>";
                echo "<td>". $value->getNewsDescription() .  '<a href=' . $value->getNewsUrl() .' target = _blank>' . $value->getNewsUrl() .  "</a></td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

