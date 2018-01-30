<?php
session_start();
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('sbeval_test');
mysql_query("SET NAMES 'utf8'");
//$dep_lst_query=mysql_query("SELECT * FROM departments ORDER BY dep_name");
//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
//$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380'or phones.num RLIKE '---') order by phones.num");
//$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");
$sb_lst_query=mysql_query("SELECT * FROM sblist WHERE sblist.id='".$_GET['id']."'");
$sb_lst=mysql_fetch_array($sb_lst_query);
$user_query=mysql_query("SELECT * FROM users WHERE users.name='".$_SESSION['login']."'");
$user=mysql_fetch_array($user_query);
$pos_query=mysql_query("SELECT * FROM positions WHERE positions.id='".$user['position']."'");
$pos=mysql_fetch_array($pos_query);


//print_r($sb_lst);
?>

<form action="newsb-proc.php" method="post">
<font size=10><b>Add New Service Bulletin Evaluation</b></font><br><br><br>
<img src="/images/sblogo.jpg" width="332" height="80">

<div class="title">
SERVICE BULLETIN EVALUATION
</div>

<div class="block1">
<table border="0">
<tr><td>
SB No <input type="text" name="sbno" size="30" value="<?php echo($sb_lst['sbno']);?>">
</td>
<td rowspan="2" style="padding-left: 26px; spacing-top:0px;">
TITLE
</td> 
<td rowspan="2">
<textarea rows="3" cols="80" name="title"><?php echo($sb_lst['title']); ?></textarea>
</td>
</tr>
<tr><td>
ATA System <input type="text" name="atasys" size="3" value="<?php echo($sb_lst['atasys']);?>">
</td></tr>
</table>
</div>

<div>
<table>
<tr>
<td style="padding-left:20px;">
EFFECTIVITY
</td>
<td rowspan="2">
<textarea rows="2" cols="40" name="effectivity"><?php echo($sb_lst['effectivity']); ?></textarea>
</td>
</tr>
<tr>
<td style="padding-left:20px;">
<?php $aff_lst_query=mysql_query("SELECT * FROM affected ORDER BY affected.name");
?>
<select name="affected" size=1>
<?php
while ($aff_lst = mysql_fetch_array($aff_lst_query)) {
      $aff_lst_array[] = array('id' => $aff_lst['id'],
                                 'name' => $aff_lst['name']);

if ($aff_lst['id']==$sb_lst['affected']) {
    echo "<option value=".$aff_lst['id']." selected=selected>".$aff_lst['name']."</option>";
    } else {
	echo "<option value=".$aff_lst['id'].">".$aff_lst['name']."</option>";
    }
}
?>
</select>

</td>
</tr>
</div>

<div>
<table>
<tr>
<td style="padding-left:50px;">
<?php $ven_lst_query=mysql_query("SELECT * FROM vendor ORDER BY vendor.name");
?>
Vendor: 
<select name="vendor" size=1>
<?php
while ($ven_lst = mysql_fetch_array($ven_lst_query)) {
      $ven_lst_array[] = array('id' => $ven_lst['id'],
                                 'name' => $ven_lst['name']);


if ($ven_lst['id']==$sb_lst['vendor']) {
    echo "<option value=".$ven_lst['id']." selected=selected>".$ven_lst['name']."</option>";
    } else {
	echo "<option value=".$ven_lst['id'].">".$ven_lst['name']."</option>";
    }

}
?>
</select>

