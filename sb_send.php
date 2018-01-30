<?php 
if (isset($_SESSION['login'])) {
header('Refresh: 1; location: index.php');
exit;
}
if (!isset($_GET['action'])) { $_GET['action']='all'; }
include('top3.php');
include('menu.php');



$usr_lst_query=mysqli_query($db, "SELECT users.id, users.name FROM users ORDER BY users.name");
while ($usr_lst = mysqli_fetch_array($usr_lst_query)) {
    //  $usr_lst_array[] = array('id' => $usr_lst['id'],
    //                             'name' => $usr_lst['name']);
	$usr_id[]=array($usr_lst['id']);
	$usr_name[]=array($usr_lst['name']);
}
?>

<script language="javascript">
function add_input(obj){
	//var arrayID = [0,1,2,3,4,5];
	//var arrayName = ["a","b","c","d","f"];
	var arrayID = <?php echo json_encode($usr_id); ?>;		//	php id array to js array
	var arrayName = <?php echo json_encode($usr_name); ?>;	//	php name array to js array

	var arrayDBLength = arrayID.length;
	var newOption = new Array();
	
	divInputi = document.getElementById("inputi");					
	inputElems = divInputi.getElementsByTagName("select");			// собираем все элементы с тэгом select
	
	var newDiv = document.createElement('div');						// создаем элементы с тэгом div
	newDiv.setAttribute("id","div_" + inputElems.length);			// создаем атрибуты в новом div
	
	var newSelect = document.createElement('select');				// создаем элементы с тэгом select
	
	newSelect.setAttribute('name',"user_" + inputElems.length);							// создаем атрибуты в новом select
	newSelect.setAttribute('size',"1");
	newDiv.innerHTML =  "<br> <input type='text' name='input_" + inputElems.length + "' size='40'>";	// добавляем текстовый инпут в новый div
	
	for(var jj=0;jj<arrayDBLength;jj++){							// по количеству записей id в БД создаем элементы option
		newOption[jj] = document.createElement('option');			// создаем элементы с тэгом option
		newOption[jj].setAttribute("value",arrayID[jj]);			// создаем атрибуты value = id в новом option
		newOption[jj].text = arrayName[jj];							// передаем в option из БД параметр name
		newSelect.appendChild(newOption[jj]);						// добавляем в новый select  option`сы
	}
	newDiv.appendChild(newSelect);									// добавляем в новый div select`ы
	newDiv.innerHTML=newDiv.innerHTML + "<input type='button' value='+' onclick='add_input(this.parentNode)'/>";	// добавляем в новый div кнопку +
	newDiv.innerHTML=newDiv.innerHTML + "<input type='button' value='-' onclick='del_input(this.parentNode)'/>";	// добавляем в новый div кнопку -
	divInputi.appendChild(newDiv);									// добавляем в div inputi новый div

	if(inputElems.length>0 )										
		document.getElementById("add").style.display  ="none";
}
function del_input(obj){
	document.getElementById('inputi').removeChild(obj);
	if(inputElems.length==0 )
		document.getElementById("add").style.display = "block";
}
</script>

 <form name="test" method="post" action="#"  style="
    position: absolute;
    top: 144;
    left: 80px;">
  <p>
	<form name="form" id="form" action="#" method="post" style="
		position: absolute;
		top: 144;
		left: 80px;">
		<div id="inputi">
			<!--Сюда будет вставлятся текстовый инпут + 2 кнопки: +/- -->
		<input type="button" id="add" value="+" onclick="add_input(this.parentNode)">
		</div>
		
		<input name="frm_sbm" type="submit" value="Submit request">
	</form>

</p>


<?php
if ($_POST) {
$i=0;
$query='';
unset($_POST['frm_sbm']);
foreach ($_POST as $key => $value) {
//     echo "[{$key}] => {$value} <br/>";
    if (preg_match('/^input_/', $key)) {
	$query.="INSERT INTO new_sb_toeval (new_sb_toeval.name, new_sb_toeval.user, new_sb_toeval.eval) VALUES ('".$value."', '";
//	echo $key."=".$value;
			}
    if (preg_match('/^user_/', $key)) {
	    $query.=$value."', '0');\r\n";
    
	}
	//echo 'input_'.preg_match('/^input_/', $key);
    //echo $_POST[$abc];
    }
//echo($query);
mysqli_multi_query($db, $query);
//print_r(mysql_result());
}
//print_r($_POST);
//print_r(json_encode($usr_name));
//print_r(json_encode($usr_id));
include('footer.php');
?>
