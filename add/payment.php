<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");

?>
<form action="payment-proc.php" method="post">
Добавить платеж<br>
<input type=hidden name=id value=<?php echo $_GET['id'];?>>
<table border=0>
<tr><td>Сумма</td><td><input type=text name=sum size=6></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Добавить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');

?>
