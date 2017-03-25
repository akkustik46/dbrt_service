<?php 
$wrkgr_lst_query=mysqli_query($db,"SELECT * FROM works_groups");
$wrk_lst_query=mysqli_query($db,"SELECT * FROM works_types");
//$wrkgr_lst=mysql_fetch_array($wrkgr_lst_query,MYSQL_ASSOC);
//print_r($wrkgr_lst);
echo "<script language='javascript'>\n".
	    "var items=1;\n".
	    "function AddItem() {\n".
  "div=document.getElementById(\"items\");\n".
  "button=document.getElementById(\"add\");\n".
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
  "newnode=document.createElement(\"p\");\n".
  "newnode.innerHTML=newitem;\n".
  "div.insertBefore(newnode,button);\n".
"}\n".
"</script>\n"; ?>

<div ID="items">
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
    <option>Выберите тип</option>
</select>
<br>
<input type="button" value="Добавить поле" onClick="AddItem();" ID="add">
</div>

