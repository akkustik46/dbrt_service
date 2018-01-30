<?php 
$wrkgr_lst_query=mysqli_query($db,"SELECT * FROM works_groups");
$wrk_lst_query=mysqli_query($db,"SELECT * FROM works_types");

echo "<script language='javascript'>\n".
	    "var items=1;\n".
	    "function AddItem() {\n".
  "div=document.getElementById(\"items\");\n".
  "button=document.getElementById(\"add\");\n".
  "items++;\n".
  "newitem=\"<br><strong>Поле \" + items + \": </strong>\";\n".
  "newitem+=\"<select name='w_gr[\" + items+ \"]' size='1'>\";\n";
while ($wrkgr_lst=mysqli_fetch_array($wrkgr_lst_query)) {
	$wrkgr_lst_array[] = array('id' => $wrkgr_lst['id'],
                                 'name' => $wrkgr_lst['name']);
echo "newitem+=\"<option value='".$wrkgr_lst['id']."'>".$wrkgr_lst['name']."</option>\";\n";
}
  echo "newitem+=\"</select>\";\n".
  "newitem+=\"<select name='wrk[\" + items;\n".
  "newitem+=\"]' size='1'>\";\n";
while ($wrk_lst=mysqli_fetch_array($wrk_lst_query)) {
	$wrk_lst_array[] = array('id' => $wrk_lst['id'],
                                 'name' => $wrk_lst['name']);
echo "newitem+=\"<option value='".$wrk_lst['id']."'>".$wrk_lst['name']."</option>\";\n";
}

    echo "\"</select><br>\";\n".
  "newnode=document.createElement(\"span\");\n".
  "newnode.innerHTML=newitem;\n".
  "div.insertBefore(newnode,button);\n".
"}\n".
"</script>\n"; ?>
<div ID="items">
<strong>Поле 1: </strong><select name="w_gr1" size="1"><option>1</option><option>2</option></select>
<select name="wrk1" size="1"><option>1</option><option>2</option></select>
<br>
<input type="button" value="Добавить поле" onClick="AddItem();" ID="add">
</div>

