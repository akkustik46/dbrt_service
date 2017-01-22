<?php

include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db(DB_SERVER_DATABASE);
mysql_query("SET NAMES 'utf8'");

mysql_query("INSERT INTO works_types (name, group_id) VALUES ('".$_POST['work']."', '".$_POST['w_gr']."')");
//print_r ($_POST);
echo "Добавлен!";
mysql_close();
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
