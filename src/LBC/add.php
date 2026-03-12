<?php
include "config.php";
$stmt=$pdo->prepare ("INSERT INTO `lbc`( `mail`, `message`) values (?,?)");
$stmt->execute([$_POST["mail"],$_POST["message"]]);
header("Location: /lbc/");




?> 