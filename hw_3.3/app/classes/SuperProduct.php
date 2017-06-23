<?php
namespace classes;

abstract class SuperProduct
{    
  protected $title; 
  protected $price;
  
  public function getTitle()
  {
    return $this->title;
  }

  public function getPrice()
  {
    return $this->price;
  }

  abstract function getDiscountPrice();
  abstract function getDeliveryPrice();
  abstract function getTotalPrice();
}