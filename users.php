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
<?php 
if ($_SESSION['login']=='admin') {
 echo "<p>".
"<a href='add/user.php' target='_blank' onClick=\"popupWin = window.open(this.href, 'AddUser', 'location,width=470,height=600,top=0'); popupWin.focus(); return false;\">Add User</a>".
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

<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('UserName'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Position'); ?>
    </td>

</tr>
<?php
$users_lst_query=mysqli_query($db, "SELECT * from users ORDER BY users.name asc");

$x=1;
while ($users_lst = mysqli_fetch_array($users_lst_query)) {
      $users_lst_array[] = array('id' => $users_lst['id'],
				'name' => $users_lst['name'],
				'passwd' => $users_lst['passwd'],
				'permisson' => $users_lst['permisson']);

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
    <?php echo ($users_lst['id']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($users_lst['name']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
<?php
    $pos_lst_query=mysqli_query($db, "SELECT * FROM users_types WHERE users_types.id='".$users_lst['permisson']."'");
    $pos=mysqli_fetch_array($pos_lst_query); ?>
    <?php echo ($pos['type']); ?>
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
