<?php
require_once "Database.php";
class Search
{
    public $query;
    public $pdo;
    public function __construct($query,$pdo)
    {
        $this->query = $query;
        $this->pdo = $pdo;

    }

    private function _search()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM  `products` WHERE `name` LIKE ? ");
        $stmt->execute(["%{$this->query}%"]);
        return $stmt->fetchAll();
    }

    public function response()
    {
        return json_encode(["success" => 1, "data"=> $this->_search()]);
    }
}
$db = new Database();
$dbConnection = $db->getConnection();
$search = new Search($_GET["search"], $dbConnection);
echo $search->response();
