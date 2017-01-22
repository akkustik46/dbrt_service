<?php

include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('dbrt_garage');
mysql_query("SET NAMES 'utf8'");
$ai=mysql_query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name =  'mnf'");
$ai=mysql_fetch_array($ai);
$mnf=mysql_query("SELECT id FROM mnf WHERE mnf_name='".$_POST['mnf']."'");
$mnf=mysql_fetch_array($mnf);
if (!isset($mnf['id'])) {$mnf['id']=$ai['AUTO_INCREMENT'];
			$result=mysql_query("INSERT INTO models (models.model, models.capacity, models.mnf_id, models.year_begin, models.year_end, models.comment,
			models.valve_in, models.valve_ex, models.fork_oil_cap, models.fork_oil_level, models.cylinders, 
			models.valves_per_cyl) 
			VALUES ('".$_POST['model']."', '".$_POST['eng']."', '".$ai['AUTO_INCREMENT']."','".$_POST['year_begin']."',
			'".$_POST['year_end']."', '".$_POST['comment']."', '".$_POST['valve_in']."', '".$_POST['valve_ex']."',
			'".$_POST['fork_cap']."', '".$_POST['fork_lev']."', '".$_POST['cyl']."', '".$_POST['valve']."')");
			mysql_query("INSERT INTO mnf (mnf.mnf_name) VALUES ('".$_POST['mnf']."')");
			    } else {
			$result=mysql_query("INSERT INTO models (models.model, models.capacity, models.mnf_id, models.year_begin, models.year_end, models.comment,
			models.valve_in, models.valve_ex, models.fork_oil_cap, models.fork_oil_level, models.cylinders,.
			models.valves_per_cyl)
			VALUES ('".$_POST['model']."', '".$_POST['eng']."', '".$mnf['id']."','".$_POST['year_begin']."',
			'".$_POST['year_end']."', '".$_POST['comment']."', '".$_POST['valve_in']."', '".$_POST['valve_ex']."',
			'".$_POST['fork_cap']."', '".$_POST['fork_lev']."', '".$_POST['cyl']."', '".$_POST['valve']."')") || die(mysql_error());
			}
/////echo($ai['AUTO_INCREMENT'].' '. $mnf['id']);
//mysql_query("INSERT INTO users (users.first_name, users.last_name, users.father_name, users.login, users.passwd, users.departament_id, users.building_id, users.tel, users.email) VALUES ('". $_POST['first_name'] ."', '". $_POST['last_name'] ."', '". $_POST['father_name'] ."', '". $_POST['login'] ."', '". $pwd ."', '". $_POST['depart'] ."', '". $_POST['building'] ."', '". $_POST['tel'] ."', '".$_POST['email'] ."')");
//mysql_query("INSERT INTO users (users.last_name, users.first_name, users.father_name, users.local_login, users.local_pwd, users.email, users.email_pwd, users.tel_mts, users.tel_travel, users.ws_id, users.dep_id, users.position, users.loc_id, users.lido_login, users.lido_pwd) VALUES 
//				('".$_POST['last_name']."', '".$_POST['first_name']."', '".$_POST['father_name']."', '".$_POST['login']."', '".$_POST['passwd']."', '".$_POST['mail_login']."', '".$_POST['mail_passwd']."', '".$_POST['phone_mts']."', '".$_POST['phone_travel']."', '".$_POST['ws_id']."', '".$_POST['depart']."', '".$_POST['position']."', '".$_POST['loc_id']."', '".$_POST['lido_log']."', '".$_POST['lido_pass']."')");
//mysql_query("INSERT INTO clients 
//		(clients.username, clients.tel1, clients.tel2, clients.comment, clients.reg_date, clients.work_discount, clients.shop_discount)
//		 VALUES ('".$_POST['name']."', '".$_POST['tel1']."', '".$_POST['tel2']."', '".$_POST['comment']."', now(),
//		'".$_POST['work_disc']."', '".$_POST['shop_disc']."')");


//echo(mysql_error($result));
echo "Добавлен!";
mysql_close();
include('../footer.php');

?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
