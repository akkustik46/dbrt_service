<?php
include('test-auth.php');
if (!isset($_GET['action'])) { $_GET['action']='all'; }
include('top3.php');
include('menu.php');
//include('db_conn.php');


//  if($_GET['action']=='all') {
echo '<br><h3 align="center">ALL Restricted Parts List</h3>';
//    } else {
//    echo ('<br><h3 align="center">'.$_GET['action'].' SB Evaluation</h3>');
//    }



?>
 <p>
<a href="add/rest_part.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddPart', 'location,width=800,height=700,top=0'); popupWin.focus(); return false;" style="padding-left:90px;"><b>Add New Part</b></a>
</p>


<table class="sortable" id='t'>
<col class='season'><col class='name'><col class='esg'><col class='esg'><col class='season'><col class='season'><col class='esg'>
<col class='esg'><col class='act'><thead>
<tr><th axis="str">ATA&nbsp;</th><th>Part Name&nbsp;</th><th>PN From&nbsp;</th><th>PN To&nbsp;</th><th>SN From&nbsp;</th><th>SN To&nbsp;</th><th>Related AD&nbsp;</th><th axis="str">Comment&nbsp;</th>
<th>Action&nbsp;</th></tr>
</thead>
<tbody>
<?php
//$pos_query=mysqli_query($db,"SELECT positions.name FROM positions where positions.id=(SELECT users.position FROM users WHERE users.name='".$_SESSION['login']."')");
//$pos=mysqli_fetch_array($pos_query);

if ($_GET['action']=='all') {
	$parts_lst_query=mysqli_query($db,"SELECT * from restricted_parts ORDER BY restricted_parts.id asc");
	} else {
	$parts_lst_query=mysqli_query($db,"SELECT * from restricted_parts WHERE aircraft=".$_GET['action']." ORDER BY restricted_parts.id asc");
    }

$x=1;
while ($parts_lst = mysqli_fetch_array($parts_lst_query)) {
      $parts_lst_array[] = array('id' => $parts_lst['id'],
				'ata' => $parts_lst['ata'],
				'part_name' => $parts_lst['part_name'],
				'pn_from' => $parts_lst['pn_from'],
				'pn_to' => $parts_lst['pn_to'],
				'sn_from' => $parts_lst['sn_from'],
				'sn_to' => $parts_lst['sn_to'],
				'related_ad' => $parts_lst['related_ad'],
				'comment' => $parts_lst['comment']);
//for ($pn=$parts_lst['pn_from'];$pn<=$parts_lst['pn_to'];$pn++) {
//    $pn_arr[]=$pn;
//}
    if($parts_lst['sn_from']==''){ $sn='any';} else { $sn=$parts_lst['sn_from'].'-'.$parts_lst['sn_to'];}
//    for ($sn=$parts_lst['sn_from'];$sn<=$parts_lst['sn_to'];$sn++) {
    //<>echo 'PN: '.$pn++.' SN: '.$sn.'<br>';
//    $sn_arr[]=$sn;
//    }
//    }

//foreach ($pn_arr as $pn) {
//    foreach ($sn_arr as $sn) {
//	 echo 'PN: '.$pn.' SN: '.$sn.'<br>';
        
echo $parts_lst['pn_from'].' - '.$parts_lst['pn_to'].' | '.$sn.'<br>';

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;

?>
<?php /*
<tr>
<td align='center'><?php echo ($parts_lst['ata']); ?></td><td><?php echo ($parts_lst['part_name']); ?></td><td><?php echo ($pn); ?></td>
<td><?php echo ($pn); ?></td><td><?php echo ($sn); ?></td><td><?php echo ($sn); ?></td>
<td><?php echo ($parts_lst['related_ad']); ?></td><td><?php echo ($parts_lst['comment']); ?></td>
*/
?>
<?php /*
<td><?php echo ($sb_lst['mcg_lead_eng']); ?></td><td><?php echo ($sb_lst['esd_manager']); ?></td><td><?php echo ($sb_lst['eval_issued']); ?></td>
*/
?>
<?php /*
<td align=center>

        <a href="edit/parts_edit.php?<?php echo 'id=' . $parts_lst['id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'SBEdit', 'location,width=1024,height=900,top=0');
     popupWin.focus(); return false;"><img src='images/edit.png' Title='Edit' alt='Edit'>
     
   </a>

    <a href="add/parts-add-based.php?<?php echo 'id=' . $parts_lst['id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'SBEdit', 'location,width=1024,height=900,top=0');
     popupWin.focus(); return false;"><img src='images/icon_plus.gif' title='Add Based on this SB' alt='Add Based on this SB'>

   </a>

        <a class="tt" href="edit/parts_del.php?<?php echo 'id=' . $parts_lst['id']; ?>
 " target="_blank" onclick="if(confirm('Are you sure?')) return true; else return false;"><img src='images/delete.png' title='Delete' alt='Delete'>
         
   </a>
 </td>
*/
?>
<?php /*
<td style="font-size: 0">
<center>
<img src="images/<?php echo $bgcol;?> " height="12" width="12"></center><?php echo $stat;?>
</td>
*/
?>
<?php /*
</tr>
*/ ?>
<?php

//	}
//    }
 } ?>
</tbody>
</table>
</body>
</html>