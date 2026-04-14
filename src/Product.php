<?php
class Product {
    public $title;
    public $price;
    private $quantity;

    public function __construct($title,$price,$quantity=0) {
        $this->title=$title;
        $this->price=$price;
         $this->quantity=$quantity;
    }

    public function getInfo(){
        return "{$this->title}{$this->price}{$this->quantity}";
    }
}
$product= new product("арбуз",45);
echo $product->getInfo()

?>