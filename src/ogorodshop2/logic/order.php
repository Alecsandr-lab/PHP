<?php
require_once "Database.php";
class Order
{

   private $costumer = [];
   private $items = [];
   public $pdo;
   public function __construct($costumer, $items, $pdo)

   {
      $this->costumer = $costumer;
      $this->items = $items;
      $this->pdo = $pdo;

   }

   private function add_order()
   {
      $stmt = $this->pdo->prepare("INSERT INTO `orders`( `name`, `phone`, `address`) VALUES (?,?,?)");
      $stmt->execute([$this->costumer["name"], $this->costumer["phone"], $this->costumer["address"]]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function response()
   {
      return json_encode(["success" => 1, "data" =>$this->add_order()]);
   }
}
$db = new Database();
$dbConnection = $db->getConnection();
$json = file_get_contents("php://input");
$data = json_decode($json, true);
//{"success":1,"data":{"customer":{"name":"shura","phone":"+7 999444000","address":"dsfsdfsdfds"},"items":[{"id":1,"name":"rose","image":"https:\/\/i.pinimg.com\/1200x\/12\/4a\/a0\/124aa0339b8ccfd0223517e5346dc782.jpg","description":"\u041a\u0440\u0430\u0441\u043d\u0430\u044f \u0440\u043e\u0437\u0430: \u0441\u0442\u0440\u0430\u0441\u0442\u044c \u0438 \u0438\u0434\u0435\u0430\u043b.","price":400}],"totalPrice":"400 \u20bd","date":"19.05.2026, 17:37:07"}}<br/>
//echo json_encode(["success" => 1, "data" => $data]);
$order= new Order ($data["customer"], $data["items"], $dbConnection);
echo $order->response();
