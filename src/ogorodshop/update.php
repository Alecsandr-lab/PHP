<?php
include "config.php";

if(isset($_GET["id"])){
    $stmt=$pdo->prepare("SELECT * FROM  `ogororodshop` WHERE id=?");
    $stmt->execute([$_GET["id"]]);
    $sau=$stmt->fetchAll()[0];
   
}

if (isset($_POST['save']) && $_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt2=$pdo->prepare("UPDATE `ogororodshop` SET `kyltura`=?, `price`=? , `opisanie`=? WHERE id=?");
    $stmt2->execute([$_POST["kyltura"],$_POST["price"],$_POST["opisanie"],$_GET["id"]]);
} 


?>

<?php  if ($sau !=null): ?>

<form method="post">
    <input type="text" name="kyltura" value="<?php echo $sau["kyltura"] ?>">
    <input type="number" name="price" value="<?php echo $sau["price"] ?>">
    <input type="text" name="opisanie"  value="<?php echo $sau["opisanie"] ?>">
    <input type="submit" name="save">
</form>
<?php endif; ?>