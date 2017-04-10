<?php

interface CountFine
{
  public function countFine(); //расчет штрафа траспортного средства
}

class MyCar implements CountFine //от этого класса могут наследоваться другие -- грузовики, автобусы, и т.п.
                                 //для них штраф может рассчитываться иначе
{  
  protected $ownerName;//владелец транспортного средства
  protected $name;//вид транспортного средства (легковая машина, грузовик, гужевая повозка и т.п.)
  protected $speed;//скорость транспортного средства 
  protected $fine;//штраф за превышение скорости транспортным средством
  
  public function __construct($name, $ownerName, $speed) 
  { 
    $this->name = $name; 
    $this->ownerName = $ownerName;
    $this->speed = $speed;
  }

  public function countFine() //расчет штрафа траспортного средства
  { 
    if ($this->speed > 90) //скорость в населенном пункте превышена
    {
      $this->fine = 5000;
    }
    return $this->fine; 
  }

  public function getOwnerName() 
  { 
    return $this->ownerName; 
  } 
}   

//Тестирование класса MyCar
echo "<pre>";
$car[] = new MyCar('Lada', 'Иванов', 190);
$car[] = new MyCar('KIA', 'Петров', 80);
foreach ($car as $key => $value) 
{
  if ($value->countFine())
  {
    echo 'Г-н '. $value->getOwnerName() . '!!! ' .  
         'Вам необходимо заплатить штраф в рамере ' . $value->countFine() . ' рублей в течение 10 дней.</br>';
  } else {
    echo 'Г-н '. $value->getOwnerName()  . '!!! ' .  'Да Вы образцовый водитель!!</br>';
  }
}
echo "</pre>";

interface ChangeMe
{
  public function changeMe();//Напомнить обновить устройство "Умного дома" по окончании срока службы.
                              // Срок службы определяется паспортом устройства
}

class MyTV implements ChangeMe
{ 
  protected $model; //модель устройства
  protected $modelOfYear; //год выпуска модели
  protected $place;//где в доме установлено
  protected $shelfLife;//срок годности устройства
  private $numberOfChannals; 
  private $favouriteChannal;

  public function __construct($model, $modelOfYear, $numberOfChannals, $favouriteChannal, $place, $shelfLife) 
  { 
    $this->model = $model;
    $this->modelOfYear = $modelOfYear;
    $this->numberOfChannals = $numberOfChannals;
    $this->favouriteChannal = $favouriteChannal;
    $this->place = $place;
    $this->shelfLife = $shelfLife;
  } 
  
  public function changeMe() 
  { 
    if (date('Y') - $this->modelOfYear > $this->shelfLife)
    {
      echo "Пора обновить устройство $this->model";
    }
  }
  public function getPlace()
  {
    return $this->place;
  }

  public function show($favouriteChannal) 
  { 
    echo "Показываю ваш любимый канал - " . $this->favouriteChannal = $favouriteChannal . "!!!";
  }
  
  public function getFavouriteChannal() 
  { 
    return $this->favouriteChannal; 
  } 
}   

//Тестирование класса TV
echo "<pre>";
$myTV1 = new MyTV('LG 1890', 1995, 190, 'RenTV','Кухня', 10);

echo $myTV1->changeMe() . "</br>";

echo $myTV1->getPlace() . ":  " ;
echo $myTV1->show($myTV1 ->getFavouriteChannal()) . "</br>";

$myTV2 = new MyTV('TOSHBA 13C', 2017, 20, 'Russia1', 'Зал', 3);

echo $myTV2->getPlace() . ":  ";
echo $myTV2->show($myTV2 ->getFavouriteChannal()) . "</br>";
echo "</pre>";

class Stationery //канцлярские принадлежности: ручки, цветные карандаши
{
  protected $color;

  public function __construct($color) 
  { 
    $this->color = $color; 
  }
  public function changeColor($newColor)
  {
    return $this->color =  $newColor;
  } 
}

interface Act
{
  public function act(); 
}

class MyPen extends Stationery implements Act //мои ручки умеют писать разным цветом
{   
  public function act() 
  { 
    echo "Я ручка и пишу цветом " . $this->color; 
  } 
} 

class MyPencil extends Stationery implements Act //мои карандаши умеют рисовать разным цветом
{   
  public function act() 
  { 
    echo "Я карандаш и рисую цветом " . $this->color; 
  } 
} 


//Тестирование класса MyPen
echo "<pre>";
$myPen = new MyPen('red');
echo $myPen->act() . "</br>";

$myPensil = new MyPencil('green');
echo $myPensil->act() . "</br>";
$myPensil->changeColor('black');
echo $myPensil->act() . "</br>";
echo "</pre>";

interface Fly
{
  public function fly(); //птицы летают по-разному или не летают совсем
}

interface Swim
{
 public function swim(); //плавают не все птицы
}

interface WinterPlace
{
  public function getWinterPlace(); //не все птицы перелетные
}


class MyDuck implements Fly, Swim, WinterPlace //мои утки умеют летать, плавать, улетают на зимовку
{   
  protected $winterPlace;
  protected $name;

  public function __construct($name, $winterPlace) 
  { 
    $this->name = $name; 
    $this->winterPlace = $winterPlace; 
  } 
  
  public function getName() 
  { 
    return $this->name; 
  }
  
  public function fly() 
  { 
    echo  " Я умею летать!! "; 
  } 
   
  public function swim() 
  { 
    echo  " Я умею плавать!! "; 
  }
  public function getWinterPlace() 
  {
    echo "Зимую на континенте $this->winterPlace";
  }  
}  

//Тестирование класса MyDuck
echo "<pre>";
$myDuck1 = new MyDuck('Билли', 'Америка'); 
echo "Меня зовут " . $myDuck1->getName() . "!";
echo $myDuck1->fly() . "</br>";

$myDuck2 = new MyDuck('Серая Шейка', 'Евразия');
echo "Меня зовут " . $myDuck2->getName() . "!";
echo $myDuck2->swim() . " " . $myDuck2->getWinterPlace();
echo "</pre>";

interface getDiscountPrice
{
  public function getDiscountPrice(); //скидка рассчитывается по-разному для разных 
}


class Product implements getDiscountPrice
{   
  protected $title; 
  protected $price;
  protected $discount;

  public function getTitle()
  {
    echo $this->title . ": </br>";
  }
     
  public function getDiscountPrice() 
  {
    if ($this->discount)
    {
      echo $this->price - round($this->price * $this->discount / 100); 
    } else {
      echo $this->price;
    }
  }
}

class Tech extends Product
{
  protected $model; 
  public $modelOfYear;

  public function __construct($title, $price, $discount, $model, $modelOfYear) 
  { 
    $this->title = $title; 
    $this->price = $price;
    $this->discount = $discount;
    $this->model = $model; 
    $this->modelOfYear = $modelOfYear;
  }

 public function getDiscountPrice() 
 { 
  if (date('Y') - $this->modelOfYear > 3) //скидка удваивается для tv старше 3 лет
  {
    echo  $this->price - round($this->price * $this->discount * 2 / 100);
  } else {
    return parent::getDiscountPrice();
  } 
 }
}

//продукт
$myProduct = new Product();
$myTech1 = new Tech('Телевизор нового поколения', 30000, 5, 'LG', 2012);
echo "<pre>";
$myTech1->getTitle();
$myTech1->getDiscountPrice();
echo "</br>";

$myTech2 = new Tech('Стиральная машина', 12600, 0, 'LG', 2017);
$myTech2->getTitle();
$myTech2->getDiscountPrice(); 
echo "</br>";
echo "</pre>";
?>
