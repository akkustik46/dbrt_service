<?php
if (isset($_SESSION['login'])) {
header('Refresh: 1; location: index.php');
exit;
}
if (!isset($_GET['action'])) { $_GET['action']='all'; }
include('top3.php');
include('menu.php');
//include('db_conn.php');
switch ($_GET['action']) {
    case 'archive':
    $tasks_query=mysqli_query($db,"SELECT * FROM tasks where status=4");
    break;
    case 'all':
    $tasks_query=mysqli_query($db,"SELECT * FROM tasks where status<>4");
    break;
    default:
    $tasks_query=mysqli_query($db,"SELECT * FROM tasks where status<>4");
    break;
    }

?>
<br>
<p>

<?php if ($_GET['action']=='all') { 
echo ("<div style=\"padding-top: 10px; margin-left: -40px; margin-top: 30px\"><a href='add/task.php' target=\'_blank\' onClick=\"popupWin = window.open(this.href, \'AddTask\', \'location,width=600,height=700,top=0\'); popupWin.focus(); return false;\" style=\"padding-left:90px;\"><img src=\"img/add.svg\" width=30px height=30px></a>");
} 
?>

</div>
</p>
<table class="sortable" id='t'>
<col class='id'><col class='bike'><col class='client'><col class='date'><col class='work'><col class='prices'><col class='status2'>
<col class='esg'><col class='esg'><col class='season'><col class='season'><col class='season'><col class='act'><col class='stat'><thead>
<tr><th axis="str">ID&nbsp;</th><th>Мотоцикл&nbsp;</th><th>Клієнт&nbsp;</th><th axis="str">Створено&nbsp;</th><th>Роботи&nbsp;</th><th>Коментар&nbsp;</th>
<th>Стан&nbsp;</th><th axis="str">Змінено&nbsp;</th>
<th axis="str">Завершено&nbsp;</th></tr>
</thead>
<tbody>
<?php
//$pos_query=mysqli_query($db,"SELECT positions.name FROM positions where positions.id=(SELECT users.position FROM users WHERE users.name='".$_SESSION['login']."')");
//$pos=mysqli_fetch_array($pos_query);
$x=1;
while ($tasks_lst = mysqli_fetch_array($tasks_query)) {
      $tasks_array[] = array('id' => $tasks_lst['id'],
				'date' => $tasks_lst['date_create'],
				'comment' => $tasks_lst['comment'],
				'client' => $tasks_lst['client'],
				'mileage' => $tasks_lst['mileage'],
				'status' => $tasks_lst['status'],
				'date_end' => $tasks_lst['date_end'],
				'date_change' => $tasks_lst['date_change']);

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;

?>

<?php /*
<tr onClick="popupWin = window.open('edit/task.php<?php echo ("?id=".$tasks_lst['id']);?>', 'Добавить задачу', 'location,width=800,height=680,top=0'); popupWin.focus(); return false;" style="padding-left:90px;">
*/ 
?>
<tr>
<td><?php echo ($tasks_lst['id']); ?></td>
<td onClick="window.open('bike-history.php?bike_id=<?php echo ($tasks_lst['bike']);?>', '_self');">
<?php $model_name=mysqli_query($db,"select (select mnf_name from mnf where id=(select mnf_id from models where id=(SELECT model FROM bike WHERE id='".$tasks_lst['bike']."'))) as make, model, capacity from models where id=(SELECT model FROM bike WHERE id='".$tasks_lst['bike']."')");
$model=mysqli_fetch_array($model_name);
		    echo ($model['make']." ".$model['model']." ".$model['capacity']); ?></td>
<td><?php $client_query=mysqli_query($db,"SELECT username FROM clients where id='".$tasks_lst['client']."'");
	    $client=mysqli_fetch_array($client_query);
echo ($client['username']); ?></td>
<td><?php
        echo ($tasks_lst['date_create']);
    
    ?>
</td><td onClick="popupWin = window.open('edit/task.php<?php echo ("?id=".$tasks_lst['id']);?>', 'Редагувати задачу', 'location,width=800,height=680,top=0'); popupWin.focus(); return false;">
<?php $work_lst_query=mysqli_query($db,"SELECT * FROM works WHERE task_id='".$tasks_lst['id']."'");
		while ($works_lst=mysqli_fetch_array($work_lst_query)) {
			    $wrk_query=mysqli_query($db,"SELECT (select name from works_groups where id=(select group_id from works_types where id='".$works_lst['type_id']."')) as group_name, name FROM works_types where id='".$works_lst['type_id']."'");
			    $wrk=mysqli_fetch_array($wrk_query);
			    echo ($wrk['group_name']." > ".$wrk['name']);
			    if ($works_lst['status']==1) {echo "   <img src=/images/green.png height='12px' width='12px'><br>";} else {echo "   <img src=/images/red.png height='12px' width='12px'><br>";}
			}
	    ?></td>
<td><?php echo ($tasks_lst['comment']); ?></td>
<td><?php 
$status_query=mysqli_query($db,"SELECT name FROM tasks_status WHERE id='".$tasks_lst['status']."'");
$status=mysqli_fetch_array($status_query);
echo ($status['name']); ?></td><td><?php echo ($tasks_lst['date_change']); ?></td>
<td><?php echo ($tasks_lst['date_end']); ?></td>
<td><a href='bill.php'>Друк</a></td>
<?php /*
<td align=center>
	 <a href="m21.php?<?php echo 'id=' . $sb_lst['id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'SBpdf', 'location,width=1024,height=900,top=0');
     popupWin.focus(); return false;"><img src='images/pdf.png' Title='PDF' alt='PDF' height="16" width="16">

   </a>
    
        <a href="edit/sb_edit.php?<?php echo 'id=' . $sb_lst['id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'SBEdit', 'location,width=1024,height=900,top=0');
     popupWin.focus(); return false;"><img src='images/edit.png' Title='Edit' alt='Edit'>
     
   </a>

    <a href="add/sb-add-based.php?<?php echo 'id=' . $sb_lst['id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'SBEdit', 'location,width=1024,height=900,top=0');
     popupWin.focus(); return false;"><img src='images/icon_plus.gif' title='Add Based on this SB' alt='Add Based on this SB'>

   </a>

        <a class="tt" href="edit/sb_del.php?<?php echo 'id=' . $sb_lst['id']; ?>
 " target="_blank" onclick="if(confirm('Are you sure?')) return true; else return false;"><img src='images/delete.png' title='Delete' alt='Delete'>
         
   </a>
   </td>
<td style="font-size: 0">
<center>
<img src="images/<?php echo $bgcol;?> " height="12" width="12"></center><?php echo $stat;?>
</td>
*/ ?>
</tr>
<?php } ?>
</tbody>
</table>
</body>
</html>
