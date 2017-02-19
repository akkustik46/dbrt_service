<?php

include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('dbrt_garage');
mysql_query("SET NAMES 'utf8'");
print_r($_POST);
mysql_query("INSERT INTO payments (task,sum,date_payment,status) values ('".$_POST['id']."','".$_POST['sum']."',now(),'1')");
//print_r ($query);
echo "Добавлен!";
mysql_close();
include('../footer.php');

?>
<script>
var tm=5000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
