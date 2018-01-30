<?php 
session_start();
if (!isset($_SESSION['login'])) {
header('Refresh: 0; index.php');
}
?>
<?php /*
<a href="zayavki.php">Заявки</a>
<a href="hardware.php">Оборудование</a>
<a href="admin.php">Администрирование</a>
<a href="addres.php">Состояния</a>
<a href="topology.php">Топология</a>
<div style="float:right">
<ul id="nav">
*/
?>
<div style="float:left">
<ul id="nav">
<?php /*
<li><a href="zayavki.php">Заявки</a></li>
*/ ?>
<?php 
include('db_conn.php');
//$dep_lst_query=mysql_query("SELECT * from departments WHERE departments.parent_id='0' ORDER BY departments.dep_name");

?>
<li>
<a href="#" class="button1">SB Base</a>
<ul>
<li><a href="sblist.php?action=all" class="button1">ALL</a></li>
<li><a href="sblist.php?action=737" class="button1">737</a></li>
<li><a href="sblist.php?action=767" class="button1">767</a></li>
</ul>
</li>

<?php
    $user_query=mysqli_query($db,"select position from users where users.name='".$_SESSION['login']."'");
    $user_pos=mysqli_fetch_array($user_query);
    if ($user_pos['position']=='3' or $user_pos['position']=='5') { echo "<li>
		<a href='sb_send.php' class='button1'>Send to Eval</a>
		<ul>
		</ul>
		</li>";}
?>

<?php /*
<li>
<a href="#" class="button1">Картриджи</a>

<ul>
<li><a href="cartriges.php" class="button1">Наличие Киев</a></li>
<li><a href="cartriges-bor.php" class="button1">Наличие Борисполь</a></li>
<li><a href="cartriges.php?page=report" class="button1">Отчет</a></li>
</ul>
</li>

<li>
<a href="#" class="button1">Админка</a>

<ul>
<li><a href="admin.php?action=phones" class="button1">Номера тел.</a></li>
<li><a href="admin.php?action=dep" class="button1">Отделы</a></li>
<li><a href="admin.php?action=admin" class="button1">Администраторы</a></li>
<li><a href="admin.php?action=bld" class="button1">Здания</a></li>
<li><a href="admin.php?action=models" class="button1">Модели ПК</a></li>
</ul>
</li>

<li>
<a href="addres.php" class="button1">Состояния</a>
</li>
*/ 
?>
<?php /*
<li><a href="topology.php">Топология</a></li>



<li>
<a href="#" class="button1">Контрагенты</a>

<ul>
<li><a href="kontragenty.php" class="button1">Контрагенты</a></li>
<li><a href="kontragenty.php?page=bills" class="button1">Счета</a></li>
</ul>
</li>
*/ ?>
<li>
<a href="users.php" class="button1">Users</a>
<?php /*
<ul>

<li><a href="supplies.php?action=list" class="button1">Список</a></li>
<li><a href="supplies.php?action=issue" class="button1">Выдать</a></li>
</ul>
*/ ?>
</li>



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
$oper_query=mysqli_query($db,"SELECT users.name FROM users WHERE users.name='" . $_SESSION['login'] . "'");
$oper=mysqli_fetch_array($oper_query);
echo $oper['name']; 
//echo($_SERVER['HTTP_USER_AGENT']);
?>

<br>