<?php
session_start();
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('dbrt_garage');
mysql_query("SET NAMES 'utf8'");
$pos_lst_query=mysql_query("SELECT * FROM positions ORDER BY positions.name");
//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
//$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380'or phones.num RLIKE '---') order by phones.num");
//$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");

?>
<form action="model-proc.php" method="post">
Новая модель<br>
<table border=0>
<tr><td>Марка</td><td><input type="text" name="mnf" size="30" value=""></td></tr>
<tr><td>Модель</td><td><input type="text" name="model" size="10" value=""></td></tr>
<tr><td>Объем двигателя</td><td><input type="text" name="eng" size="10" value=""></td></tr>
<tr><td>Годы выпуска</td><td><input type="text" name="year_begin" size="5" value="">-<input type="text" name="year_end" size="5" value=""></td></tr>
<tr><td>Цилиндров</td><td><input type="text" name="cyl" size="2" value="">Клапанов на цилиндр<input type="text" name="valve" size="2" value=""></td></tr>
<tr><td>Зазоры клапанов </td><td>IN:<input type="text" name="valve_in" size="5" value=""> EX:<input type="text" name="valve_ex" size="5" value=""></td></tr>
<tr><td>Объем масла в вилке</td><td><input type="text" name="fork_cap" size="5" value="">мл</td></tr>
<tr><td>Уровень масла в вилке</td><td><input type="text" name="fork_lev" size="5" value="">мм</td></tr>
<tr><td colspan="2">Коментарий:</td></tr>
<tr><td colspan="2"><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>