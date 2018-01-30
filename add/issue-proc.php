<?php

include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('dbrt_garage');
mysql_query("SET NAMES 'utf8'");

mysql_query("INSERT INTO known_issues (model_id, symptoms, issue) VALUES ('".$_POST['model']."','".$_POST['symptoms']."','".$_POST['issue']."')");
echo "Добавлен!";
mysql_close();
include('../footer.php');

?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
