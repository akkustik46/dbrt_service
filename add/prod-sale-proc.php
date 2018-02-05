<?php

include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");
//print_r($_POST);
$nam='';
$val='';
function generatePassword($length = 5){
  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTYvWXYZ1234567890';
  $numChars = strlen($chars);
  $string = 'SAL';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}

$task=generatePassword(5);
$task_query=mysqli_query($db,"SELECT count(id) as count from prod_sale where task='".$task."' group by task");
$task_check=(mysqli_fetch_array($task_query));
a:
if ($task_check['count']<>0) {$task=generatePassword(5); goto a;} else {echo "OK";}
$q="INSERT INTO ".$_POST['tbl']." (";
///unset($_POST['tbl']);
foreach ($_POST['prod'] as $key=>$value) {
	$q="INSERT INTO ".$_POST['tbl']." (";
	$val="'".$task."','".$value."','".$_POST['qty'][$key]."',now()";
	$q.="task,prod,qty,date_sale) VALUES (".$val.")";
//	echo $q."<br>";
mysqli_query($db,$q);
mysqli_query($db,"UPDATE prod_prod set qty=qty-".$_POST['qty'][$key]." where id='".$value."'");
	    }


//print_r ($query);
echo "Добавлен!";
mysqli_close($db);
include('../footer.php');

?>

<script>
var tm=3000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
