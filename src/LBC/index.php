<?php
include "config.php" ;
$stmt=$pdo->query ("SELECT * FROM `lbc`");
$data=$stmt->fetchAll();
?><table>
     <tr>
    <th>почта</th>
    <th>сообщение</th>
  </tr>
  <?php 
foreach ($data as $row) {
    ?>
  <tr>
    <td><?php echo $row["mail"] ?></td>
    <td><?php echo $row["message"] ?></td>
  </tr>

<?php
}
?></table>
<form method="post" action="/LBC/add.php">
    <input type="text" name="mail">
    <input type="text" name="message">
    <input type="submit">
</form>