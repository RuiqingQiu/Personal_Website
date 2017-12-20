<?php session_start();
?>

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
	{
		if (empty($_POST['place']) || empty($_POST['time']) || empty($_POST['num']) 
		|| empty($_POST['note']) || empty($_POST['password']))
		{		
			echo "Failure!";
		}
		else
		{
			$numberOfPeople = $_POST['num'];
			
			if($numberOfPeople > 10)
			{
				echo "<script type='text/javascript'>alert('人数不得大于10人');</script>";
				echo "<script>window.location.href='rider.php'</script>";
			}
			else if($numberOfPeople <= 0)
			{
				echo "<script type='text/javascript'>alert('人数不能是负数');</script>";
				echo "<script>window.location.href='rider.php'</script>";
			}
			else
			{
			
				$month = substr($_POST['time'],0,2);
				$date = substr($_POST['time'],3,2);
				$year = substr($_POST['time'],6,4);		
			
				//get the current year month date
				$currentMonth=date("m");
				$currentDate=date("d");
				$currentYear=date("Y");	
			
				//Error checking if the date is before the current date
				//When the input year is less than current year, give error message
				if($currentYear > $year)
				{	
					echo "<script type='text/javascript'>alert('输入日期早于当前日期!');</script>";
					echo "<script>window.location.href='rider.php'</script>";
					}
					//When input year is the current year, then check the month
					else if($currentYear == $year)
					{
						//When the input month is less than current month, give error message
					if ($currentMonth > $month)
					{
						echo "<script type='text/javascript'>alert('输入日期早于当前日期!');</script>";
						echo "<script>window.location.href='rider.php'</script>";
					}
					else if ($currentMonth == $month)
					{
						//When the input day is less than current date, give error message
						if ($currentDate > $date)
						{
							echo "<script type='text/javascript'>alert('输入日期早于当前日期!');</script>";
							echo "<script>window.location.href='rider.php'</script>";
						}
						//when the date is equal to or larger than current date 
						else
						{
							$time = $year . "-" . $month . "-" . $date;
							$sql = "INSERT INTO  `ucsdcarpool`.`cp_regular_places` (`place` ,`time` ,`num_limit`, `num_current` , `initiator_id`, `note` ,`password`) VALUES ('".$_POST['place']."','". $time."','".$_POST['num'] ."','0', '".$_SESSION['id']."' , '" . $_POST['note']. "','"  .$_POST['password'] ."')";
							//echo $sql;
							mysql_query($sql);
							echo "<script>window.location.href='passenger.php'</script>";
						}
	
					}
					else
					{
						$time = $year . "-" . $month . "-" . $date;
						$sql = "INSERT INTO  `ucsdcarpool`.`cp_regular_places` (`place` ,`time` ,`num_limit`, `num_current` , `initiator_id`, `note` ,`password`) VALUES ('".$_POST['place']."','". $time."','".$_POST['num'] ."','0', '".$_SESSION['id']."' , '" . $_POST['note']. "','"  .$_POST['password'] ."')";
						//echo $sql;
						mysql_query($sql);
						echo "<script>window.location.href='passenger.php'</script>";
					}
				}
				else
				{
					$time = $year . "-" . $month . "-" . $date;
					$sql = "INSERT INTO  `ucsdcarpool`.`cp_regular_places` (`place` ,`time` ,`num_limit`, `num_current` , `initiator_id`, `note` ,`password`) VALUES ('".$_POST['place']."','". $time."','".$_POST['num'] ."','0', '".$_SESSION['id']."' , '" . $_POST['note']. "','"  .$_POST['password'] ."')";
				//echo $sql;
					mysql_query($sql);
					echo "<script>window.location.href='passenger.php'</script>";
				}
			}
						
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
			$month = substr($_POST['time'],0,2);
			$date = substr($_POST['time'],3,2);
			$year = substr($_POST['time'],6,4);		
			
			//get the current year month date
			$currentMonth=date("m");
			$currentDate=date("d");
			$currentYear=date("Y");	
			
			//Error checking if the date is before the current date
			//When the input year is less than current year, give error message
			if($currentYear > $year)
			{	
				echo "<script type='text/javascript'>alert('输入日期早于当前日期!');</script>";
				echo "<script>window.location.href='rider.php'</script>";
			}
			//When input year is the current year, then check the month
			else if($currentYear == $year)
			{
				//When the input month is less than current month, give error message
				if ($currentMonth > $month)
				{
					echo "<script type='text/javascript'>alert('输入日期早于当前日期!');</script>";
					echo "<script>window.location.href='rider.php'</script>";
				}
				else if ($currentMonth == $month)
				{
					//When the input day is less than current date, give error message
					if ($currentDate > $date)
					{
						echo "<script type='text/javascript'>alert('输入日期早于当前日期!');</script>";
						echo "<script>window.location.href='rider.php'</script>";
					}
					//when the date is equal to or larger than current date 
					else
					{
						$time = $year . "-" . $month . "-" . $date;
						$sql = "INSERT INTO  `ucsdcarpool`.`cp_special_places` ( `place` ,`time` ,`num_limit`, `num_current` , `initiator_id`, `note` ,`password`) VALUES ('".$_POST['place']."','".  $time."','0','0', '".$_SESSION['id']."' ,'" . $_POST['note']. "','0')";
						
						//echo $sql;
						mysql_query($sql);
						echo "<script>window.location.href='passenger.php'</script>";
					}

				}
				else
				{
					$time = $year . "-" . $month . "-" . $date;
					$sql = "INSERT INTO  `ucsdcarpool`.`cp_special_places` ( `place` ,`time` ,`num_limit`, `num_current` , `initiator_id`, `note` ,
			`password`) VALUES ('".$_POST['place']."','".  $time."','0','0', '".$_SESSION['id']."' ,'" . $_POST['note']. "','0')";
					//echo $sql;
					mysql_query($sql);
					echo "<script>window.location.href='passenger.php'</script>";
				}
			}
			else
			{
				$time = $year . "-" . $month . "-" . $date;
				$sql = "INSERT INTO  `ucsdcarpool`.`cp_special_places` ( `place` ,`time` ,`num_limit`, `num_current` , `initiator_id`, `note` ,`password`) VALUES ('".$_POST['place']."','".  $time."','0','0', '".$_SESSION['id']."' ,'" . $_POST['note']. "','0')";
			//echo $sql;
				mysql_query($sql);
				echo "<script>window.location.href='passenger.php'</script>";
			}
			
		}
	}
	else
	{
		echo "Unknown Error!";
	}
}

?>
