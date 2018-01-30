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
//print_r($_POST);
if (!isset($_SESSION['post']['priority'])) {$_SESSION['post']['priority']=0;}
if (!isset($_SESSION['post']['man_aff_mm'])) {$_SESSION['post']['man_aff_mm']=0;}
if (!isset($_SESSION['post']['man_aff_ipc'])) {$_SESSION['post']['man_aff_ipc']=0;}
if (!isset($_SESSION['post']['man_aff_wdm'])) {$_SESSION['post']['man_aff_wdm']=0;}
if (!isset($_SESSION['post']['man_aff_ovhm'])) {$_SESSION['post']['man_aff_ovhm']=0;}
if (!isset($_SESSION['post']['man_aff_other'])) {$_SESSION['post']['man_aff_other']=0;}
if (!isset($_SESSION['post']['acc_cat'])) {$_SESSION['post']['acc_cat']=0;}

if($_SESSION['post']['esg_eng']<>$sb_lst['esg_eng']) {$esg_eng=$_SESSION['login'].": ".$_SESSION['post']['esg_eng']; } else {$esg_eng=$_SESSION['post']['esg_eng'];}
if($_SESSION['post']['esg_lead_eng']<>$sb_lst['esg_lead_eng']) {$esg_lead_eng=$_SESSION['login'].": ".$_SESSION['post']['esg_lead_eng']; } else {$esg_lead_eng=$_SESSION['post']['esg_lead_eng'];}
if($_SESSION['post']['mcg_lead_eng']<>$sb_lst['mcg_lead_eng']) {$mcg_lead_eng=$_SESSION['login'].": ".$_SESSION['post']['mcg_lead_eng']; } else {$mcg_lead_eng=$_SESSION['post']['mcg_lead_eng'];}
if($_SESSION['post']['esg_dep_man']<>$sb_lst['esd_manager']) {$esd_manager=$_SESSION['login'].": ".$_SESSION['post']['esg_dep_man']; } else {$esd_manager=$_SESSION['post']['esg_dep_man'];}


mysql_query("INSERT INTO sblist (sblist.sbno, sblist.title, sblist.atasys, sblist.vendor, sblist.rev, sblist.ad_note, sblist.release_date, sblist.affected, sblist.effectivity, sblist.acc_category, 
				sblist.priority, sblist.prior_to, sblist.man_aff, sblist.man_aff_mm, sblist.man_aff_ipc, sblist.man_aff_wdm, sblist.man_aff_ovhm, sblist.man_aff_other, sblist.wt_change, sblist.mom_change, 
				sblist.sb_mhr, sblist.actual_mhr, sblist.labor_rate, sblist.mhr_cost, sblist.req_kit_material_spares, sblist.kit_price, sblist.esg_eng, sblist.esg_lead_eng, sblist.mcg_lead_eng, sblist.esd_manager, 
				sblist.eval_issued, sblist.eojo_no, sblist.rev_sb_before, sblist.last_chg, sblist.last_chg_act) VALUES 
				('".$_SESSION['post']['sbno']."', \"".$_SESSION['post']['title']."\", '".$_SESSION['post']['atasys']."', '".$_SESSION['post']['vendor']."', '".$_SESSION['post']['rev']."', 
				\"".$_SESSION['post']['adnote']."\", '".$_SESSION['post']['rel_date']."', '".$_SESSION['post']['affected']."', 
				'".$_SESSION['post']['effectivity']."', '".$_SESSION['post']['acc_cat']."', '".$_SESSION['post']['priority']."', '".$_SESSION['post']['prior_to']."', '".$_SESSION['post']['man_aff']."',
				 '".$_SESSION['post']['man_aff_mm']."', '".$_SESSION['post']['man_aff_ipc']."', 
				'".$_SESSION['post']['man_aff_wdm']."', '".$_SESSION['post']['man_aff_ovhm']."', '".$_SESSION['post']['man_aff_other']."', '".$_SESSION['post']['wt_change']."', '".$_SESSION['post']['mom_change']."',
				 '".$_SESSION['post']['sb_mhr']."', '".$_SESSION['post']['act_mhr']."', 
				'".$_SESSION['post']['labor_rate']."', '".$_SESSION['post']['mhr_cost']."', \"".$_SESSION['post']['kit_req']."\", '".$_SESSION['post']['kit_price']."', \"".$esg_eng."\",
				 \"".$esg_lead_eng."\", \"".$mcg_lead_eng."\", 
				\"".$esd_manager."\", '".$_SESSION['post']['eval_issued']."', '".$_SESSION['post']['eojo_no']."', '".$_SESSION['post']['rev_before']."', '".$user['id']."', 'added')");
