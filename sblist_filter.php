<?php
if (isset($_SESSION['login'])) {
header('Refresh: 1; location: index.php');
exit;
}

include('top3.php');
include('menu.php');
if (!isset($_GET['action'])) {$_GET['action']='all';}

?>
<br>
 <p>
<a href="add/newsb.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddSB', 'location,width=1024,height=900,top=0'); popupWin.focus(); return false;">Add New Service Bulletin</a>
</p>

<p>

<b>
<?php 
  if($_GET['action']=='all') {
	echo 'ALL SB';
    } else {
    echo ($_GET['action']);
    }
?>
</b>
<br>
<input class="filter" name="livefilter" type="text" value="" />
<table class="live_filter" cellspacing="1" cellpadding="2" border="0" bgcolor="black" >
<thead>
    <tr>
    <th align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </th>
    <th class="title" align=center bgcolor=#acacff>
    <?php echo ('SB No'); ?>
    </th>
    <th align=center bgcolor=#acacff>
    <?php echo ('Title'); ?>
    </th>
    <td align=center bgcolor=#acacff>
    <?php echo ('ATA System'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Vendor'); ?>
    </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('Revision'); ?>
     </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('Effectivity'); ?>
     </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('AD Note'); ?>
     </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('ESG Engineer'); ?>
     </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('ESG Lead Engineer'); ?>
     </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('MCG Lead Enginer'); ?>
     </td>
    <td align=center bgcolor=#acacff>
     <?php echo ('ESG Manager'); ?>
     </td>
    <td align=center bgcolor=#acacff>
     <?php echo ('Evaluation date'); ?>
     </td>
    <td align=center bgcolor=#acacff>
     <?php echo ('Action'); ?>
     </td>
</tr>
</thead>

<tbody>
<?php
if ($_GET['action']=='all') {
$sb_lst_query=mysql_query("SELECT * from sblist ORDER BY sblist.id asc");
    } else {
    $sb_lst_query=mysql_query("select * from sblist where sblist.sbno rlike '^".$_GET['action']."'");
//    echo "select * from users where dep_id in (select dep_id from departments where parent_id=(select dep_id from departments where parent_id='".$_GET['action']."') or parent_id='".$_GET['action']."') or dep_id='".$_GET['action']."' ORDER BY users.last_name";
    }

#$phones_lst_query=mysql_query("SELECT * from phones");
#while ($phones_lst = mysql_fetch_array($phones_lst_query)) {
#	$phones_lst_array[] = array('id' => $phones_lst['id'],
#				    'num' => $phones_lst['num']);
#	}
$x=1;
while ($sb_lst = mysql_fetch_array($sb_lst_query)) {
      $sb_lst_array[] = array('id' => $sb_lst['id'],
				'sbno' => $sb_lst['sbno'],
				'title' => $sb_lst['title'],
				'atasys' => $sb_lst['atasys'],
				'vendor' => $sb_lst['vendor'],
				'rev' => $sb_lst['rev'],
				'effectivity' => $sb_lst['effectivity'],
				'ad_note' => $sb_lst['ad_note'],
				'esg_eng' => $sb_lst['esg_eng'],
				'esg_lead_eng' => $sb_lst['esg_lead_eng'],
				'mcg_lead_eng' => $sb_lst['mcg_lead_eng'],
				'esd_manager' => $sb_lst['esd_manager'],
				'eval_issued' => $sb_lst['eval_issued']);

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;
?>

<tr>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['id']); ?>
    </td>
    <td class="title" bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['sbno']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['title']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['atasys']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php 
	$ven_lst_query=mysql_query("SELECT vendor.name FROM vendor WHERE vendor.id='".$sb_lst['vendor']."'");
	while ($ven_lst=mysql_fetch_array($ven_lst_query)) {
        $ven_lst_array[]=array('name'=>$ven_lst['name']);
	echo ($ven_lst['name'].'<br>');
    } 
    ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php  echo ($sb_lst['rev']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['effectivity']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['ad_note']); ?>
    </td>
     <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['esg_eng']); ?>
    </td>

    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['esg_lead_eng']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['mcg_lead_eng']); ?>
    </td>

    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['esd_manager']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($sb_lst['eval_issued']); ?>
    </td>


    <td align=center bgcolor=<?php echo $bg; ?>>
        <a class="tt" href="edit/user_edit.php?<?php echo 'id=' . $sb_lst['id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'SBEdit', 'location,width=600,height=600,top=0');
     popupWin.focus(); return false;"><img src='images/edit.png' alt='Edit'>
      <span>Edit</span>
   </a>
        <a class="tt" href="edit/users_del.php?<?php echo 'id=' . $sb_lst['id']; ?>
 " target="_blank" onclick="if(confirm('Are you sure?')) return true; else return false;"><img src='images/delete.png' alt='Delete'>
          <span>Delete</span>
   </a>
   </td>
</tr>
<?php
}
?>
</tbody>
</table>
</p>
<?php
//print_r($phones_lst_array);
include('footer.php');
?>
