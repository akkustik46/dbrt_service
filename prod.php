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

<table cellspacing="1" cellpadding="2" border="0" bgcolor="black" style="margin-left: 50px">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Категорія'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Виробник'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Товар'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Ціна, грн.'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('од виміру'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Залишок'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Action'); ?>
    </td>

</tr>
<?php
$prod_lst_query=mysqli_query($db, "SELECT * from prod_prod ORDER BY prod_prod.category asc");

$x=1;
while ($prod_lst = mysqli_fetch_array($prod_lst_query)) {
      $prod_lst_array[] = array('id' => $prod_lst['id'],
				'category' => $prod_lst['category'],
				'manufacturer' => $prod_lst['manufacturer'],
				'name' => $prod_lst['name'],
				'price_out' => $prod_lst['price_out'],
				'units' => $prod_lst['units'],
				'qty' => $prod_lst['qty'],
				'price_in' => $prod_lst['price_in'],
				'currency' => $prod_lst['currency']);

$bg=$x%2;
if ($bg===0) {
$bg='#ddddee';
} else {
$bg='#ccccee';
}
$x++;
?>
<?php $b_qty=mysqli_query($db, "SELECT sum(qty) as b_qty from prod_buy where prod='".$prod_lst['id']."'");
    $b_qty=mysqli_fetch_array($b_qty);
    $s_qty=mysqli_query($db, "SELECT sum(qty) as s_qty from prod_sale where prod='".$prod_lst['id']."'");
    $s_qty=mysqli_fetch_array($s_qty);
//mysqli_query($db,"UPDATE prod_prod set qty='".($b_qty['b_qty']-$s_qty['s_qty'])."' where id='".$prod_lst['id']."'");
?>
<tr>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($prod_lst['id']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php 
	$cat=mysqli_query($db, "SELECT name from prod_category where id='".$prod_lst['category']."'");
	$cat=mysqli_fetch_array($cat);
	echo ($cat['name']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php $man=mysqli_query($db, "SELECT name from prod_mnf where id='".$prod_lst['manufacturer']."'");
	$man=mysqli_fetch_array($man);
	echo ($man['name']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($prod_lst['name']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php if ($prod_lst['currency']!=1) {
			$currency=mysqli_query($db, "SELECT name,value FROM currency where id='".$prod_lst['currency']."'");
			$currency=mysqli_fetch_array($currency);
			echo ("<p title=".round($prod_lst['price_in']*$currency['value'],2).">".round($prod_lst['price_out']*$currency['value'],-1)."</p>");
	    } ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($prod_lst['units']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ($b_qty['b_qty']-$s_qty['s_qty']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> align=right>
    <?php echo ("<a href='add/prod-add-qty.php?id=".$prod_lst['id']."' target='_blank' onClick=\"popupWin = window.open(this.href, 'AddProd', 'location=no,width=470,height=300,top=200,left=60'); popupWin.focus(); return false;\">
    <img src=/images/icon_plus.gif></a>");
    ?>
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
