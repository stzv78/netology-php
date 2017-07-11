<?php

abstract class SuperProduct
{    
  protected $title; 
  protected $price;
  
  public function getPrice()
  {
    return $this->price;
  }

  public function getTitle()
  {
    return $this->$title;
  }

  abstract function getDiscountPrice();
  abstract function getDeliveryPrice();
  abstract function getTotalPrice();
}