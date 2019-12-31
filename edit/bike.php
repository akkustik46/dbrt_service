<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
$mysqli = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_SERVER_DATABASE);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");

?>
<form action="bike-proc.php" method="post">
Редактировать мотоцикл<br>
<input type="hidden" name="id" value="<?php echo($_GET['id']); ?>">
<table border=0>
<tr><td>Марка</td><td>
<?php $mnf_lst_query=mysqli_query($db,"SELECT mnf_name FROM mnf where id=(SELECT mnf_id from models where id=(SELECT model FROM bike WHERE id='".$_GET['id']."'))");
?>
<?php
$mnf_lst=mysqli_fetch_array($mnf_lst_query);
echo $mnf_lst['mnf_name'];
?>
</td></tr>

<tr><td>Модель</td><td>
<?php $model_lst_query=mysqli_query($db,"SELECT model, capacity  FROM models  WHERE id=(SELECT model FROM bike WHERE id='".$_GET['id']."')");
$model_lst=mysqli_fetch_array($model_lst_query);
echo $model_lst['model'].$model_lst['capacity'];
?>
</td></tr>
<tr><td>Владелец</td><td>
<?php $owner_lst_query=mysqli_query($db,"SELECT * FROM clients ORDER BY clients.username");
?>
<select name="owner" size=1>
<?php
$bike_q=$mysqli->query("SELECT owner,year,mileage_last,mi_km,vin,license_plate,comment from bike WHERE id='".$_GET['id']."'");
$bike=$bike_q->fetch_array(MYSQLI_ASSOC);
while ($owner_lst = mysqli_fetch_array($owner_lst_query)) {
      $owner_lst_array[] = array('id' => $owner_lst['id'],
                                 'username' => $owner_lst['username']);

?>
<option <?php echo ("value=".$owner_lst['id']); if ($owner_lst['id']==$bike['owner']) {echo ' selected'; } ?>> <?php echo ($owner_lst['username']); ?></option>
<?php
}
?>
</select></td></tr>


<tr><td>Год выпуска</td><td><input type="text" name="year" size="5" value="<?php echo $bike['year']; ?>"></td></tr>
<tr><td>Пробег</td><td><input type="text" name="mileage" size="7" value="<?php echo $bike['mileage_last']; ?>">
<?php
if ($bike['mi_km']==0) {
			echo "km<input type=\"radio\" name=\"mikm\" value=\"0\" checked>mi<input type=\"radio\" name=\"mikm\" value=\"1\">";
		    } else {
		    echo "km<input type=\"radio\" name=\"mikm\" value=\"0\">mi<input type=\"radio\" name=\"mikm\" value=\"1\" checked>";
		    }
?>
</td></tr>
<tr><td>VIN</td><td><input type="text" name="vin" size="19" value="<?php echo $bike['vin']; ?>"></td></tr>
<tr><td>ДНЗ</td><td><input type="text" name="license_plate" size="8" value="<?php echo $bike['license_plate']; ?>"></td></tr>
<tr><td colspan="2">Коментарий:</td></tr>
<tr><td colspan="2"><textarea name="comment" cols="50" rows="5"><?php echo $bike['comment']; ?></textarea></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Сохранить"></center></td></tr>
</table>
</form>
<?php

print_r($bike);

include('../footer.php');
?>
