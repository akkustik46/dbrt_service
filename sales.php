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
"<a href='add/prod-add-new.php' target='_blank' onClick=\"popupWin = window.open(this.href, 'AddProd', 'location=no,width=470,height=300,top=200,left=60'); popupWin.focus(); return false;\">Добавить товар</a>".
"<a href='add/prod-sale.php' target='_blank' onClick=\"popupWin = window.open(this.href, 'SaleProd', 'location=no,width=500,height=400,top=150,left=460'); popupWin.focus(); return false;\" style=padding-left:10px;>Продажа</a>".
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
<form action="sales.php" method="post">
<input type="date" name="from">
<input type="date" name="till">
<input type="submit">
<?php 


if ($_POST['from'] || $_POST['till'] !== 'null') {

$_POST['from'] .= " 00:00:00";
$_POST['till'] .= " 23:59:59";
echo "from ".$_POST['from']. " to ". $_POST['till'];

?>    
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black" style="margin-left: 50px">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo (' Наименование '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Кол-во'); ?>
    </td>

</tr>
<?php

$sale_lst_query=mysqli_query($db, "SELECT prod, sum(qty) as sum from prod_sale WHERE prod_sale.date_sale>'".$_POST['from']."' AND prod_sale.date_sale<'".$_POST['till']."' GROUP BY prod");
//print_r("SELECT * from prod_sale WHERE prod_sale.date_sale>'".$_POST['from']."' AND prod_sale.date_sale<'".$_POST['till']."' ORDER BY prod_sale.date_sale asc");

$x=1;
while ($sale_lst = mysqli_fetch_array($sale_lst_query)) {
      $sale_lst_array[] = array('prod' => $sale_lst['prod'],
				'sum' => $sale_lst['sum']);

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;
?>
<?php /*$b_qty=mysqli_query($db, "SELECT sum(qty) as b_qty from prod_buy where prod='".$prod_lst['id']."'");
    $b_qty=mysqli_fetch_array($b_qty);
    $s_qty=mysqli_query($db, "SELECT sum(qty) as s_qty from prod_sale where prod='".$prod_lst['id']."'");
    $s_qty=mysqli_fetch_array($s_qty);*/
//mysqli_query($db,"UPDATE prod_prod set qty='".($b_qty['b_qty']-$s_qty['s_qty'])."' where id='".$prod_lst['id']."'");
?>
<tr>
    <td bgcolor=<?php echo $bg; ?>>
    <?php
    $name=mysqli_query($db,"SELECT name from prod_prod WHERE id='".$sale_lst['prod']."'");
$name=mysqli_fetch_array($name);
 echo ($name['name']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($sale_lst['sum']); ?>
    </td>

</tr>
<?php
}
?>
</table>
</p>
<?php
}

//print_r($phones_lst_array);
include('footer.php');
?>
