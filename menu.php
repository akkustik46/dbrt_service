<?php 
session_start();
if (!isset($_SESSION['login'])) {
header('Refresh: 0; index.php');
}
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
<a href="tasks.php" class="button1">Заказы</a>
<ul>
<li><a href="sblist.php?action=all" class="button1">ALL</a></li>
<li><a href="sblist.php?action=737" class="button1">737</a></li>
<li><a href="sblist.php?action=767" class="button1">767</a></li>
</ul>
</li>
<li>
<a href="" class="button1">Справочник</a>
<ul>
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
?>

<br>