<?php
include "config.php";

if (isset($_GET['d'])){
    $stmt=$pdo->prepare ("DELETE FROM `ogororodshop` WHERE id=?");
    $stmt->execute([$_GET["d"]]);
}

header("Location: /ogorodshop/list.php");
?>