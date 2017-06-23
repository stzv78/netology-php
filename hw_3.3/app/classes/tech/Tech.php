<?php
namespace classes\tech;

use \classes\Product;
use \classes\GetInfoProduct;

class Tech extends Product implements GetInfoProduct
{ 
  private $model; 
  private $weight;

  public function __construct($title, $price, $model) 
  { 
    $this->title = $title;
    $this->price = $price;
    $this->model = $model; 
      
  }

  public function getInfoProduct()
  { 
    $info = "<p>" . $this->title . "</br> 
    Модель: " . $this->model . "</p>";
    return $info;
  }

}