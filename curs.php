<?php

require('config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'service');
mysqli_query($db,"SET NAMES 'utf8'");

$json=file_get_contents('https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');
$j=json_decode($json,true);

//print_r($j);

//print_r ($j[0]);

foreach ($j as $key=>$value){
//print_r($key);
if ($value['ccy']=='USD' || $value['ccy']=='EUR') {
echo($value['ccy'].":".$value['sale']);
$req=mysqli_query($db,"UPDATE currency set value='".$value['sale']."' WHERE name='".$value['ccy']."'");
print_r($req);
}

//	foreach($value as $key2=>$value2) {
//	print_r ($key2);
//	print_r($value2);
//     }


}
mysqli_close($db)
?>