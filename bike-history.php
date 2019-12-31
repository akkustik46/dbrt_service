<?php
if (isset($_SESSION['login'])) {
header('Refresh: 1; location: index.php');
exit;
}
include('top3.php');
include('menu.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);

$tasks_query=mysqli_query($db,"SELECT * FROM tasks where bike=".$_GET['bike_id']);
$model_name=mysqli_query($db,"select (select mnf_name from mnf where id=(select mnf_id from models where id=(SELECT model FROM bike WHERE id='".$_GET['bike_id']."'))) as make, model, capacity from models where id=(SELECT modelFROM bike WHERE id='".$_GET['bike_id']."')");
$model=mysqli_fetch_array($model_name);
		    echo ("<div style=\"padding-top: 10px; margin-left: 200px; margin-top: 30px;font-size: x-large;\">".$model['make']." ".$model['model']." ".$model['capacity']."</div>"); 
$x=1;
while ($tasks_lst = mysqli_fetch_array($tasks_query)) {
      $tasks_array[] = array('id' => $tasks_lst['id'],
				'date' => $tasks_lst['date_create'],
				'comment' => $tasks_lst['comment'],
				'client' => $tasks_lst['client'],
				'bike' => $tasks_lst['mileage'],
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

}

?>