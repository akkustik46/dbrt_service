<?php 
$cat_lst_query=mysqli_query($db,"SELECT * FROM prod_category");
$prod_lst_query=mysqli_query($db,"SELECT * FROM prod_prod");

//$wrkgr_lst=mysql_fetch_array($wrkgr_lst_query,MYSQL_ASSOC);
//print_r($wrkgr_lst);

echo "<script language='javascript'>\n".
	    "var items2=1;\n".
	    "function AddProd() {\n".
  "divprod=document.getElementById(\"prod\");\n".
  "buttonprod=document.getElementById(\"add_prod\");\n".
  "items2++;\n".
  "newitem2=\"<select name='cat[\" + items2+ \"]' size='1' onchange='loadProd(this)'>\";\n";
while ($cat_lst=mysqli_fetch_array($cat_lst_query)) {
	$cat_lst_array[] = array('id' => $cat_lst['id'],
                                 'name' => $cat_lst['name']);
echo "newitem2+=\"<option value='".$cat_lst['id']."'>".$cat_lst['name']."</option>\";\n";
}
  echo "newitem2+=\"</select>\";\n".
  "newitem2+=\"<select name='prod[\" + items2;\n".
  "newitem2+=\"]' id='cat[\" + items2 + \"]' disabled='disabled'>\";\n";
while ($prod_lst=mysqli_fetch_array($prod_lst_query)) {
	$prod_lst_array[] = array('id' => $prod_lst['id'],
                                 'name' => $prod_lst['name']);
echo "newitem2+=\"<option value='".$prod_lst['id']."'>".$prod_lst['name']."</option>\";\n";
}

    echo "newitem2+=\"</select>\";\n";
    echo "newitem2+=\"<input type=text size=5 name='qty[\" + items2 + \"]'>\";\n".
  "newnodeprod=document.createElement(\"tr\");\n".
  "newnodeprod.innerHTML=newitem2;\n".
  "divprod.insertBefore(newnodeprod,buttonprod);\n".
"}\n".
"</script>\n"; ?>


<table cellspacing="1" cellpadding="2" border="0" bgcolor="black">
<tr>
<td bgcolor='white'>Матеріали</td><td bgcolor='white'>Тип</td><td bgcolor='white'>Ціна</td><td bgcolor='white'>Кіл-ть</td><td bgcolor='white'>Разом</td>
</tr>
<?php
////$prod_query=mysql_query("SELECT * from prod_sale WHERE task='".$_GET['id']."'"); 
$prod_query=mysqli_query($db,"SELECT id,(select name from prod_category where id=(select category from prod_prod where id=prod)) as cat, (select name from prod_prod where id=prod) as name, qty, price, (select value from currency where id=(select currency from prod_prod where id=prod)) as cur  from prod_sale WHERE task='".$_GET['id']."'");
$prod_sum=0;
while($prod_lst=mysqli_fetch_array($prod_query)) {
		$task_prod=array('cat'=>$prod_lst['cat'],
				'name'=>$prod_lst['name'],
				'qty'=>$prod_lst['qty'],
				'price'=>$prod_lst['price'],
				'cur'=>$prod_lst['cur'],
				'id'=>$prod_lst['id']);
///$wrk=mysql_query("select works_groups.name as wgr_name, works_types.name as wrk_name from works_groups,works_types where works_groups.id=(SELECT  group_id FROM `works_types` WHERE id='".$task_wrk['type_id']."') and works_types.id='".$task_wrk['type_id']."'");
///$wrk=mysql_fetch_array($wrk,MYSQL_ASSOC);
//$status=mysql_query("SELECT status_name from status WHERE id='".$task_wrk['status']."'");
//$status=mysql_fetch_array($status,MYSQL_ASSOC);
//    if ($task_wrk['status']==1) {$wrk_chk='checked';} else {$wrk_chk='';}
//	$uah=($prod_lst['price']*$prod_lst['cur']);
	echo "<tr><td bgcolor='white'>".$prod_lst['name']."</td><td bgcolor='white'>".$prod_lst['cat']."</td><td bgcolor='white'>".$prod_lst['price']."</td><td bgcolor='white' align=center>".$task_prod['qty']."</td><td bgcolor='white' align=center>".($prod_lst['price']*$task_prod['qty'])."</td>";
$prod_sum=$prod_sum+($prod_lst['price']*$task_prod['qty']);
}
 ?>
<tr><td bgcolor='white'><b>Разом за матеріали</b></td><td bgcolor='white'></td><td bgcolor='white'></td><td bgcolor='white'></td><td bgcolor='white'><b><?php echo $prod_sum; ?></b></td></tr>
<input type=hidden name='prod_sum' value=<?php echo $prod_sum; ?>>
</table>
<div ID="prod">
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
    <option>Оберіть тип</option>
</select>
<input type=text size=5 name="qty[1]">
<br>
<input type="button" value="Добавить поле" onClick="AddProd();" ID="add_prod">
</div>

