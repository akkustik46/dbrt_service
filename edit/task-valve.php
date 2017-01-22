<?php 
$wrkgr_lst_query=mysql_query("SELECT * FROM works_groups");
$wrk_lst_query=mysql_query("SELECT * FROM works_types");

$bike_lst_query=mysql_query("SELECT cylinders, valves_per_cyl FROM models WHERE id=(SELECT model from bike WHERE id=(SELECT bike FROM tasks WHERE id='".$_GET['id']."'))");
$spec=mysql_fetch_array($bike_lst_query, MYSQL_ASSOC);
$clear_query=mysql_query("SELECT valve_in,valve_ex FROM tech_data WHERE model_id=(SELECT model from bike WHERE id=(SELECT bike FROM tasks WHERE id='".$_GET['id']."'))");
$clear=mysql_fetch_array($clear_query,MYSQL_ASSOC);
print_r ($spec);

print_r ($clear);

echo "A%B=".(integer)(3/2);
$ex_valves=(integer)($spec['valves_per_cyl']/2);
$in_valves=$spec['valves_per_cyl']-$ex_valves;

//$wrkgr_lst=mysql_fetch_array($wrkgr_lst_query,MYSQL_ASSOC);
//print_r($wrkgr_lst);
/*
echo "<script language='javascript'>\n".
	    "var items=1;\n".
	    "function AddItem() {\n".
  "div=document.getElementById(\"items\");\n".
  "button=document.getElementById(\"add\");\n".
  "items++;\n".
  "newitem=\"<select name='wrk_gr[\" + items+ \"]' size='1' onchange='loadCity(this)'>\";\n";
while ($wrkgr_lst=mysql_fetch_array($wrkgr_lst_query)) {
	$wrkgr_lst_array[] = array('id' => $wrkgr_lst['id'],
                                 'name' => $wrkgr_lst['name']);
echo "newitem+=\"<option value='".$wrkgr_lst['id']."'>".$wrkgr_lst['name']."</option>\";\n";
}
  echo "newitem+=\"</select>\";\n".
  "newitem+=\"<select name='work[\" + items;\n".
  "newitem+=\"]' id='wrk_gr[\" + items + \"]' disabled='disabled'>\";\n";
while ($wrk_lst=mysql_fetch_array($wrk_lst_query)) {
	$wrk_lst_array[] = array('id' => $wrk_lst['id'],
                                 'name' => $wrk_lst['name']);
echo "newitem+=\"<option value='".$wrk_lst['id']."'>".$wrk_lst['name']."</option>\";\n";
}

    echo "\"</select>\";\n".
  "newnode=document.createElement(\"p\");\n".
  "newnode.innerHTML=newitem;\n".
  "div.insertBefore(newnode,button);\n".
"}\n".
"</script>\n";
*/
?>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td></td>
<?php
    for ($i=1;$i<=$spec['cylinders'];$i++) {
	echo "<td colspan='".$in_valves."' bgcolor=white>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=($ex_valves*$spec['cylinders']);$i++) { 
		echo "<td bgcolor=white>0.25</td>";    
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		echo "<td bgcolor=white>0.15</td>";
	}
    ?>

</tr>
</table>

