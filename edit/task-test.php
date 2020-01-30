<?php 
$wrkgr_lst_query=mysqli_query($db,"SELECT * FROM works_groups");
$wrk_lst_query=mysqli_query($db,"SELECT * FROM works_types");

//$wrkgr_lst=mysql_fetch_array($wrkgr_lst_query,MYSQL_ASSOC);
//print_r($wrkgr_lst);

echo "<script language='javascript'>\n".
	    "var items=1;\n".
	    "function AddItem() {\n".
  "div=document.getElementById(\"wrk\");\n".
  "button=document.getElementById(\"add_wrk\");\n".
  "items++;\n".
  "newitem=\"<select name='wrk_gr[\" + items+ \"]' size='1' onchange='loadCity(this)'>\";\n";
while ($wrkgr_lst=mysqli_fetch_array($wrkgr_lst_query)) {
	$wrkgr_lst_array[] = array('id' => $wrkgr_lst['id'],
                                 'name' => $wrkgr_lst['name']);
echo "newitem+=\"<option value='".$wrkgr_lst['id']."'>".$wrkgr_lst['name']."</option>\";\n";
}
  echo "newitem+=\"</select>\";\n".
  "newitem+=\"<select name='work[\" + items;\n".
  "newitem+=\"]' id='wrk_gr[\" + items + \"]' disabled='disabled'>\";\n";
while ($wrk_lst=mysqli_fetch_array($wrk_lst_query)) {
	$wrk_lst_array[] = array('id' => $wrk_lst['id'],
                                 'name' => $wrk_lst['name']);
echo "newitem+=\"<option value='".$wrk_lst['id']."'>".$wrk_lst['name']."</option>\";\n";
}

    echo "\"</select>\";\n".
  "newnode=document.createElement(\"tr\");\n".
  "newnode.innerHTML=newitem;\n".
  "div.insertBefore(newnode,button);\n".
"}\n".
"</script>\n";

?>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor='white'>Роботи</td><td bgcolor='white'>Тип</td><td bgcolor='white'>Ціна</td><td bgcolor='white'>Виконано</td>
</tr>
<?php
$task_wrk_query=mysqli_query($db,"SELECT * from works WHERE task_id='".$_GET['id']."'"); 
$wrk_sum=0;
while($task_wrk_lst=mysqli_fetch_array($task_wrk_query)) {
		$task_wrk=array('id'=>$task_wrk_lst['id'],
				'type_id'=>$task_wrk_lst['type_id'],
				'price'=>$task_wrk_lst['price'],
				'status'=>$task_wrk_lst['status']);
$wrk=mysqli_query($db,"select works_groups.name as wgr_name, works_types.name as wrk_name from works_groups,works_types where works_groups.id=(SELECT  group_id FROM `works_types` WHERE id='".$task_wrk['type_id']."') and works_types.id='".$task_wrk['type_id']."'");
$wrk=mysqli_fetch_array($wrk);
//$status=mysql_query("SELECT status_name from status WHERE id='".$task_wrk['status']."'");
//$status=mysql_fetch_array($status,MYSQL_ASSOC);
    if ($task_wrk['status']==1) {$wrk_chk='checked';} else {$wrk_chk='';}
	echo "<tr><td bgcolor='white'>".$wrk['wrk_name']."</td><td bgcolor='white'>".$wrk['wgr_name']."</td><td bgcolor='white'><input type=text size=4 name=price[".$task_wrk['id']."] value=".$task_wrk['price']."></input></td><td bgcolor='white' align=center><input type='checkbox' ".$wrk_chk." name='wrk[".$task_wrk['id']."]'></input></td>";
$wrk_sum=$wrk_sum+$task_wrk_lst['price'];
}
 ?>
<tr><td bgcolor='white'><b>Разом за роботи</b></td><td bgcolor='white'></td><td bgcolor='white'><b><?php echo $wrk_sum; ?></b></td><td bgcolor='white'></td></tr>
<input type=hidden name='wrk_sum' value=<?php echo $wrk_sum; ?>>
</table>
<div ID="wrk">
<select name="wrk_gr[1]" onchange="loadCity(this)">
    <option></option>

    <?php
    $wrkgr_lst_query=mysqli_query($db,"SELECT * FROM works_groups");
    while ($wrkgr_lst=mysqli_fetch_array($wrkgr_lst_query)) { 
		$wrkgr=array('id'=>$wrkgr_lst['id'],
				'name'=>$wrkgr_lst['name']);
	// заполняем список областей
    ///foreach ($wrkgr_lst['name'] as $id => $name)
    ///{
	
        echo '<option value="' . $wrkgr['id'] . '">' . $wrkgr['name'] . '</option>' . "\n";
    ///}
    }
///foreach ($wrkgr as $id => $name) {
///	echo '<option value="' . $id . '">' . $name . '</option>' . "\n";
///    }

    ?>

</select>

<select name="work[1]" id="wrk_gr[1]" disabled="disabled">
    <option>Оберіть тип</option>
</select>
<br>
<input type="button" value="Добавить поле" onClick="AddItem();" ID="add_wrk">
</div>
