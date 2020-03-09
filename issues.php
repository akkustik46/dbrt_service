<?php
include('test-auth.php');
include('top.php');
include('menu.php');
//if (!isset($_GET['action'])) {$_GET['action']='all';}

?>
<br>
<br>
<?php 
if ($_SESSION['login']=='admin') {
 echo "<p style=\"margin-left: 50px\">".
"<a href='add/issue.php' target='_blank' onClick=\"popupWin = window.open(this.href, 'AddIssue', 'width=470,height=380,top=200,left=60'); popupWin.focus(); return false;\">Добавить проблему</a>".
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
    <td align=center bgcolor=#acacff width=350px>
    <?php echo ('Симптомы'); ?>
    </td>
    <td align=center bgcolor=#acacff width=350px>
    <?php echo ('Проблема'); ?>
    </td>
</tr>
<?php
$issues_lst_query=mysqli_query($db, "SELECT * from known_issues");

$x=1;
while ($issues_lst = mysqli_fetch_array($issues_lst_query)) {
      $issues_lst_array[] = array('id' => $issues_lst['id'],
				'model_id' => $issues_lst['model_id'],
				'symptoms' => $issues_lst['symptoms'],
				'issue' => $issues_lst['issue']);

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
    <?php echo ($issues_lst['id']); ?>
    </td>
<?php $bike=mysqli_query($db,"SELECT mnf.mnf_name, models.model, models.capacity, models.year_begin,models.year_end from mnf,models where mnf.id=(select mnf_id from models where id='".$issues_lst['model_id']."') and models.id='".$issues_lst['model_id']."'");
	$bike=mysqli_fetch_array($bike, MYSQL_ASSOC);
?>
    <td bgcolor=<?php echo $bg; ?>>
    <?php //$mnf=mysqli_query($db,"SELECT mnf_name from mnf where mnf.id='".$models_lst['mnf_id']."'");
	    //$mnf=mysqli_fetch_array($mnf);
	    echo ($bike['mnf_name']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($bike['model'].' '.$bike['capacity']); ?>
    </td>
    <td align=center bgcolor=<?php echo $bg; ?>>
    <?php echo ($bike['year_begin'].'-'.$bike['year_end']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> width=350px>
    <?php echo ($issues_lst['symptoms']); ?>
    </td>
    <td bgcolor=<?php echo $bg; ?> width=350px>
    <?php echo ($issues_lst['issue']); ?>
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
