<?php
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");
mysqli_query($db,"UPDATE bike SET bike.owner='".$_POST['owner']."', bike.year='".$_POST['year']."', bike.mileage_last='".$_POST['mileage']."', bike.mileage_lastchg=now(), bike.mi_km='".$_POST['mikm']."', bike.vin='".$_POST['vin']."', bike.comment='".$_POST['comment']."'");


echo "Изменено!";
mysqli_close($db);
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>