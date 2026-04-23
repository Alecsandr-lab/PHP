<?php 
require_once "Database.php";
class Search {
public $query;
public $db;
public function ___construct($query,$db) {
    $this->query=$query;
    $this->db=$db;
}

private function _search() {
     $stmt=$this->db->prepare("SELECT * FROM LIKE `products` WHERE `name` LIKE %?%");
    $stmt->execute([$this->qurey]);

    return $stmt->fetchAll();
}

public function response() {
    return json_encode($this-> _search());
}
}
$db= new Database();
$dbConnection= $db->getConnection();
$search = new Search($_POST["query"],$dbConnection);
 echo $search->response();

?>