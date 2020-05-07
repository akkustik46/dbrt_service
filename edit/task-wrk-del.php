<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");

$wrk_del=mysqli_query($db,"DELETE FROM works WHERE id='".$_GET['id']."'")
?>

<script>
var tm=1
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>