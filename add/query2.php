<?php
session_start();
require('../config.php');
$dbq=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($dbq,'dbrt_service');
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
$cat_query = mysqli_query($dbq,"SELECT * from prod_category");
$cat = array();
while($cat_lst = mysqli_fetch_array($cat_query)) {
	$prod_query=mysqli_query($dbq,"SELECT id,name from prod_prod where category='".$cat_lst['id']."'");
	    $prodtypes[$cat_lst['id']]=array();
	while ($prod_lst=mysqli_fetch_array($prod_query)) {
	$prodtypes[$cat_lst['id']]=$prodtypes[$cat_lst['id']] + array($prod_lst['id']=>$prod_lst['name']);
	}
}

if (isset($_GET['action']) && $_GET['action'] == 'getProd')
{
    if (isset($prodtypes[$_GET['types']]))
    {
        echo json_encode($prodtypes[$_GET['types']],JSON_UNESCAPED_UNICODE); // возвращаем данные в JSON формате;
    }
    else
    {
        echo json_encode(array('Выберите тип'),JSON_UNESCAPED_UNICODE);
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
?>