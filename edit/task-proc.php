<?php
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'dbrt_garage');
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
foreach ($_POST['price'] as $key=>$value) {
    if (isset($_POST['wrk'][$key])) {
			if ($_POST['wrk'][$key]=='on') {$wrk_stat=1;} else {$wrk_stat=0;}
			mysqli_query($db,"UPDATE works SET price='".$value."', status='".$wrk_stat."' where task_id='".$_POST['task_id']."' AND id='".$key."'");
			    } else {
	mysqli_query($db,"UPDATE works SET price='".$value."', status='0' where task_id='".$_POST['task_id']."' AND id='".$key."'");
	}
    }
if (isset($_POST['work'])) { 
		foreach($_POST['work'] as $key=>$value){
				mysqli_query($db,"INSERT INTO works (type_id,task_id,price,status) VALUES ('".$value."','".$_POST['task_id']."','0','0')");
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
mysqli_query($db,"UPDATE tasks SET payment='".($_POST['wrk_sum']+$_POST['prod_sum'])."' where id='".$_POST['task_id']."'");

if (isset($_POST['prod'])) {
	foreach($_POST['prod'] as $key=>$value){
	mysqli_query($db,"INSERT INTO prod_sale (task,prod,qty,date_sale) VALUES (".$_POST['task_id'].",".$value.",".$_POST['qty'][$key].",now())");
	}
    }

echo "UPDATE works SET ";
echo "Изменено!";
mysqli_close($db);
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
