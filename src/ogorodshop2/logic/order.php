<?php 
require_once "Database.php";
class Order {

private $costumer=[];
private $items=[] ;
 public $pdo;
 public function __construct($costumer,$items)
 
 {
    $this->costumer=$costumer;
    $this->items=$items;
 }

 private function add_order()
 {
     $stmt = $this->pdo->prepare("INSERT INTO `orders`(`id`, `name`, `phone`, `address`, `date`) VALUES (?,?,?)");
        $stmt->execute([$this->costumer["name"],$this->costumer["phone"],$this->costumer["address"]]);
        return true ;
        
 }

 public function response() 
 {
$this->add_order() ;

 }
}

echo json_encode(["success" => 1, "data"=> $_POST]);

?>