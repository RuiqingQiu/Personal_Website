<?php

include_once '../lib/db.php';
include_once '../lib/functions.php';
include_once '../lib/common.php';
	
	if(isSet($_POST['reg_email']))
	{
		$email = $_POST['reg_email'];

		$dbHost = '50.63.226.198'; // usually localhost
		$dbUsername = 'ucsdcarpool';
		$dbPassword = 'Qy7QbqjSr8@w';
		$dbDatabase = 'ucsdcarpool';
		
		$db = mysql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database Server.");
		mysql_select_db ($dbDatabase, $db) or die ("Could not select database.");
		
		$result1=mysql_query("select * from `ucsdcarpool`.`cp_user` where `email`='".$email."'");
		$row=mysql_num_rows($result1);
				
		if($row)
		{
			echo '<font color="red">The email <STRONG>'.$email.'</STRONG> is already in use.</font>';
		}
		else
		{
			echo 'OK';
		}

	}
?>