<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php

include_once '../lib/common.php';
include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/user.php';
//include_once '../user/interceptor.php';

//session_start();
//header('Cache-control:private');
mysql_query("set names utf8");
if (isset($_GET['post-regular'])) 
{
//echo $_POST['name'];

	if (isset($_POST['place']) && isset($_POST['time']) && isset($_POST['num']) 
	&& isset($_POST['note']) && isset($_POST['password'])) 
	{echo "1";
		if (empty($_POST['place']) || empty($_POST['time']) || empty($_POST['num']) 
		|| empty($_POST['note']) || empty($_POST['password']))
		{		
			echo "Failure!";
		}
		else
		{
			$sql = "INSERT INTO  `db_cp`.`cp_regular_places` ( `place` ,`time` ,`num_limit`, `num_current` ,`note` ,
			`password`) VALUES ('". $_POST['place']."','".  $_POST['time'] ."','".
			$_POST['num'] ."','0','" . $_POST['note']. "','"  .$_POST['password'] ."')";
			echo $sql;
			mysql_query($sql);
			echo "Success!";
		}
	}
	else
	{
		echo "Unknown Error!";
	}
}
else if (isset($_GET['post-special'])) 
{
//echo $_POST['name'];
	if (isset($_POST['place']) && isset($_POST['time']) && isset($_POST['note'])) 
	{
		if (empty($_POST['place']) || empty($_POST['time']) || empty($_POST['note']))
		{		
			echo "Failure!";
		}
		else
		{
			$sql = "INSERT INTO  `db_cp`.`cp_special_places` (`place` ,`time` ,`num_limit`, `num_current` ,`note` ,
			`password`) VALUES ('".$_POST['place']."','".  $_POST['time'] ."','0','0','" . $_POST['note']. "','0')";
			//echo $sql;
			mysql_query($sql);
			echo "Success!";
		}
	}
	else
	{
		echo "Unknown Error!";
	}
}

?>
