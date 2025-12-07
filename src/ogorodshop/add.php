<?php
include "config.php";

if (isset($_POST['save']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt=$pdo->prepare ("INSERT INTO `ogororodshop`( `kyltura`, `price`, `opisanie`) values (?,?,?)");
    $stmt->execute([$_POST["kyltura"],$_POST["price"],$_POST["opisanie"]]);
}
?>


<form method="post">
    <input type="text" name="kyltura">
    <input type="number" name="price">
    <input type="text" name="opisanie">
    <input type="submit" name="save">
</form>