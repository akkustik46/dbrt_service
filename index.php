<?php
require('db_conn.php');
session_start();

if($_POST['login'] == "" OR $_POST['pass'] == ""){ 
header("Location: index.html"); //Возвращаем пользователя на форму входа, в случае если он не ввел данные входа.
} else {
$pass = md5($_POST['pass']); //Определение для пароля.
$login = $_POST['login']; //Определение для входа.
$pro = mysqli_query($db,"SELECT * FROM users WHERE name='".$login."' AND passwd='".$pass."'"); //Запрашиваем список пользователей с полученными данными.
$res = mysqli_fetch_array($pro); //Сокращаем.
if($pro->num_rows == '0'){
header("Location: login.html"); //Если пользователей не найдено, то скидываем посетителя обратно на форму входа.
}else{ //Если все-же найдены пользователи с таким же логином и паролем, то..
$_SESSION['username'] = $res['name']; //Ставим инфу сессии.
$_SESSION['pass'] = $res['passwd']; //Ставим инфу сессии.
header("Location: tasks.php"); //Перекидываем пользователя на индексную страницу сайта.
}
}
?>
