<?php
if (isset($_SESSION['login'])) {
header('Refresh: 1; location: index.php');
exit;
}

include('top.php');
include('menu.php');
if (!isset($_GET['action'])) {$_GET['action']='all';}

?>
<br>
<br>
<?php 
if ($_SESSION['login']=='admin') {
 echo "<p style=\"margin-left: 50px\">".
"<a href='add/model.php' target='_blank' onClick=\"popupWin = window.open(this.href, 'AddModel', 'width=470,height=380,top=200,left=60'); popupWin.focus(); return false;\">Добавить модель</a>".
"</p>";
    }
?>
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
<br>

<table cellspacing="1" cellpadding="2" border="0" bgcolor="black" style="margin-left: 50px">
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
    <?php echo ('Годы выпуска'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Зазоры клапанов'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Количество масла в вилке'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Уровень масла в вилке'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Тип масла в вилке'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Цилиндров'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Клапанов на цилиндр'); ?>
    </td>
</tr>
<?php
$models_lst_query=mysqli_query($db, "SELECT * from models ORDER BY models.model asc");

$x=1;
while ($models_lst = mysqli_fetch_array($models_lst_query)) {
      $models_lst_array[] = array('id' => $models_lst['id'],
				'model' => $models_lst['model'],
				'capacity' => $models_lst['capacity'],
				'mnf_id' => $models_lst['mnf_id'],
				'year_begin' => $models_lst['year_begin'],
				'year_end' => $models_lst['year_end'],
				'comment' => $models_lst['comment'],
//				'valve_in' => $models_lst['valve_in'],
//				'valve_ex' => $models_lst['valve_ex'],
//				'fork_oil_cap' => $models_lst['fork_oil_cap'],
//				'fork_oil_level' => $models_lst['fork_oil_level'],
				'cylinders' => $models_lst['cylinders'],
				'valves_per_cyl' => $models_lst['valves_per_cyl']);

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;
$tech_data=mysqli_query($db,"SELECT * FROM tech_data where model_id='".$models_lst['id']."'");
$tech_data=mysqli_fetch_array($tech_data);
?>

<tr>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($models_lst['id']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php $mnf=mysqli_query($db,"SELECT mnf_name from mnf where mnf.id='".$models_lst['mnf_id']."'");
	    $mnf=mysqli_fetch_array($mnf);
	    echo ($mnf['mnf_name']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($models_lst['model'].' '.$models_lst['capacity']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($models_lst['year_begin'].'-'.$models_lst['year_end']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ('IN:'.$tech_data['valve_in'].' EX:'.$tech_data['valve_ex']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($tech_data['fork_oil_cap']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($tech_data['fork_oil_level']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($tech_data['fork_oil_type']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($models_lst['cylinders']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($models_lst['valves_per_cyl']); ?>
    </td>

</tr>
<?php
}
?>
</table>
</p>
<?php
//print_r($phones_lst_array);
include('footer.php');
?>
