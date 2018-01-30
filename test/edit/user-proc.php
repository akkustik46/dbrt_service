<?php
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('helpdesk');
mysql_query("SET NAMES 'utf8'");
//mysql_query("UPDATE users SET users.last_name='" . $_POST['last_name'] . "', users.first_name='" . $_POST['first_name'] . "', users.father_name='" . $_POST['father_name'] . 
//	    "', users.login='" . $_POST['login'] . "', users.passwd='" . $pass . 
//	    "', users.departament_id='" . $_POST['depart'] . "', users.building_id='" . $_POST['building'] . "', users.tel='" . $_POST['tel'] . 
//	    "', users.email='" . $_POST['email'] . "'  WHERE users.id='" . $_POST['usr_id'] . "'");
mysql_query("UPDATE users SET users.last_name='".$_POST['last_name']."', users.first_name='".$_POST['first_name']."', users.father_name='".$_POST['father_name']."', 
		users.local_login='".$_POST['login']."', users.local_pwd='".$_POST['passwd']."', users.email='".$_POST['mail_login']."', users.email_pwd='".$_POST['mail_passwd']."',
		users.tel_mts='".$_POST['phone_mts']."', users.tel_travel='".$_POST['phone_travel']."', users.position='".$_POST['position']."', users.lido_login='".$_POST['lido_log']."',
		users.lido_pwd='".$_POST['lido_pass']."', users.dep_id='".$_POST['depart']."' WHERE users.id='".$_POST['id']."'");
if ($_POST['phone_mts']<>'33') { mysql_query("UPDATE phones SET phones.user_id='".$_POST['id']."' WHERE phones.id='".$_POST['phone_mts']."'"); }
if ($_POST['phone_travel']<>'33') { mysql_query("UPDATE phones SET phones.user_id='".$_POST['id']."' WHERE phones.id='".$_POST['phone_travel']."'"); }

print_r ($_POST);
echo "Изменено!";
mysql_close();
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
