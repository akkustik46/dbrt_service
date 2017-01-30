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
<tr><td>Марка</td><td>
<select name=make size=1>
<?php 
$mnf_query=mysql_query("SELECT * FROM mnf ORDER BY mnf_name asc");
    while ($mnf=mysql_fetch_array($mnf_query, MYSQL_ASSOC)) {
		echo "<option value=".$mnf['id'].">".$mnf['mnf_name']."</option>";
	}
?>
</select>
</td></tr>
<tr><td>Модель</td><td>
<select name=model size=1>
<?php
$model_query=mysql_query("SELECT id, model, capacity, year_begin, year_end FROM models ORDER BY model asc");
    while ($model=mysql_fetch_array($model_query, MYSQL_ASSOC)) {
		echo "<option value=".$model['id'].">".$model['model']." ".$model['capacity']." ".$model['year_begin']."-".$model['year_end']."</option>";
	}
?>
</select>

<tr><td colspan="2">Симптомы:</td></tr>
<tr><td colspan="2"><textarea name="symptoms" cols="50" rows="5"></textarea></td></tr>
<tr><td colspan="2">Проблема и решение:</td></tr>
<tr><td colspan="2"><textarea name="issue" cols="50" rows="5"></textarea></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>
