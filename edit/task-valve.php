<?php 
$wrkgr_lst_query=mysql_query("SELECT * FROM works_groups");
$wrk_lst_query=mysql_query("SELECT * FROM works_types");

$bike_lst_query=mysql_query("SELECT cylinders, valves_per_cyl, eng_type FROM models WHERE id=(SELECT model from bike WHERE id=(SELECT bike FROM tasks WHERE id='".$_GET['id']."'))");
$spec=mysql_fetch_array($bike_lst_query, MYSQL_ASSOC);
$clear_query=mysql_query("SELECT valve_in,valve_ex FROM tech_data WHERE model_id=(SELECT model from bike WHERE id=(SELECT bike FROM tasks WHERE id='".$_GET['id']."'))");
$clear=mysql_fetch_array($clear_query,MYSQL_ASSOC);
$valves_query=mysql_query("SELECT * FROM valve_clearances where task_id='".$_GET['id']."'");
$valves=mysql_fetch_array($valves_query,MYSQL_ASSOC);

$exist=mysql_query("SELECT COUNT(valvenum) as valvecount FROM valve_clearances where task_id='".$_GET['id']."' GROUP BY task_id");
$exist=mysql_fetch_array($exist);
if (!isset($exist['valvecount'])) {$exist['valvecount']=0;}
echo "Valves in database for this task:".$exist['valvecount']."<br>";

//print_r ($valves);
//echo "A%B=".(integer)(3/2);
echo "Valve clearances from service manual: IN:".$clear['valve_in']." EX:".$clear['valve_ex']."<br>";
$ex_valves=(integer)($spec['valves_per_cyl']/2);
$in_valves=$spec['valves_per_cyl']-$ex_valves;
echo $spec['eng_type']."<br>";
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
<?php 
    switch($spec['eng_type']) {
    case 'I':
?>
<b>Измеренные зазоры</b>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor=white></td>
<?php
    for ($i=1;$i<=$spec['cylinders'];$i++) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
$valve_num=1;
	for ($i=1;$i<=($ex_valves*$spec['cylinders']);$i++) { 
		$clearance=mysql_query("SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";    
	$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		$clearance=mysql_query("SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
	$valve_num++;
	}
    ?>

</tr>
</table>

<b>Установленные шайбы до регулировки</b>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor=white></td>
<?php
    for ($i=1;$i<=$spec['cylinders'];$i++) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
$valve_num=1;
	for ($i=1;$i<=($ex_valves*$spec['cylinders']);$i++) {
		$shim_before=mysql_query("SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_before=mysql_fetch_array($shim_before,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$shim_before['shim_before']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		$shim_before=mysql_query("SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_before=mysql_fetch_array($shim_before,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$shim_before['shim_before']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
</table>

<b>Нужны шайбы</b>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor=white></td>
<?php
    for ($i=1;$i<=$spec['cylinders'];$i++) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
$valve_num=1;
	for ($i=1;$i<=($ex_valves*$spec['cylinders']);$i++) {
		$shim_need=mysql_query("SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_need=mysql_fetch_array($shim_need,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$shim_need['shim_need']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		$shim_need=mysql_query("SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_need=mysql_fetch_array($shim_need,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$shim_need['shim_need']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
</table>

<b>Шайбы после регулировки</b>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor=white></td>
<?php
    for ($i=1;$i<=$spec['cylinders'];$i++) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
$valve_num=1;
	for ($i=1;$i<=($ex_valves*$spec['cylinders']);$i++) {
		$shim_installed=mysql_query("SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_installed=mysql_fetch_array($shim_installed,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$shim_installed['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		$shim_installed=mysql_query("SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_installed=mysql_fetch_array($shim_installed,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$shim_installed['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
</table>
<?php break;
    case 'V':
	if ($spec['cylinders']<=2) {echo "<table><tr><td>";}
?>

<b>Измеренные зазоры</b>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor=white></td>
<?php
    for ($i=1;$i<=($spec['cylinders']);($i=$i+2)) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
$valve_num=1;
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
	$valve_num++;
	}
    ?>

</tr>
<tr>
<td bgcolor=white></td>
<?php
    for ($i=2;$i<=($spec['cylinders']);($i=$i+2)) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
	$valve_num++;
	}
    ?>

</tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
		$valve_num++;
	}
    ?>
</tr>

</table>
<?php if ($spec['cylinders']<=2) {echo "</td><td align=center>";}?>
<b>Установленные шайбы до регулировки</b>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor=white></td>
<?php
    for ($i=1;$i<=($spec['cylinders']);($i=$i+2)) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
$valve_num=1;
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$clearance['shim_before']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
		for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$clearance['shim_before']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<tr>
<td bgcolor=white></td>
<?php
    for ($i=2;$i<=($spec['cylinders']);($i=$i+2)) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$clearance['shim_before']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$clearance['shim_before']."'></td>";
		$valve_num++;
	}
    ?>
</tr>

</table>
<?php if ($spec['cylinders']<=2) {echo "</td></tr><tr><td>";} ?>
<b>Нужны шайбы</b>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor=white></td>
<?php
    for ($i=1;$i<=($spec['cylinders']);($i=$i+2)) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
$valve_num=1;
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$clearance['shim_need']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$clearance['shim_need']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<tr>
<td bgcolor=white></td>
<?php
    for ($i=2;$i<=($spec['cylinders']);($i=$i+2)) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$clearance['shim_need']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$clearance['shim_need']."'></td>";
		$valve_num++;
	}
    ?>
</tr>

</table>
<?php if ($spec['cylinders']<=2) {echo "</td><td align=center>";} ?>
<b>Шайбы после регулировки</b>
<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor=white></td>
<?php
    for ($i=1;$i<=($spec['cylinders']);($i=$i+2)) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>EX</td>
    <?php
$valve_num=1;
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$clearance['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$clearance['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<tr>
<td bgcolor=white></td>
<?php
    for ($i=2;$i<=($spec['cylinders']);($i=$i+2)) {
	echo "<td colspan='".$in_valves."' bgcolor=white align=center>".$i."</td>";
    }
?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$clearance['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysql_query("SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysql_fetch_array($clearance,MYSQL_ASSOC);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$clearance['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>
</tr>

</table>

<?php
    if ($spec['cylinders']<=2) {echo "</td></tr></table>";}
    break;

}
?>