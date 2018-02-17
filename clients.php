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
<p>
<div style="padding-top: 10px; margin-left: 50px; margin-top: 30px">
<a href='add/client.php' target='_blank' onClick="popupWin = window.open(this.href, 'AddClient', 'location=no,width=470,height=300,top=200,left=60'); popupWin.focus(); return false;"><img src="img/add.svg" width=30px height=30px></a>
</p
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

<table cellspacing="1" cellpadding="2" border="0" bgcolor="black" style="margin-left: 50px">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Имя'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Тел.'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Баланс'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Скидка работы'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Скидка товары'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Зарегистрирован'); ?>
    </td>
</tr>
<?php
$users_lst_query=mysqli_query($db, "SELECT * from clients ORDER BY clients.username asc");

$x=1;
while ($users_lst = mysqli_fetch_array($users_lst_query)) {
      $users_lst_array[] = array('id' => $users_lst['id'],
				'username' => $users_lst['username'],
				'tel1' => $users_lst['tel1'],
				'tel2' => $users_lst['tel2'],
				'comment' => $users_lst['comment'],
				'reg_date' => $users_lst['reg_date'],
				'work_discount' => $users_lst['work_discount'],
				'shop_discount' => $users_lst['shop_discount'],
				'balance' => $users_lst['balance']);

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
    <?php echo ($users_lst['username']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($users_lst['tel1'].' '.$users_lst['tel2']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($users_lst['balance']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($users_lst['work_discount'].'%'); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($users_lst['shop_discount'].'%'); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($users_lst['reg_date']); ?>
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
