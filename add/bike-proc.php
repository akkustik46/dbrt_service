<?php
session_start();
include('../top2.php');
require('../db_conn.php');
///$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
///mysqli_select_db($db,DB_SERVER_DATABASE);
///mysqli_query($db,"SET NAMES 'utf8'");

mysqli_query($db,"INSERT INTO bike (model, year, owner, mileage, mi_km, mileage_lastchg, status, vin, comment, created,mileage_last) 
	    VALUES ('".$_POST['model']."', '".$_POST['year']."', '".$_POST['owner']."', '".$_POST['mileage']."', '".$_POST['mikm']."',
	    now(), '5', '".$_POST['vin']."', '".$_POST['comment']."', now(), '".$_POST['mileage']."')");


echo "Добавлен!";
mysqli_close($db);
include('../footer.php');

?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>