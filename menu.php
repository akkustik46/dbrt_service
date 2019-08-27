<?php 
session_start();
if (!isset($_SESSION['login'])) {
header('Refresh: 0; index.php');
}
?>
<div style="float:left">
<?php //<ul id="nav">
 /*
<li><a href="zayavki.php">Заявки</a></li>
*/ ?>
<?php
include('db_conn.php');
//$dep_lst_query=mysql_query("SELECT * from departments WHERE departments.parent_id='0' ORDER BY departments.dep_name");
?>
<nav class="menu">
<ul class="topmenu">
?>
<li>
<a href="tasks.php?action=all" class="button1">Заказы</a>
    <ul class="submenu">
	<li><a href="tasks.php?action=archive" class="button1">Архив</a></li>
    </ul>
</li>
<li>

<a href="" class="button1">Справочник</a>
    <ul class="submenu">
	<li><a href="clients.php" class="button1">Клиенты</a></li>
	<li><a href="bikes.php" class="button1">Мотоциклы</a></li>
	<li><a href="models.php" class="button1">Модели</a></li>
	<li><a href="works.php" class="button1">Работы</a></li>
	<li><a href="issues.php" class="button1">Извесные проблемы</a></li>
    </ul>
</li>
<?php
/*    $user_query=mysqli_query($db,"select position, restricted_parts from users where users.name='".$_SESSION['login']."'");
    $user_pos=mysqli_fetch_array($user_query);
    if ($user_pos['position']=='3' or $user_pos['position']=='5') { echo "<li>
		<a href='sb_send.php' class='button1'>Send to Eval</a>
		<ul>
		</ul>
		</li>";}*/
?>
<li>
<a href="prod.php" class="button1">Склад</a>
    <ul class="submenu">
	<li><a href="sales.php" class="button1">Продажи за период</a></li>
    </ul>
</li>

<li>
<a href="users.php" class="button1">Users</a>
</li>

<?php /*if ($user_pos['restricted_parts']=='1') {
	$ac_type=mysqli_query($db, "SELECT * FROM aircrafts_types");
//	$ac_type_lst=mysqli_fetch_array($ac_type);
            echo '<li>
	    <a href="restricted_list.php?action=all" class="button1">Restricted Parts</a>
	    <ul>';
while ($type_lst = mysqli_fetch_array($ac_type)) {
      $type_lst_array[] = array('id' => $type_lst['id'],
                                 'type' => $type_lst['type']);

echo ('<li><a href="restricted_list.php?action='.$type_lst['id'].'" class="button1">'.$type_lst['type'].'</a></li>');

}
	    echo '</ul>
		    </li>';



    }*/
?>
<li>
<a href="logout.php" class="button1">Logout</a>
</li>
</ul>
</div>
<?php /*
<script type="text/javascript">
startList = function()
{
if (document.all&&document.getElementById)
{
navRoot = document.getElementById("nav")
for (i=0; i<navRoot.childNodes.length; i++)
{
node = navRoot.childNodes[i];
if (node.nodeName=="LI")
{
node.onmouseover=function()
{
this.className+=" over";
}
node.onmouseout=function()
{
this.className=this.className.replace(" over", "");
}
}
}
}
}
window.onload=startList;
</script> 

<?php 
//require('db_conn.php');
//mysql_select_db('asvt-helpdesk', $db);
//mysql_query("SET NAMES 'utf8'");
*/
////$oper_query=mysqli_query($db,"SELECT users.name FROM users WHERE users.name='" . $_SESSION['login'] . "'");
////$oper=mysqli_fetch_array($oper_query);
////echo $oper['name']; 
//echo($_SERVER['HTTP_USER_AGENT']);
//require('db_conn.php');
//mysql_select_db('dbrt_garage', $db);
$cur_query=mysqli_query($db,"SELECT * FROM currency");
//echo("Курс: ");
?>
<div id="currency" style="float:right">
<?php
while ($cur=mysqli_fetch_array($cur_query)) {
		if ($cur['name']=='UAH') {} else {
			echo ($cur['name'].":".round($cur['value'],2)." ");
			$upd=$cur['updated'];
		    }
		}
    echo (" <br> ".$upd);
?>
</div>
