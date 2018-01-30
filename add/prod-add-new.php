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

?>
<form action="prod-add-new-proc.php" method="post">
<input type="hidden" value="prod_prod" name="tbl">
Добавить товар<br>
<table border=0>
<tr><td>Категория</td><td>
<?php $cat_lst_query=mysqli_query($db,"SELECT * FROM prod_category ORDER BY prod_category.name");
?>
<select name="category" size=1>
<?php
while ($cat_lst = mysqli_fetch_array($cat_lst_query)) {
      $cat_lst_array[] = array('id' => $cat_lst['id'],
                                 'name' => $cat_lst['name']);

?>
<option value="<?php echo ($cat_lst['id']); ?>"> <?php echo ($cat_lst['name']); ?> </option>
<?php
}
?>
</select></td></tr>

<tr><td>Производитель</td><td>
<?php $man_lst_query=mysqli_query($db,"SELECT * FROM prod_mnf ORDER BY prod_mnf.name");
?>
<select name="manufacturer" size=1>
<?php
while ($man_lst = mysqli_fetch_array($man_lst_query)) {
      $man_lst_array[] = array('id' => $man_lst['id'],
                                 'name' => $man_lst['name']);

?>
<option value="<?php echo ($man_lst['id']); ?>"> <?php echo ($man_lst['name']); ?> </option>
<?php
}
?>
</select></td></tr>
<tr><td>Нименование</td><td>
<input type="text" name="name" size=25>
</td></tr>


<tr><td>Ед. изм</td><td><input type="text" name="units" size="4" value=""></td></tr>
<tr><td>Цена закупка</td><td><input type="text" name="price_in" size="7" value=""></td></tr>
<tr><td>Цена розница</td><td><input type="text" name="price_out" size="7" value=""></td></tr>
<tr><td>Валюта</td>
<td>
<?php $cur_query=mysqli_query($db,"SELECT * FROM currency"); ?>
<select name="currency" size=1>
<?php
while ($cur_lst=mysqli_fetch_array($cur_query)) {
    $cur_lst_array[] = array('id' => $cur_lst['id'],
                                 'name' => $cur_lst['name']);
?>
<option value="<?php echo ($cur_lst['id']); ?>"> <?php echo ($cur_lst['name']); ?> </option>
<?php
}
?>
</select></td></tr>

<tr><td colspan="2"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>