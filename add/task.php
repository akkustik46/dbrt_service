<?php
session_start();
include('../top2.php');
require('../config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");
?>

<style type="text/css">
		/* These styles are for the documentation only */
		body	{ font-family:'Trebuchet MS',serif; background-color:#eee }
		
	</style>


</head><body>
<h1><span id="ver"></span></h1>


<div id="pagecontent">

<h2 class="tabset_label">ÐÐ¾Ð²Ð°Ñ Ð·Ð°Ð´Ð°Ñ‡Ð°</h2>
<ul class="tabset_tabs">
	<li class="firstchild"><a href="#bike" class="preActive active">ÐœÐ¾Ñ‚Ð¾Ñ†Ð¸ÐºÐ»</a></li><li><a class="preActive postActive" href="#works">Ð Ð°Ð±Ð¾Ñ‚Ñ‹</a></li><li><a class="preActive" href="#stepbystep">Step By Step</a></li><li><a class="" href="#notes">Notes</a></li>
</ul>

<form action="task-proc.php" method="post">
<div id="bike" class="tabset_content tabset_content_active">
	<h2 class="tabset_label">ÐœÐ¾Ñ‚Ð¾Ñ†Ð¸ÐºÐ»</h2>
	<p><?php include('task-client.php');?></p>
</div>


<div id="works" class="tabset_content">
	<h2 class="tabset_label">Ð Ð°Ð±Ð¾Ñ‚Ñ‹</h2>
	<p><?php include('task-test.php');
	    ?></p>
</div>
	
<div id="stepbystep" class="tabset_content">
	<h2 class="tabset_label">Step-by-Step</h2>
	<p><?php //include('task-test.php');
	    ?></p>
</div>



<div id="notes" class="tabset_content">
	<h2 class="tabset_label">Notes</h2>
	<p>Âêëàäêà ¹4</p>
</div>


<center><input type="submit" value="Ð”Ð¾Ð±Ð°Ð²Ð¸Ñ‚ÑŒ"></center>
</div>
</form>
<p class="byline" id="copyright">&nbsp;</p>

</body></html>