mysql_query("INSERT INTO sblist_history (sblist_history.sbno, sblist_history.title, sblist_history.atasys, sblist_history.vendor, sblist_history.rev, sblist_history.ad_note, sblist_history.release_date, sblist_history.affected,
				 sblist_history.effectivity, sblist_history.acc_category, sblist_history.priority, sblist_history.prior_to, sblist_history.man_aff, sblist_history.man_aff_mm, sblist_history.man_aff_ipc, 
				sblist_history.man_aff_wdm, sblist_history.man_aff_ovhm, sblist_history.man_aff_other, sblist_history.wt_change, sblist_history.mom_change, sblist_history.sb_mhr, sblist_history.actual_mhr, 
				sblist_history.labor_rate, sblist_history.mhr_cost, sblist_history.req_kit_material_spares, sblist_history.kit_price, sblist_history.esg_eng, sblist_history.esg_lead_eng, 
				sblist_history.mcg_lead_eng, sblist_history.esd_manager, sblist_history.eval_issued, sblist_history.eojo_no, sblist_history.rev_sb_before, sblist_history.user, sblist_history.action) VALUES
				('".$_SESSION['post']['sbno']."', \"".$_SESSION['post']['title']."\", '".$_SESSION['post']['atasys']."', '".$_SESSION['post']['vendor']."', '".$_SESSION['post']['rev']."',
				 \"".$_SESSION['post']['adnote']."\", '".$_SESSION['post']['rel_date']."', '".$_SESSION['post']['affected']."',
				'".$_SESSION['post']['effectivity']."', '".$_SESSION['post']['acc_cat']."', '".$_SESSION['post']['priority']."', '".$_SESSION['post']['prior_to']."', '".$_SESSION['post']['man_aff']."',
				 '".$_SESSION['post']['man_aff_mm']."', '".$_SESSION['post']['man_aff_ipc']."',
				'".$_SESSION['post']['man_aff_wdm']."', '".$_SESSION['post']['man_aff_ovhm']."', '".$_SESSION['post']['man_aff_other']."', '".$_SESSION['post']['wt_change']."', '".$_SESSION['post']['mom_change']."',
				 '".$_SESSION['post']['sb_mhr']."', '".$_SESSION['post']['act_mhr']."',
				'".$_SESSION['post']['labor_rate']."', '".$_SESSION['post']['mhr_cost']."', \"".$_SESSION['post']['kit_req']."\", '".$_SESSION['post']['kit_price']."', \"".$esg_eng."\",
				 \"".$esg_lead_eng."\", \"".$mcg_lead_eng."\",
				\"".$esd_manager."\", '".$_SESSION['post']['eval_issued']."', '".$_SESSION['post']['eojo_no']."', '".$_SESSION['post']['rev_before']."', '".$_SESSION['post']['user']."', '".$_SESSION['post']['action']."')");
$usr_query=mysql_query("SELECT users.id FROM users");
$view_query='';
$sb_id=mysql_insert_id();
while ($user_lst = mysql_fetch_array($usr_query)) {
      $user_array[] = array('id' => $user_lst['id']);
    if ($user['id']==$user_lst['id']) {$view='1';} else {$view='0';}
    mysql_query("INSERT INTO viewed (viewed.sb_id, viewed.user_id, viewed.view) VALUES ('".$sb_id."', '".$user_lst['id']."', '".$view."')");
}

//print_r ($_SESSION['post']['sbno']);
echo "ADDED!";
mysql_close();
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
