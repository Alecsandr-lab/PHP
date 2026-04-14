<?php

class Dog {

  public $name;

  public $age;

  public $poroda;

  

  public function __construct($name, $age, $poroda) {

    $this->name   = $name;

    $this->age    = $age;

    $this->poroda = $poroda;

  }

  

  public function echoData() {

    return "Name: $this->name, Age: $this->age, Poroda: $this->poroda";

  }

}

// $dog1 = new Dog();

// $dog1->name   = "Alibibek";

// $dog1->age    = 2;

// $dog1->poroda = "Экстерьер";

// echo $dog1->echoData();

$dog2 = new Dog("Aliba", 120, "Test");

echo $dog2->echoData();
?>