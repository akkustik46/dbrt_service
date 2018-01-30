<?php
if (isset($_SESSION['login'])) {
header('Refresh: 3; location: index.php');
exit;
}

include('top.php');
include('menu.php');

?>
<br>
 <p>
<a href="add/cartriges.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddCart', 'location,width=400,height=300,top=0'); popupWin.focus(); return false;">Добавить тип</a>
<a href="add/cart-output.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddCart', 'location,width=500,height=550,top=0,scrollbars=yes'); popupWin.focus(); return false;">Выдать картридж</a>
<a href="add/cart-charge.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddCart', 'location,width=800,height=500,top=0,scrollbars=yes'); popupWin.focus(); return false;">Заправка</a>
<a href="add/cart-add.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddCart', 'location,width=850,height=500,top=0,scrollbars=yes'); popupWin.focus(); return false;">Добавить в наличие</a>
<a href="add/cart-charge-proc.php?action=all" target="_self" onClick="if(confirm('Уверены что хотите отправить все на заправку?')) return true; else return false;">На заправку все</a>
</p>

<p>

<b>Наличие картриджей</b>
<br>

<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Тип'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Принтер'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('В наличии'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Пустые'); ?>
    </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('На заправке'); ?>
     </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('Посл. действ.'); ?>
     </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('Действия'); ?>
     </td>
</tr>
<?php
$cart_lst_query=mysql_query("SELECT * FROM cartriges_work");
$x=1;
while ($cart_lst = mysql_fetch_array($cart_lst_query)) {
      $cart_lst_array[] = array('cart_wrk_id' => $cart_lst['cart_wrk_id'],
				'cart_wrk_type' => $cart_lst['cart_wrk_type'],
				'cart_wrk_empty' => $cart_lst['cart_wrk_empty'],
				'cart_wrk_full' => $cart_lst['cart_wrk_full'],
				'cart_wrk_oncharge' => $cart_lst['cart_wrk_oncharge'],
				'cart_wrk_printer' => $cart_lst['cart_wrk_printer'],
				'cart_wrk_change' => $cart_lst['cart_wrk_change']);

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
    <?php echo ($cart_lst['cart_wrk_id']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($cart_lst['cart_wrk_type']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($cart_lst['cart_wrk_printer']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php if ($cart_lst['cart_wrk_full']<>0) {
    echo ($cart_lst['cart_wrk_full']);
    } else {
    echo('---');
    } ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php if ($cart_lst['cart_wrk_empty']<>0) {
    echo ($cart_lst['cart_wrk_empty']);
    } else {
    echo('---');
    } ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php if ($cart_lst['cart_wrk_oncharge']<>0) {
    echo ($cart_lst['cart_wrk_oncharge']);
    } else {
    echo('---');
    } ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($cart_lst['cart_wrk_change']); ?>
    </td>

    <td align=center bgcolor=<?php echo $bg; ?>>
        <a class="tt" href="edit/cart_edit.php?<?php echo 'id=' . $cart_lst['cart_wrk_id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'CartEdit', 'location,width=600,height=400,top=0');
     popupWin.focus(); return false;"><img src='images/edit.png' alt='Редактировать'>
      <span>Редактировать</span>
   </a>
        <a class="tt" href="edit/cart_del.php?<?php echo 'id=' . $cart_lst['cart_wrk_id']; ?>
 " target="_blank" onclick="if(confirm('Уверены что хотите удалить?')) return true; else return false;"><img src='images/delete.png' alt='Удалить'>
          <span>Удалить</span>
   </a>
   </td>
</tr>
<?php
}
?>
</table>

</p>

<?php
include('footer.php');
?>