<br>
Release Date of SB <input type="date" name="rel_date" value='<?php echo($sb_lst['release_date']); ?>'></input><br>
Revision <input type="text" size="4" name="rev" value='<?php echo($sb_lst['rev']); ?>'></input><br>
AD Note<input type="text"  size="10" name="adnote" value='<?php echo($sb_lst['ad_note']); ?>'></input><br>
</td>
<td align="right" style="padding-left:70px;">
<b>ACCOMPLISHMENT CATEGORY</b><br>
<?php
switch($sb_lst['acc_category']) {
case 1:
    echo "AD Releated<input type='radio' name='acc_cat' value='1' checked=checked><Br>
	Reliability mandatory<input type='radio' name='acc_cat' value='2'><Br>
	    Recommended<input type='radio' name='acc_cat' value='3'><br>
	    Optional<input type='radio' name='acc_cat' value='4'>";
break;
case 2:
    echo "AD Releated<input type='radio' name='acc_cat' value='1'><Br>
	Reliability mandatory<input type='radio' name='acc_cat' value='2' checked=checked><Br>
	    Recommended<input type='radio' name='acc_cat' value='3'><br>
	    Optional<input type='radio' name='acc_cat' value='4'>";
break;
case 3:
    echo "AD Releated<input type='radio' name='acc_cat' value='1'><Br>
	Reliability mandatory<input type='radio' name='acc_cat' value='2'><Br>
	    Recommended<input type='radio' name='acc_cat' value='3' checked=checked><br>
	    Optional<input type='radio' name='acc_cat' value='4'>";
break;
case 4:
    echo "AD Releated<input type='radio' name='acc_cat' value='1'><Br>
	Reliability mandatory<input type='radio' name='acc_cat' value='2'><Br>
	    Recommended<input type='radio' name='acc_cat' value='3'><br>
	    Optional<input type='radio' name='acc_cat' value='4' checked=checked>";

default:
    echo "AD Releated<input type='radio' name='acc_cat' value='1'><Br>
	Reliability mandatory<input type='radio' name='acc_cat' value='2'><Br>
	    Recommended<input type='radio' name='acc_cat' value='3'><br>
	Optional<input type='radio' name='acc_cat' value='4'>";
break;
}
?>
</td>
<td  align="right" style="padding-left:90px;">
<b>SCHEDULING PRIORITY</b><br>
<?php
switch($sb_lst['priority']) {
case 1:
    echo "Next check/shop visit<input type='radio' name='priority' value='1' checked=checked><Br>
	Next heavy maint visit<input type='radio' name='priority' value='2'><Br>
	As scheduled by PPC<input type='radio' name='priority' value='3'><br><br>";
break;
case 2:
    echo "Next check/shop visit<input type='radio' name='priority' value='1'><Br>
	Next heavy maint visit<input type='radio' name='priority' value='2' checked=checked><Br>
	As scheduled by PPC<input type='radio' name='priority' value='3'><br><br>";
break;
case 3:
    echo "Next check/shop visit<input type='radio' name='priority' value='1'><Br>
	Next heavy maint visit<input type='radio' name='priority' value='2'><Br>
	As scheduled by PPC<input type='radio' name='priority' value='3' checked=checked><br><br>";
break;
default:
    echo "Next check/shop visit<input type='radio' name='priority' value='1'><Br>
	Next heavy maint visit<input type='radio' name='priority' value='2'><Br>
	As scheduled by PPC<input type='radio' name='priority' value='3'><br><br>";
break;
}
?>
Prior to:<input type="date" name="prior_to" value='<?php echo($sb_lst['prior_to']); ?>'></input>
</td>
</tr>
</table>
</div>
<div>
<b><center><br>MANUALS AFFECTED</center></b><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MM<input type="checkbox" name="man_aff_mm" value="1" <?php if($sb_lst['man_aff_mm']=='1') {echo "checked='checked'"; } ?>>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
IPC<input type="checkbox" name="man_aff_ipc" value="1" <?php if($sb_lst['man_aff_ipc']=='1') {echo "checked='checked'"; } ?>>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
OVHM<input type="checkbox" name="man_aff_ovhm" value="1" <?php if($sb_lst['man_aff_ovhm']=='1') {echo "checked='checked'"; } ?>>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
WDM<input type="checkbox" name="man_aff_wdm" value="1" <?php if($sb_lst['man_aff_wdm']=='1') {echo "checked='checked'"; } ?>>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Other<input type="checkbox" name="man_aff_other" value="1" <?php if($sb_lst['man_aff_other']=='1') {echo "checked='checked'"; } ?>>
<input type="text"  size="20" name="man_aff" value="<?php echo ($sb_lst['man_aff']); ?>"></input>
</div>
<br><br>

