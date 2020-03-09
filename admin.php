<?php
include('test-auth.php');
include('top.php');
include('menu.php');

switch($_GET['action']) {

case 'phones': 
?>
<br>
 <p>
<a href="add/phone.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddPhone', 'location,width=400,height=300,top=0'); popupWin.focus(); return false;">Добавить номер</a>
</p>

<p>

<b>Корпоративные номера</b>
<br>

<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Номер'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Пользователь'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Оператор'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Тариф'); ?>
    </td>

     <td align=center bgcolor=#acacff>
     <?php echo ('Действия'); ?>
     </td>
</tr>
<?php
$phones_lst_query=mysql_query("SELECT * FROM phones");
$x=1;
while ($phones_lst = mysql_fetch_array($phones_lst_query)) {
      $phones_lst_array[] = array('id' => $phones_lst['id'],
				'num' => $phones_lst['num'],
				'operator' => $phones_lst['operator'],
				'tarif' => $phones_lst['tarif']);

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
    <?php echo ($phones_lst['id']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($phones_lst['num']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ''; ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($phones_lst['operator']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($phones_lst['tarif']); ?>
    </td>

    <td align=center bgcolor=<?php echo $bg; ?>>
        <a class="tt" href="edit/phone_edit.php?<?php echo 'id=' . $phones_lst['id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'CartEdit', 'location,width=600,height=400,top=0');
     popupWin.focus(); return false;"><img src='images/edit.png' alt='Редактировать'>
      <span>Редактировать</span>
   </a>
        <a class="tt" href="edit/phone_del.php?<?php echo 'id=' . $phones_lst['id']; ?>
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
break;

case 'dep':
?>
<br>
 <p>
<a href="add/dep.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddDep', 'location,width=400,height=300,top=0'); popupWin.focus(); return false;">Добавить отдел</a>
</p>

<p>
<b>Отделы</b>
<br>

<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Отдел'); ?>
    </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('Действия'); ?>
     </td>
</tr>
<?php
$dep_lst_query=mysql_query("SELECT * FROM departments");
$x=1;
while ($dep_lst = mysql_fetch_array($dep_lst_query)) {
      $dep_lst_array[] = array('dep_id' => $dep_lst['dep_id'],
				'dep_name' => $dep_lst['dep_name']);

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
    <?php echo ($dep_lst['dep_id']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($dep_lst['dep_name']); ?>
    </td>

    <td align=center bgcolor=<?php echo $bg; ?>>
        <a class="tt" href="edit/dep_edit.php?<?php echo 'id=' . $dep_lst['dep_id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'DepEdit', 'location,width=600,height=400,top=0');
     popupWin.focus(); return false;"><img src='images/edit.png' alt='Редактировать'>
      <span>Редактировать</span>
   </a>
        <a class="tt" href="edit/dep_del.php?<?php echo 'id=' . $dep_lst['dep_id']; ?>
 " target="_blank" onclick="if(confirm('Уверены что хотите удалить?')) return true; else return false;"><img src='images/delete.png' alt='Удалить'>
          <span>Удалить</span>
   </a>
   </td>
</tr>
<?php
}
?>
</table>


<?php
break;
case 'models':
?>
<br>
 <p>
<a href="add/model.php" target="_blank" onClick="popupWin = window.open(this.href, 'AddModel', 'location,width=400,height=300,top=0'); popupWin.focus(); return false;">Добавить модель ПК</a>
</p>

<p>
<b>Модели ПК</b>
<br>

<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
    <tr>
    <td align=center bgcolor=#acacff>
    <?php echo ('  ID  '); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Модель'); ?>
    </td>
    <td align=center bgcolor=#acacff>
    <?php echo ('Тип'); ?>
    </td>
     <td align=center bgcolor=#acacff>
     <?php echo ('Действия'); ?>
     </td>
</tr>
<?php
$model_lst_query=mysql_query("SELECT * FROM ws_models");
$x=1;
while ($model_lst = mysql_fetch_array($model_lst_query)) {
      $model_lst_array[] = array('ws_model_id' => $model_lst['ws_model_id'],
				'ws_model_name' => $model_lst['ws_model_name'],
				'ws_model_type' => $model_lst['ws_model_type']);

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
    <?php echo ($model_lst['ws_model_id']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php echo ($model_lst['ws_model_name']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?>>
    <?php 
    if ($model_lst['ws_model_type']=='0') {
    echo 'Ноутбук';
    } else {
     echo 'Стационарный ПК';
    } ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
        <a class="tt" href="edit/model_edit.php?<?php echo 'id=' . $model_lst['ws_model_id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'ModelEdit', 'location,width=600,height=400,top=0');
     popupWin.focus(); return false;"><img src='images/edit.png' alt='Редактировать'>
      <span>Редактировать</span>
   </a>
        <a class="tt" href="edit/model_del.php?<?php echo 'id=' . $model_lst['ws_model_id']; ?>
 " target="_blank" onclick="if(confirm('Уверены что хотите удалить?')) return true; else return false;"><img src='images/delete.png' alt='Удалить'>
          <span>Удалить</span>
   </a>
   </td>
</tr>
<?php
}
?>
</table>
<?php
break;
}
include('footer.php');
?>
