<?php 
$wrkgr_lst_query=mysqli_query($db,"SELECT * FROM works_groups");
$wrk_lst_query=mysqli_query($db,"SELECT * FROM works_types");

$bike_lst_query=mysqli_query($db,"SELECT cylinders, valves_per_cyl, eng_type FROM models WHERE id=(SELECT model from bike WHERE id=(SELECT bike FROM tasks WHERE id='".$_GET['id']."'))");
$spec=mysqli_fetch_array($bike_lst_query);
$clear_query=mysqli_query($db,"SELECT valve_in,valve_ex FROM tech_data WHERE model_id=(SELECT model from bike WHERE id=(SELECT bike FROM tasks WHERE id='".$_GET['id']."'))");
$clear=mysqli_fetch_array($clear_query);
$valves_query=mysqli_query($db,"SELECT * FROM valve_clearances where task_id='".$_GET['id']."'");
$valves=mysqli_fetch_array($valves_query);

$exist=mysqli_query($db,"SELECT COUNT(valvenum) as valvecount FROM valve_clearances where task_id='".$_GET['id']."' GROUP BY task_id");
$exist=mysqli_fetch_array($exist);
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
<b>Виміряні зазори</b>
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
		$clearance=mysqli_query($db,"SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";    
	$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		$clearance=mysqli_query($db,"SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
	$valve_num++;
	}
    ?>

</tr>
</table>

<b>Встановлені шайби до регулювання</b>
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
		$shim_before=mysqli_query($db,"SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_before=mysqli_fetch_array($shim_before);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$shim_before['shim_before']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		$shim_before=mysqli_query($db,"SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_before=mysqli_fetch_array($shim_before);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$shim_before['shim_before']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
</table>

<b>Необхідні шайби</b>
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
		$shim_need=mysqli_query($db,"SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_need=mysqli_fetch_array($shim_need);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$shim_need['shim_need']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		$shim_need=mysqli_query($db,"SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_need=mysqli_fetch_array($shim_need);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$shim_need['shim_need']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
</table>

<b>Шайби після регулювання</b>
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
		$shim_installed=mysqli_query($db,"SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_installed=mysqli_fetch_array($shim_installed);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$shim_installed['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=($in_valves*$spec['cylinders']);$i++) {
		$shim_installed=mysqli_query($db,"SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$shim_installed=mysqli_fetch_array($shim_installed);
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

<b>Виміряні зазори</b>
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
		$clearance=mysqli_query($db,"SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysqli_query($db,"SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
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
		$clearance=mysqli_query($db,"SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
	$valve_num++;
	}
    ?>

</tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysqli_query($db,"SELECT clearance from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=valve[".$valve_num."] value='".$clearance['clearance']."'></td>";
		$valve_num++;
	}
    ?>
</tr>

</table>
<?php if ($spec['cylinders']<=2) {echo "</td><td align=center>";}?>
<b>Встановлені шайби до регулювання</b>
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
		$clearance=mysqli_query($db,"SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$clearance['shim_before']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
		for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysqli_query($db,"SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
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
		$clearance=mysqli_query($db,"SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$clearance['shim_before']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysqli_query($db,"SELECT shim_before from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=shim_before[".$valve_num."] value='".$clearance['shim_before']."'></td>";
		$valve_num++;
	}
    ?>
</tr>

</table>
<?php if ($spec['cylinders']<=2) {echo "</td></tr><tr><td>";} ?>
<b>Необхідні шайби</b>
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
		$clearance=mysqli_query($db,"SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$clearance['shim_need']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysqli_query($db,"SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
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
		$clearance=mysqli_query($db,"SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$clearance['shim_need']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysqli_query($db,"SELECT shim_need from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=shim_need[".$valve_num."] value='".$clearance['shim_need']."'></td>";
		$valve_num++;
	}
    ?>
</tr>

</table>
<?php if ($spec['cylinders']<=2) {echo "</td><td align=center>";} ?>
<b>Шайби після регулювання</b>
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
		$clearance=mysqli_query($db,"SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$clearance['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>
</tr>
<tr>
<td bgcolor=white>IN</td>
    <?php
	for ($i=1;$i<=(($in_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysqli_query($db,"SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
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
		$clearance=mysqli_query($db,"SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
		echo "<td bgcolor=white><input type=text size=5 name=shim_installed[".$valve_num."] value='".$clearance['shim_installed']."'></td>";
		$valve_num++;
	}
    ?>

</tr>
<td bgcolor=white>EX</td>
    <?php
	for ($i=1;$i<=(($ex_valves*$spec['cylinders'])/2);$i++) {
		$clearance=mysqli_query($db,"SELECT shim_installed from valve_clearances where task_id='".$_GET['id']."' AND valvenum='".$valve_num."'");
		$clearance=mysqli_fetch_array($clearance);
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