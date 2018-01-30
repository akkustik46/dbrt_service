<?php
session_start();
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
//$pwd=md5($_POST['passwd']);
mysql_select_db('sbeval');
mysql_query("SET NAMES 'utf8'");
//mysql_query("INSERT INTO users (users.first_name, users.last_name, users.father_name, users.login, users.passwd, users.departament_id, users.building_id, users.tel, users.email) VALUES ('". $_POST['first_name'] ."', '". $_POST['last_name'] ."', '". $_POST['father_name'] ."', '". $_POST['login'] ."', '". $pwd ."', '". $_POST['depart'] ."', '". $_POST['building'] ."', '". $_POST['tel'] ."', '".$_POST['email'] ."')");
//mysql_query("INSERT INTO users (users.last_name, users.first_name, users.father_name, users.local_login, users.local_pwd, users.email, users.email_pwd, users.tel_mts, users.tel_travel, users.ws_id, users.dep_id, users.position, users.loc_id, users.lido_login, users.lido_pwd) VALUES 
//				('".$_POST['last_name']."', '".$_POST['first_name']."', '".$_POST['father_name']."', '".$_POST['login']."', '".$_POST['passwd']."', '".$_POST['mail_login']."', '".$_POST['mail_passwd']."', '".$_POST['phone_mts']."', '".$_POST['phone_travel']."', '".$_POST['ws_id']."', '".$_POST['depart']."', '".$_POST['position']."', '".$_POST['loc_id']."', '".$_POST['lido_log']."', '".$_POST['lido_pass']."')");
if (!isset($_POST['priority'])) {$_POST['priority']=0;}
if (!isset($_POST['man_aff_mm'])) {$_POST['man_aff_mm']=0;}
if (!isset($_POST['man_aff_ipc'])) {$_POST['man_aff_ipc']=0;}
if (!isset($_POST['man_aff_wdm'])) {$_POST['man_aff_wdm']=0;}
if (!isset($_POST['man_aff_ovhm'])) {$_POST['man_aff_ovhm']=0;}
if (!isset($_POST['man_aff_other'])) {$_POST['man_aff_other']=0;}
if (!isset($_POST['acc_cat'])) {$_POST['acc_cat']='';}
$sb_lst_query=mysql_query("SELECT * FROM sblist WHERE sblist.id='".$_POST['id']."'");
$sb_lst=mysql_fetch_array($sb_lst_query);
$user_query=mysql_query("SELECT * FROM users WHERE users.name='".$_SESSION['login']."'");
$user=mysql_fetch_array($user_query);

if($_POST['esg_eng']<>$sb_lst['esg_eng']) {$esg_eng=$_SESSION['login'].": ".$_POST['esg_eng']; } else {$esg_eng=$_POST['esg_eng'];}
if($_POST['esg_lead_eng']<>$sb_lst['esg_lead_eng']) {$esg_lead_eng=$_SESSION['login'].": ".$_POST['esg_lead_eng']; } else {$esg_lead_eng=$_POST['esg_lead_eng'];}
if($_POST['mcg_lead_eng']<>$sb_lst['mcg_lead_eng']) {$mcg_lead_eng=$_SESSION['login'].": ".$_POST['mcg_lead_eng']; } else {$mcg_lead_eng=$_POST['mcg_lead_eng'];}
if($_POST['esg_dep_man']<>$sb_lst['esd_manager']) {$esd_manager=$_SESSION['login'].": ".$_POST['esg_dep_man']; } else {$esd_manager=$_POST['esg_dep_man'];}

mysql_query("INSERT INTO sblist_history (sblist_history.sbno, sblist_history.title, sblist_history.atasys, sblist_history.vendor, sblist_history.rev, sblist_history.ad_note, sblist_history.release_date, sblist_history.affected,
				 sblist_history.effectivity, sblist_history.acc_category, sblist_history.priority, sblist_history.prior_to, sblist_history.man_aff, sblist_history.man_aff_mm, sblist_history.man_aff_ipc,
				sblist_history.man_aff_wdm, sblist_history.man_aff_ovhm, sblist_history.man_aff_other, sblist_history.wt_change, sblist_history.mom_change, sblist_history.sb_mhr, sblist_history.actual_mhr,
				sblist_history.labor_rate, sblist_history.mhr_cost, sblist_history.req_kit_material_spares, sblist_history.kit_price, sblist_history.esg_eng, sblist_history.esg_lead_eng,
				sblist_history.mcg_lead_eng, sblist_history.esd_manager, sblist_history.eval_issued, sblist_history.eojo_no, sblist_history.rev_sb_before, sblist_history.user, sblist_history.action,
				sblist_history.last_chg, sblist_history.last_chg_act, sblist_history.last_chg_date) VALUES
				('".$sb_lst['sbno']."', \"".$sb_lst['title']."\", '".$sb_lst['atasys']."', '".$sb_lst['vendor']."', '".$sb_lst['rev']."', \"".$sb_lst['ad_note']."\", '".$sb_lst['release_date']."', '".$sb_lst['affected']."',
				'".$sb_lst['effectivity']."', '".$sb_lst['acc_category']."', '".$sb_lst['priority']."', '".$sb_lst['prior_to']."', '".$sb_lst['man_aff']."', '".$sb_lst['man_aff_mm']."', '".$sb_lst['man_aff_ipc']."',
				'".$sb_lst['man_aff_wdm']."', '".$sb_lst['man_aff_ovhm']."', '".$sb_lst['man_aff_other']."', '".$sb_lst['wt_change']."', '".$sb_lst['mom_change']."', '".$sb_lst['sb_mhr']."', '".$sb_lst['actual_mhr']."',
				'".$sb_lst['labor_rate']."', '".$sb_lst['mhr_cost']."', \"".$sb_lst['req_kit_material_spares']."\", '".$sb_lst['kit_price']."', \"".$sb_lst['esg_eng']."\", \"".$sb_lst['esg_lead_eng']."\", 
				\"".$sb_lst['mcg_lead_eng']."\", \"".$sb_lst['esd_manager']."\", '".$sb_lst['eval_issued']."', '".$sb_lst['eojo_no']."', '".$sb_lst['rev_sb_before']."', '".$_POST['user']."', '".$_POST['action']."',
				'".$sb_lst['last_chg']."', '".$sb_lst['last_chg_act']."', '".$sb_lst['last_chg_date']."')");
