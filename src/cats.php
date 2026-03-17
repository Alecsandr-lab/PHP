<?php

// 	1) Класс

// 	2) Объект

// 	3) Свойств

// 	4) Метод

	

class Dog {

  public $name;

  public $rost;

  public $ves;

  public $poroda;

  

  public function echoName() {

    return $this->name;

  }

  

  public function parametrsDog() {

    return [

      'Рост' => $this->rost,

      'Вес' => $this->ves,

      'Порода' => $this->poroda,

    ];

  }

}

$dog1 = new Dog();

$dog1->name = "Шарик";

$dog1->ves = 30;

echo $dog1->echoName();

var_dump($dog1->parametrsDog());

$dog2 = new Dog();

$dog2->name = "Бобик";

echo $dog2->echoName();



class Cat {
    public $name ;

    public $ves;

    public $poroda;

    public $pol;

  public function echoName() {
    return $this->name;
  }

    public function parametrsCats() {
        return [
        "пол"=> $this->pol,

        "Вес"=> $this->ves,

        "порода"=>$this->poroda,
        ];
    }
}

$cat = new Cat();

$cat->name = "персик";

echo $cat->echoName();
?>