<?php
class Weels extends Product implements GetInfoProduct
{
  private $size; 
 
  public function __construct($title, $size, $price) 
  { 
    $this->title = $title;
    $this->price = $price;
    $this->size = $size;
  }

  public function getInfoProduct()
  { 
    $info = "<strong>" . $this->title . "</strong> 
    <small><p> Размер: " . $this->size . "</p></small>";
    return $info;
  }
}