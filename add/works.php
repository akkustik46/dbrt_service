<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'dbrt_garage');
mysqli_query($db,"SET NAMES 'utf8'");
$w_gr=mysqli_query($db,"SELECT * FROM works_groups");
//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
//$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380'or phones.num RLIKE '---') order by phones.num");
//$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");

?>
<form action="work-proc.php" method="post">
Добавить работы<br>
<table border=0>
<tr><td>Группа:</td>
<td>
<select name="w_gr" size=1>
<?php
    while ($w_gr_lst = mysqli_fetch_array($w_gr)) {
	$w_gr_lst_array[] = array('id' => $w_gr_lst['id'],
                                 'name' => $w_gr_lst['name']);

?>
<option value="<?php echo ($w_gr_lst['id']."\""); ?>> <?php echo ($w_gr_lst['name']); ?> </option>
<?php }
?>
</select>
</td></tr>
<tr><td>Наименование:</td>
<td><input type="text" name="work" size="30">
</tr>

<tr><td width=100%><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>
