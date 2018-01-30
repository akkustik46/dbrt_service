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

<form action="task-proc.php" method="post">
<b>Новая задача</b><br><br>
<div class="tabsLink">
        <a href="#tab1">Вкладка 1</a>
        <a href="#tab2">Вкладка 2</a>
        </div>

<br>
        <a class="tabs" id="tab1"></a>
        <div class="tab">
<table border=1>
<tr><td>Клиент</td><td>
<?php $cl_lst_query=mysql_query("SELECT id as cl_id, username as cl_name FROM clients ORDER BY clients.username");
?>
<select name="cl_id" size=1 onchange="document.location=this.options[this.selectedIndex].value">
<?php
while ($cl_lst = mysql_fetch_array($cl_lst_query)) {
      $cl_lst_array[] = array('cl_id' => $cl_lst['cl_id'],
                                 'cl_name' => $cl_lst['cl_name']);

?>
<option value="task.php?cl_id=<?php echo ($cl_lst['cl_id']."#tab1"); ?>" <?php if ($cl_lst['cl_id']==$_GET['cl_id']) {echo 'selected="selected"';} ?>> <?php echo ($cl_lst['cl_name']); ?> </option>
<?php
}
?>
</select>

</td>
<td><a href='client.php' target='_blank' onClick="popupWin = window.open(this.href, 'Добавить клинета', 'location,width=800,height=600,top=70,left=150'); popupWin.focus(); return false;">+</a></td>
<td>Мотоцикл</td>
<td>
<?php if (!isset($_GET['cl_id'])) {
	$bike_lst_query=mysql_query("SELECT id as bike_id, model as mod_id FROM bike");
	} else {
	$bike_lst_query=mysql_query("SELECT id as bike_id, model as mod_id FROM bike WHERE bike.owner='".$_GET['cl_id']."'");
	}
?>
<select name="bike_id" size=1 onchange="document.location=this.options[this.selectedIndex].value">
<option value=''>---</option>
<?php
while ($bike_lst = mysql_fetch_array($bike_lst_query)) {
      $bike_lst_array[] = array('bike_id' => $bike_lst['bike_id'],
                                 'mod_id' => $bike_lst['mod_id']);


?>
<option value="task.php?cl_id=<?php echo ($_GET['cl_id']."&bike_id=".$bike_lst['bike_id']."#tab1"); ?>"> <?php echo ($bike_lst['bike_id']); ?> </option>
<?php
}
?>
</select>

</td>
</tr>

<tr><td>Пробег</td><td colspan="4"><input type="text" name="model" size="10" value=""></td></tr>
<tr><td colspan="5">Коментарий:</td></tr>
<tr><td colspan="5"><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
<tr><td colspan="5"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
</div>

<?php
include('../footer.php');
?>
