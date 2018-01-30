<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'dbrt_garage');
mysqli_query($db,"SET NAMES 'utf8'");
?>
<form action="prod-sale-proc.php" method="post">
<input type=hidden value='prod_sale' name='tbl'>
<?php 

$cat_lst_query=mysqli_query($db,"SELECT * FROM prod_category");
$prod_lst_query=mysqli_query($db,"SELECT * FROM prod_prod");
//$wrkgr_lst=mysql_fetch_array($wrkgr_lst_query,MYSQL_ASSOC);
//print_r($wrkgr_lst);
echo "<script language='javascript'>\n".
	    "var items=1;\n".
	    "function AddItem() {\n".
  "div=document.getElementById(\"items\");\n".
  "button=document.getElementById(\"add\");\n".
  "items++;\n".
  "newitem=\"<select name='cat[\" + items+ \"]' size='1' onchange='loadProd(this)'><option></option>\";\n";
while ($cat_lst=mysqli_fetch_array($cat_lst_query)) {
	$cat_lst_array[] = array('id' => $cat_lst['id'],
                                 'name' => $cat_lst['name']);
echo "newitem+=\"<option value='".$cat_lst['id']."'>".$cat_lst['name']."</option>\";\n";
}
  echo "newitem+=\"</select>&nbsp\";\n".
  "newitem+=\"<select name='prod[\" + items;\n".
  "newitem+=\"]' id='cat[\" + items + \"]' disabled='disabled'>\";\n";
while ($prod_lst=mysqli_fetch_array($prod_lst_query)) {
	$prod_lst_array[] = array('id' => $prod_lst['id'],
                                 'name' => $prod_lst['name']);
echo "newitem+=\"<option value='".$prod_lst['id']."'>".$prod_lst['name']."</option>\";\n";
}

    echo "newitem+=\"</select>&nbsp\";\n";
    echo "newitem+=\"<input type=text size=5 name='qty[\" + items + \"]'></td>\";\n".
  "newnode=document.createElement(\"tr\");\n".
  "newnode.innerHTML=newitem;\n".
  "div.insertBefore(newnode,button);\n".
"}\n".
"</script>\n"; ?>


<div ID="items">

<select name="cat[1]" onchange="loadProd(this)">
    <option></option>

    <?php
    $cat_lst_query=mysqli_query($db,"SELECT * FROM prod_category");
    while ($cat_lst=mysqli_fetch_array($cat_lst_query)) { 
		$cat=array('id'=>$cat_lst['id'],
				'name'=>$cat_lst['name']);
	// заполняем список областей
    ///foreach ($wrkgr_lst['name'] as $id => $name)
    ///{
	
        echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>' . "\n";
    ///}
    }
///foreach ($wrkgr as $id => $name) {
///	echo '<option value="' . $id . '">' . $name . '</option>' . "\n";
///    }

    ?>

</select>
<select name="prod[1]" id="cat[1]" disabled="disabled">
    <option>Выберите тип</option>
</select>
<input type=text size=5 name='qty[1]'>
<br>
<input type="button" value="+" onClick="AddItem();" ID="add">

</div>
<input type="submit" value="Сохранить">

