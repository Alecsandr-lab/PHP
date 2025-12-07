<?php

// Настройки $host = 'db'; // Имя сервиса из docker-compose.yml
$dbname = 'myapp';
$username = 'root';
$password = 'rootpassword';
$port = 3306;
$host = 'db';
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $username, $password, $options);
$stmt1=$pdo->prepare  ("insert into `cars_business` (name,price,brend) values (?,?,?)");
$stmt1->execute(["a4",1300000,"audi"]);

$stmt=$pdo->prepare ("SELECT*FROM `cars_business`");
$stmt->execute();
$data=$stmt->fetchAll();
var_dump($data);
$
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

$stmt2=$pdo->prepare("delete from `cars_business` where id=?");
$stmt2->execute([13]);

$stmt=$pdo->prepare("UPDATE `cars_business` SET name=?,price=? where id=?");
$stmt->execute(["a7",2500000,5]);