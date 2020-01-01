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
while ($tasks_lst = mysqli_fetch_array($tasks_query)) {
      $tasks_array[] = array('id' => $tasks_lst['id'],
				'date' => $tasks_lst['date_create'],
				'comment' => $tasks_lst['comment'],
				'client' => $tasks_lst['client'],
				'mileage' => $tasks_lst['mileage'],
				'status' => $tasks_lst['status'],
				'date_end' => $tasks_lst['date_end'],
				'date_change' => $tasks_lst['date_change']);

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;
echo $tasks_lst['mileage']." ".$tasks_lst['date_change']."<br>";
}

while ($action_lst = mysqli_fetch_array($action_query)) {
	$action_array[] = array('old' => $action_lst['old'],
				'new' => $action_lst['new'],
				'type' => $action_lst['type'],
				'mileage' => $action_lst['mileage'],
				'date_change' => $action_lst['date_change']);

echo $action_lst['mileage']." ".$action_lst['old']." ".$action_lst['new']." ".$action_lst['type']." ".$action_lst['date_change']."<br>";
}
?>