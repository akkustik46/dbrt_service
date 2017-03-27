<table border=0>
<tr><td>Клиент</td><td>
<?php $cl_lst_query=mysqli_query($db,"SELECT id as cl_id, username as cl_name FROM clients WHERE id='".$task_lst['client']."'");
$cl_lst=mysqli_fetch_array($cl_lst_query);

?>


<?php echo ($cl_lst['cl_name']); ?>
</td>

<td>Мотоцикл</td>
<td>
<?php 
//    if (!isset($_GET['cl_id'])) {
//        $bike_lst_query=mysql_query("SELECT id as bike_id, model as mod_id FROM bike");
//        } else {
//        $bike_lst_query=mysql_query("SELECT id as bike_id, model as mod_id FROM bike WHERE bike.owner='".$_GET['cl_id']."'");
//        }
$model_name=mysqli_query($db,"select (select mnf_name from mnf where id=(select mnf_id from models where id=(SELECT model FROM bike WHERE id='".$task_lst['bike']."'))) as make, model, capacity from models where id=(SELECT model FROM bike WHERE id='".$task_lst['bike']."')");
$model=mysqli_fetch_array($model_name);
$payment=mysqli_query($db,"select payment from tasks where id='".$_GET['id']."'");
$payment=mysqli_fetch_array($payment);
$payed=mysqli_query($db,"select * from payments where task='".$_GET['id']."'");
$payed_sum=0;

while ($payed_lst=mysqli_fetch_array($payed)) {
			$payed_sum=$payed_sum+$payed_lst['sum'];
	}
 echo ($model['make']." ".$model['model']." ".$model['capacity']); 
?>

</td>
<td><b>К оплате:</b></td><td><?php echo $payment['payment']; ?> грн.</td>
</tr>

<tr><td>Пробег</td><td colspan="3">
<?php $bike_data_query=mysqli_query($db,"SELECT * FROM bike WHERE id='".$task_lst['bike']."'");
$bike_data=mysqli_fetch_array($bike_data_query);
if ($bike_data['mi_km']==0) {$units='km';} else {$units='miles';} 
echo $bike_data['mileage_last']." ".$units ;
?>
</td>
<td><b>Оплачено:</b></td><td>
<?php 
while ($payed_lst=mysqli_fetch_array($payed)) {
			$payed_sum=$payed_sum+$payed_lst['sum'];
			echo $payed_lst['sum']. 'грн.'. $payed_lst['date_payment'].'<br>';
		}

?>
<?php echo $payed_sum;?> грн.</td>
</tr>
<tr><td>Статус</td><td colspan="4">

<select name="status">
<?php 
$stat_cur=mysqli_query($db,"SELECT status,comment from tasks where id='".$_GET['id']."'");
$stat_cur=mysqli_fetch_array($stat_cur);
$status_lst_query=mysqli_query($db,"SELECT * FROM tasks_status");
while ($status_lst = mysqli_fetch_array($status_lst_query)) {
      $status_lst_array[] = array('id' => $status_lst['id'],
                                 'name' => $status_lst['name']);
?>
<option value="<?php echo ($status_lst['id']."\""); if ($status_lst['id']==$stat_cur['status']) {echo " selected=selected";}?> >
	<?php echo ($status_lst['name']); ?> </option>
<?php
}

?>
</select>

</td></tr>
<tr><td colspan="5">Коментарий:</td></tr>
<tr><td colspan="5"><textarea name="comment" cols="50" rows="5"><?php echo $stat_cur['comment']; ?></textarea></td>
<td><a href=/add/payment.php?id=<?php echo $_GET['id']; ?> target="_blank" onClick="popupWin = window.open(this.href, 'Добавить платеж', 'location,width=200,height=200,top=200,left=450'); popupWin.focus(); return false;" style="padding-left:10px;"><b>Добавить платеж</b></a></td>
</tr>
</table>

<?php 
/*$wgr_query = mysql_query("SELECT * from works_groups");
$wgr = array();
while($wgr_lst = mysql_fetch_array($wgr_query,MYSQL_ASSOC)) {
	$wrk_query=mysql_query("SELECT id,name from works_types where group_id='".$wgr_lst['id']."'");
	    $types[$wgr_lst['id']]=array();
	while ($wrk_lst=mysql_fetch_array($wrk_query,MYSQL_ASSOC)) {
	$types[$wgr_lst['id']]=$types[$wgr_lst['id']] + array($wrk_lst['id']=>$wrk_lst['name']);
	}
}
echo json_encode($types,JSON_UNESCAPED_UNICODE);*/
?>