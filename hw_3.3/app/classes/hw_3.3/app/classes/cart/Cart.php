<?php
namespace classes\cart;

class Cart
{ 
  
  public $products = array();

  
  public function addProduct($product) {
  $this->products[] = $product;
  }

  public function printProduct() {
    var_dump($this->products);
  }
}
