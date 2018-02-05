<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");

//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
//$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380'or phones.num RLIKE '---') order by phones.num");
//$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");

?>
<form action="client-proc.php" method="post">
Новый клиент<br>
<input type="hidden" name="balance" size="10" value="0">
<table border=0>
<tr><td>Имя:</td><td><input type="text" name="name" size="30" value=""></td></tr>
<tr><td>Тел1.:</td><td><input type="text" name="tel1" size="10" value=""></td></tr>
<tr><td>Тел2.:</td><td><input type="text" name="tel2" size="10" value=""></td></tr>
<tr><td>Скидка на работы:</td><td><input type="text" name="work_disc" size="3" value='0'>%</td></tr>
<tr><td>Скидка на товары:</td><td><input type="text" name="shop_disc" size="3" value='0'>%</td></tr>

<tr><td colspan="2">Коментарий:</td></tr>
<tr><td colspan="2"><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>
