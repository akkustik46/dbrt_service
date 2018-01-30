<?php
//echo ($_SESSION['login']);
$noty_query=mysqli_query($db,"SELECT * FROM new_sb_toeval where (new_sb_toeval.user=(SELECT users.id FROM users WHERE users.name='".$_SESSION['login']."') and new_sb_toeval.eval='0')");
?>
<table width=100%>
<?php
while ($noty_lst_array = mysqli_fetch_array($noty_query)) {

?>
    <tr>
	<td>
		<font color='red'><?php echo ($noty_lst_array['name']); ?><br></font>
	</td>
	<td align=right>
	    <a href="edit/notify.php?<?php echo 'id=' . $noty_lst_array['id']; ?>
    " target="_blank" onClick="popupWin = window.open(this.href, 'Notydel', 'location,width=200,height=100,top=0');
     popupWin.focus(); return false;">OK

   </a>

	</td>
    </tr>
<?php
}
//print_r($noty_query);

?>
</table>
