<?php
session_start();
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('sbeval');
mysql_query("SET NAMES 'utf8'");
$pos_lst_query=mysql_query("SELECT * FROM positions ORDER BY positions.name");
//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
//$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380'or phones.num RLIKE '---') order by phones.num");
//$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");

?>
<form action="user-proc.php" method="post">
Add New User<br>
<table border=0>
<tr><td>Login:</td><td><input type="text" name="login" size="30" value=""></td></tr>
<tr><td>Password:</td><td><input type="password" name="passwd" size="30" value=""></td></tr>
<tr><td>Position:</td>
<td>
<select name="position" size=1>
<?php
    while ($pos_lst = mysql_fetch_array($pos_lst_query)) {
	$pos_lst_array[] = array('id' => $pos_lst['id'],
                                 'name' => $pos_lst['name']);

?>
<option value="<?php echo ($pos_lst['id']); ?>"> <?php echo ($pos_lst['name']); ?> </option>
<?php }
?>
</select>
</td></tr>

<tr><td width=100%><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>
