<?php

include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'dbrt_garage');
mysqli_query($db,"SET NAMES 'utf8'");

mysqli_query($db,"INSERT INTO tasks (date_create, comment, client, bike, mileage, status) VALUES (now(),'".$_POST['comment']."','".$_POST['cl_id']."','".$_POST['bike_id']."','".$_POST['mileage']."','".$_POST['status']."')");
//print_r($result);
//echo mysql_error();
printf(mysqli_error($db));
$task_id=mysqli_insert_id($db);
foreach($_POST['work'] as $num=>$id) {
mysqli_query($db,"INSERT INTO works (type_id, task_id,status) VALUES (".$id.",".$task_id.",0)");

}
mysqli_query($db,"UPDATE bike SET mileage_last='".$_POST['mileage']."', mileage_lastchg=CURDATE() where id='".$_POST['bike_id']."'");
printf(mysqli_error($db));
echo "Добавлен!";
mysqli_close($db);
include('../footer.php');

?>
<?php /*
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
*/ ?>