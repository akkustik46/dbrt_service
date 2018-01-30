<?php
session_start();
if(!isset($_SESSION['login'])) {
echo "<script>
var tm=100
window.setTimeout(\"window.close();\",tm)
</script>";
}

include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('sbeval');
mysql_query("SET NAMES 'utf8'");
//$dep_lst_query=mysql_query("SELECT * FROM departments ORDER BY dep_name");
//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
//$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380'or phones.num RLIKE '---') order by phones.num");
//$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");
//$sb_lsq_query=mysql_query("SELECT sblist.sbno FROM sblist WHERE sbno='11'");
//$sb_lsq= mysql_num_rows($sb_lsq_query);
$user_query=mysql_query("SELECT * FROM users WHERE users.name='".$_SESSION['login']."'");
$user=mysql_fetch_array($user_query);
$pos_query=mysql_query("SELECT * FROM positions WHERE positions.id='".$user['position']."'");
$pos=mysql_fetch_array($pos_query);
$aircraft_query=mysql_query("SELECT * FROM aircrafts_types");


//echo($sb_lsq);
?>
<form action="newpart-proc.php" method="post">
<font size=10><b>Add New Restricted Part</b></font><br><br><br>
<img src="/images/sblogo.jpg" width="332" height="80">


<div class="block1">
<table border="0">
<tr><td>
ATA <input type="text" name="ata" size="10" value="">
</td>
<td  style="padding-left: 6px; spacing-top:0px;">
Part Name
<input type="text" size="50" name="part_name">
</td>
</tr>
<tr><td  style="padding-left: 6px; spacing-top:0px;">
PN From 
<input type="text" name="pn_from" size="20" value="">
</td>
<td  style="padding-left: 6px; spacing-top:0px;">
PN To 
<input type="text" name="pn_to" size="20" value="">
</td>
</tr>
<tr><td  style="padding-left: 6px; spacing-top:0px;">
SN From 
<input type="text" name="sn_from" size="20" value="">
</td>
<td  style="padding-left: 6px; spacing-top:0px;">
SN To 
<input type="text" name="sn_to" size="20" value="">
</td>
</tr>
</table>

<table>
<tr><td  style="padding-left: 6px; spacing-top:0px;">
Related AD 
</td><td>
<textarea rows="4" cols="80" name="related_ad"></textarea>
</td></tr>
<tr>
<td style="padding-left: 6px; spacing-top:0px;">
Comment 
</td><td>
<textarea rows="4" cols="80" name="comment"></textarea>
</td>
</tr>
<tr>
<td>
Aircraft Type
</td><td>
<select name="ac_type" size=1>
<?php
while ($type_lst = mysql_fetch_array($aircraft_query)) {
      $type_lst_array[] = array('id' => $type_lst['id'],
                                 'type' => $type_lst['type']);

?>
<option value=" <?php echo ($type_lst['id']); ?> "> <?php echo ($type_lst['type']); ?> </option>
<?php
}
?>
</select>

</td>
</table>
</div>

<input type="hidden" name="action" value="added"></input>
<center><b><input type="submit" value="ADD"></b><input type="reset" value="CLEAR"></center>

</form>
<?php
include('../footer.php');
?>
