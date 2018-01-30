<?php
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('sbeval');
mysql_query("SET NAMES 'utf8'");
$old_query=mysql_query("SELECT * FROM sblist WHERE sblist.id='" . $_GET['id'] . "'");
$sb_lst=mysql_fetch_array($old_query);
session_start();
$user_query=mysql_query("SELECT * FROM users WHERE users.name='".$_SESSION['login']."'");
$user=mysql_fetch_array($user_query);
//$ed_query=mysql_query("SELECT operators.id FROM operators WHERE operators.login='" . $_SESSION['login'] . "'");
//$ed=mysql_fetch_array($ed_query);
mysql_query("INSERT INTO sblist_history (sblist_history.sbno, sblist_history.title, sblist_history.atasys, sblist_history.vendor, sblist_history.rev, sblist_history.ad_note, sblist_history.release_date, sblist_history.affected,
				sblist_history.effectivity, sblist_history.acc_category, sblist_history.priority, sblist_history.prior_to, sblist_history.man_aff, sblist_history.man_aff_mm, sblist_history.man_aff_ipc,
				sblist_history.man_aff_wdm, sblist_history.man_aff_ovhm, sblist_history.man_aff_other, sblist_history.wt_change, sblist_history.mom_change, sblist_history.sb_mhr, sblist_history.actual_mhr,
				sblist_history.labor_rate, sblist_history.mhr_cost, sblist_history.req_kit_material_spares, sblist_history.kit_price, sblist_history.esg_eng, sblist_history.esg_lead_eng,
				sblist_history.mcg_lead_eng, sblist_history.esd_manager, sblist_history.eval_issued, sblist_history.eojo_no, sblist_history.rev_sb_before, sblist_history.user, sblist_history.action,
				sblist_history.last_chg, sblist_history.last_chg_act, sblist_history.last_chg_date) VALUES
				('".$sb_lst['sbno']."', '".$sb_lst['title']."', '".$sb_lst['atasys']."', '".$sb_lst['vendor']."', '".$sb_lst['rev']."', '".$sb_lst['ad_note']."', '".$sb_lst['release_date']."', '".$sb_lst['affected']."',
				'".$sb_lst['effectivity']."', '".$sb_lst['acc_category']."', '".$sb_lst['priority']."', '".$sb_lst['prior_to']."', '".$sb_lst['man_aff']."', '".$sb_lst['man_aff_mm']."', '".$sb_lst['man_aff_ipc']."',
				'".$sb_lst['man_aff_wdm']."', '".$sb_lst['man_aff_ovhm']."', '".$sb_lst['man_aff_other']."', '".$sb_lst['wt_change']."', '".$sb_lst['mom_change']."', '".$sb_lst['sb_mhr']."', '".$sb_lst['actual_mhr']."',
				'".$sb_lst['labor_rate']."', '".$sb_lst['mhr_cost']."', '".$sb_lst['req_kit_material_spares']."', '".$sb_lst['kit_price']."', '".$sb_lst['esg_eng']."', '".$sb_lst['esg_lead_eng']."',
				'".$sb_lst['mcg_lead_eng']."', '".$sb_lst['esd_manager']."', '".$sb_lst['eval_issued']."', '".$sb_lst['eojo_no']."', '".$sb_lst['rev_sb_before']."', '".$user['id']."', 'deleted', '".$sb_lst['last_chg']."',
				'".$sb_lst['last_chg_act']."', '".$sb_lst['last_chg_date']."')");
mysql_query("DELETE FROM sblist WHERE sblist.id='" . $_GET['id'] . "'");
//print ($_POST['res_name']);
//header('Refresh: 2; URL=../sblist.php');
echo "Deleted!";
//exit;
mysql_close();
include('../footer.php');
?>
<script>
var tm=1000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
