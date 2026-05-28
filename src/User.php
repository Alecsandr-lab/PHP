<?php 
class User {
    private $age;
    private $name;


  public  function __construct($age,$name) {
    $this->age=$age;
    $this->name=$name;
    }

    public function  getInfo() {
        return "{$this->age}{$this->name}";
    }
}

$user = new User(25,"Oleg");
echo $user->getInfo();

$user2= new User(20,"Elena");
echo $user2->getinfo();
?>