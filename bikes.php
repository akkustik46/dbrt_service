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
<div style="padding-top: 10px; margin-left: 50px; margin-top: 30px">
<a href='add/bike.php' target='_blank' onClick=\"popupWin = window.open(this.href, 'AddBike', 'width=470,height=380,top=200,left=60'); popupWin.focus(); return false;\"><img src="img/add.svg" width=30px height=30px></a>
</div>
</p>
<p>

<b>
<?php /*
  if($_GET['action']=='all') {
	echo 'Все пользователи';
    } else {
    $dep_lst_query=mysql_query("SELECT * FROM departments where departments.dep_id='".$_GET['action']."'");
    $dep_lst=mysql_fetch_array($dep_lst_query);
    echo $dep_lst['dep_name'];
    }
*/
?>
</b>

<table class="sortable" id="t">
<col class="id"><col class="make"><col class="model"><col class="year"><col class="vin"><col class="model"><col class="owner"><col class="mileage"><col class="status">
<thead>
<tr><th axis="str">ID&nbsp;</th><th axis="str">Марка&nbsp;</th><th axis="str">Модель&nbsp;</th><th axis="str">Год&nbsp;</th><th axis="str">VIN&nbsp;</th><th axis="str">Номер&nbsp;</th>
<th axis="str">Владелец&nbsp;</th><th axis="str">Пробег&nbsp;</th><th axis="str">История&nbsp;</th></tr>
</thead>
<?php /*
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Марка'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Модель'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Год выпуска'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('VIN'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Номер'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Владелец'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Пробег'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('История'); ?>
    </td>
</tr>
*/ ?>
<tbody>
<?php
$bike_lst_query=mysqli_query($db, "SELECT * from bike");

$x=1;
while ($bike_lst = mysqli_fetch_array($bike_lst_query)) {
      $bike_lst_array[] = array('id' => $bike_lst['id'],
				'model' => $bike_lst['model'],
				'year' => $bike_lst['year'],
				'owner' => $bike_lst['owner'],
				'mileage' => $bike_lst['mileage'],
				'mi-km' => $bike_lst['mi_km'],
				'mileage_lastchg' => $bike_lst['mileage_lastchg'],
				/*'status' => $bike_lst['status'],*/
				'vin' => $bike_lst['vin'],
				'licence_plate' => $bike_lst['license_plate'],
				'comment' => $bike_lst['comment'],
				'mileage_last' => $bike_lst['mileage_last']);

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
    <?php echo ($bike_lst['id']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php $model=mysqli_query($db,"SELECT model,mnf_id, capacity from models where models.id='".$bike_lst['model']."'");
	    $model=mysqli_fetch_array($model);
	    $mnf=mysqli_query($db,"SELECT mnf_name from mnf where mnf.id='".$model['mnf_id']."'");
	    $mnf=mysqli_fetch_array($mnf);
	    echo ($mnf['mnf_name']);?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($model['model']. ' '.$model['capacity']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($bike_lst['year']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($bike_lst['vin']); ?>
    </td>
    <td onClick="popupWin = window.open('edit/bike.php<?php echo ("?id=".$bike_lst['id']);?>', 'Изменить мотоцикл', 'location,width=800,height=550,top=0'); popupWin.focus(); return false;"  bgcolor=<?php echo $bg; ?>>
    <?php echo ($bike_lst['license_plate']); ?>
    </td>
    <td onClick="popupWin = window.open('edit/bike.php<?php echo ("?id=".$bike_lst['id']);?>', 'Изменить мотоцикл', 'location,width=800,height=550,top=0'); popupWin.focus(); return false;"  bgcolor=<?php echo $bg; ?> align=left>
    <?php $client=mysqli_query($db, "SELECT username FROM clients WHERE id='".$bike_lst['owner']."'");
		$client=mysqli_fetch_array($client);
		echo ($client['username']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php if ($bike_lst['mi_km']==0) {$mikm='KM';} else {$mikm='MI';} 
	echo ($bike_lst['mileage_last'].$mikm); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php /* $status=mysqli_query($db,"SELECT status_name from status where status.id='".$bike_lst['status']."'"); 
	$status=mysqli_fetch_array($status);
    echo ($status['status_name']); */
    echo "<a href=bike-history.php?bike_id=".$bike_lst['id'].">История</a>" ?>
    </td>

</tr>
<?php
}
?>
</tbody>
</table>
<div class="navig" style="
    margin-top: 15px;"
</div>
</p>
<?php
//print_r($phones_lst_array);
include('footer.php');
?>
