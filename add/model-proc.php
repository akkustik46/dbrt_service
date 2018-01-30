<?php

include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,'dbrt_garage');
mysqli_query($db,"SET NAMES 'utf8'");
$mnf_cnt=mysqli_num_rows(mysqli_query($db,"SELECT id FROM mnf WHERE mnf_name='".$_POST['mnf']."'"));
echo $mnf_cnt;
if ($mnf_cnt==0) {
			mysqli_query($db,"INSERT INTO mnf (mnf.mnf_name) VALUES ('".$_POST['mnf']."')");
			mysqli_query($db,"INSERT INTO models (models.model, models.capacity, models.mnf_id, models.year_begin, models.year_end, models.comment, models.cylinders, 
			models.valves_per_cyl, models.eng_type) 
			VALUES ('".$_POST['model']."', '".$_POST['eng']."', '".mysqli_insert_id($db)."','".$_POST['year_begin']."',
			'".$_POST['year_end']."', '".$_POST['comment']."', '".$_POST['cyl']."', '".$_POST['valve']."', '".$_POST['eng_type']."')");
			mysqli_query($db,"INSERT INTO tech_data (tech_data.model_id, tech_data.valve_in, tech_data.valve_ex, tech_data.fork_oil_cap, tech_data.fork_oil_level, tech_data.fork_oil_type) 
			VALUES (
			'".$_POST['valve_in']."', '".$_POST['valve_ex']."', '".$_POST['fork_cap']."', '".$_POST['fork_lev']."', '".$_POST['fork_oil_type']."')");
			
			    } else {
			$mnf=mysqli_query($db,"SELECT id FROM mnf WHERE mnf_name='".$_POST['mnf']."'");
			$mnf=mysqli_fetch_array($mnf);
			mysqli_query($db,"INSERT INTO models (models.model, models.capacity, models.mnf_id, models.year_begin, models.year_end, models.comment, models.cylinders,
			models.valves_per_cyl, models.eng_type)
			VALUES ('".$_POST['model']."', '".$_POST['eng']."', '".$mnf['id']."','".$_POST['year_begin']."',
			'".$_POST['year_end']."', '".$_POST['comment']."', '".$_POST['cyl']."', '".$_POST['valve']."', '".$_POST['eng_type']."')");

			//printf(mysqli_error($db));
			$model_id=mysqli_insert_id($db);
			mysqli_query($db,"INSERT INTO tech_data (tech_data.model_id, tech_data.valve_in, tech_data.valve_ex, tech_data.fork_oil_cap, tech_data.fork_oil_level, tech_data.fork_oil_type)
			VALUES ('".$model_id."','".$_POST['valve_in']."', '".$_POST['valve_ex']."', '".$_POST['fork_cap']."', '".$_POST['fork_lev']."', '".$_POST['fork_oil_type']."')");
			//printf(mysqli_error($db));
			}
echo "Добавлен!";
mysqli_close($db);
include('../footer.php');

?>
<script>
var tm=3000
window.setTimeout("opener.window.location.reload(); window.close();",tm)
</script>
