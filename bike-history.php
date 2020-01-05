<?php
if (isset($_SESSION['login'])) {
header('Refresh: 1; location: index.php');
exit;
}
include('top3.php');
include('menu.php');
//$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);

$tasks_query=mysqli_query($db,"SELECT * FROM tasks where bike=".$_GET['bike_id']);
$action_query=mysqli_query($db,"SELECT * FROM bike_action where bike=".$_GET['bike_id']);
$model_name=mysqli_query($db,"select (select mnf_name from mnf where id=(select mnf_id from models where id=(SELECT model FROM bike WHERE id='".$_GET['bike_id']."'))) as make, model, capacity from models where id=(SELECT model FROM bike WHERE id='".$_GET['bike_id']."')");
$model=mysqli_fetch_array($model_name);
		    echo ("<br><p><div style=\"padding-top: 10px; margin-left: 100px; margin-top: 30px;font-size: x-large;\">".$model['make']." ".$model['model']." ".$model['capacity']."</div></p>");
$x=1;
?>
<table class="sortable" id='t'>
<col class='act'><col class='bike'><col class='client'><col class='client'><col class='season'>
<thead>
<tr><th axis="str">Пробіг&nbsp;</th><th>Тип&nbsp;</th><th>Попередній&nbsp;</th><th axis="str">Новий запис&nbsp;</th><th>Дата&nbsp;</th></tr>
</thead>
<tbody>
<?php
while ($tasks_lst = mysqli_fetch_array($tasks_query)) {
      $tasks_array[] = array('id' => $tasks_lst['id'],
				'date' => $tasks_lst['date_create'],
				'comment' => $tasks_lst['comment'],
				'client' => $tasks_lst['client'],
				'mileage' => $tasks_lst['mileage'],
				'status' => $tasks_lst['status'],
				'date_end' => $tasks_lst['date_end'],
				'date_change' => $tasks_lst['date_change']);

$tasks_lst['type']=1;
$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;
?>
<tr>
<td><?php echo $tasks_lst['mileage']; ?> </td>
<td><?php $type_query=mysqli_query($db, "SELECT name from bike_action_type WHERE id='".$tasks_lst['type']."'");
	    $type=mysqli_fetch_array($type_query);
	    echo $type['name'];
	 ?> </td>
<td></td>
<td></td>
<td><?php echo $tasks_lst['date_change']; ?> </td>
</tr>
<?php
//echo $tasks_lst['mileage']." ".$tasks_lst['type']." ".$tasks_lst['date_change']."<br>";

} ?>


<?php
while ($action_lst = mysqli_fetch_array($action_query)) {
	$action_array[] = array('old' => $action_lst['old'],
				'new' => $action_lst['new'],
				'type' => $action_lst['type'],
				'mileage' => $action_lst['mileage'],
				'date_change' => $action_lst['date_change']);

//echo $action_lst['mileage']." ".$action_lst['old']." ".$action_lst['new']." ".$action_lst['type']." ".$action_lst['date_change']."<br>";
?>
<tr>
<td><?php echo $action_lst['mileage']; ?> </td>
<td><?php echo $action_lst['type']; ?> </td>
<td><?php echo $action_lst['old']; ?></td>
<td><?php echo $action_lst['new']; ?></td>
<td><?php echo $action_lst['date_change']; ?> </td>
</tr>

<?php
}
?>