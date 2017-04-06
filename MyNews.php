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

class PostReqest
{
    public $urlNewsServer;
    public $responseFromNewsServer;
    public $dataJson;
    public $error;

  public function __construct($urlNewsServer) 
  {
    // задаем url для запроса
    $this->urlNewsServer = $urlNewsServer;
    // получаем новости с сервера 
    $this->responseFromNewsServer = $this->getPostUrl();
    if($this->responseFromNewsServer)
        {
          // декодируем полученные данные в массив
          $this->dataJson = json_decode($this->responseFromNewsServer,true);
        } else {
          $this->error = true;
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

$postReqest = new PostReqest($myUrl); // создаем объект с источником новостей
if (!$postReqest->error) //если нет ошибки связи с сервером, то создаем массив объектов-новостей
{
  foreach ($postReqest->dataJson['sources'] as $key => $value) 
  { 
          $news[] = new Posts($value['name'], $value['description'], $value['url']);
  } 
} else {
          echo "Сервер не доступен";
          break;
        }
      
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
                <th>Наименование канала</th>
                <th>Тематика новостей</th>
            </tr>
       </thead>

        <tbody>
        <?php 
            foreach ($news as $key => $value) 
            {
                echo "<tr>";
                echo "<td>". $news[$key]->getNewsName() . "</td>";
                echo "<td>". $news[$key]->getNewsDescription() .  '<a href=' . $news[$key]->getNewsUrl() .' target = _blank>' . $news[$key]->getNewsUrl() .  "</a></td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
