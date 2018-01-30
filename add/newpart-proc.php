<?php
session_start();
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
//$pwd=md5($_POST['passwd']);
mysql_select_db('sbeval');
mysql_query("SET NAMES 'utf8'");
$user_query=mysql_query("SELECT * FROM users WHERE users.name='".$_SESSION['login']."'");
$user=mysql_fetch_array($user_query);
//mysql_query("INSERT INTO users (users.first_name, users.last_name, users.father_name, users.login, users.passwd, users.departament_id, users.building_id, users.tel, users.email) VALUES ('". $_POST['first_name'] ."', '". $_POST['last_name'] ."', '". $_POST['father_name'] ."', '". $_POST['login'] ."', '". $pwd ."', '". $_POST['depart'] ."', '". $_POST['building'] ."', '". $_POST['tel'] ."', '".$_POST['email'] ."')");
//mysql_query("INSERT INTO users (users.last_name, users.first_name, users.father_name, users.local_login, users.local_pwd, users.email, users.email_pwd, users.tel_mts, users.tel_travel, users.ws_id, users.dep_id, users.position, users.loc_id, users.lido_login, users.lido_pwd) VALUES 
//				('".$_POST['last_name']."', '".$_POST['first_name']."', '".$_POST['father_name']."', '".$_POST['login']."', '".$_POST['passwd']."', '".$_POST['mail_login']."', '".$_POST['mail_passwd']."', '".$_POST['phone_mts']."', '".$_POST['phone_travel']."', '".$_POST['ws_id']."', '".$_POST['depart']."', '".$_POST['position']."', '".$_POST['loc_id']."', '".$_POST['lido_log']."', '".$_POST['lido_pass']."')");
//$sb_lst_query=mysql_query("SELECT * FROM sblist WHERE sblist.id='".$_GET['id']."'");
//$sb_lst=mysql_fetch_array($sb_lst_query);

if ($_POST['pn_to']=='') {$_POST['pn_to']=$_POST['pn_from'];}
if ($_POST['sn_to']=='') {$_POST['sn_to']=$_POST['sn_from'];}

mysql_query("INSERT INTO restricted_parts (restricted_parts.ata, restricted_parts.part_name, restricted_parts.pn_from, restricted_parts.pn_to, restricted_parts.sn_from, restricted_parts.sn_to, restricted_parts.related_ad, 
					    restricted_parts.comment, restricted_parts.aircraft) VALUES ('".$_POST['ata']."', '".$_POST['part_name']."', '".$_POST['pn_from']."', '".$_POST['pn_to']."', '".$_POST['sn_from']."', '".$_POST['sn_to']."',
					    '".$_POST['related_ad']."', '".$_POST['comment']."', '".$_POST['ac_type']."')");
//mysql_query("INSERT INTO sblist (sblist.sbno, sblist.title, sblist.atasys, sblist.vendor, sblist.rev, sblist.ad_note, sblist.release_date, sblist.affected, sblist.effectivity, sblist.acc_category, 
//				sblist.priority, sblist.prior_to, sblist.man_aff, sblist.man_aff_mm, sblist.man_aff_ipc, sblist.man_aff_wdm, sblist.man_aff_ovhm, sblist.man_aff_other, sblist.wt_change, sblist.mom_change, 
//				sblist.sb_mhr, sblist.actual_mhr, sblist.labor_rate, sblist.mhr_cost, sblist.req_kit_material_spares, sblist.kit_price, sblist.esg_eng, sblist.esg_lead_eng, sblist.mcg_lead_eng, sblist.esd_manager, 
//				sblist.eval_issued, sblist.eojo_no, sblist.rev_sb_before, sblist.last_chg, sblist.last_chg_act) VALUES 
//				('".$_POST['sbno']."', \"".$_POST['title']."\", '".$_POST['atasys']."', '".$_POST['vendor']."', '".$_POST['rev']."', \"".$_POST['adnote']."\", '".$_POST['rel_date']."', '".$_POST['affected']."', 
//				'".$_POST['effectivity']."', '".$_POST['acc_cat']."', '".$_POST['priority']."', '".$_POST['prior_to']."', '".$_POST['man_aff']."', '".$_POST['man_aff_mm']."', '".$_POST['man_aff_ipc']."', 
//				'".$_POST['man_aff_wdm']."', '".$_POST['man_aff_ovhm']."', '".$_POST['man_aff_other']."', '".$_POST['wt_change']."', '".$_POST['mom_change']."', '".$_POST['sb_mhr']."', '".$_POST['act_mhr']."', 
//				'".$_POST['labor_rate']."', '".$_POST['mhr_cost']."', \"".$_POST['kit_req']."\", '".$_POST['kit_price']."', \"".$esg_eng."\", \"".$esg_lead_eng."\", \"".$mcg_lead_eng."\", 
//				\"".$esd_manager."\", '".$_POST['eval_issued']."', '".$_POST['eojo_no']."', '".$_POST['rev_before']."', '".$user['id']."', 'added')");
//$usr_query=mysql_query("SELECT users.id FROM users");
//$view_query='';
//$sb_id=mysql_insert_id();
//while ($user_lst = mysql_fetch_array($usr_query)) {
//      $user_array[] = array('id' => $user_lst['id']);
//    if ($user['id']==$user_lst['id']) {$view='1';} else {$view='0';}
//    mysql_query("INSERT INTO viewed (viewed.sb_id, viewed.user_id, viewed.view) VALUES ('".$sb_id."', '".$user_lst['id']."', '".$view."')");
//}

//print_r ($_POST);
echo "ADDED!";
mysql_close();
include('../footer.php');

?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
