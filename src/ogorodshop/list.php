<?php
/*$data = [
    ['id' => 1, 'name' => 'rrose', 'price' => 500000],
    ['id' => 2, 'name' => 'kaktus', 'price' => 2500000],
    ['id' => 3, 'name' => 'olivki', 'price' => 700000],
];

echo '<table>';
echo '
    <tr>
        <th>ID</th>
        <th>name</th>
        <th>price</th>
    </tr>
';

foreach ($data as $row) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
    echo '<td>' . htmlspecialchars($row['price']) . '</td>';
    echo '</tr>';
}

echo '</table>';*/


include "config.php";

$ors=$pdo->query("SELECT * FROM `ogororodshop`");
?><table>
     <tr>
    <th>название</th>
    <th>цена</th>
    <th>описание</th>
  </tr>
  <?php 
  $data=$ors->fetchAll();
foreach ($data as $row) {
    ?>

  <tr>
    <td><?php echo $row["kyltura"] ?></td>
    <td><?php echo $row["price"] ?></td>
    <td><?php echo $row["opisanie"] ?></td>
    <td>
      <form action="delete.php">
        <input type="hidden" name="d" value="<?php echo $row["id"];?>">
        <input type="submit" value="delete">
      </form>
    </td>

    <td>
      <a href="update.php/?id=<?php echo $row ["id"] ?>">upadate</a>
    </td>
  </tr>

<?php
}
?></table>

<style>
table {
width: 50%;
heght:60%;
background:#F0E68C ;
position:absolute;
left:30px;
top:20px;
border-radius:2%;
transition: all .3s linear;
}

td{
border-right:2px solid grey;
padding:10px 60px 10px 40px ;

}

.bat{

  width: 100px;
  height: 40px;
  position:absolute;
  background:#F0E68C;
  top: 50%;
  left:2%;
  padding:5px 0;
 line-height:40px;
  text-align:center;
  border-radius:10%;
  text-decoration:none;
  transition: all .3s linear;
}
.bat:hover {
  color:#BDB76B;
  background-color:#FFE4B5;
}

table:hover {
  color:#BDB76B;
  background-color:#FFE4B5;
}

</style>
<body>
  <a href="add.php" class="bat">add repository</a>
  
</body>
