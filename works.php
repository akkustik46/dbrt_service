<?php
include('test-auth.php');
include('top.php');
include('menu.php');
if (!isset($_GET['action'])) {$_GET['action']='all';}

?>
<br>
<br>
<?php 
if ($_SESSION['login']=='admin') {
 echo "<p style=\"margin-left: 50px\">".
"<a href='add/w_group.php' target='_blank' onClick=\"popupWin = window.open(this.href, 'AddWorksGroup', 'width=470,height=380,top=200,left=60'); popupWin.focus(); return false;\">Добавить группу </a>".
"<a href='add/works.php' target='_blank' onClick=\"popupWin = window.open(this.href, 'AddWorks', 'width=470,height=380,top=200,left=60'); popupWin.focus(); return false;\"> Добавить работы</a>".
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
<div style="margin-left:10px;">
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black" style="margin-left: 50px">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Группа'); ?>
    </td>
</tr>
<?php
$wgr_lst_query=mysqli_query($db, "SELECT * from works_groups ORDER BY name asc");

$x=1;
while ($wgr_lst = mysqli_fetch_array($wgr_lst_query)) {
      $wgr_lst_array[] = array('id' => $wgr_lst['id'],
				'name' => $wgr_lst['name']);

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;
?>

<tr style="cursor: hand" bgcolor='<?php echo $bg; ?>' onMouseOver="this.style.backgroundColor='white';" onMouseOut="this.style.backgroundColor='<?php echo $bg; ?>';"onclick="window.location.href='works.php?id=<?php echo ($wgr_lst['id']); ?>'; return false">
    <td>
    <?php echo ($wgr_lst['id']); ?>
    </td>
    <td>
    <?php echo ($wgr_lst['name']); ?>
    </td>

</tr>
<?php
}
?>
</table>
<div>
<div style="position:fixed;margin-left:220px;margin-top:-155px">
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Работы'); ?>
    </td>
</tr>
<?php
$wrk_lst_query=mysqli_query($db, "SELECT * from works_types where group_id='".$_GET['id']."' ORDER BY name asc");

$x=1;
while ($wrk_lst = mysqli_fetch_array($wrk_lst_query)) {
      $wrk_lst_array[] = array('id' => $wrk_lst['id'],
				'name' => $wrk_lst['name']);

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;
?>
<tr bgcolor='<?php echo $bg; ?>'>
    <td>
    <?php echo ($wrk_lst['id']); ?>
    </td>
    <td>
    <?php echo ($wrk_lst['name']); ?>
    </td>

</tr>
<?php
}
?>
</table>
</div>

</p>
<?php
//print_r($phones_lst_array);
include('footer.php');
?>
