<?php

include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");

mysqli_query($db,"INSERT INTO works_types (name, group_id) VALUES ('".$_POST['work']."', '".$_POST['w_gr']."')");
//print_r ($_POST);
echo "Добавлен!";
mysqli_close($db);
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
