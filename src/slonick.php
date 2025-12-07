<?php

// Настройки $host = 'db'; // Имя сервиса из docker-compose.yml
$dbname = 'myapp';
$username = 'root';
$password = 'rootpassword';
$port = 3306;

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $username, $password, $options);подключения



$stmt=$pdo->prepare ("SELECT * FROM `narrko shops`");
$stmt->execute();
$data=$stmt->fetchAll();
print_r($data);
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}


?>