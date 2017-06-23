<?php
namespace __NAMESPACE__;

use classes\Product;


class Tech extends Product implements GetInfoProduct
{ 
  use classes\GetInfoProduct;

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
    $info = "<strong>" . $this->title . "</strong> 
    <small><p> Модель: " . $this->model . "</p></small>";
    return $info;
  }

}