<?php
session_start();
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('dbrt_garage');
mysql_query("SET NAMES 'utf8'");
//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
//$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380'or phones.num RLIKE '---') order by phones.num");
//$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");

?>
<form action="issue-proc.php" method="post">
Новая извесная проблема<br>
<table border=0>
<tr><td>Марка</td><td><input type="text" name="mnf" size="30" value=""></td></tr>
<tr><td>Модель</td><td><input type="text" name="model" size="10" value=""></td></tr>
<tr><td>Объем двигателя</td><td><input type="text" name="eng" size="10" value=""></td></tr>
<tr><td colspan="2">Коментарий:</td></tr>
<tr><td colspan="2"><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>
