<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'dbrt_service');
mysqli_query($db,"SET NAMES 'utf8'");
//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
//$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380'or phones.num RLIKE '---') order by phones.num");
//$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");

$prod=mysqli_query($db,"SELECT * from prod_prod where id='".$_GET['id']."'");
$prod=mysqli_fetch_array($prod);
echo "<b>".$prod['name']."</b>";
?>

<form action="prod-add-new-proc.php" method="post">
<input type="hidden" value="prod_buy" name="tbl">
<input type="hidden" value="now()" name="date_buy">
<input type="hidden" value="<?php echo $prod['id']; ?>" name="prod">
Добавить количество<br>
<table border=0>
<tr><td>Количество</td><td><input type="text" name="qty" size=5></td></tr>
<tr><td>Основание</td><td> <input type="text" name="comment" size=20></td></tr>

<tr><td colspan="2"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>