<table border=1>
<tr><td>Клиент</td><td>
<?php $cl_lst_query=mysqli_query($db,"SELECT id as cl_id, username as cl_name FROM clients ORDER BY clients.username");
?>

<select name="cl_id" size="1" id="cl_select" onchange="document.location=this.options[this.selectedIndex].value">
<?php
while ($cl_lst = mysqli_fetch_array($cl_lst_query)) {
      $cl_lst_array[] = array('cl_id' => $cl_lst['cl_id'],
                                 'cl_name' => $cl_lst['cl_name']);

$getadd="task.php?cl_id=".$cl_lst['cl_id'];
?>
<option value="<?php echo ($getadd."\""); 
			if ($cl_lst['cl_id']==$_GET['cl_id']) { echo "selected";}
?>><?php echo ($cl_lst['cl_name']); ?></option>
<?php
}
?>
</select>
<input type="hidden" name="cl_id" value="<?php echo ($_GET['cl_id']."\"");?>>
</td>
<td><a href='client.php' target='_blank' onClick="popupWin = window.open(this.href, 'Добавить клинета', 'location,width=800,height=600,top=70,left=150'); popupWin.focus(); return false;">+</a></td>
<td>Мотоцикл</td>
<td>
<?php 
    if (!isset($_GET['cl_id'])) {
        $bike_lst_query=mysqli_query($db,"SELECT id as bike_id, model as mod_id FROM bike");
        } else {
        $bike_lst_query=mysqli_query($db,"SELECT id as bike_id, model as mod_id FROM bike WHERE bike.owner='".$_GET['cl_id']."'");
        }
?>

<select name="bike_id" size="1" onchange="document.location=this.options[this.selectedIndex].value">
<option value=''>---</option>
<?php
while ($bike_lst = mysqli_fetch_array($bike_lst_query)) {
      $bike_lst_array[] = array('bike_id' => $bike_lst['bike_id'],
                                 'mod_id' => $bike_lst['mod_id']);


$model_name=mysqli_query($db,"select (select mnf_name from mnf where id=(select mnf_id from models where id=(SELECT model FROM bike WHERE id='".$bike_lst['bike_id']."'))) as make, model, capacity from models where id=(SELECT model FROM bike WHERE id='".$bike_lst['bike_id']."')");
$model=mysqli_fetch_array($model_name);
$getadd=$getadd."&bike_id=".$bike_lst['bike_id'];
?>

<option value="<?php echo ($getadd."\""); if ($bike_lst['bike_id']==$_GET['bike_id']) {echo "selected";}?> > <?php echo ($model['make']." ".$model['model']." ".$model['capacity']); ?> </option>
<?php
}
?>
</select>
<input type="hidden" name="bike_id" value="<?php echo ($_GET['bike_id']."\"");?>>

</td>
</tr>

<tr><td>Пробег</td><td colspan="4"><input type="text" name="mileage" size="10" value=""></td></tr>
<tr><td>Статус</td><td colspan="4">

<select name="status">
<?php $status_lst_query=mysqli_query($db,"SELECT * FROM tasks_status");
while ($status_lst = mysqli_fetch_array($status_lst_query)) {
      $status_lst_array[] = array('id' => $status_lst['id'],
                                 'name' => $status_lst['name']);
?>
<option value="<?php echo ($status_lst['id']."\""); ?> >
	<?php echo ($status_lst['name']); ?> </option>
<?php
}

?>
</select>

</td></tr>
<tr><td colspan="5">Коментарий:</td></tr>
<tr><td colspan="5"><textarea name="comment" cols="50" rows="5"></textarea></td></tr>
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