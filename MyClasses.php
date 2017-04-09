<?php

class MyCar 
{   
    private $name; 
    private $ownerName;
    private $speed;
    private $fine;

    public function __construct($name, $ownerName, $speed) 
    { 
      $this->name = $name; 
      $this->ownerName = $ownerName;
      $this->speed = $speed;
    } 
   
    public function countFine() 
    { 
      if ($this->speed > 90)
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

class MyTV 
{   
    private $model; 
    private $numberOfChannals;
    private $favouriteChannal;
    
    public function __construct($model, $numberOfChannals, $favouriteChannal) 
    { 
      $this->model = $model; 
      $this->numberOfChannals = $numberOfChannals;
      $this->favouriteChannal = $favouriteChannal;
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

class MyPen 
{   
    private $color; 
            
    public function __construct($color) 
    { 
      $this->color = $color; 
    } 
   
    public function write() 
    { 
      echo "Я ручка и пишу цветом " . $this->color; 
    } 
}  

class MyDuck 
{   
    private $name; 
           
    public function __construct($name) 
    { 
      $this->name = $name; 
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
}  

class Product 
{   
    private $name; 
    private $price;
    private $discount;
    
    
    public function __construct($name, $price, $discount) 
    { 
      $this->name = $name; 
      $this->price = $price;
      $this->discount = $discount;
    } 
   
    public function getDiscountPrice() 
    { if ($this->discount)
      {
       return $this->price - round($this->price * $this->discount / 100);
      }
    }
} 


//машина
$car1 = new MyCar('Lada', 'Иванов', 190);
if ($car1->countFine())
  {
    echo 'Г-н '. $car1->getOwnerName()  . '!!!' .  'Вам необходимо заплатить штраф в рамере ' . $car1->countFine() . ' рублей в течение 10 дней. ';
  } else {
    echo 'Г-н '. $car1->getOwnerName()  . '!!!' .  'Да Вы образцовый водитель!!';
  }

$car2 = new MyCar('KIA', 'Петров', 80);
echo $car2->countFine() . "</br>";

//TV
$myTV1 = new MyTV('LG 1890', 190, 'RenTV');
echo $myTV1->show($myTV1 ->getFavouriteChannal()) . "</br>";

$myTV2 = new MyTV('TOSHBA 13C', 7, 'Russia1');
echo $myTV2->show($myTV2 ->getFavouriteChannal()) . "</br>";

//ручка
$myPen1 = new MyPen('red');
echo $myPen1->write() . "</br>";

$myPen2 = new MyPen('green');
echo $myPen2->write() . "</br>";

//утка
$myDuck1 = new MyDuck('Билли');
echo "Меня зовут " . $myDuck1->getName() . "!";
echo $myDuck1->fly() . "</br>";

$myDuck2 = new MyDuck('Вилли');
echo "Меня зовут " . $myDuck2->getName() . "!";
echo $myDuck2->swim() . "</br>";


//продукт
$myProduct1 = new Product('Tide Automat', 120, 5);
echo $myProduct1->getDiscountPrice() . "</br>";
echo $myProduct1->getDiscountPrice() . "</br>";

$myProduct2 = new Product('Ariel Automat', 126, 3);
echo $myProduct2->getDiscountPrice() . "</br>";

?>
