<?php

include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
$pwd=md5($_POST['passwd']);
mysql_select_db('sbeval');
mysql_query("SET NAMES 'utf8'");
//mysql_query("INSERT INTO users (users.first_name, users.last_name, users.father_name, users.login, users.passwd, users.departament_id, users.building_id, users.tel, users.email) VALUES ('". $_POST['first_name'] ."', '". $_POST['last_name'] ."', '". $_POST['father_name'] ."', '". $_POST['login'] ."', '". $pwd ."', '". $_POST['depart'] ."', '". $_POST['building'] ."', '". $_POST['tel'] ."', '".$_POST['email'] ."')");
//mysql_query("INSERT INTO users (users.last_name, users.first_name, users.father_name, users.local_login, users.local_pwd, users.email, users.email_pwd, users.tel_mts, users.tel_travel, users.ws_id, users.dep_id, users.position, users.loc_id, users.lido_login, users.lido_pwd) VALUES 
//				('".$_POST['last_name']."', '".$_POST['first_name']."', '".$_POST['father_name']."', '".$_POST['login']."', '".$_POST['passwd']."', '".$_POST['mail_login']."', '".$_POST['mail_passwd']."', '".$_POST['phone_mts']."', '".$_POST['phone_travel']."', '".$_POST['ws_id']."', '".$_POST['depart']."', '".$_POST['position']."', '".$_POST['loc_id']."', '".$_POST['lido_log']."', '".$_POST['lido_pass']."')");
mysql_query("INSERT INTO users (users.name, users.passwd, users.position) VALUES ('".$_POST['login']."', '".$pwd."', '".$_POST['position']."')");

//print_r ($_POST);
echo "Добавлен!";
mysql_close();
include('../footer.php');
?>

<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
