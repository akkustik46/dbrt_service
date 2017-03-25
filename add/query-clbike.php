<?php
session_start();
require('../config.php');
$dbq=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($dbq,'dbrt_garage');
mysqli_query($dbq,"SET NAMES 'utf8'");

/**
 * @author Evgeni Lezhenkin evgeni@lezhenkin.ru http://lezhenkin.ru
 * 
 * Скрипт, обрабатывающий POST-запросы от JavaScript-сценариев
 * Скрипт получает строку запроса, а в ответ отправляет массив с данными
 */
// Непосредственно для этого скрипта мы создадим здесь массивы, в которых будут храниться
// значения, запрашиваемые JavaScript-сценарием. В ваших сценариях этих массивов, скорее всего,
// не будет. Информация, подобная этой, будет в вашей базе данных, и вам её придется оттуда 
// извлечь. Как вы это сделаете, это уже ваши предпочтения
$cli_query = mysqli_query($dbq,"SELECT id,username from clients");
$cli = array();
while($cli_lst = mysqli_fetch_array($cli_query)) {
	$bike_query=mysqli_query($dbq,"SELECT id,model from bike where owner='".$cli_lst['id']."'");
	    $bikes[$cli_lst['id']]=array();
	while ($bike_lst=mysqli_fetch_array($bike_query)) {
		$model_name=mysqli_query($dbq,"select (select mnf_name from mnf where id=(select mnf_id from models where id=(SELECT model FROM bike WHERE id='".$bike_lst['id']."'))) as make, model, capacity from models where id=(SELECT model FROM bike WHERE id='".$bike_lst['id']."')");
		    $model=mysqli_fetch_array($model_name);

		$bikes[$cli_lst['id']]=$bikes[$cli_lst['id']] + array($bike_lst['id']=>$model['make']." ".$model['model']." ".$model['capacity']);
	}
}

if (isset($_GET['action']) && $_GET['action'] == 'getBikes')
{
    if (isset($bikes[$_GET['bikes']]))
    {
        echo json_encode($bikes[$_GET['bikes']],JSON_UNESCAPED_UNICODE); // возвращаем данные в JSON формате;
    }
    else
    {
        echo json_encode(array('Выберите клиента'),JSON_UNESCAPED_UNICODE);
    }
 
    exit;
}
/**
 * Данный код не идеален. Сама идея представления исходных данных о транспорте в виде массива очень
 * далека от идеала. И вы должны понимать почему. Данные должны храниться в реляционной базе данных, 
 * а представленный вариант написания сценария является лишь простейшим примером, который не стоит 
 * в таком виде применять на практике. Вы здесь должны лишь понять принципы работы языка и взаимодействия
 * между языками программирования
 */
//session_close();
mysqli_close($dbq);
?>
    