<?php

include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'dbrt_garage');
mysqli_query($db,"SET NAMES 'utf8'");
$ai=mysqli_query($db,"SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name =  'mnf'");
$ai=mysqli_fetch_array($ai);
$mnf_cnt=mysqli_num_rows(mysqli_query($db,"SELECT id FROM mnf WHERE mnf_name='".$_POST['mnf']."'"));
echo $mnf_cnt;
if ($mnf_cnt==0) {
			//$mnf['id']=$ai['AUTO_INCREMENT'];
			$result=mysqli_query($db,"INSERT INTO models (models.model, models.capacity, models.mnf_id, models.year_begin, models.year_end, models.comment, models.cylinders, 
			models.valves_per_cyl, models.eng_type) 
			VALUES ('".$_POST['model']."', '".$_POST['eng']."', '".$ai['AUTO_INCREMENT']."','".$_POST['year_begin']."',
			'".$_POST['year_end']."', '".$_POST['comment']."', '".$_POST['cyl']."', '".$_POST['valve']."', '".$_POST['eng_type']."')");
			mysqli_query($db,"INSERT INTO tech_data (tech_data.model_id, tech_data.valve_in, tech_data.valve_ex, tech_data.fork_oil_cap, tech_data.fork_oil_level, tech_data.fork_oil_type) 
			VALUES (
			'".$_POST['valve_in']."', '".$_POST['valve_ex']."', '".$_POST['fork_cap']."', '".$_POST['fork_lev']."', '".$_POST['fork_oil_type']."')");
			mysqli_query($db,"INSERT INTO mnf (mnf.mnf_name) VALUES ('".$_POST['mnf']."')");
			    } else {
			$mnf=mysqli_query($db,"SELECT id FROM mnf WHERE mnf_name='".$_POST['mnf']."'");
			$mnf=mysqli_fetch_array($mnf);
			mysqli_query($db,"INSERT INTO models (models.model, models.capacity, models.mnf_id, models.year_begin, models.year_end, models.comment, models.cylinders,
			models.valves_per_cyl, models.eng_type)
			VALUES ('".$_POST['model']."', '".$_POST['eng']."', '".$mnf['id']."','".$_POST['year_begin']."',
			'".$_POST['year_end']."', '".$_POST['comment']."', '".$_POST['cyl']."', '".$_POST['valve']."', '".$_POST['eng_type']."')");
			$model_id=mysqli_insert_id($db);
			mysqli_query($db,"INSERT INTO tech_data (tech_data.model_id, tech_data.valve_in, tech_data.valve_ex, tech_data.fork_oil_cap, tech_data.fork_oil_level, tech_data.fork_oil_type)
			VALUES ('".$model_id."','".$_POST['valve_in']."', '".$_POST['valve_ex']."', '".$_POST['fork_cap']."', '".$_POST['fork_lev']."', '".$_POST['fork_oil_type']."')");
			printf(mysqli_error($db));
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
mysqli_close($db);
include('../footer.php');

?>
<?php /*
<script>
var tm=3000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
*/
?>