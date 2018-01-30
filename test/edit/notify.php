<?php
include('../top2.php');
require('../db_conn.php');
session_start();
mysqli_query($db,"UPDATE new_sb_toeval SET new_sb_toeval.eval='1', new_sb_toeval.modified=(select now()) WHERE new_sb_toeval.id='".$_GET['id']."'");

include('../footer.php');
?>
<script>
var tm=10
window.setTimeout("window.close();",tm)
</script>