<div>
<center><b>WEIGHT AND BALANCE</b></center><br>
<center>
Wt Change(+/- lbs)<input type="text" size="10" name="wt_change" value="<?php echo ($sb_lst['wt_change']); ?>"></input>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Mom Change(+/- lbs-inch)<input type="text" size="10" name="mom_change" value="<?php echo ($sb_lst['mom_change']); ?>"></input>
</center>
</div>
<br><br>
<div>
<center><b>MANHOUR REQUIREMENT PER UNIT</b></center><br>
<center>
SB Mhr<input type="text" size="10" name="sb_mhr" value="<?php echo ($sb_lst['sb_mhr']); ?>"></input>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Actual Mhrs<input type="text" size="10" name="act_mhr" value="<?php echo ($sb_lst['actual_mhr']); ?>"></input>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Labor Rate ($)<input type="text" size="10" name="labor_rate" value="<?php echo ($sb_lst['labor_rate']); ?>"></input>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Mhr Cost ($)<input type="text" size="10" name="mhr_cost" value="<?php echo ($sb_lst['mhr_cost']); ?>"></input>
</center>
</div>

<br><br>
<div>
<table border=0>
<tr>
<td rowspan="2" style="width: 129px;">
Kit, spares and
materials required</td><td rowspan="2"><textarea rows="3" cols="40" name="kit_req"><?php echo ($sb_lst['req_kit_material_spares']); ?></textarea>
</td>

<td>
Kit price per unit($)<input type="text" size="10" name="kit_price" value="<?php echo ($sb_lst['kit_price']); ?>"></input>
</td>
</tr>
<tr>
<td>
<b style="width: 100px; padding-left: 30px;">MATERIAL REQUIRED PER UNIT</b>
</td>
</tr>
</table>
</div>

<div>
<table border=0>
<tr>
<td style="width: 162px;">
Engineering Support Group Engineer</td><td colspan="3"><textarea rows="3" cols="100" name="esg_eng"></textarea>
</td>
</tr>

<tr>
<td>
ESG Leading Engineer</td>
<td>
<?php if($pos['name']=='ESG Leading Engeneer') {
 echo "<textarea rows=\"3\" cols=\"30\" name=\"esg_lead_eng\"></textarea>";
    } else {
    echo "<p style=\"border: 0px solid black; padding: 10px; background: white;\"></p>
    <input type=\"hidden\" name=\"esg_lead_eng\" value=\"\"></input>";
    }
?>
</td>
<td>
MCG Leading Engineer</td>
<td>
<?php if($pos['name']=='MCG Leading Engineer') {
 echo "<textarea rows=\"3\" cols=\"30\" name=\"mcg_lead_eng\"></textarea>";
    } else {
    echo "<p style=\"border: 0px solid black; padding: 10px; background: white;\"></p>
    <input type=\"hidden\" name=\"mcg_lead_eng\" value=\"\"></input>";
    }
?>
</td>
</tr>

<tr><td rowspan="2">.
Engineering Support Department Manager</td>
<td rowspan="2">
<?php if($pos['name']=='ESD Manager') {
 echo "<textarea rows=\"3\" cols=\"30\" name=\"esg_dep_man\"></textarea>";
    } else {
    echo "<p style=\"border: 0px solid black; padding: 10px; background: white;\"></p>
	<input type=\"hidden\" name=\"esg_dep_man\" value=\"\"></input>";
    }
?>

</td>
<td>
 EO/JO №</td><td><input type="text" size="10" name="eojo_no" value="<?php echo ($sb_lst['eojo_no']); ?>"></input></td>
</td>
</tr>
<tr><td>REVIEW SB before</td><td><input type="date" name="rev_before" value="<?php echo ($sb_lst['rev_sb_before']); ?>"></input></td>
</tr>
</table>
</div>
<br>
<div>
<?php $usr_lst_query=mysql_query("SELECT * FROM users WHERE users.name='".$_SESSION['login']."'");
	$usr_lst=mysql_fetch_array($usr_lst_query);
?>
<input type="hidden" name="user" value="<?php echo($usr_lst['id']); ?>"></input>

<input type="hidden" name="action" value="added"></input>
Evaluation issued<input type="date" name="eval_issued" value="<?php echo ($sb_lst['eval_issued']); ?>"></input>
</div>


<center><b><input type="submit" value="ADD"></b><input type="reset" value="CLEAR"></center>

</form>
<?php
include('../footer.php');
?>
