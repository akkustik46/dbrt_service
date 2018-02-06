<?php

include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");
//print_r($_POST);
mysqli_query($db,"INSERT INTO payments (task,sum,date_payment,status) values ('".$_POST['id']."','".$_POST['sum']."',now(),'1')");
//print_r ($query);
echo "Добавлен!";
mysqli_close($db);
include('../footer.php');

?>
<script>
var tm=5000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>

