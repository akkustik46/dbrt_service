<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");

?>
<form action="bike-proc.php" method="post">
Добавить мотоцикл<br>
<table border=0>
<tr><td>Марка</td><td>
<?php $mnf_lst_query=mysqli_query($db,"SELECT * FROM mnf ORDER BY mnf.mnf_name");
?>
<select name="mnf" size=1>
<?php
while ($mnf_lst = mysqli_fetch_array($mnf_lst_query)) {
      $mnf_lst_array[] = array('id' => $mnf_lst['id'],
                                 'mnf_name' => $mnf_lst['mnf_name']);

?>
<option value="<?php echo ($mnf_lst['id']); ?>"> <?php echo ($mnf_lst['mnf_name']); ?> </option>
<?php
}
?>
</select></td></tr>

<tr><td>Модель</td><td>
<?php $model_lst_query=mysqli_query($db,"SELECT * FROM models ORDER BY models.model");
?>
<select name="model" size=1>
<?php
while ($model_lst = mysqli_fetch_array($model_lst_query)) {
      $model_lst_array[] = array('id' => $model_lst['id'],
                                 'model' => $model_lst['model'],
				 'capacity' => $model_lst['capacity'],
				 'modification' => $model_lst['modification'],
				 'year_begin' => $model_lst['year_begin'],
				 'year_end' => $model_lst['year_end']);

?>
<option value="<?php echo ($model_lst['id']); ?>"> <?php echo ($model_lst['model'].$model_lst['capacity'].$model_lst['modification'].' '.$model_lst['year_begin'].'-'.$model_lst['year_end']); ?> </option>
<?php
}
?>
</select></td></tr>
<tr><td>Владелец</td><td>
<?php $owner_lst_query=mysqli_query($db,"SELECT * FROM clients ORDER BY clients.username");
?>
<select name="owner" size=1>
<?php
while ($owner_lst = mysqli_fetch_array($owner_lst_query)) {
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
