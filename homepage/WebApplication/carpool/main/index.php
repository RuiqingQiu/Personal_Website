<?php
	session_start();
include_once '../lib/common.php';
include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/user.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<head>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/status.css" />
	<link rel="stylesheet" type="text/css" href="../css/header.css" />
	<link rel="stylesheet" type="text/css" href="../css/footer.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<title>UCSD CSSA Carpool</title>
	<link rel="shortcut icon" href="../img/carpoolIcon.ico">
</head>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >

<body>
	<div class="header">
		<?php
			include_once '../lib/header.php';?>
	</div>
	
	<div class="centered">
	<a class="mainBtn" href="../business/rider.php?get=get"><img style="vertical-align:middle" src="../img/givearide_off.png" width = "200" height="100" onmouseover="this.src='../img/givearide_on.png'" onmouseout="this.src='../img/givearide_off.png'" /></a>
	
	<a class="mainBtn" href="../business/passenger.php"><img style="vertical-align:middle" src="../img/needaride_off.png" width = "200" height="100" onmouseover="this.src='../img/needaride_on.png'" onmouseout="this.src='../img/needaride_off.png'" /></a>
	</div>
	
	<div id="startPageBackgroundImg"><image src="../img/CarPool_bg.jpg"></image></div>
	
	<div class="footer">
	<?php
		include_once '../lib/footer.php';?>
	</div>

</body>
</html>

