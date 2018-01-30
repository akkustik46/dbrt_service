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
$wgr_query = mysqli_query($dbq,"SELECT * from works_groups");
$wgr = array();
while($wgr_lst = mysqli_fetch_array($wgr_query)) {
	$wrk_query=mysqli_query($dbq,"SELECT id,name from works_types where group_id='".$wgr_lst['id']."'");
	    $types[$wgr_lst['id']]=array();
	while ($wrk_lst=mysqli_fetch_array($wrk_query)) {
	$types[$wgr_lst['id']]=$types[$wgr_lst['id']] + array($wrk_lst['id']=>$wrk_lst['name']);
	}
}

$cat_query = mysqli_query($dbq,"SELECT * from prod_category");
$cat = array();
while($cat_lst = mysqli_fetch_array($cat_query)) {
	$prod_query=mysqli_query($dbq,"SELECT id,name from prod_prod where category='".$cat_lst['id']."'");
	    $prodtypes[$cat_lst['id']]=array();
	while ($prod_lst=mysqli_fetch_array($prod_query)) {
	$prodtypes[$cat_lst['id']]=$prodtypes[$cat_lst['id']] + array($prod_lst['id']=>$prod_lst['name']);
	}
}

/*
$types = array(
    1 => array(
	// Наземный транспорт
	1 => 'Железнодорожный транспорт',
	2 => 'Автомобильный транспорт',
	3 => 'Ручной транспорт'
    ),
    2 => array(
	// Водный транспорт
	1 => 'Речной транспорт',
	2 => 'Морской транспорт',
	3 => 'Подводный транспорт'
    ),
    3 => array(
	// Воздушный транспорт
	1 => 'Самолеты',
	2 => 'Вертолеты',
	3 => 'Ракета (шаттл)'
    )
);*/
/*$kinds = array(
    // Наземный транспорт
    1 => array(
	// Железнодорожный транспорт
	1 => array(
	    1 => 'Электропоезд',
	    2 => 'Дизельный поезд',
	    3 => 'Дрезина'
	),
	// Автомобильный транспорт
	2 => array(
	    1 => 'Легковой автомобиль',
	    2 => 'Грузовой автомобиль',
	    3 => 'Автобус'
	),
	// Ручной транспорт
	3 => array(
	    1 => 'Тачка',
	    2 => 'Тележка',
	    3 => 'Велосипед'
	)
    ),
    // Водный транспорт
    2 => array(
	// Речной транспорт
	1 => array(
	    1 => 'Трамвай',
	    2 => 'Теплоход',
	    3 => 'Ракета'
	),
	// Морской транспорт
	2 => array(
	    1 => 'Крейсер',
	    2 => 'Круизный лайнер',
	    3 => 'Баржа'
	),
	// Подводный транспорт
	3 => array(
	    1 => 'Подводная лодка',
	    2 => 'Батискаф',
	    3 => 'Капсула смерти'
	)
    ),
    // Воздушный транспорт
    3 => array(
	// Самолет
	1 => array(
	    1 => 'Боинг',
	    2 => 'Аэробус',
	    3 => 'Руслан'
	),
	// Вертолеты
	2 => array(
	    1 => 'МИ',
	    2 => 'Апач',
	    3 => 'Черная акула'
	),
	// Ракета (шаттл)
	3 => array(
	    1 => 'Союз',
	    2 => 'Апполон',
	    3 => 'Дискавери',
	    4 => 'Буран'
	)
    )
);
*/
if (isset($_GET['action']) && $_GET['action'] == 'getWork')
{
    if (isset($types[$_GET['types']]))
    {
        echo json_encode($types[$_GET['types']],JSON_UNESCAPED_UNICODE); // возвращаем данные в JSON формате;
    }
    else
    {
        echo json_encode(array('Выберите тип'),JSON_UNESCAPED_UNICODE);
    }

    exit;
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
mysqli_close($dbq);
?>