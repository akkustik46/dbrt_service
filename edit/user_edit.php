<?php
include('../top2.php');
require('../config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('helpdesk');
mysql_query("SET NAMES 'utf8'");
//$dep_lst_query=mysql_query("SELECT departaments.id, departaments.dep_name FROM departaments ORDER BY departaments.dep_name asc");
//$loc_lst_query=mysql_query("SELECT locations.id, locations.building, buildings.room FROM locations ORDER BY locations.building, buildings.room");
$phones_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^380' or phones.num RLIKE '---')order by phones.num");
$travel_lst_query=mysql_query("SELECT * FROM phones WHERE (phones.num RLIKE '^3725' or phones.num RLIKE '---') order by phones.num");
$usr_data=mysql_query("SELECT * FROM users where users.id='".$_GET['id']."'");
$usr_data=mysql_fetch_array($usr_data);
$ws_query=mysql_query("SELECT * FROM workstations");
$dep_lst_query=mysql_query("SELECT * FROM departments order by dep_name")
?>
<form action="user-proc.php" method="post">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
Редактировать пользователя<br>
<table border=0>
<tr><td>Фамилия:</td><td><input type="text" name="last_name" size="30" value="<?php echo $usr_data['last_name']; ?>"></td></tr>
<tr><td>Имя:</td><td><input type="text" name="first_name" size="30" value="<?php echo $usr_data['first_name']; ?>"></td></tr>
<tr><td>Отчество:</td><td><input type="text" name="father_name" size="30" value="<?php echo $usr_data['father_name']; ?>"></td></tr>
<tr><td>Local login:</td><td><input type="text" name="login" size="30" value="<?php echo $usr_data['local_login']; ?>"></td></tr>
<tr><td>Password:</td><td><input type="text" name="passwd" size="30" value="<?php echo $usr_data['local_pwd']; ?>"></td></tr>
<tr><td>E-Mail:</td><td><input type="text" name="mail_login" size="30" value="<?php echo $usr_data['email']; ?>"></td></tr>
<tr><td>Mail passwd:</td><td><input type="text" name="mail_passwd" size="30" value="<?php echo $usr_data['email_pwd']; ?>"></td></tr>
<tr><td>Тел МТС:</td>
<td>
<select name="phone_mts" size=1>
<?php
while ($phones_lst = mysql_fetch_array($phones_lst_query)) {
      $phones_lst_array[] = array('phones_id' => $phones_lst['id'],
                                 'phones_num' => $phones_lst['num']);

?>
<option value=" <?php echo ($phones_lst['id']); echo "\""; if ($phones_lst['id']==$usr_data['tel_mts']) {echo "selected='selected'";} ?> > <?php echo ($phones_lst['num']); ?> </option>
<?php
}
?>
</select>
</td></tr>

<tr><td>Тел TravelSim:</td>
<td>
<select name="phone_travel" size=1>
<?php
while ($travel_lst = mysql_fetch_array($travel_lst_query)) {
      $travel_lst_array[] = array('travel_id' => $travel_lst['id'],
                                 'travel_num' => $travel_lst['num']);

?>
<option value=" <?php echo ($travel_lst['id']); echo "\""; if ($travel_lst['id']==$usr_data['tel_travel']) {echo "selected='selected'";} ?> "> <?php echo ($travel_lst['num']); ?> </option>
<?php
}

?>
</select>
</td></tr>
<?php
/*
<tr><td>WS:</td>
<td>
<select name="ws" size=1>
<?php
while ($ws = mysql_fetch_array($ws_query)) {
      $ws_array[] = array('ws_id' => $ws['ws_id'],
                                 'ws_name' => $ws['ws_name']);

?>
<option value=" <?php echo ($ws['ws_id']); echo "\""; if ($ws['ws_id']==$usr_data['ws_id']) {echo "selected='selected'";} ?> "> <?php echo ($ws['ws_name']); ?> </option>
<?php
}
?>
</select>
</td></tr>
*/
?>
<tr><td>Здание:</td>
<td> 
<select name="loc_id" size="1">
<?php
while ($loc_lst = mysql_fetch_array($loc_lst_query)) {
      $loc_lst_array[] = array('loc_id' => $loc_lst['id'],
                                 'loc_building' => $loc_lst['building'],
                                 'loc_room' => $loc_lst['room']);

?>
<option value=" <?php echo ($loc_lst['id']); ?> "> <?php echo ($loc_lst['building'] . ' к.' . $loc_lst['room']); ?> </option>
<?php
}
?>
</select>
</td></tr>
<tr><td> 
Отдел:</td><td><select name="depart" size="1">
<?php while ($dep_lst = mysql_fetch_array($dep_lst_query)) {
      $dep_lst_array[] = array('dep_id' => $dep_lst['dep_id'],
        		       'dep_name' => $dep_lst['dep_name']);

?>
<option value="<?php echo ($dep_lst['dep_id']); ?>" <?php if ($dep_lst['dep_id']==$usr_data['dep_id']) {echo "selected=\"selected\""; } ?>> <?php echo ($dep_lst['dep_name']); ?> </option>
<?php } ?>
</select>
</td></tr>
<tr><td>Должность:</td><td><input type="text" name="position" size="30" value="<?php echo($usr_data['position']); ?>"></td></tr>
<tr><td>Lido login:</td><td><input type="text" name="lido_log" size="30" value=""></td></tr>
<tr><td>Lido passwd:</td><td><input type="text" name="lido_pass" size="30" value=""></td></tr>
<tr><td width=100%><center><input type="submit" value="Сохранить"></center></td></tr>
</table>
</form>
<?php
include('../footer.php');
?>
