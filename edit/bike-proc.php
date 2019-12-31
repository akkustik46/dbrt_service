<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");
mysqli_query($db,"UPDATE bike SET bike.owner='".$_POST['owner']."', bike.year='".$_POST['year']."', bike.mileage_last='".$_POST['mileage']."', bike.mileage_lastchg=now(), bike.mi_km='".$_POST['mikm']."', bike.vin='".$_POST['vin']."', bike.license_plate='".$_POST['license_plate']."' where bike.id='".$_POST['id']."'");

$changes=array_diff($_POST,$_SESSION["bike"]);
foreach ($changes as $key => $value) {
	$act_id=mysqli_query($db,"SELECT id FROM bike_action_type WHERE parameter='".$key."'");
	$act_id=mysqli_fetch_array($act_id);
	mysqli_query($db,"INSERT INTO bike_action (bike, old, new, type, date_change) VALUES ('".$_POST['id']."', '".$_SESSION['bike'][$key]."', '".$_POST[$key]."', '".$act_id['id']."', now())");
    }

echo "Изменено!";
mysqli_close($db);
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
