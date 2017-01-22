<?php
session_start();
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('dbrt_garage');
mysql_query("SET NAMES 'utf8'");

?>
<form action="bike-proc.php" method="post">
Редактировать мотоцикл<br>
<table border=0>
<tr><td>Марка</td><td>
<?php $mnf_lst_query=mysql_query("SELECT mnf_name FROM mnf where id=(SELECT mnf_id from models where id=(SELECT model FROM bike WHERE id='".$_GET['id']."'))");
?>
<?php
$mnf_lst=mysql_fetch_array($mnf_lst_query);
echo $mnf_lst['mnf_name'];
?>
</td></tr>

<tr><td>Модель</td><td>
<?php $model_lst_query=mysql_query("SELECT model, capacity  FROM models WHERE id=(SELECT model FROM bike WHERE id='".$_GET['id']."')");
$model_lst=mysql_fetch_array($model_lst_query);
echo $model_lst['model'].$model_lst['capacity']
?>
</td></tr>
<tr><td>Владелец</td><td>
<?php $owner_lst_query=mysql_query("SELECT * FROM clients ORDER BY clients.username");
?>
<select name="owner" size=1>
<?php
while ($owner_lst = mysql_fetch_array($owner_lst_query)) {
      $owner_lst_array[] = array('id' => $owner_lst['id'],
                                 'username' => $owner_lst['username']);

?>
<option value="<?php echo ($owner_lst['id']); ?>"> <?php echo ($owner_lst['username']); ?></option>
<?php
}
?>
</select></td></tr>


<tr><td>Год выпуска</td><td><input type="text" name="year" size="5" value=""></td></tr>
<tr><td>Пробег</td><td><input type="text" name="mileage" size="7" value="">km<input type="radio" name="mikm" value="0">mi<input type="radio" name="mikm" value="1"></td></tr>
<tr><td>VIN</td><td><input type="text" name="vin" size="19" value=""></td></tr>
<tr><td colspan="2">Коментарий:</td></tr>
<tr><td colspan="2"><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>
