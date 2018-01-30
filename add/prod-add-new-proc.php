<?php

include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'dbrt_service');
mysqli_query($db,"SET NAMES 'utf8'");
//print_r($_POST);
$nam='';
$val='';
$q="INSERT INTO ".$_POST['tbl']." (";
unset($_POST['tbl']);
foreach ($_POST as $key=>$value) {
	echo $key."=>".$value."<br>";
	$nam.=$key.",";
	if ($value=='now()') {$val.=$value.",";
	} else {
	$val.="'".$value."',";
		}
	    }
$nam=substr($nam,0,-1);
$val=substr($val,0,-1);
$q.=$nam.") VALUES (".$val.")";
echo $q;
mysqli_query($db,$q);
echo "Добавлен!";
mysqli_close($db);
include('../footer.php');

?>
<script>
var tm=3000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>