<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<meta http-equiv="refresh" content="3;url=../business/passenger.php"/>

<?php

include_once '../lib/common.php';
include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/user.php';

//session_start();

//header('Cache-control:private');
mysql_query("set names utf8");
if (isset($_GET['id'])) 
{
//echo $_POST['name'];
	if (isset($_POST['password'])) 
	{
		if (empty($_POST['password']))
		{		
			echo "Failure!";
		}
		else
		{
			$sql = "SELECT * FROM `ucsdcarpool`.`cp_regular_places` WHERE `id`='". $_GET['id']."'";
			$re=mysql_query($sql) or die('Cannot Execute:'. mysql_error());

		$row=mysql_num_rows($re);
		$row2=mysql_fetch_array($re);

			if ($row2['password'] == $_POST['password'])
			{
				$num_people=$row2['num_current']+1;
				$sql = "UPDATE `ucsdcarpool`.`cp_regular_places` SET `num_current`=".$num_people ." WHERE `id` = '". $_GET['id']."'";
				mysql_query($sql);
				echo "Success! You are in!\n";
				echo "Refresh in 3 seconds";
			}
			else
			{
				echo "Failure!!refresh in 3 seconds...";
			}
		}
	}
	else
	{
		echo "Unknown Error!";
	}
}

?>