mysql_query("UPDATE sblist SET sblist.sbno='".$_POST['sbno']."', sblist.title=\"".$_POST['title']."\", sblist.atasys='".$_POST['atasys']."', sblist.vendor='".$_POST['vendor']."', sblist.rev='".$_POST['rev']."', 
				sblist.ad_note=\"".$_POST['adnote']."\", sblist.release_date='".$_POST['rel_date']."', sblist.affected='".$_POST['affected']."', sblist.effectivity='".$_POST['effectivity']."', 
				sblist.acc_category='".$_POST['acc_cat']."', sblist.priority='".$_POST['priority']."', sblist.prior_to='".$_POST['prior_to']."', sblist.man_aff='".$_POST['man_aff']."', sblist.man_aff_mm='".$_POST['man_aff_mm']."',
				sblist.man_aff_ipc='".$_POST['man_aff_ipc']."', sblist.man_aff_wdm='".$_POST['man_aff_wdm']."', sblist.man_aff_ovhm='".$_POST['man_aff_ovhm']."', sblist.man_aff_other='".$_POST['man_aff_other']."', 
				sblist.wt_change='".$_POST['wt_change']."', sblist.mom_change='".$_POST['mom_change']."', sblist.sb_mhr='".$_POST['sb_mhr']."', sblist.actual_mhr='".$_POST['act_mhr']."', 
				sblist.labor_rate='".$_POST['labor_rate']."', sblist.mhr_cost='".$_POST['mhr_cost']."', sblist.req_kit_material_spares='".$_POST['kit_req']."', sblist.kit_price='".$_POST['kit_price']."', 
				sblist.esg_eng=\"".$esg_eng."\", sblist.esg_lead_eng=\"".$esg_lead_eng."\", sblist.mcg_lead_eng=\"".$mcg_lead_eng."\", sblist.esd_manager=\"".$esd_manager."\",
				sblist.eval_issued='".$_POST['eval_issued']."', sblist.eojo_no='".$_POST['eojo_no']."', sblist.rev_sb_before='".$_POST['rev_before']."', sblist.last_chg='".$user['id']."',
				 sblist.last_chg_act='edited' WHERE sblist.id='".$_POST['id']."'");
/////mysql_query("INSERT INTO sblist (sblist.sbno, sblist.title, sblist.atasys, sblist.vendor, sblist.rev, sblist.ad_note, sblist.release_date, sblist.affected, sblist.effectivity, sblist.acc_cat, 
/////				sblist.priority, sblist.prior_to, sblist.man_aff, sblist.man_aff_mm, sblist.man_aff_ipc, sblist.man_aff_wdm, sblist.man_aff_ovhm, sblist.man_aff_other, sblist.wt_change, sblist.mom_change, 
/////				sblist.sb_mhr, sblist.actual_mhr, sblist.labor_rate, sblist.mhr_cost, sblist.req_kit_material_spares, sblist.kit_price, sblist.esg_eng, sblist.esg_lead_eng, sblist.mcg_lead_eng, sblist.esd_manager, 
/////				sblist.eval_issued, sblist.eojo_no, sblist.rev_sb_before) VALUES 
/////				('".$_POST['sbno']."', '".$_POST['title']."', '".$_POST['atasys']."', '".$_POST['vendor']."', '".$_POST['rev']."', '".$_POST['adnote']."', '".$_POST['rel_date']."', '".$_POST['affected']."', 
/////				'".$_POST['effectivity']."', '".$_POST['acc_cat']."', '".$_POST['priority']."', '".$_POST['prior_to']."', '".$_POST['man_aff']."', '".$_POST['man_aff_mm']."', '".$_POST['man_aff_ipc']."', 
/////				'".$_POST['man_aff_wdm']."', '".$_POST['man_aff_ovhm']."', '".$_POST['man_aff_other']."', '".$_POST['wt_change']."', '".$_POST['mom_change']."', '".$_POST['sb_mhr']."', '".$_POST['act_mhr']."', 
/////				'".$_POST['labor_rate']."', '".$_POST['mhr_cost']."', '".$_POST['kit_req']."', '".$_POST['kit_price']."', '".$_POST['esg_eng']."', '".$_POST['esg_lead_eng']."', '".$_POST['mcg_lead_eng']."', 
/////				'".$_POST['esg_dep_man']."', '".$_POST['eval_issued']."', '".$_POST['eojo_no']."', '".$_POST['rev_before']."', )");
/////print_r ($_POST);
mysql_query("UPDATE viewed SET viewed.view='1' where viewed.sb_id='".$_POST['id']."' AND viewed.user_id IN (SELECT users.id FROM users WHERE users.position='".$user['position']."')");
echo "SAVED!";
mysql_close();
include('../footer.php');
?>

<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>