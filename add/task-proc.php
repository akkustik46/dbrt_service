<?php

include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('dbrt_garage');
mysql_query("SET NAMES 'utf8'");

print_r ($_POST);
//print_r($_POST["DynamicExtraField"][0]);
//echo "<br>";
$result=mysql_query("INSERT INTO tasks (date_create, comment, client, bike, mileage, status) VALUES (now(),'".$_POST['comment']."','".$_POST['cl_id']."','".$_POST['bike_id']."','".$_POST['mileage']."','".$_POST['status']."')");
print_r($result);
echo mysql_error();
$task_id=mysql_insert_id();
foreach($_POST['work'] as $num=>$id) {
mysql_query("INSERT INTO works (type_id, task_id,status) VALUES (".$id.",".$task_id.",0)");
}
mysql_query("UPDATE bike SET mileage_last='".$_POST['mileage']."', mileage_lastchg=CURDATE() where id='".$_POST['bike_id']."'");
echo "Добавлен!";
mysql_close();
include('../footer.php');

?>
<?php /*
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
*/
?>