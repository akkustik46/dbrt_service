<?php
if (isset($_SESSION['login'])) {
header('Refresh: 1; location: index.php');
exit;
}
include('top3.php');
include('menu.php');

$tasks_query=mysqli_query($db,"SELECT * FROM tasks where bike=".$_GET['bike_id']);


?>