<?php
require('config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'sbeval_test');
mysqli_query($db,"SET NAMES 'utf8'");
?>