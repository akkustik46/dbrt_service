<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<head>
<title>Страница авторизации</title>
</head>
<body bgcolor=#dcdcdc>

<?php
session_start(); //инициализирум механизм сесссий
//print_r($_SESSION);
require('db_conn.php');
if(!isset($_POST['ok'])) {
// если форма не заполнена, то выводим ее
echo"
<table width='100%' height='100%'>
<form method='POST' action='index.php'>
<tr><td align=center>
<table>
<tr><td>
<table>
<tr><td>Login:</td><td><input type='text'
        name='login' size='15'></td></tr>
<tr><td>Password:</td><td><input
        type='password' name='pass' size='15'></td></tr>
</table>
</td></tr>
<tr><td align=center><input type='submit' name='ok'
        value='Вход'></td></tr>
</table>
</td></tr>
</form>
</table>
";
}
else{
//предполагается, что информацию о пользователях вы
//храните в базе данных, в таблице users, содержащей поля id, login, pass

$db=mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('dbrt_garage', $db);
mysql_query("SET NAMES 'utf8'");
//проверяем есть ли пользователь с таким loginом и passwordом
$res=mysql_query("SELECT * FROM users WHERE users.name='".$_POST['login']."'
        AND users.passwd='".md5($_POST['pass'])."'", $db);
if(mysql_num_rows($res)!=1){//такого пользователя нет
echo "
<table width='100%' height='100%'>
<tr><td align=center>
<table>
<tr><td>
<table>
<tr><td></td></tr>
<tr><td></td>Введены не верные логин или пароль<td></td></tr>
</table>
</td></tr>
<tr><td align=center></td></tr>
</table>
</td></tr>
</table>
";
header( 'Refresh: 3;' );
}
else{//пользователь найден
$_SESSION['login']=$_POST['login'];//устанавливаем login & pass
$_SESSION['pass']=$_POST['pass'];
Header("Location: tasks.php");// еренаправляем на protected.php

}

mysql_close();
unset($_SESSION['pass']);
}
?>
</body>
</html>