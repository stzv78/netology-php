<?php
interface getDiscountPrice
{
  public function getDiscountPrice(); //скидка рассчитывается по-разному для разных продуктов
}

class Product implements getDiscountPrice
{   
  protected $title; 
  protected $price;
  protected $discount = 10;
  protected $delivery = 250;

  public function getTitle()
  {
    echo "<p><strong>" . $this->title . "</strong></p>";
  }
     
  public function getDiscountPrice() //считаем цену со скидкой
  {
    echo "<p>Скидка -- " . $this->discount . "</p>";
    echo "<p>Цена со скидкой -- ";
    echo $this->price - round($this->price * $this->discount / 100);
    echo "</p>";
  }
  public function getDeliveryPrice() //считаем стоимость доставки
  {
    if($this->discount)//если была скидка
    {
      $this->delivery = 300;
    } 
    echo "<p>Стоимость доставки - " . $this->delivery . "</p>";
  }
}

class Tech extends Product
{
  private $model; 
  private $weight;

  public function __construct($title, $price, $model, $weight) 
  { 
    $this->title = $title;
    $this->price = $price;
    $this->model = $model; 
    $this->weight = $weight;//вес в кг
  }

  public function getDiscountPrice() 
  { 
    if ($this->weight > 10) //скидку считаем если вес > 10 кг 
    {
      echo parent::getDiscountPrice();
    } else {
      $this->discount = 0;
      echo "<p>Цена -- " . $this->price . "</p>";
    }
  } 
}

class Weels extends Product
{
  protected $size; 
 
  public function __construct($title, $size, $price) 
  { 
    $this->title = $title;
    $this->price = $price;
    $this->size = $size; 
  }
}
class Food extends Product
{
  protected $countryFrom;
  private $weight;

  public function __construct($title, $countryFrom, $price, $weight) 
  { 
    $this->title = $title;
    $this->countryFrom = $countryFrom;
    $this->price = $price;
    $this->weight = $weight; //вес в кг
  }
}

//Тестируем классы
echo "<pre>";

$myTech[] = new Tech('Телевизор нового поколения', 30000, 'LG', 5);
$myTech[] = new Tech('Стиральная машина', 12600, 'LG1250', 60);
foreach ($myTech as $key => $value) 
  {
    $myTech[$key]->getTitle();
    $myTech[$key]->getDiscountPrice();
    $myTech[$key]->getDeliveryPrice();
 }

$myWeel[] = new Weels('Резина летняя Dunlop SP Winter Sport 400','175/70 R13', 1930);
$myWeel[] = new Weels('Резина летняя Kumho Ecowing ES01 KH27','165/60 R14', 2330);
$myWeel[] = new Weels('Резина летняя Tigar Sigura 165/60 R14','165/60 R14', 2420);
foreach ($myWeel as $key => $value) 
  {
    $myWeel[$key]->getTitle();
    $myWeel[$key]->getDiscountPrice();
    $myWeel[$key]->getDeliveryPrice();
 }

$myFood[] = new Food('Томаты','Турция', 180, 20);
$myFood[] = new Food('Огурцы','Россия', 120, 4);
$myFood[] = new Food('Киви','Египт', 140, 15);
foreach ($myWeel as $key => $value) 
  {
    $myFood[$key]->getTitle();
    $myFood[$key]->getDiscountPrice();
    $myFood[$key]->getDeliveryPrice();
 }

echo "</pre>";
?>
