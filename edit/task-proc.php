<?php
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");
//mysql_query("UPDATE users SET users.last_name='" . $_POST['last_name'] . "', users.first_name='" . $_POST['first_name'] . "', users.father_name='" . $_POST['father_name'] .
//	    "', users.login='" . $_POST['login'] . "', users.passwd='" . $pass .
//	    "', users.departament_id='" . $_POST['depart'] . "', users.building_id='" . $_POST['building'] . "', users.tel='" . $_POST['tel'] .
//	    "', users.email='" . $_POST['email'] . "'  WHERE users.id='" . $_POST['usr_id'] . "'");
/*mysql_query("UPDATE users SET users.last_name='".$_POST['last_name']."', users.first_name='".$_POST['first_name']."', users.father_name='".$_POST['father_name']."',
		users.local_login='".$_POST['login']."', users.local_pwd='".$_POST['passwd']."', users.email='".$_POST['mail_login']."', users.email_pwd='".$_POST['mail_passwd']."',
		users.tel_mts='".$_POST['phone_mts']."', users.tel_travel='".$_POST['phone_travel']."', users.position='".$_POST['position']."', users.lido_login='".$_POST['lido_log']."',
		users.lido_pwd='".$_POST['lido_pass']."', users.dep_id='".$_POST['depart']."' WHERE users.id='".$_POST['id']."'");
if ($_POST['phone_mts']<>'33') { mysql_query("UPDATE phones SET phones.user_id='".$_POST['id']."' WHERE phones.id='".$_POST['phone_mts']."'"); }
if ($_POST['phone_travel']<>'33') { mysql_query("UPDATE phones SET phones.user_id='".$_POST['id']."' WHERE phones.id='".$_POST['phone_travel']."'"); }
*/
//print_r ($_POST);

//рабочее
mysqli_query($db,"UPDATE tasks SET tasks.status='".$_POST['status']."', tasks.date_change=now(), comment='".$_POST['comment']."' WHERE tasks.id='".$_POST['task_id']."'");
if ($_POST['status']=='3') {
		mysqli_query($db,"UPDATE tasks SET tasks.date_end=now() WHERE tasks.id='".$_POST['task_id']."'");
	}
$work_sum=0;
foreach ($_POST['price'] as $key=>$value) {
    if (isset($_POST['wrk'][$key])) {
			if ($_POST['wrk'][$key]=='on') {$wrk_stat=1;} else {$wrk_stat=0;}
			mysqli_query($db,"UPDATE works SET price='".$value."', status='".$wrk_stat."' where task_id='".$_POST['task_id']."' AND id='".$key."'");
			$work_sum=$work_sum+$value;
			    } else {
	mysqli_query($db,"UPDATE works SET price='".$value."', status='0' where task_id='".$_POST['task_id']."' AND id='".$key."'");
	$work_sum=$work_sum+$value;
	}
    }
if (isset($_POST['work'])) {
		foreach($_POST['work'] as $key=>$value){
				mysqli_query($db,"INSERT INTO works (type_id,task_id,price,status) VALUES ('".$value."','".$_POST['task_id']."','0','0')");
				$work_sum=$work_sum+$value;
			}
	}

$exist=mysqli_query($db,"SELECT COUNT(valvenum) as valvecount FROM valve_clearances where task_id='".$_POST['task_id']."' GROUP BY task_id");
$exist=mysqli_fetch_array($exist);
if (!isset($exist['valvecount'])) {
				foreach ($_POST['valve'] as $key=>$value) {
				mysqli_query($db,"INSERT INTO valve_clearances (task_id,valvenum,clearance,shim_before,shim_need,shim_installed) VALUES ('".$_POST['task_id']."', '".$key."', '".$value."','".$_POST['shim_before'][$key]."','".$_POST['shim_need'][$key]."','".$_POST['shim_installed'][$key]."')");
				}
	} else {
				foreach ($_POST['valve'] as $key=>$value) {
				mysqli_query($db,"UPDATE valve_clearances SET clearance='".$value."', shim_before='".$_POST['shim_before'][$key]."', shim_need='".$_POST['shim_need'][$key]."', shim_installed='".$_POST['shim_installed'][$key]."' WHERE task_id='".$_POST['task_id']."' AND valvenum='".$key."'");
				}
    }
//mysqli_query($db,"UPDATE tasks SET payment='".($_POST['wrk_sum']+$_POST['prod_sum'])."' where id='".$_POST['task_id']."'");
$prod_sum=0;
if (isset($_POST['prod'])) {
	foreach($_POST['prod'] as $key=>$value){
	$price=mysqli_query($db,"SELECT price_out, currency  from prod_prod where id='".$value."'");
	$price=mysqli_fetch_array($price);
	$cur=mysqli_query($db,"SELECT value from currency where id='".$price['currency']."'");
	$cur=mysqli_fetch_array($cur);
	mysqli_query($db,"INSERT INTO prod_sale (task,prod,qty,price,date_sale) VALUES (".$_POST['task_id'].",".$value.",".$_POST['qty'][$key].", ".round($price['price_out']*$cur['value'],-1).",now())");
	$prod_sum=$prod_sum+(round($price['price_out']*$cur['value'],-1));
	}
    }

mysqli_query($db,"UPDATE tasks SET payment='".($work_sum+$prod_sum+$_POST['prod_sum'])."' where id='".$_POST['task_id']."'");
echo "UPDATE works SET ";
echo "Изменено!";
mysqli_close($db);
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
